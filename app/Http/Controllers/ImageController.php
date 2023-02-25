<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('image/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('image/create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show($id)
    {
        return view('image/edit', ['imageId' => $id]);
    }
}
