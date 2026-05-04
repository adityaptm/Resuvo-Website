<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CvData;
use Illuminate\Support\Str;

class CvDataController extends Controller
{
    /**
     * Show the CV builder form.
     */
    public function create()
    {
        return view('cv.builder');
    }

    /**
     * Store a newly created CV.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|array',
            'template' => 'nullable|string',
        ]);

        $slug = Str::random(10);
        
        $cv = CvData::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'slug' => $slug,
            'template' => $request->input('template', 'modern'),
            'content' => $validated['content'],
            'is_paid' => false,
        ]);

        return redirect()->route('cv.show', $slug);
    }

    /**
     * Display the specified CV.
     */
    public function show($slug)
    {
        $cv = CvData::where('slug', $slug)->firstOrFail();
        return view('cv.show', compact('cv'));
    }
}
