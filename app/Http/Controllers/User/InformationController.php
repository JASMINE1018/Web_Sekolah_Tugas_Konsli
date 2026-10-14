<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InformationController extends Controller
{
    /**
     * Display a listing of published information for school users (Pengguna - Informasi sekolah.png)
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $category = $request->query('category');

        $query = Information::with('author')
            ->where('status', 'Terbit');

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

        $allPublished = $query->latest('created_at')->get();

        // Featured item (first item) and other items
        $featured = $allPublished->first();
        $otherList = $allPublished->slice(1);

        $counts = [
            'all' => Information::where('status', 'Terbit')->count(),
            'Kegiatan' => Information::where('status', 'Terbit')->where('category', 'Kegiatan')->count(),
            'Pengumuman' => Information::where('status', 'Terbit')->where('category', 'Pengumuman')->count(),
            'Artikel' => Information::where('status', 'Terbit')->where('category', 'Artikel')->count(),
        ];

        return view('user.information.index', compact(
            'featured',
            'otherList',
            'search',
            'category',
            'counts'
        ));
    }

    /**
     * Display detailed information for school users (Pengguna - Detail informasi.png)
     */
    public function show(Information $information): View
    {
        abort_unless($information->status === 'Terbit', 404);

        $information->load('author');

        // Other recommended stories
        $otherStories = Information::where('status', 'Terbit')
            ->where('id', '!=', $information->id)
            ->latest('created_at')
            ->take(2)
            ->get();

        return view('user.information.show', compact('information', 'otherStories'));
    }
}
