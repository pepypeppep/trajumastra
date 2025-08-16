<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Preferences\UpdateRequest;
use App\Http\Services\Settings\PreferencesService;

class PreferencesController extends Controller
{

    public function __construct(protected PreferencesService $preferencesService){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('settings-preferences.read');

        // Get all preferences
        $preferences = $this->preferencesService->getAllPreferences();
        return view('admin.settings.preferences.index', compact('preferences'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $preferenceId = null)
    {
        $this->setRule('settings-preferences.update');
        // Update process
        return $this->preferencesService->update($preferenceId, $request->validated());
    }

}
