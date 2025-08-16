<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Navigations\CreateRequest;
use App\Http\Services\Settings\NavigationsService;
use App\Models\Navigation;
use Illuminate\Http\Request;

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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->setRule('settings-navs.update');

        $navigation = Navigation::find($id);
        $navigations = Navigation::all();
        return view('settings.navigation.edit', compact('navigation', 'navigations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $this->setRule('settings-navs.update');

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'url' => 'required',
            'icon' => 'nullable',
            'parent_id' => 'nullable',
            'order' => 'nullable',
            'active' => 'nullable',
            'display' => 'nullable',
        ]);
        //
        $navigation = Navigation::find($id);
        $navigation->name = $request->name;
        $navigation->url = $request->url;
        $navigation->icon = $request->icon;
        $navigation->parent_id = $request->parent_id;
        $navigation->order = $request->order;
        $navigation->active = $request->active;
        $navigation->display = $request->display;
        if(!$request->has('active')){
            $navigation->active = 0;
        }
        if(!$request->has('display')){
            $navigation->display = 0;
        }
        $navigation->save();
        return redirect()->back()->with('success', __('app.notif.successUpdate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->setRule('settings-navs.delete');

        $navigation = Navigation::find($id);
        $navigation->delete();
        return redirect('navs')->with('success', __('app.notif.successDelete'));
    }
}
