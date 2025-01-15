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
        try{
            $pelanggan = Pelanggan::all();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data pelanggan',
                'data'=>$pelanggan,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data pelanggan. '. $e.message(),
            ]);
        }
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
    public function show($id)
    {
        try{
            $pelanggan = Pelanggan::where('id',$id,)->first();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data detail pelanggan',
                'data'=>$pelanggan,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data detail pelanggan. '. $e.message(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
           'nama'=>'required|string',
            'alamat'=>'required|string',
            'telp'=>'required|string'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah = Pelanggan::where('id',$id)->update([
            'nama'        =>$request->nama,
            'alamat'      =>$request->alamat,
            'telp'        =>$request->telp,
           
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
        $hapus=Pelanggan::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'Success']);
        } else {
            return Response()->json(['status'=>'Failed']);
        }
    }
}
