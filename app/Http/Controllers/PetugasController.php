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
        try{
            $petugas = Petugas::all();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data detail petugas',
                'data'=>$petugas,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data detail petugas. '. $e.message(),
            ]);
        }
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
            'level'=>'required|string|in:admin,karyawan'
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
    public function show($id)
    {
        try{
            $petugas = Petugas::where('id',$id,)->first();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data detail petugas',
                'data'=>$petugas,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data detail petugas. '. $e.message(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'nama_petugas'=>'required|string',
            'username'=>'required|string',
            'password'=>'required|string',
            'level'=>'required|string|in:admin,karyawan'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah=Petugas::where('id',$id)->update([
            'nama_petugas'    =>$request->nama_petugas,
            'username'        =>$request->username,
            'password'        =>$request->password,
            'level'           =>$request->level,
           
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
        $hapus=Petugas::where('id',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'Success']);
        } else {
            return Response()->json(['status'=>'Failed']);
        }
    }
}
