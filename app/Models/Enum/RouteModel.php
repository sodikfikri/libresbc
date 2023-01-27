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
        $data = DB::select('SELECT * FROM libresbc.getroutev2 '.$serchX.' ORDER BY '.$option['order']['column'].' '.$option['order']['dir'].' LIMIT ' . $option['limit']['limit'] . ' OFFSET ' . $option['limit']['offset']);
        
        foreach($data as $key => $val) { 
            $Obj[$key] = [
                'check' => '<div class="form-check"><input type="checkbox" class="form-check-input route-check" id="route-check" data-id="'.$val->id.'"><label class="form-check-label" for="exampleCheck1"></label></div>',
                'destination_number' => $val->destination_number,
                'primary_route' => $val->primary_route,
                'secondary_route' => $val->secondary_route,
                'action' => '<button type="button" class="btn btn-warning btn-xs waves-effect mr-2" data-id="'.$val->id.'"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger btn-xs waves-effect" data-id="'.$val->id.'"><i class="fas fa-trash"></i></button>'
            ];
        }

        return $Obj;
    }
    public function store($data)
    {
        $ins = DB::table('getroutev2')->insert($data);

        return $ins;
    }
}
