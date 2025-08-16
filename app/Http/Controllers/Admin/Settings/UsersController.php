<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Users\CreateRequest;
use App\Http\Services\Settings\UsersService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
    public function __construct(protected UsersService $usersService){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('settings-users.read');
        // Get data users for data table
        if (request()->ajax()) {
            return $this->usersService->getAllUsersForDataTable();
        }

        // Get data roles
        $roles = $this->usersService->getAllRoles();
        return view('admin.settings.users.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('settings-users.create');

        // Store process
        return $this->usersService->store($request->validated());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($userId = null)
    {
        $this->setRule('settings-users.update');

        return $this->usersService->getUserById($userId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->setRule('settings-users.update');

        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $user->id,
            'role' => 'required',
        ]);
        //
        if ($request->has('password') && $request->password != '') {
            $request->validate([
                'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();
        $user->syncRoles($request->role);
        return redirect()->back()->with('success', __('app.notif.successUpdate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->setRule('settings-users.delete');

        $user->delete();
        return redirect('users')->with('success', __('app.notif.successDelete'));
    }
}
