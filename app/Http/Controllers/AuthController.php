<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email',
            'address'  => 'required|string',
            'birthday' => 'required|date_format:d-m-Y',
            'role'     => 'required|string|in:admin,user',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'failed',
                'message' => $validator->errors(),
            ], 422);
        }

        $formattedDate = \DateTime::createFromFormat('d-m-Y', $request->birthday)
            ->format('Y-m-d');

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'address'  => $request->address,
            'birthday' => $formattedDate,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
        ];

        try {
            $insert = User::create($data);
            return response()->json([
                'status'  => 'success',
                'message' => 'Data berhasil dimasukkan',
                'data' => $insert
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'failed',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    function getUser() {
        try{
            $user = User::get();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data user',
                'data'=>$user,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data user. '. $e.message(),
            ]);
        }
    }
    function getDetailUser($id) {
        try{
            $user = User::where('id',$id,)->first();
            return response()->json([
                'status'=>true,
                'message'=>'berhasil load data detail user',
                'data'=>$user,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal load data detail user. '. $e.message(),
            ]);
        }
    }
    function update_user($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'email'=>['required', Rule::unique('users')->ignore($id)],
            'address'  => 'required|string',
            'birthday' => 'required|date_format:d-m-Y',
            'role'     => 'required|string|in:admin,karyawan',
            'password' => 'required|string',
            
            
        ]);


        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }
        $formattedDate = \DateTime::createFromFormat('d-m-Y', $request->birthday)
        ->format('Y-m-d');
        $data = [
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'password'=>Hash::make($request->get('password')),
            'role'=>$request->get('role'),
            "address"=>$request->get("address"),
            "birthday"=>$formattedDate,
        ];
        try {
            $update = User::where('id',$id)->update($data);
            return Response()->json([
                "status"=>true,
                'message'=>'Data berhasil diupdate'
            ]);


        } catch (Exception $e) {
            return Response()->json([
                "status"=>false,
                'message'=>$e
            ]);
        }
    }
    function delete_user($id) {
        try{
            User::where('id',$id,)->delete();
            return response()->json([
                'status'=>true,
                'message'=>'data berhasil dihapus',
            ]);
        } catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'gagal hapus data. '. $e.message(),
            ]);
        }
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::guard('api')->user();
        return response()->json([
                'status' => true,
                'message'=>'Sukses login',
                'data'=>$user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
    }


   
    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json([
            'status' => true,
            'message' => 'Sukses logout',
        ]);
    }


    
    public function me()
    {
        return response()->json(auth()->guard('api')->user());
    }

}
