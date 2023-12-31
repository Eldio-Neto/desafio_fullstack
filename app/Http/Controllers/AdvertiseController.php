<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Carbon\Carbon;


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;


class AdvertiseController extends Controller
{
    public function newAdForm()
    {
        $categories = Category::all();

        return Inertia::render('NewAdvertise', ['categories' => $categories]);
    }

    public function showMenu()
    {
        return Inertia::render('Menu');
    }

    public function index()
    {

        $date = Carbon::now()->startOfDay();
        $posts = Advertise::where('expires_at', '>=', $date)->paginate(1);

        foreach ($posts as $post) {
            $category = Category::where('id', $post->category_id)->first();
            $post->category_name = $category->name;
        }



        return Inertia('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'posts' => $posts
        ]);
    }

    public function allPosts()
    {
        $date = Carbon::now()->startOfDay();
        $posts = Advertise::where('expires_at', '>=', $date)->paginate(2);

        foreach ($posts as $post) {
            $post->slug = asset($post->slug);
            $category = Category::where('id', $post->category_id)->first();
            $post->category_name = $category->name;
        }

        return Inertia('AllPosts', compact('posts'));
    }

    public function searchByTerm($term)
    {
        $date = Carbon::now()->startOfDay();
        $posts = Advertise::where(function ($query) use ($term) {
            $query->where('title', 'like', '%' . $term . '%')
                ->orWhere('description', 'like', '%' . $term . '%');
        })
            ->where('expires_at', '>=', $date)
            ->paginate(2);

        foreach ($posts as $post) {
            $post->slug = asset($post->slug);
            $category = Category::where('id', $post->category_id)->first();
            $post->category_name = $category->name;
        }

        return Inertia('Search', compact(['posts', 'term']));
    }

    public function MyAdvertyse()
    {
        $MyPosts = Advertise::where('user_id', '=', Auth::id())->paginate(2);

        foreach ($MyPosts as $post) {
            $post->slug = asset($post->slug);
            $category = Category::where('id', $post->category_id)->first();
            $post->category_name = $category->name;
        }
        return Inertia('Dashboard', compact('MyPosts'));
    }

    public function store(Request $request)
    {

        if ($request->hasFile('image')) {
            $imagePath = "storage/" . $request->file('image')->store('images', 'public');
        } else {
            $imagePath = "src/images/default.jpg";
        }

        $validated = $request->validate([
            'title' => 'required|max:50',
            'price' => 'required',
            'expires' => 'required',
            'desc' => 'required|max:200',
            'category' => 'required',
        ]);

        if ($validated) {
            Advertise::create([
                "title" => $request->input('title'),
                "slug" =>  $imagePath ?? '',
                "price" => $request->input('price'),
                "expires_at" => $request->input('expires'),
                "description" => $request->input('desc'),
                "user_id" => Auth::id(),
                "category_id" => $request->category
            ]);
        }

        return redirect('/dashboard');
    }

    public function showSinglePost($id)
    {
        $singlepost = Advertise::where('id', $id)->first();

        $canEdit = false;

        if ($singlepost && $singlepost->user_id == Auth::id()) {
            $canEdit = true;
        }
        $singlepost->slug = asset($singlepost->slug);

        $category = Category::where('id', $singlepost->category_id)->first();
        $singlepost->category_name = $category->name;

        return Inertia::render('SingleAd', [
            'singlepost' => $singlepost,
            'canEdit' => $canEdit,
        ]);
    }

    public function editAd($id)
    {

        $singlepost = Advertise::where('id', $id)->first();
        $categories = Category::all();
        if ($singlepost && $singlepost->user_id == Auth::id()) {
            $singlepost->slug = asset($singlepost->slug);

            return Inertia('EditAdvertise', compact(['singlepost', 'categories']));
        }
        return redirect('/');
    }

    public function saveEditAd(Request $request, Advertise $advertise)
    {

        if ($advertise->user_id == Auth::id()) {


            $validated = $request->validate([
                'title' => 'required|max:50',
                'price' => 'required',
                'expires' => 'required',
                'desc' => 'required|max:200',
                'category' => 'required',
            ]);



            if ($validated) {
                $array = [
                    "title" => trim($request->title),
                    "description" => trim($request->desc),
                    "price" => trim($request->price),
                    "expires_at" => trim($request->expires),
                    'category_id' => trim($request->category),
                ];


                if ($request->hasFile('image')) {
                    $array['slug'] =  "storage/" . $request->file('image')->store('images', 'public');

                    if ($advertise->slug != "src/images/default.jpg") {
                        unlink($advertise->slug);
                    }
                }

                $advertise->update($array);
                $advertise->slug = asset($advertise->slug);
            }

            return to_route('singleAd', ["id" => $advertise->id]);
        }

        return redirect('/');
    }

    public function deleteAd(Advertise $advertise)
    {
        if ($advertise->user_id == Auth::id()) {
            if ($advertise->slug != "src/images/default.jpg") {
                if (file_exists($advertise->slug)) {
                    unlink($advertise->slug);
                }
            }
            $advertise->delete();
        }
        return to_route('dashboard');
    }
}
