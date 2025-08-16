<?php

namespace App\Http\Services;

class ProfileService
{

    /* Get data user has logged in */
    public function get_user($request){
        return $request->user();
    }

    /* Update process */
    public function update($request)
    {
        try {
            $user = $this->get_user($request);
            $user->fill($request->validated());
            $user->save();

            // Return back with success
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            // Handle any errors that occur during the update
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

    }

}