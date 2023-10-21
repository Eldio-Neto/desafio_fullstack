<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdvertiseController extends Controller
{

    public function store(Request $req)
    {
        Advertise::create([
            "title" => $req->title,
            "slug" => ' ',
            "price" => $req->price,
            "expires_at" => $req->expires,
            "description" => $req->desc,
            "user_id" => Auth::id(),
            "category_id" => '1'
        ]);
        return redirect('/dashboard');
    }

    public function MyAdvertyse()
    {
        $MyPosts = Advertise::where('user_id', '=', Auth::id())->get();
        return Inertia('Dashboard', compact('MyPosts'));
    }
}
