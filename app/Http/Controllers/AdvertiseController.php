<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdvertiseController extends Controller
{


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
           $imagePath = "storage/" . $request->file('image')->store('images', 'public');
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

        return redirect('/dashboard');
    }

    public function showSinglePost ($id){
        $singlepost = Advertise::where('id', $id)->first();

        $canEdit = false;

        if ($singlepost && $singlepost->user_id == Auth::id()) {
            $canEdit = true;
        }
        $singlepost->slug = asset($singlepost->slug);

        return Inertia::render('SingleAd', [
            'singlepost' => $singlepost,
            'canEdit' => $canEdit,
        ]);
    }

    public function editAd($id){

        $singlepost = Advertise::where('id', $id)->first();

        if ($singlepost && $singlepost->user_id == Auth::id()) {    
            $singlepost->slug = asset($singlepost->slug);       
            
            return Inertia('EditAdvertise', compact('singlepost'));
        }

        return redirect('/');
    }

    public function saveEditAd(Request $request, $id){

        $singlepost = Advertise::where('id', $id)->first();

        if ($singlepost && $singlepost->user_id == Auth::id()) {    
            $singlepost->slug = asset($singlepost->slug);    
               
            if ($request->hasFile('image')) {
                $imagePath = "storage/" . $request->file('image')->store('images', 'public');
             }
            return $request;
        }

        return redirect('/');
    }

    public function deleteAd($id){

        $singlepost = Advertise::where('id', $id)->first();

        if ($singlepost && $singlepost->user_id == Auth::id()) {           
            return Inertia::render('EditAdvertise', [
                'singlepost' => $singlepost
            ]);
        }

        return redirect('/');
    }

}
