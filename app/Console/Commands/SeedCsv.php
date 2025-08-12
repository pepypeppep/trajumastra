<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SeedCsv extends Command
{
    protected $signature = 'seed:csv {directory : Path to the directory containing CSV files}';
    protected $description = 'Seed database tables from CSV files inside a directory (delimiter ;)';

    public function handle()
    {
        $directory = $this->argument('directory');

        if (!File::exists($directory) || !File::isDirectory($directory)) {
            $this->error("Directory not found: $directory");
            return 1;
        }

        $csvFiles = File::files($directory);

        foreach ($csvFiles as $file) {
            if ($file->getExtension() !== 'csv') {
                continue; // Skip non-csv files
            }

            $tableName = pathinfo($file->getFilename(), PATHINFO_FILENAME);

            $this->warn("Processing file: {$file->getFilename()} => table: $tableName");
            $tableColumns = DB::getSchemaBuilder()->getColumnListing($tableName);

            // Debug output
            $this->line("Detected columns in {$tableName}: " . implode(', ', $tableColumns));


            $handle = fopen($file->getRealPath(), 'r');
            if (!$handle) {
                $this->error("Unable to open file: {$file->getFilename()}");
                continue;
            }

            // Read header
            $header = fgetcsv($handle, 0, ';');
            if (!$header) {
                $this->error("No header found in: {$file->getFilename()}");
                fclose($handle);
                continue;
            }
            // Remove BOM from the first header cell (if present)
            $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);

            // Also trim spaces from all headers
            $header = array_map('trim', $header);

            $batchData = [];
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                $rowData = array_combine(str_replace('\u{FEFF}', '', $header), array_map(function ($value) {
                    if (in_array($value, [''])) {
                        return null;
                    }
                    return $value;
                }, $row));

                // Keep only columns that actually exist in DB
                $rowData = array_intersect_key($rowData, array_flip($tableColumns));

                // Remove 'id' if it's auto-increment
                unset($rowData['id']);

                if (!empty($rowData)) {
                    $batchData[] = $rowData;
                }
            }
            fclose($handle);

            if (!empty($batchData)) {
                try {
                    foreach ($batchData as $row) {
                        $existingRow = DB::table($tableName)
                            ->where($row)
                            ->first();

                        if (!$existingRow) {
                            DB::table($tableName)->insert($row);
                        }
                    }
                    $this->info("Inserted " . count($batchData) . " rows into $tableName.");
                } catch (\Exception $e) {
                    $this->error("Error inserting into $tableName: " . $e->getMessage());
                }
            }
        }

        $this->info("All CSV files processed.");
        return 0;
    }
}
