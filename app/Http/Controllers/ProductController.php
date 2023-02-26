<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('product/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product/create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('product/edit', ['productId' => $id]);
    }
}
