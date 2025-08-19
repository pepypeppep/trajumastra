<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Services\Settings\RolesService;
use App\Http\Requests\Settings\Roles\CreateRequest;
use App\Http\Requests\Settings\Roles\UpdateRequest;

class RolesController extends Controller
{
    public function __construct(protected RolesService $rolesService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('settings-roles.read');

        $roles = $this->rolesService->getAllRoles();
        return view('admin.settings.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->setRule('settings-roles.create');

        $create = true;
        return view('settings.roles.edit', compact('create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('settings-roles.create');
        // Store Process
        return $this->rolesService->create($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $roleId)
    {
        $this->setRule('settings-roles.update');

        // Update Process
        return $this->rolesService->update($roleId, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($roleId)
    {
        $this->setRule('settings-roles.delete');
        
        // Delete process
        return $this->rolesService->delete($roleId);
    }

    /**
     * Display a listing of the permission.
     */
    public function show($roleId)
    {
        $this->setRule('settings-roles.update');

        // Get data
        $permissions = $this->rolesService->getAllPermissions($roleId);
        $navigations = $this->rolesService->getAllNavigations();
        $role = $this->rolesService->getRoleById($roleId);
        return view('admin.settings.roles.show-permissions', compact('role', 'permissions', 'navigations'));
        
    }

    public function givePermission(Request $request, $roleId)
    {
        $this->setRule('settings-roles.update');
        // Give Permissions Process
        return $this->rolesService->givePermission($roleId, $request->all());
    }
}
