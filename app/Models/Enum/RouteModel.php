<?php

namespace App\Models\Enum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class RouteModel extends Model
{
    public function routev2_count($option)
    {
        $serchX = ($option['search'] == "") ? '' : ' WHERE (destination_number LIKE "%'.$option['search'].'%" OR primary_route LIKE "%'.$option['search'].'%" OR secondary_route LIKE "%'.$option['search'].'%") ';
        $data = DB::select('SELECT count(*) total FROM libresbc.getroutev2 '.$serchX);

        return $data;
    }
    public function routev2_list($option)
    {
        $Obj = [];
        // search query
        $serchX = ($option['search'] == "") ? '' : ' WHERE (destination_number LIKE "%'.$option['search'].'%" OR primary_route LIKE "%'.$option['search'].'%" OR secondary_route LIKE "%'.$option['search'].'%") ';
        $data = DB::select('SELECT *,
                            CASE
                                WHEN primary_route = "141" then "TELIN_IP_HK"
                                WHEN primary_route = "112" then "TELIN_GP_HK"
                                WHEN primary_route = "110" then "TELIN_GP_SG"
                                ELSE primary_route
                            END  primary_name
                            FROM libresbc.getroutev2 '.$serchX.' ORDER BY '.$option['order']['column'].' '.$option['order']['dir'].' LIMIT ' . $option['limit']['limit'] . ' OFFSET ' . $option['limit']['offset']);
        
        foreach($data as $key => $val) { 
            $Obj[$key] = [
                'id' => $val->id,
                'check' => '<div class="form-check"><input type="checkbox" class="form-check-input route-check" id="route-check" data-id="'.$val->id.'"><label class="form-check-label" for="exampleCheck1"></label></div>',
                'destination_number' => $val->destination_number,
                'primary_route' => $val->primary_name,
                'secondary_route' => $val->secondary_route,
                'action' => '<button type="button" class="btn btn-warning btn-sm waves-effect mr-2" id="btn-detail" data-id="'.$val->id.'"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger btn-sm waves-effect" id="btn-delete" data-id="'.$val->id.'"><i class="fas fa-trash"></i></button>'
            ];
        }

        return $Obj;
    }

    public function dst_chek($data) 
    {
        $data = DB::table('getroutev2')->where('destination_number', $data)->get();
        return $data;
    }

    public function store($data)
    {
        $ins = DB::table('getroutev2')->insert($data);
        return $ins;
    }

    public function update(array $id = [], array $data = [])
    {
        $update = DB::table('getroutev2')->where('id', $id)->update($data);
        return $update;
    }

    public function detail($id)
    {
        $data = DB::table('getroutev2')->where('id', $id)->get();
        return $data;
    }

    public function delete_data($id)
    {
        $data = DB::table('getroutev2')->whereIn('id', $id)->delete();
        return $data;
    }
}
