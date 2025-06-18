<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PodcastController extends Controller
{
    public function index()
    {
        return inertia('Podcasts/Index');
    }

    public function create()
    {
        return inertia('Podcasts/Create');
    }

    public function store(Request $request)
    {
        // Handle storing logic here, then redirect
        return redirect()->route('podcasts.index');
    }

    public function show($id)
    {
        return inertia('Podcasts/Show', ['id' => $id]);
    }

    public function edit($id)
    {
        return inertia('Podcasts/Edit', ['id' => $id]);
    }

    public function update(Request $request, $id)
    {
        // Handle update logic here, then redirect
        return redirect()->route('podcasts.show', $id);
    }

    public function destroy($id)
    {
        // Handle delete logic here, then redirect
        return redirect()->route('podcasts.index');
    }

    // Route::get('/podcasts/latest', [\App\Http\Controllers\PodcastController::class, 'latest'])->name('podcasts.latest');
    public function latest()
    {
        // Logic to fetch and return the latest podcasts
        return inertia('Podcasts/Latest');
    }
}
