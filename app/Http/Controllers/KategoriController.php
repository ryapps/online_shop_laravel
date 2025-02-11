<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $kategori = Kategori::all();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data kategori',
                'data'=>$kategori,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data kategori. '. $e.message(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $save = Kategori::create([
            'nama_kategori'    =>$request->nama_kategori,
            'deskripsi'      =>$request->deskripsi,
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
    public function show($id)
    {
        try{
            $kategori = Kategori::where('id_kategori',$id,)->first();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data detail kategori',
                'data'=>$kategori,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data detail kategori. '. $e.message(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
           
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah = Kategori::where('id_kategori',$id)->update([
            'nama_kategori'    =>$request->nama_kategori,
            'deskripsi'      =>$request->deskripsi,
           
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
    public function destroy($id)
    {
        $hapus=Kategori::where('id_kategori',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'Success']);
        } else {
            return Response()->json(['status'=>'Failed']);
        }
    }
}
