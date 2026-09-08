<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCatControoler extends Controller
{
    public function index(){
        $sevCate = ServiceCategory::latest()->get();
        $serCate = ServiceCategory::latest()->get() ?? [];
     return view('admin.services.categories.index',compact('sevCate','serCate'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:service_categories,name',
        ]);

        ServiceCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()
            ->route('serCat.index')
            ->with('success', 'Service category created successfully.');
    }



    public function edit($id)
    {
                $serCate = ServiceCategory::latest()->get() ?? [];
                $edit = ServiceCategory::findOrFail($id);
        return view('admin.services.categories.index', compact('serCate','edit'));
    }

    public function update(Request $request, $id)
    {

        $serviceCategory = ServiceCategory::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:service_categories,id,' . $serviceCategory->id,
        ]);

        $serviceCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()
            ->route('serCat.index')
            ->with('success', 'Service category updated successfully.');
    }

    public function destroy($id)
    {
       $serviceCategory = ServiceCategory::findOrFail($id);
        $serviceCategory->delete();

        return redirect()
            ->route('serCat.index')
            ->with('success', 'Service category deleted successfully.');
    }
}
