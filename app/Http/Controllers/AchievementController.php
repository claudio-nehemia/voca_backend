<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::orderBy('type')->orderBy('required_points')->paginate(6);
        return view('admin.achievements.index', compact('achievements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'icon'            => 'required|string|max:10',
            'type'            => 'required|in:speaking,writing,vocabulary,total',
            'required_points' => 'required|integer|min:1',
        ]);

        Achievement::create($request->only(['name', 'description', 'icon', 'type', 'required_points']));

        return redirect()->route('achievements.index')->with('success', 'Achievement berhasil ditambahkan.');
    }

    public function edit(Achievement $achievement)
    {
        return response()->json($achievement);
    }

    public function update(Request $request, Achievement $achievement)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'icon'            => 'required|string|max:10',
            'type'            => 'required|in:speaking,writing,vocabulary,total',
            'required_points' => 'required|integer|min:1',
        ]);

        $achievement->update($request->only(['name', 'description', 'icon', 'type', 'required_points']));

        return redirect()->route('achievements.index')->with('success', 'Achievement berhasil diperbarui.');
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return redirect()->route('achievements.index')->with('success', 'Achievement berhasil dihapus.');
    }
}
