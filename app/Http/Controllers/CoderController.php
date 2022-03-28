<?php

namespace App\Http\Controllers;

use App\Models\Coder;
use App\Http\Requests\StoreCoderRequest;
use App\Http\Requests\UpdateCoderRequest;

class CoderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCoderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coder  $coder
     * @return \Illuminate\Http\Response
     */
    public function show(Coder $coder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coder  $coder
     * @return \Illuminate\Http\Response
     */
    public function edit(Coder $coder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCoderRequest  $request
     * @param  \App\Models\Coder  $coder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoderRequest $request, Coder $coder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coder  $coder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coder $coder)
    {
        //
    }
}
