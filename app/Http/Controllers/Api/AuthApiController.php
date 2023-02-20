<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use Validator;
use Exception;
use Hash;
use Illuminate\Support\Facades\Session;

class AuthApiController extends Controller
{
    public function Login(Request $request)
    {
        try {

            $username = $request->username;
            $password = $request->password;

            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ]);

            if($validator->fails()) throw new Exception($validator->errors()->first());
            
            $user = DB::select('select * from users where username = "'.$username.'"');
            if (count($user) == 0) {
                $response = [
                    'meta' => [
                        'code' => '404',
                        'message' => 'User not found!'
                    ]
                ];
                return response()->json($response, 200);
            }
            
            if(!Hash::check($password, $user[0]->password)) {
                throw new Exception('Username or Password is wrong!');
            }
            
            $access_menu = $this->access_menu($user[0]->role_id);
            session()->put("access-menu",  json_encode($access_menu));
            
            $key = env('JWT_SECRET');
            $payload = [
                'iss' => 'STS DEV', // Issuer => oleh siapa dibuat
                'aud' => 'LIBRE SBC', // Audience => digunakan untuk siapa
                'iat' => time(), // Issued At => dibuat kapan (timestamps)
                'nbf' => time(), // Not Before => tidak bisa digunakan sebelum (1s)
                'exp' => time()+86400, // Expired 24 Hours
                'data' => [
                    'id'  => $user[0]->id,
                ]
            ];
            $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
            session()->put("jwt-token",  $token);
            // header("Set-Cookie: token=".$token."; path=/; httpOnly");

            return redirect('/dashboard');
            // dd($token);
            // $response = [
            //     'meta' => [
            //         'code' => '200',
            //         'message' => 'Login has success full'
            //     ],
            //     'token' => $token
            // ];
            // redirect()->route("dashboard");
            // return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'meta' => [
                    'code' => '400',
                    'message' => (string) $th->getMessage()
                ]
            ];
            return response()->json($response);
        }
    }

    public function Logout(Request $request)
    {
        try {
            session()->flush();
            return redirect('/');
        } catch (\Throwable $th) {
            $response = [
                'meta' => [
                    'code' => '400',
                    'message' => (string) $th->getMessage()
                ]
            ];
            return response()->json($response);
        }
    }

    public function access_menu($role) 
    {
        try {
            $data = [];
            $menu_id = $this->get_menu($role);
            // dd($menu_id);
            if (count($menu_id) != 0) {
                foreach($menu_id as $key => $val) {
                    $params = [
                        'name' => $val->menu_name,
                        'is_active' => $val->is_active,
                        'access' => $val->access,
                        'sub_menu' => count($this->sub_menu($val->menu_id, $role)) == 0 ? [] : $this->sub_menu($val->menu_id, $role)
                    ];
                    array_push($data, $params);
                }
            }
            return $data;

        } catch (\Throwable $th) {
            $response = [
                'meta' => [
                    'code' => '400',
                    'message' => 'err access menu ' . (string) $th->getMessage()
                ]
            ];
            return response()->json($response);
        }
    }

    public function get_menu($role)
    {
        try {
            $data = DB::table('access_menu')
                        ->select('access_menu.id','access_menu.menu_id', 'menu.name as menu_name')
                        ->join('menu', 'access_menu.menu_id', '=', 'menu.id')
                        ->where('role_id', $role)
                        ->groupBy('menu_id')
                        ->get();

            // dd($data);
            if (count($data) != 0) {
                foreach($data as $key => $val) {
                    $acc_permit = DB::select('select is_create, is_read, is_update, is_delete, is_import, is_export, is_active from permissions where role_id = '.$role.' and category = 1 and module_id ='.$val->menu_id)[0];
                    $menu_status = DB::select('select is_active from permissions where role_id = '.$role.' and module_id = '.$val->menu_id.' and category = 1')[0];

                    $val->is_active = $menu_status->is_active;
                    $val->access = $acc_permit;
                }
            }

            return $data;
        } catch (\Throwable $th) {
            $response = [
                'meta' => [
                    'code' => '400',
                    'message' => 'err get menu ' . (string) $th->getMessage()
                ]
            ];
            return $response;
        }
    }

    public function sub_menu($menu_id, $role)
    {
        try {
            $data = [];

            $sub_menu = DB::table('sub_menu')
                        ->where('menu_id', $menu_id)
                        ->get();
            
            foreach($sub_menu as $key => $val) {
                $acc_permit = DB::select('select is_create, is_read, is_update, is_delete, is_import, is_export, is_active from permissions where role_id = '.$role.' and category = 2 and module_id ='.$val->id)[0];
                // dd('select * from permissions where role_id = '.$role.' and module_id = '.$val->menu_id.' and category = 2');
                $menu_status = DB::select('select is_active from permissions where role_id = '.$role.' and module_id = '.$val->id.' and category = 2')[0];

                $params = [
                    'name' => $val->name,
                    'is_active' => $menu_status->is_active,
                    'access' => $acc_permit,
                    'child' => $this->child($val->id, $role)
                ];
                array_push($data, $params);
            }

            return $data;
        } catch (\Throwable $th) {
            $response = [
                'meta' => [
                    'code' => '400',
                    'message' => 'err sub menu ' . (string) $th->getMessage()
                ]
            ];
            return $response;
        }
    }

    public function child($sub_menu_id, $role)
    {
        $data = DB::table('child')->select('id', 'name')->where('sub_menu_id', $sub_menu_id)->get();
        if (count($data) != 0) {
            foreach($data as $key => $val) {
                $acc_permit = DB::select('select is_create, is_read, is_update, is_delete, is_import, is_export, is_active from permissions where role_id = '.$role.' and category = 3 and module_id ='.$val->id)[0];
                $menu_status = DB::select('select is_active from permissions where role_id = '.$role.' and module_id = '.$val->id.' and category = 3')[0];

                $val->is_active = $menu_status->is_active;
                $val->access = $acc_permit;
            }
        }
        
        return count($data) == 0 ? [] : $data;
    }
}
