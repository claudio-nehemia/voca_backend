<?php

namespace App\Http\Controllers;

use App\Models\Vocabulary;
use App\Models\VocabularyTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VocabularyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vocabularies = Vocabulary::with('theme')->latest()->paginate(10);
        $themes = VocabularyTheme::withCount('vocabularies')->get();
        return view('vocabularies.index', compact('vocabularies', 'themes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'theme_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== 'new' && !VocabularyTheme::where('id', $value)->exists()) {
                        $fail('The selected theme is invalid.');
                    }
                },
            ],
            'new_theme' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'goals' => 'nullable|string',
            'audio_url' => 'nullable|string',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg|max:10240', // Max 10MB
            'point' => 'required|integer|min:0',
        ]);

        if (empty($validatedData['theme_id']) && empty($validatedData['new_theme'])) {
            return back()->withErrors([
                'theme_id' => 'Pilih tema atau buat tema baru.'
            ]);
        }

        // Handle Theme
        if ($validatedData['theme_id'] === 'new' && !empty($validatedData['new_theme'])) {
            $theme = VocabularyTheme::firstOrCreate(['name' => $validatedData['new_theme']]);
            $validatedData['theme_id'] = $theme->id;
        } elseif ($validatedData['theme_id'] === 'new') {
             return back()->withErrors(['new_theme' => 'Nama tema baru wajib diisi.'])->withInput();
        }
        unset($validatedData['new_theme']);

        // Handle Audio
        if ($request->hasFile('audio_file')) {
            $path = $request->file('audio_file')->store('vocabularies/audio', 'public');
            $validatedData['audio_url'] = Storage::url($path);
        }
        unset($validatedData['audio_file']);

        Vocabulary::create($validatedData);

        return redirect()
            ->route('vocabularies.index')
            ->with('success', 'Vocabulary created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vocabulary $vocabulary)
    {
        $vocabulary->load('theme');
        return response()->json($vocabulary);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vocabulary $vocabulary)
    {
        $themes = VocabularyTheme::all();
        return response()->json([
            'vocabulary' => $vocabulary,
            'themes' => $themes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $vocabulary = Vocabulary::findOrFail($id);

        $validatedData = $request->validate([
            'theme_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== 'new' && !VocabularyTheme::where('id', $value)->exists()) {
                        $fail('The selected theme is invalid.');
                    }
                },
            ],
            'new_theme' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'goals' => 'nullable|string',
            'audio_url' => 'nullable|string',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg|max:10240',
            'point' => 'required|integer|min:0',
        ]);

        // Handle Theme
        if ($validatedData['theme_id'] === 'new' && !empty($validatedData['new_theme'])) {
            $theme = VocabularyTheme::firstOrCreate(['name' => $validatedData['new_theme']]);
            $validatedData['theme_id'] = $theme->id;
        } elseif ($validatedData['theme_id'] === 'new') {
             return back()->withErrors(['new_theme' => 'Nama tema baru wajib diisi.'])->withInput();
        }
        unset($validatedData['new_theme']);

        // Handle Audio
        if ($request->hasFile('audio_file')) {
            // Delete old file if exists (and if it's a local storage file)
            if ($vocabulary->audio_url && str_contains($vocabulary->audio_url, '/storage/')) {
                $oldPath = str_replace(Storage::url(''), '', $vocabulary->audio_url);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('audio_file')->store('vocabularies/audio', 'public');
            $validatedData['audio_url'] = Storage::url($path);
        }
        unset($validatedData['audio_file']);

        $vocabulary->update($validatedData);

        return redirect()
            ->route('vocabularies.index')
            ->with('success', 'Vocabulary updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vocabulary $vocabulary)
    {
        // Delete file if it exists
        if ($vocabulary->audio_url && str_contains($vocabulary->audio_url, '/storage/')) {
            $oldPath = str_replace(Storage::url(''), '', $vocabulary->audio_url);
            Storage::disk('public')->delete($oldPath);
        }

        $vocabulary->delete();

        return redirect()
            ->route('vocabularies.index')
            ->with('success', 'Vocabulary deleted successfully.');
    }
}
