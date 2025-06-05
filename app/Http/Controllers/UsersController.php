<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Users::with('office')->get();
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

        $users = Users::create($data);

        return response()->json([
            'message' => 'Usuario creado correctamente',
            'user' => $users,
        ], 201);
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
    public function update(Request $request, string $id_user)
    {
        $request->validate([
            'nick_user' => "required|string|max:50|unique:users,nick_user,{$id_user},id_user",
            'password' => 'required|string|max:60',
        ]);

        $dataUpdate = $request->only(['nick_user', 'password']);

        try {
            $user = Users::findOrFail($id_user);
            $dataUpdate['password'] = bcrypt($request->password);
            $user->update($dataUpdate);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'user' => $user,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
