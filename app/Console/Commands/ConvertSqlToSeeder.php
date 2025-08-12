<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConvertSqlToSeeder extends Command
{
    protected $signature = 'convert:sql-to-seeder {input} {outputDir}';
    protected $description = 'Convert INSERT INTO statements from an SQL file into PHP array files, one per table';

    public function handle()
    {
        $inputFile = $this->argument('input');
        $outputDir = rtrim($this->argument('outputDir'), '/');

        if (!file_exists($inputFile)) {
            $this->error("Input file not found: {$inputFile}");
            return Command::FAILURE;
        }

        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        $sql = file_get_contents($inputFile);

        // Match all INSERT INTO `table` (...) VALUES ...;
        preg_match_all('/INSERT\s+INTO\s+`?([a-zA-Z0-9_]+)`?\s*\((.*?)\)\s*VALUES\s*(.+?);/is', $sql, $stmts, PREG_SET_ORDER);

        if (empty($stmts)) {
            $this->error('No INSERT INTO statements found in the SQL file.');
            return Command::FAILURE;
        }

        $tableData = [];

        foreach ($stmts as $stmt) {
            $table = $stmt[1];
            $columnsRaw = $stmt[2];
            $valuesPart = $stmt[3];

            $columns = array_map(function ($c) {
                return trim($c, " `\t\n\r\0\x0B");
            }, explode(',', $columnsRaw));

            $groups = $this->extractParenthesisGroups($valuesPart);

            foreach ($groups as $group) {
                $inner = trim($group);
                if ($inner[0] === '(' && substr($inner, -1) === ')') {
                    $inner = substr($inner, 1, -1);
                }

                $tokens = $this->splitCommaRespectQuotes($inner);
                if (count($tokens) < count($columns)) {
                    $tokens = array_pad($tokens, count($columns), 'NULL');
                }

                $rowAssoc = [];
                foreach ($columns as $i => $col) {
                    $token = trim($tokens[$i]);

                    if (preg_match("/^'(.*)'$/s", $token, $m)) {
                        $raw = str_replace("''", "'", $m[1]);
                        $raw = str_replace("\\'", "'", $raw);
                        $raw = str_replace('\\\\', '\\', $raw);
                        $rowAssoc[$col] = ['type' => 'string', 'value' => $raw];
                    } elseif (strcasecmp($token, 'NULL') === 0) {
                        $rowAssoc[$col] = ['type' => 'null', 'value' => null];
                    } elseif (is_numeric($token)) {
                        if (strpos($token, '.') !== false) {
                            $rowAssoc[$col] = ['type' => 'float', 'value' => (float) $token];
                        } else {
                            $rowAssoc[$col] = ['type' => 'int', 'value' => (int) $token];
                        }
                    } else {
                        $fallback = trim($token, " `");
                        $rowAssoc[$col] = ['type' => 'string', 'value' => $fallback];
                    }
                }

                $tableData[$table][] = $rowAssoc;
            }
        }

        // Save each table's data to its own file
        foreach ($tableData as $table => $rows) {
            $php = "<?php\n\nreturn [\n";
            foreach ($rows as $row) {
                $php .= "    [\n";
                foreach ($row as $col => $info) {
                    $colEsc = addslashes($col);
                    if ($info['type'] === 'null') {
                        $php .= "        '{$colEsc}' => null,\n";
                    } elseif ($info['type'] === 'int' || $info['type'] === 'float') {
                        $php .= "        '{$colEsc}' => {$info['value']},\n";
                    } else {
                        $val = str_replace("'", "\\'", $info['value']);
                        $php .= "        '{$colEsc}' => '{$val}',\n";
                    }
                }
                $php .= "    ],\n";
            }
            $php .= "];\n";

            $filePath = "{$outputDir}/{$table}.php";
            file_put_contents($filePath, $php);
            $this->info("Converted table '{$table}' to {$filePath}");
        }

        $this->info('All conversions completed!');
        return Command::SUCCESS;
    }

    private function extractParenthesisGroups(string $s): array
    {
        $groups = [];
        $len = strlen($s);
        $inQuote = false;
        $depth = 0;
        $start = null;

        for ($i = 0; $i < $len; $i++) {
            $ch = $s[$i];
            if ($ch === "'") {
                if ($inQuote) {
                    if (isset($s[$i + 1]) && $s[$i + 1] === "'") {
                        $i++;
                        continue;
                    } else {
                        $inQuote = false;
                        continue;
                    }
                } else {
                    $inQuote = true;
                    continue;
                }
            }

            if (!$inQuote) {
                if ($ch === '(') {
                    if ($depth === 0) {
                        $start = $i;
                    }
                    $depth++;
                } elseif ($ch === ')') {
                    $depth--;
                    if ($depth === 0 && $start !== null) {
                        $groups[] = substr($s, $start, $i - $start + 1);
                        $start = null;
                    }
                }
            }
        }

        return $groups;
    }

    private function splitCommaRespectQuotes(string $s): array
    {
        $parts = [];
        $len = strlen($s);
        $inQuote = false;
        $start = 0;

        for ($i = 0; $i < $len; $i++) {
            $ch = $s[$i];
            if ($ch === "'") {
                if ($inQuote) {
                    if (isset($s[$i + 1]) && $s[$i + 1] === "'") {
                        $i++;
                        continue;
                    } else {
                        $inQuote = false;
                        continue;
                    }
                } else {
                    $inQuote = true;
                    continue;
                }
            }

            if ($ch === ',' && !$inQuote) {
                $parts[] = substr($s, $start, $i - $start);
                $start = $i + 1;
            }
        }

        $parts[] = substr($s, $start);

        return array_map('trim', $parts);
    }
}
