<?php

namespace App\Http\Services\Settings;

use App\Models\User;
use App\Enums\RoleEnum;
use Spatie\Permission\Models\Role;
use Illuminate\Container\Attributes\DB;
use Yajra\DataTables\Facades\DataTables;

class UsersService
{
    /* Get all users */
    public function getAllUsersForDataTable()
    {
        $users = User::with('roles')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', RoleEnum::DEVELOPER->value);
            })
            ->orderBy('name');

        return Datatables::eloquent($users)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('d M Y H:i');
            })
            ->addColumn('role', function ($row) {
                return $row->getRoleNames()->isNotEmpty() ? $row->getRoleNames()->implode(', ') : '-';
            })
            ->addColumn('aksi', function ($row) {
                // Btn Edit
                $btnEdit = '<button href="javascript:void(0);" title="Edit data pengguna" id="btn-modal-edit-user"
                        data-id="' . $row->id . '"  data-url-action="' . route('settings.users.update', $row->id) . '" data-url-get="' . route('settings.users.edit', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-yellow-500 border-yellow-500 hover:text-white hover:bg-yellow-600 hover:border-yellow-600 focus:text-white focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:border-yellow-600 active:ring active:ring-yellow-100 dark:ring-yellow-400/20">
                        <i class="ri-edit-line"></i>
                        </button>';

                // Btn Delete
                $btnDelete = '<button href="javascript:void(0);" title="Hapus data pengguna" id="btn-modal-delete-user" onclick="confirmDelete(this)"
                        data-id="' . $row->id . '"  data-url-action="' . route('settings.users.destroy', $row->id) . '"
                        class="items-center justify-center size-[37.5px] p-0 text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20">
                        <i class="ri-delete-bin-line"></i>
                        </button>';

                return $btnEdit . ' ' . $btnDelete;
            })
            ->escapeColumns([])
            ->make(true);
    }

    /* Get all roles (except developer) */
    public function getAllRoles()
    {
        return Role::where('name', '!=', 'developer')->get();
    }

    /* Get user by ID */
    public function getUserById(int $id)
    {
        $user = User::findOrFail($id);
        // If you want to include role names, you can add them as an attribute
        $user->role_names = $user->roles->pluck('name')->toArray();
        return $user;
    }

    /* Store new user data */
    public function store(array $data)
    {
        try {
            // DB Transaction
            \DB::beginTransaction();
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
            ]);
            
            // Assign roles
            if (isset($data['roles']) && is_array($data['roles'])) {
                $user->syncRoles($data['roles']);
            }

            // Return success response
            \DB::commit();
            return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan');
        } catch (\Exception $e) {
            // Return error response
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Pengguna gagal ditambahkan. Error :' . $e->getMessage()]);
        }
    }

    /* Update user data */
    public function update(User $user, array $data)
    {
        try {
            // DB Transaction
            \DB::beginTransaction();

            // Update user data
            $user->update([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
            ]);

            // Assign roles
            if (isset($data['roles']) && is_array($data['roles'])) {
                $user->syncRoles($data['roles']);
            }

            // Return success response
            \DB::commit();
            return redirect()->back()->with('success', 'Pengguna berhasil diperbarui');
        } catch (\Exception $e) {
            // Return error response
            \DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Pengguna gagal diperbarui. Error :' . $e->getMessage()]);
        }
    }
}