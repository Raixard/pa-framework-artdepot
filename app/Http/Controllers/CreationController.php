<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Creation;
use App\Models\Follow;
use App\Models\ReportCat;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class CreationController extends Controller
{
    // Viewing website home page
    public function home()
    {
        $endpoint = env('BASE_ENV') . '/api/creations';

        $client = new Client();
        $response = $client->request('GET', $endpoint);
        $data = json_decode($response->getBody(), true);

        return view('home', [
            'creations' => $data['data'],
            'title' => 'explore',
            'jenis' => ReportCat::all(),
        ]);
    }

    // Visiting search page
    public function search(Request $request)
    {
        $endpoint = env('BASE_ENV') . '/api/creations/search/' . $request->get('q');

        $client = new Client();
        $response = $client->request('GET', $endpoint);
        $result = json_decode($response->getBody(), true)["data"];

        // View the page
        return view('creations.search', [
            'creations' => $result,
        ]);
    }

    // Viewing followed creations page
    public function showFollowed()
    {
        $endpoint = env('BASE_ENV') . '/api/creations/user/' . Auth::user()->id . '/followed';
        $client = new Client();
        $response = $client->request('GET', $endpoint);
        $followedCreations = json_decode($response->getBody(), true)["data"];

        return view('home', [
            'creations' => $followedCreations,
            'title' => 'followed',
            'jenis' => ReportCat::where('id',1)->get(),
        ]);
    }

    // Viewing creation detail page
    public function show($id)
    {
        $endpoint = env('BASE_ENV') . '/api/creation/' . $id;
        $client = new Client();
        $response = $client->request('GET', $endpoint);
        $creation = json_decode($response->getBody(), true)["data"];

        // Poster id
        $posterUserId = $creation["user"]["id"];
        $isFollowingPoster = FollowController::isFollowing($posterUserId);

        // Other by this user
        $endpoint = env('BASE_ENV') . '/api/creations/user/' . $posterUserId . '/true/not/' . $creation['id'];
        $client = new Client();
        $response = $client->request('GET', $endpoint);
        $otherByThisUser = json_decode($response->getBody(), true)["data"];

        return view('creations.show', [
            'creation' => $creation,
            'otherByThisUser' => array_slice($otherByThisUser, 0, 6),
            'isFollowingPoster' => $isFollowingPoster,
        ]);
    }

    // Viewing creation creation page
    public function create()
    {
        return view('creations.create', ['categories' => Category::all()]);
    }

    // Store creation to database
    public function store(Request $request)
    {
        // Validate user input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'title' => 'required|max:64',
            'description' => 'required',
            'categories' => 'required',
            'keywords' => 'nullable',
        ]);

        // Create new Creation data
        $creation = new Creation();

        // If image file exissts
        if ($request->file('image')) {
            // Save data
            $creation->image_url = '';
            $creation->title = $request->get('title');
            $creation->description = $request->get('description');
            $creation->category_id = $request->get('categories');
            $creation->keywords = $request->get('keywords') ?? '';
            $creation->user_id = Auth::user()->id;
            $creation->save();

            // Save image and image url
            $image = $request->file('image');
            $filename = $creation->id . '-' . Auth::user()->username . '-' . $image->getClientOriginalName();
            $image_resized = Image::make($image->getRealPath());
            if (
                $image_resized->width() > 1280 ||
                $image_resized->height() > 1280
            ) {
                $image_resized->resize(1280, 1280, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
            $image_resized->save(public_path('img/creations/') . $filename);
            $creation->image_url = $filename;
            $creation->save();
        }

        // Redirect
        return redirect()->route('creationShow', $creation->id);
    }

    // Viewing creation edit page
    public function edit($id)
    {
        // If the creation is not user's or the user is not admin, redirect
        if (
            Auth::user()->id != Creation::where('id', $id)->first()->user_id &&
            Auth::user()->role != 'admin'
        ) {
            return redirect('/');
        }

        // Redirect
        return view('creations.edit', [
            'creation' => Creation::all()->where('id', $id)->first(),
            'categories' => Category::all()
        ]);
    }

    // Update creation detail
    public function update(Request $request, $id)
    {
        // Validate user input
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'title' => 'required|max:64',
            'description' => 'required',
            'categories' => 'required',
            'keywords' => 'nullable',
        ]);

        // Update text-based details
        $creation = Creation::findOrFail($id);
        $creation->title = $request->get('title');
        $creation->description = $request->get('description');
        $creation->category_id = $request->get('categories');
        $creation->keywords = $request->get('keywords') ?? '';
        $creation->save();

        // Overwrite image if user upload new image
        if ($request->file('image')) {
            $image = $request->file('image');
            $image_resized = Image::make($image->getRealPath());
            if (
                $image_resized->width() > 1280 ||
                $image_resized->height() > 1280
            ) {
                $image_resized->resize(1280, 1280, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
            $image_resized->save(public_path('img/creations/') . $creation->image_url);
        }

        // Redirect
        return redirect()->route('creationShow', $creation->id);
    }

    // Delete creation
    public function destroy($id)
    {
        // Find creation by id
        $creation = Creation::findOrFail($id);

        // Delete the image file if it exists
        if (File::exists(public_path('img/creations/' . $creation->image_url))) {
            File::delete(public_path('img/creations/' . $creation->image_url));
        }

        // Delete creation record
        $creation->delete();

        // Redirect
        return redirect('/');
    }

    public function getDataAPI()
    {
        $endpoint = env('BASE_ENV') . '/api/creations';

        $client = new Client();
        $response = $client->request('GET', $endpoint);
        $data = json_decode($response->getBody(), true);

        return view('home', [
            'creations' => $data['data'],
            'title' => 'ArtDepot'
        ]);
    }
}
