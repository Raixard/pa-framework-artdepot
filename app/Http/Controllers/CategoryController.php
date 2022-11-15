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
        return view('categories.index', [
            'creations' => Creation::all()->whereNotNull('category_id'),
        ]);
    }

    public function show($id){
        return view('categories.show', [
            'creations' => Creation::all()->where('category_id', $id),
            'category' => Category::where('id',$id)->first()
        ]);
    }

}