<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::latest()->get()->map(function($m) {
            return [
                'id' => $m->id,
                'name' => $m->name,
                'description' => $m->description,
                'file_url' => asset('storage/' . $m->file_path),
            ];
        });

        return response()->json([
            'materials' => $materials
        ]);
    }
}
