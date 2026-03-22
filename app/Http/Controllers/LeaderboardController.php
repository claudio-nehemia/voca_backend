<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    /**
     * Display the top students ranked by score.
     */
    public function index()
    {
        $students = User::where('role', '!=', 'admin')
                        ->orderBy('score', 'desc')
                        ->paginate(10);

        return view('admin.leaderboard.index', compact('students'));
    }
}
