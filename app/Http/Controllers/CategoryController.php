<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Creation;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $creationIds = Creation::inRandomOrder()
        ->select('category_id')
        ->distinct()
        ->pluck('category_id');

        $creations = collect();
        foreach ($creationIds as $creationId) {
            $creations->push(Creation::where('category_id', $creationId)->first());
        }

        return view('categories.index', [
            'creations' => $creations,
        ]);
    }

    public function show($id){
        return view('categories.show', [
            'creations' => Creation::all()->where('category_id', $id),
            'category' => Category::where('id',$id)->first()
        ]);
    }

}