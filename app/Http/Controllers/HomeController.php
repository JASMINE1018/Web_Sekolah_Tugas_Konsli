<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show school landing page matching Beranda Sekolah Inspirasi.
     */
    public function index(): View
    {
        $recentStories = Information::with('author')
            ->where('status', 'Terbit')
            ->latest()
            ->take(3)
            ->get();

        return view('landing', compact('recentStories'));
    }
}
