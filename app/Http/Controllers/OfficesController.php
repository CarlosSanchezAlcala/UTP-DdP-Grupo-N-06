<?php

namespace App\Http\Controllers;

use App\Models\Offices;
use Illuminate\Http\Request;

class OfficesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Offices::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_offi' => 'required|string|max:40',
            'desc_offi' => 'required|string|max:100',
        ]);

        return Offices::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
