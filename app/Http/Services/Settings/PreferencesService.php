<?php

namespace App\Http\Services\Settings;

use App\Models\Preference;

class PreferencesService
{
    /* Get all preferences */
    public function getAllPreferences()
    {
        return Preference::all();
    }

    /* Update preference data */
    public function update($preferenceId, array $data)
    {
        try {
            $preference = Preference::findOrFail($preferenceId);
            $preference->update($data);
            return redirect()->back()->with('success', 'Preferensi berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui preferensi. Error: ' . $e->getMessage());
        }
    }

}