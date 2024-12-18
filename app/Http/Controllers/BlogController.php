<?php

namespace App\Http\Controllers;

use App\Models\Dinas\Artikel;

class BlogController extends Controller
{
    public function index()
    {
        $list_artikel = Artikel::where('status', 'aktif')->orderBy('created_at','desc')->paginate(6);
        return view('customer.blog', compact('list_artikel'));
    }

    public function detail($slug)
    {
        $artikel = Artikel::where('status', 'aktif')->where('slug', $slug)->first();
        $list_artikel = Artikel::where('status', 'aktif')->skip(0)->take(4)->get();
        $artikel->increment('views'); //viewsnya otomatis nambah kalo dibuka
        return view('customer.detail_blog', compact('artikel', 'list_artikel'));
    }
}
