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
        try{
            $produk = Produk::all();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data detail produk',
                'data'=>$produk,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data detail produk. '. $e.message(),
            ]);
        }
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
        try{
            $produk = Produk::where('id',$id,)->first();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data detail produk',
                'data'=>$produk,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data detail produk. '. $e.message(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'nama_produk'=>'required|string',
            'deskripsi'=>'string',
            'harga'=>'required|numeric'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah=Produk::where('id',$id)->update([
            'nama_produk'    =>$request->nama_produk,
            'deskripsi'      =>$request->deskripsi,
            'harga'          =>$request->harga,
           
        ]);
        if($ubah){
            return Response()->json(['status'=>'Success']);
        } else {
            return Response()->json(['status'=>'Failed']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hapus=Produk::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'Success']);
        } else {
            return Response()->json(['status'=>'Failed']);
        }
    }
}
