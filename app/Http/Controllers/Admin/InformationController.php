<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InformationController extends Controller
{
    /**
     * Dashboard / Ringkasan (Admin - Ringkasan.png)
     */
    public function dashboard(): View
    {
        $totalInformation = Information::count();
        $publishedCount = Information::where('status', 'Terbit')->count();
        $draftCount = Information::where('status', 'Draf')->count();
        
        $categoriesCount = [
            'Kegiatan' => Information::where('category', 'Kegiatan')->count(),
            'Pengumuman' => Information::where('category', 'Pengumuman')->count(),
            'Artikel' => Information::where('category', 'Artikel')->count(),
        ];
        $totalCategoryTypes = count(array_filter($categoriesCount, fn ($v) => $v > 0));

        $latestInformation = Information::with('author')
            ->latest('updated_at')
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'totalInformation',
            'publishedCount',
            'draftCount',
            'categoriesCount',
            'totalCategoryTypes',
            'latestInformation'
        ));
    }

    /**
     * Display a listing of information (Admin - Kelola informasi.png)
     */
    public function index(Request $request): View
    {
        $tab = $request->query('tab', 'semua');
        $search = $request->query('search');
        $category = $request->query('category');
        $sort = $request->query('sort', 'terbaru');

        $query = Information::with('author');

        if ($tab === 'terbit') {
            $query->where('status', 'Terbit');
        } elseif ($tab === 'draf') {
            $query->where('status', 'Draf');
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($category && in_array($category, ['Kegiatan', 'Pengumuman', 'Artikel'])) {
            $query->where('category', $category);
        }

        if ($sort === 'terlama') {
            $query->oldest('updated_at');
        } else {
            $query->latest('updated_at');
        }

        $allCount = Information::count();
        $publishedCount = Information::where('status', 'Terbit')->count();
        $draftCount = Information::where('status', 'Draf')->count();

        $informations = $query->paginate(10)->withQueryString();

        return view('admin.information.index', compact(
            'informations',
            'tab',
            'search',
            'category',
            'sort',
            'allCount',
            'publishedCount',
            'draftCount'
        ));
    }

    /**
     * Show the form for creating a new resource (Admin - Tambah informasi.png)
     */
    public function create(): View
    {
        return view('admin.information.create');
    }

    /**
     * Store a newly created resource in storage (CRUD - Store)
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'summary' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'category' => ['required', 'in:Kegiatan,Pengumuman,Artikel'],
            'status' => ['required', 'in:Terbit,Draf'],
            'cover_image' => ['nullable', 'image', 'max:5120'], // Max 5MB
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $validated['cover_image'] = $path;
        }

        $validated['created_by'] = Auth::id();

        $info = Information::create($validated);

        return redirect()->route('admin.information.index')
            ->with('success', 'Informasi berhasil disimpan.');
    }

    /**
     * Display the specified resource (Admin - Detail informasi.png)
     */
    public function show(Information $information): View
    {
        $information->load('author');
        return view('admin.information.show', compact('information'));
    }

    /**
     * Show the form for editing the specified resource (Admin - Edit informasi.png)
     */
    public function edit(Information $information): View
    {
        return view('admin.information.edit', compact('information'));
    }

    /**
     * Update the specified resource in storage (CRUD - Update)
     */
    public function update(Request $request, Information $information): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'summary' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'category' => ['required', 'in:Kegiatan,Pengumuman,Artikel'],
            'status' => ['required', 'in:Terbit,Draf'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('cover_image')) {
            if ($information->cover_image) {
                Storage::disk('public')->delete($information->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $information->update($validated);

        return redirect()->route('admin.information.index')
            ->with('success', 'Informasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage (CRUD - Delete)
     */
    public function destroy(Information $information): RedirectResponse
    {
        if ($information->cover_image) {
            Storage::disk('public')->delete($information->cover_image);
        }

        $information->delete();

        return redirect()->route('admin.information.index')
            ->with('success', 'Informasi telah dihapus dari sistem.');
    }
}
