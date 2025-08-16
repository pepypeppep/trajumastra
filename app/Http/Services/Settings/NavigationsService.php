<?php

namespace App\Http\Services\Settings;

use App\Models\Navigation;

class NavigationsService
{
    /* Get data all navigations */
    public function getAllNavigations()
    {
        return Navigation::with('child')
                    ->where('parent_id', null)    
                    ->get();
    }

    /* Store new navigation */
    public function store($data)
    {
        try {
            $navigation = Navigation::create($data);
            return redirect()->back()->with('success', 'Navigasi ' . $navigation->name . ' berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat navigasi. Error: ' . $e->getMessage());
        }
    }
}