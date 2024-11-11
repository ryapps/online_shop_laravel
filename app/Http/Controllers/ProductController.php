<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
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
            'nama_produk'=>'required|string',
            'deskripsi'=>'string',
            'harga'=>'required|numeric'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $save = Produk::create([
            'nama_produk'    =>$request->nama_produk,
            'deskripsi'      =>$request->deskripsi,
            'harga'      =>$request->harga,
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
