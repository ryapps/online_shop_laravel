<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Validator;
class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_petugas'=>'required|string',
            'username'=>'required|string',
            'password'=>'required|string',
            'level'=>'required|string'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $save = Petugas::create([
            'nama_petugas'    =>$request->nama_petugas,
            'username'      =>$request->username,
            'password'      =>$request->password,
            'level'      =>$request->level,
        ]);
        if($save){
            return Response()->json(['status'=>'Success']);
        } else {
            return Response()->json(['status'=>'Failed']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
