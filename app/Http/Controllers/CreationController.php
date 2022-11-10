<?php

namespace App\Http\Controllers;

use App\Models\Creation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CreationController extends Controller
{
    // Viewing creation detail page
    public function show($id)
    {
        Creation::findOrFail($id);
        $posterUserId = Creation::where('id', $id)->first()->user->id;

        return view('creations.show', [
            'creation' => Creation::where('id', $id)->first(),
            'otherByThisUser' => Creation::where('user_id', $posterUserId)
                ->where('id', '!=', $id)->inRandomOrder()->limit(6)->get(),
        ]);
    }

    // Viewing creation creation page
    public function create()
    {
        return view('creations.create');
    }

    // Store creation to database
    public function store(Request $request)
    {
        // Validate user input
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'title' => 'required|max:64',
            'description' => 'required',
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
            $creation->keywords = $request->get('keywords') ?? '';
            $creation->user_id = Auth::user()->id;
            $creation->save();

            // Save image and image url
            $file = $request->file('image');
            $filename = $creation->id . '-' . Auth::user()->username . '-' . $file->getClientOriginalName();
            $file->move(public_path('img/creations'), $filename);
            $creation->image_url = $filename;
            $creation->save();
        }

        // Redirect
        return redirect()->route('creationShow', $creation->id);
    }

    // Viewing creation edit page
    public function edit($id)
    {
        // If the creation is not user's, redirect
        if (Auth::user()->id != Creation::where('id', $id)->first()->user_id) {
            return redirect('/');
        }

        // Redirect
        return view('creations.edit', [
            'creation' => Creation::all()->where('id', $id)->first(),
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
            'keywords' => 'nullable',
        ]);

        // Update text-based details
        $creation = Creation::findOrFail($id);
        $creation->title = $request->get('title');
        $creation->description = $request->get('description');
        $creation->keywords = $request->get('keywords') ?? '';
        $creation->save();

        // Overwrite image if user upload new image
        if ($request->file('image')) {
            $file = $request->file('image');
            $file->move(public_path('img/creations'), $creation->image_url);
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
}
