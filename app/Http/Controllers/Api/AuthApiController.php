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
use Session;

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

            $user = DB::table('users')->where('username', $username)->get();

            if (!$user) {
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
            header("Set-Cookie: token=".$token."; path=/; httpOnly");
            
            $response = [
                'meta' => [
                    'code' => '200',
                    'message' => 'Login has success full'
                ],
                'token' => $token
            ];

            return response()->json($response, 200);
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
}
