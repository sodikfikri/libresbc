<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserManagementApiController extends Controller
{
    public function user_list(Request $request)
    {
        try {
            $data = DB::table('users')
                    ->select('users.id', 'users.fullname', 'users.email', 'users.username', 'users.password', 'roles.name as role_name')
                    ->join('roles', 'users.role_id', '=', 'roles.id')
                    ->whereNull('users.deleted_at')
                    ->get();

            return datatables()->of($data)
            // ->addIndexColumn()
            ->addColumn('action', function($row){
                $data = '<button type="button" class="btn btn-warning btn-sm waves-effect mr-2" id="btn-detail" data-id="'.$row->id.'"><i class="fas fa-edit"></i></button>';
                $data .= '<button type="button" class="btn btn-danger btn-sm waves-effect" id="btn-delete" data-id="'.$row->id.'"><i class="fas fa-trash"></i></button>';
                return $data;
            })
            ->make(true);
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
