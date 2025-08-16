<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(protected ProfileService $profileService){}

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $this->setRule('profile.read');

        // Get user
        $user = $this->profileService->get_user($request);

        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->setRule('profile.read');
        // Update process
        return $this->profileService->update($request);
    }
}
