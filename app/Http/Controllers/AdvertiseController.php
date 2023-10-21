<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdvertiseController extends Controller
{

    public function  store2(Request $req)
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

    public function store(Request $request)
    {
        $request->validate([
            // suas regras de validação aqui
        ]);

        if ($request->hasFile('image')) {
            // Salva a imagem no disco público (pasta storage/app/public/images)
            $imagePath = "storage/app/public/" . $request->file('image')->store('images', 'public');
            // $imagePath = 'https://google.com/google.jpg';
        }

        Advertise::create([
            "title" => $request->input('title'),
            "slug" =>  $imagePath,
            "price" => $request->input('price'),
            "expires_at" => $request->input('expires'),
            "description" => $request->input('desc'),
            "user_id" => Auth::id(),
            "category_id" => '1'
        ]);

        return redirect('/dashboard'); //response()->json(['message' => 'Anúncio criado com sucesso']);
    }
}
