<?php

namespace App\Http\Services\Master;

use App\Models\Tag;
use App\Models\Materi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class   MateriService
{
    /* Get alls */
    public function getAll()
    {
        $data = Materi::with('tags')->orderBy('created_at', 'desc');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('tags', function ($row) {
                return $row->tags->pluck('name')->implode(', ');
            })
            ->filterColumn('tags', function ($query, $keyword) {
                $query->whereHas('tags', function ($q) use ($keyword) {
                    $q->where('tags.name', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('tags', function ($query, $order) {
                $query->withAggregate('tags', 'name')
                    ->orderBy('tags_name', $order);
            })
            ->addColumn('attachment_data', function ($row) {
                $content = '<button href="javascript:void(0);" title="Lihat data materi" id="btn-modal-file"
                        data-id="' . $row->id . '" data-url-get="' . route('master.materi.attachment', $row->id) . '"
                        class="items-center justify-center size-[37.5px] transition-all duration-200 ease-linear p-0 text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 dark:bg-sky-500/20 dark:text-sky-400 dark:hover:bg-sky-500 dark:hover:text-white dark:focus:bg-sky-500 dark:focus:text-white dark:active:bg-sky-500 dark:active:text-white dark:ring-sky-400/20">
                        <i class="ri-file-line"></i>
                        </button>';

                return $content;
            })
            ->addColumn('created_date', function ($row) {
                $content = Carbon::parse($row->created_at)->format('d F Y, H:i');

                return $content;
            })
            ->addColumn('aksi', function ($row) {
                $btnEdit = '';
                $btnDelete = '';
                // Btn Edit
                if (auth()->user()->can('master-materi.update')) {
                    $btnEdit = '<button href="javascript:void(0);" title="Ubah data materi" id="btn-modal-edit"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.materi.update', $row->id) . '" data-url-get="' . route('master.materi.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';
                }

                // Btn Delete
                if (auth()->user()->can('master-materi.delete')) {
                    $btnDelete = '<button href="javascript:void(0);" title="Hapus data materi" id="btn-delete" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('master.materi.destroy', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                        <i class="ri-delete-bin-line"></i>
                        </button>';
                }

                return $btnEdit . ' ' . $btnDelete;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /* Get data by ID */
    public function getById(int $id)
    {
        $data = Materi::with('tags')->findOrFail($id);

        return $data;
    }

    /* Get attachment by ID */
    public function getAttachmentById(int $id)
    {
        $data = Materi::findOrFail($id);

        return response()->download(Storage::disk('local')->path($data->attachment));
    }

    /* Store new data*/
    public function store(array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            if ($attributes['attachment'] != null) {
                $attachmentName = strtotime(now()) . '.' . $attributes['attachment']->getClientOriginalExtension();
                $attachmentPath = Storage::disk('local')->put('materi/' . $attachmentName, file_get_contents($attributes['attachment']));
                $attachment = 'materi/' . $attachmentName;
            }

            $data = Materi::create([
                'title' => $attributes['title'],
                'tag' => $attributes['tag'],
                'description' => $attributes['description'],
                'attachment' => $attachment,
                'attachment_type' => $attributes['attachment_type'] ?? null,
                'user_id' => auth()->user()->id,
            ]);

            $tagIds = [];

            foreach ($attributes['tag'] as $tagName) {
                // Normalize: Title Case each word
                $tagName = Str::title(trim(strtolower($tagName)));

                // Check if exists or create new
                $tag = Tag::firstOrCreate(['name' => $tagName]);

                $tagIds[] = $tag->id;
            }

            // Attach to materi (sync prevents duplicates)
            $data->tags()->sync($tagIds);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Materi berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Materi gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update data*/
    public function update($id, array $attributes)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = Materi::findOrFail($id);

            if ($attributes['attachment'] != null) {
                $attachmentName = strtotime(now()) . '.' . $attributes['attachment']->getClientOriginalExtension();
                $attachmentPath = Storage::disk('local')->put('materi/' . $attachmentName, file_get_contents($attributes['attachment']));
                $attachment = 'materi/' . $attachmentName;
            }

            // Update data data
            $data->update([
                'title' => $attributes['title'] ?? $data->title,
                'tag' => $attributes['tag'] ?? $data->tag,
                'description' => $attributes['description'] ?? $data->description,
                'attachment' => $attachment ?? $data->attachment,
                'attachment_type' => $attributes['attachment_type'] ?? $data->attachment_type,
                'user_id' => auth()->user()->id,
            ]);

            $tagIds = [];

            foreach ($attributes['tag'] as $tagName) {
                // Normalize: Title Case each word
                $tagName = Str::title(trim(strtolower($tagName)));

                // Check if exists or create new
                $tag = Tag::firstOrCreate(['name' => $tagName]);

                $tagIds[] = $tag->id;
            }

            // Attach to materi (sync prevents duplicates)
            $data->tags()->sync($tagIds);

            // Return success response
            DB::commit();
            return redirect()->back()->with('success', 'Materi berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Materi gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }

    /* Delete data*/
    public function delete($id)
    {
        try {
            // DB Transaction
            DB::beginTransaction();

            // Get data
            $data = Materi::findOrFail($id);
            $data->delete();

            // Return success response
            DB::commit();
            return redirect()->route('master.materi.index')->with('success', 'Materi berhasil dihapus');
        } catch (\Exception $e) {
            // Return error response
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Materi gagal dihapus. Error :' . $e->getMessage()]);
        }
    }
}
