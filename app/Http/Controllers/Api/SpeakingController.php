<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Speaking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpeakingController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        
        $speakings = Speaking::with('jenisSpeaking')
            ->get()
            ->map(function ($s) use ($userId) {
                $activity = DB::table('speaking_user')
                    ->where('user_id', $userId)
                    ->where('speaking_id', $s->id)
                    ->first();
                
                return [
                    'id' => $s->id,
                    'jenis_name' => $s->jenisSpeaking?->name ?? 'General',
                    'title' => $s->title,
                    'instruction' => $s->instruction,
                    'point' => $s->point,
                    'is_done' => !is_null($activity),
                    'audio_url' => $activity?->audio_url ? asset('storage/' . $activity->audio_url) : null,

                ];
            });

        return response()->json([
            'exercises' => $speakings
        ]);
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;
        $s = Speaking::with('jenisSpeaking')->findOrFail($id);
        
        $activity = DB::table('speaking_user')
            ->where('user_id', $userId)
            ->where('speaking_id', $s->id)
            ->first();

        return response()->json([
            'id' => $s->id,
            'jenis_name' => $s->jenisSpeaking?->name ?? 'General',
            'title' => $s->title,
            'instruction' => $s->instruction,
            'point' => $s->point,
            'is_done' => !is_null($activity),
            'audio_url' => $activity?->audio_url ? asset('storage/' . $activity->audio_url) : null,

        ]);
    }

    public function submit(Request $request, $id)
    {
        $request->validate([
            'audio' => 'required|file|mimes:mp3,m4a,wav,ogg,mp4,mpeg,3gp,3gpp,aac|max:10240', // Increased to 10MB
        ]);

        $user = $request->user();
        $speaking = Speaking::findOrFail($id);

        // Check if already done
        $exists = DB::table('speaking_user')
            ->where('user_id', $user->id)
            ->where('speaking_id', $speaking->id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Latihan ini sudah dikerjakan'], 422);
        }

        $path = $request->file('audio')->store('recordings/speaking', 'public');

        $user->speakings()->attach($speaking->id, [
            'audio_url' => $path,
            'point_earned' => $speaking->point,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user->increment('score', $speaking->point);

        return response()->json([
            'message' => 'Jawaban berhasil dikirim!',
            'point_earned' => $speaking->point,
            'audio_url' => asset('storage/' . $path)
        ]);
    }
}
