<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserManagementModel extends Model
{
    public function UserList()
    {
        $data = DB::table('users')
                    ->select('users.id', 'users.fullname', 'users.email', 'users.username', 'users.password', 'roles.name as role_name')
                    ->join('roles', 'users.role_id', '=', 'roles.id')
                    ->whereNull('users.deleted_at')
                    ->get();

        return $data;
    }

    public function UserDetail($id)
    {
        $data = DB::table('users')->where('id', $id)->get();

        return $data;
    }

    public function UserAdd($data)
    {
        $data = DB::table('users')->insert($data);

        return $data;
    }

    public function UserUpdate($id, $data)
    {
        $doChange = DB::table('users')->where('id', $id)->update($data);

        return $doChange;
    }

    public function RoleSelect()
    {
        $data = DB::table('roles')->select('id', 'name')->whereNull('deleted_at')->get();

        return $data;
    }

    public function RoleList()
    {
        $data = DB::table('roles')->select('id', 'name', 'is_active', 'created_at')->whereNull('deleted_at')->get();
        $response = [];

        foreach($data as $key => $val) {
            if ($val->created_at != null) {
                $val->created_at = Carbon::parse($val->created_at)->setTimezone('Asia/Jakarta')->format('Y-m-d H:i');
            }
        }

        return $data;
    }

    public function RoleDetail($id)
    {
        $data = DB::table('roles')->where('id', $id)->get();

        return $data;
    }

    public function RoleAdd($data)
    {
        $data = DB::table('roles')->insert($data);
        
        return $data;
    }

    public function RoleUpdate($id, $data) 
    {
        $data = DB::table('roles')->where('id', $id)->update($data);

        return $data;
    }

}
