<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Validator;
class CustomerController extends Controller
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
            'nama'=>'required|string',
            'alamat'=>'required|string',
            'telp'=>'required|string'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $save = Pelanggan::create([
            'nama'    =>$request->nama,
            'alamat'      =>$request->alamat,
            'telp'      =>$request->telp,
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
