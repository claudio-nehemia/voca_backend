<?php

namespace App\Http\Controllers;

use App\Models\Writing;
use App\Models\WritingTheme;
use Illuminate\Http\Request;

class WritingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $writings = Writing::with('writingTheme')->latest()->paginate(10);
        $themes = WritingTheme::withCount('writings')->get();
        return view('writings.index', compact('writings', 'themes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $themes = WritingTheme::all();
        return response()->json([
            'themes' => $themes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'writing_theme_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== 'new' && !WritingTheme::where('id', $value)->exists()) {
                        $fail('The selected theme is invalid.');
                    }
                },
            ],
            'new_theme' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'instruction' => 'required|string',
            'point' => 'required|integer|min:0',
        ]);

        if (empty($validatedData['writing_theme_id']) && empty($validatedData['new_theme'])) {
            return back()->withErrors([
                'writing_theme_id' => 'Pilih tema atau buat tema baru.'
            ]);
        }

        // Handle Theme
        if ($validatedData['writing_theme_id'] === 'new' && !empty($validatedData['new_theme'])) {
            $theme = WritingTheme::firstOrCreate(['name' => $validatedData['new_theme']]);
            $validatedData['writing_theme_id'] = $theme->id;
        } elseif ($validatedData['writing_theme_id'] === 'new') {
             return back()->withErrors(['new_theme' => 'Nama tema baru wajib diisi.'])->withInput();
        } 
        unset($validatedData['new_theme']);

        Writing::create($validatedData);

        return redirect()
            ->route('writings.index')
            ->with('success', 'Writing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Writing $writing)
    {
        $writing->load('writingTheme');
        return response()->json($writing);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Writing $writing)
    {
        $themes = WritingTheme::all();
        return response()->json([
            'writing' => $writing,
            'themes' => $themes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Writing $writing)
    {
        $validatedData = $request->validate([
            'writing_theme_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== 'new' && !WritingTheme::where('id', $value)->exists()) {
                        $fail('The selected theme is invalid.');
                    }
                },
            ],
            'new_theme' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'instruction' => 'required|string',
            'point' => 'required|integer|min:0',
        ]);

        if (empty($validatedData['writing_theme_id']) && empty($validatedData['new_theme'])) {
            return back()->withErrors([
                'writing_theme_id' => 'Pilih tema atau buat tema baru.'
            ]);
        }

        // Handle Theme
        if ($validatedData['writing_theme_id'] === 'new' && !empty($validatedData['new_theme'])) {
            $theme = WritingTheme::firstOrCreate(['name' => $validatedData['new_theme']]);
            $validatedData['writing_theme_id'] = $theme->id;
        } elseif ($validatedData['writing_theme_id'] === 'new') {
             return back()->withErrors(['new_theme' => 'Nama tema baru wajib diisi.'])->withInput();
        }
        unset($validatedData['new_theme']);

        $writing->update($validatedData);

        return redirect()
            ->route('writings.index')
            ->with('success', 'Writing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Writing $writing)
    {
        $writing->delete();
        return redirect()
            ->route('writings.index')
            ->with('success', 'Writing deleted successfully.');
    }
}
