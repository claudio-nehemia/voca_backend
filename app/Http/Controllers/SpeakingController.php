<?php

namespace App\Http\Controllers;

use App\Models\Speaking;
use App\Models\JenisSpeaking;
use Illuminate\Http\Request;

class SpeakingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $speakings = Speaking::with('jenisSpeaking')->latest()->paginate(10);
        $jenisSpeakings = JenisSpeaking::withCount('speakings')->get();
        return view('speakings.index', compact('speakings', 'jenisSpeakings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisSpeakings = JenisSpeaking::all();
        return response()->json($jenisSpeakings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_speaking_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== 'new' && !JenisSpeaking::where('id', $value)->exists()) {
                        $fail('The selected jenis speaking is invalid.');
                    }
                },
            ],
            'new_jenis_speaking' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'instruction' => 'required|string',
            'point' => 'required|integer|min:0',
        ]);

        if (empty($validatedData['jenis_speaking_id']) && empty($validatedData['new_jenis_speaking'])) {
            return back()->withErrors([
                'jenis_speaking_id' => 'Pilih jenis speaking atau buat jenis baru.'
            ]);
        }

        // Handle Theme
        if ($validatedData['jenis_speaking_id'] === 'new' && !empty($validatedData['new_jenis_speaking'])) {
            $theme = JenisSpeaking::firstOrCreate(['name' => $validatedData['new_jenis_speaking']]);
            $validatedData['jenis_speaking_id'] = $theme->id;
        } elseif ($validatedData['jenis_speaking_id'] === 'new') {
             return back()->withErrors(['new_jenis_speaking' => 'Nama tema baru wajib diisi.'])->withInput();
        } 

        unset($validatedData['new_jenis_speaking']);
        Speaking::create($validatedData);

        return redirect()
            ->route('speakings.index')
            ->with('success', 'Speaking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Speaking $speaking)
    {
        $speaking->load('jenisSpeaking');
        return response()->json($speaking);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Speaking $speaking)
    {
        $jenisSpeakings = JenisSpeaking::all();
        return response()->json([
            'speaking' => $speaking,
            'jenisSpeakings' => $jenisSpeakings
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Speaking $speaking)
    {
        $validatedData = $request->validate([
            'jenis_speaking_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== 'new' && !JenisSpeaking::where('id', $value)->exists()) {
                        $fail('The selected jenis speaking is invalid.');
                    }
                },
            ],
            'new_jenis_speaking' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'instruction' => 'required|string',
            'point' => 'required|integer|min:0',
        ]);

        if (empty($validatedData['jenis_speaking_id']) && empty($validatedData['new_jenis_speaking'])) {
            return back()->withErrors([
                'writing_theme_id' => 'Pilih tema atau buat tema baru.'
            ]);
        }

        // Handle Theme
        if ($validatedData['jenis_speaking_id'] === 'new' && !empty($validatedData['new_jenis_speaking'])) {
            $theme = JenisSpeaking::firstOrCreate(['name' => $validatedData['new_jenis_speaking']]);
            $validatedData['jenis_speaking_id'] = $theme->id;
        } elseif ($validatedData['jenis_speaking_id'] === 'new') {
             return back()->withErrors(['new_jenis_speaking' => 'Nama tema baru wajib diisi.'])->withInput();
        } 

        unset($validatedData['new_jenis_speaking']);
        $speaking->update($validatedData);

        return redirect()
            ->route('speakings.index')
            ->with('success', 'Speaking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Speaking $speaking)
    {
        $speaking->delete();
        return redirect()
            ->route('speakings.index')
            ->with('success', 'Speaking deleted successfully.');
    }
}
