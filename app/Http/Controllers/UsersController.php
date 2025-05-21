<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Users::with('offices')->get();
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
            'name_user' => 'required|string|max:50',
            'ape_pat_user' => 'required|string|max:50',
            'ape_mat_user' => 'required|string|max:50',
            'dni_user' => 'required|string|max:8|unique:users',
            'nick_user' => 'required|string|max:50|unique:users',
            'password' => 'required|string|max:60',
            'level_user' => 'required|string|max:1|in:A,E',
            'id_offi' => 'required|string',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        return Users::create($data);
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
