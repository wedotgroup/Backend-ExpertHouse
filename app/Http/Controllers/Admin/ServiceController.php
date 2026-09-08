<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['serviceCat'])->latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {

        $serCat = ServiceCategory::select('id', 'name')->latest()->get() ?? [];

        return view('admin.services.create', compact('serCat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',

            'main_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sec_imag' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'small_pag' => 'nullable|string',
            'first_heading' => 'nullable|string|max:255',
            'paragraph' => 'nullable|string',
            'note' => 'nullable|string',
            'sec_heading' => 'nullable|string|max:255',
            'sec_paragraph' => 'nullable|string',
            'third_heading' => 'nullable|string|max:255',

            'listing_heading' => 'nullable|array',
            'listing_heading.*' => 'nullable|string|max:255',

            'listing_summary' => 'nullable|array',
            'listing_summary.*' => 'nullable|string',

            'serviceCat_id' => 'required|exists:service_categories,id',
        ]);

        $data = $request->except([
            'main_img',
            'sec_imag',
            'listing_heading',
            'listing_summary',
        ]);

        if ($request->hasFile('main_img')) {

            $image = $request->file('main_img');

            $imageName = time() . '_main_' . $image->getClientOriginalName();

            $image->move(
                public_path('uploads/services'),
                $imageName
            );

            $data['main_img'] = 'uploads/services/' . $imageName;
        }

        if ($request->hasFile('sec_imag')) {

            $image = $request->file('sec_imag');

            $imageName = time() . '_second_' . $image->getClientOriginalName();

            $image->move(
                public_path('uploads/services'),
                $imageName
            );

            $data['sec_imag'] = 'uploads/services/' . $imageName;
        }

        $listing = [];

        $headings = $request->input('listing_heading', []);
        $summaries = $request->input('listing_summary', []);

        foreach ($headings as $key => $heading) {
            if (empty($heading) && empty($summaries[$key] ?? null)) {
                continue;
            }

            $listing[] = [
                'heading' => $heading,
                'summary' => $summaries[$key] ?? '',
            ];
        }
        $data['slug'] = Str::slug($request->heading);
        $data['list'] = json_encode($listing);

        Service::create($data);

        return redirect()
            ->route('service.index')
            ->with('success', 'Service created successfully.');
    }

    // public function show(Service $service)
    // {
    //     return view('', compact('service'));
    // }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $serCat = ServiceCategory::all();

        return view('admin.services.edit', compact('service', 'serCat'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'heading' => 'required|string|max:255',
            'main_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sec_imag' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'small_pag' => 'nullable|string',
            'first_heading' => 'nullable|string|max:255',
            'paragraph' => 'nullable|string',
            'note' => 'nullable|string',
            'sec_heading' => 'nullable|string|max:255',
            'sec_paragraph' => 'nullable|string',
            'third_heading' => 'nullable|string|max:255',

            'listing_heading' => 'nullable|array',
            'listing_heading.*' => 'nullable|string|max:255',

            'listing_summary' => 'nullable|array',
            'listing_summary.*' => 'nullable|string',

            'serviceCat_id' => 'required|exists:service_categories,id',
        ]);

        $data = $request->except([
            'main_img',
            'sec_imag',
            'listing_heading',
            'listing_summary',
        ]);

        if ($request->hasFile('main_img')) {

            // Delete old image
            if (
                $service->main_img &&
                file_exists(public_path($service->main_img))
            ) {
                unlink(public_path($service->main_img));
            }

            $image = $request->file('main_img');

            $imageName = time() . '_main_' . $image->getClientOriginalName();

            $image->move(
                public_path('uploads/services'),
                $imageName
            );

            $data['main_img'] = 'uploads/services/' . $imageName;
        }

        if ($request->hasFile('sec_imag')) {

            // Delete old image
            if (
                $service->sec_img &&
                file_exists(public_path($service->sec_img))
            ) {
                unlink(public_path($service->sec_img));
            }

            $image = $request->file('sec_imag');

            $imageName = time() . '_second_' . $image->getClientOriginalName();

            $image->move(
                public_path('uploads/services'),
                $imageName
            );

            $data['sec_imag'] = 'uploads/services/' . $imageName;
        }

        $listing = [];

        $headings = $request->input('listing_heading', []);
        $summaries = $request->input('listing_summary', []);

        foreach ($headings as $key => $heading) {

            if (
                empty($heading) &&
                empty($summaries[$key] ?? null)
            ) {
                continue;
            }

            $listing[] = [
                'heading' => $heading,
                'summary' => $summaries[$key] ?? '',
            ];
        }

        $data['list'] = $listing;
        $data['slug'] = Str::slug($request->heading);
        $service->update($data);

        return redirect()
            ->route('service.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
       $service = Service::findOrFail($id);
        if ($service->main_img) {

            $image = public_path($service->main_img);

            if (file_exists($image)) {
                unlink($image);
            }
        }

        if ($service->sec_img) {

            $image = public_path($service->sec_img);

            if (file_exists($image)) {
                unlink($image);
            }
        }

        $service->delete();

        return redirect()
            ->route('service.index')
            ->with('success', 'Service deleted successfully.');
    }
}
