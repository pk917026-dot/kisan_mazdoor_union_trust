<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSectionController extends Controller
{
    public function index()
    {
        $sections = PageSection::orderBy('page')
            ->orderBy('sort_order')
            ->get();

        return view('admin.page_sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.page_sections.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'page'        => 'required|string',
            'section_key' => 'required|string',
            'title'       => 'nullable|string',
            'content'     => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_url'  => 'nullable|string',
            'icon'        => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'   => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $data['is_active'] = $request->has('is_active');

        // Image upload to storage
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('sections', 'public');   // storage/app/public/sections
        }

        PageSection::create($data);

        return redirect()->route('admin.page-sections.index')
            ->with('success', 'Section created successfully.');
    }

    public function edit(PageSection $pageSection)
    {
        return view('admin.page_sections.edit', compact('pageSection'));
    }

    public function update(Request $request, PageSection $pageSection)
    {
        $data = $request->validate([
            'page'        => 'required|string',
            'section_key' => 'required|string',
            'title'       => 'nullable|string',
            'content'     => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_url'  => 'nullable|string',
            'icon'        => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'   => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $data['is_active'] = $request->has('is_active');

        // New image upload
        if ($request->hasFile('image')) {

            // Purani image delete
            if ($pageSection->image && Storage::disk('public')->exists($pageSection->image)) {
                Storage::disk('public')->delete($pageSection->image);
            }

            // New image store
            $data['image'] = $request->file('image')
                ->store('sections', 'public');
        }

        $pageSection->update($data);

        return redirect()->route('admin.page-sections.index')
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(PageSection $pageSection)
    {
        // Delete image from storage
        if ($pageSection->image && Storage::disk('public')->exists($pageSection->image)) {
            Storage::disk('public')->delete($pageSection->image);
        }

        $pageSection->delete();

        return redirect()->route('admin.page-sections.index')
            ->with('success', 'Section deleted successfully.');
    }
}
