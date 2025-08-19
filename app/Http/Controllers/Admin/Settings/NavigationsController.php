<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Settings\NavigationsService;
use App\Http\Requests\Settings\Navigations\CreateRequest;
use App\Http\Requests\Settings\Navigations\UpdateRequest;

class NavigationsController extends Controller
{
    public function __construct(protected NavigationsService $navigationsService){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setRule('settings-navs.read');

        $navigations = $this->navigationsService->getAllNavigations();
        $parentNavigations = $navigations->where('parent_id', null);
        return view('admin.settings.navs.index', compact('navigations', 'parentNavigations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $this->setRule('settings-navs.create');
        // Create process
        return $this->navigationsService->store($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $this->setRule('settings-navs.update');
        // Update Process
        return $this->navigationsService->update($id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->setRule('settings-navs.delete');
        // Destroy Process
        return $this->navigationsService->destroy($id);
    }
}
