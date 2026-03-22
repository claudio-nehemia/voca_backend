<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::latest()->paginate(10);
        return view('materials.index', compact('materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'file_path' => 'required|file|mimes:pdf|max:10240',
        ]);

        if($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('materials', 'public');
            $validatedData['file_path'] = $path;
        }

        Material::create($validatedData);

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return response()->json($material);
    }   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return response()->json($material);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if($request->hasFile('file_path')) {
            if($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
            }
            $path = $request->file('file_path')->store('materials', 'public');
            $validatedData['file_path'] = $path;
        } else {
            unset($validatedData['file_path']);
        }

        $material->update($validatedData);

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete();

        Storage::disk('public')->delete($material->file_path);

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material deleted successfully.');
    }
}
