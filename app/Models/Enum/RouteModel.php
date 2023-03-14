<?php

namespace App\Models\Enum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class RouteModel extends Model
{
    public function test() 
    {
        $data = DB::select('select * from testroutev2 limit 5');
        return $data;
    }
    public function routev2_count($option)
    {
        $serchX = ($option['search'] == "") ? '' : ' WHERE (destination_number LIKE "%'.$option['search'].'%" OR primary_route LIKE "%'.$option['search'].'%" OR secondary_route LIKE "%'.$option['search'].'%") ';
        $data = DB::select('SELECT count(*) total FROM testroutev2 '.$serchX);

        return $data;
    }
    public function routev2_list($option, $access)
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
                            FROM testroutev2 '.$serchX.' ORDER BY '.$option['order']['column'].' '.$option['order']['dir'].' LIMIT ' . $option['limit']['limit'] . ' OFFSET ' . $option['limit']['offset']);
        
        foreach($data as $key => $val) { 
            $act = '';
            if ($access['is_update'] == 1) {
                $act .= '<button type="button" class="btn btn-warning btn-sm waves-effect mr-2" id="btn-detail" data-id="'.$val->destination_number.'"><i class="fas fa-edit"></i></button>';
            }
            if ($access['is_delete'] == 1) {
                $act .= '<button type="button" class="btn btn-danger btn-sm waves-effect" id="btn-delete" data-id="'.$val->destination_number.'"><i class="fas fa-trash"></i></button>';
            }
            $Obj[$key] = [
                'id' => $val->destination_number,
                'check' => '<div class="form-check"><input type="checkbox" class="form-check-input route-check" id="route-check" data-id="'.$val->destination_number.'"><label class="form-check-label" for="exampleCheck1"></label></div>',
                'destination_number' => $val->destination_number,
                'primary_route' => $val->primary_name,
                'secondary_route' => $val->secondary_route,
                'action' => $act
            ];
        }

        return $Obj;
    }

    public function dst_chek($data) 
    {
        $data = DB::table('testroutev2')->where('destination_number', $data)->get();
        return $data;
    }

    public function store($data)
    {
        $ins = DB::table('testroutev2')->insert($data);
        return $ins;
    }

    public function update(array $id = [], array $data = [])
    {
        $update = DB::table('testroutev2')->where('destination_number', $id)->update($data);
        return $update;
    }

    public function detail($id)
    {
        $data = DB::table('testroutev2')->where('destination_number', $id)->get();
        return $data;
    }

    public function delete_data($id)
    {
        $data = DB::table('testroutev2')->whereIn('destination_number', $id)->delete();
        return $data;
    }

    public function primary_route()
    {
        // $data = DB::select('SELECT destination_number,
        //                     CASE
        //                         WHEN primary_route = "141" then "TELIN_IP_HK"
        //                         WHEN primary_route = "112" then "TELIN_GP_HK"
        //                         WHEN primary_route = "110" then "TELIN_GP_SG"
        //                         ELSE primary_route
        //                     END primary_route
        //                     FROM testroutev2 GROUP BY primary_route');
        $data = DB::table('master_primary')->where('is_active', '1')->get();
        return $data;
    }

    public function import($data) 
    {
        try {
            $arr = [];
    
            foreach($data as $key => $val) {
                $validate = $this->dst_chek($val['Destination Number']);
                if (count($validate) != 0) {
                    $obj = [
                        'destination_number' => $val['destination_number'],
                        'primary_route' => $val['primary_route'],
                        'secondary_route' => $val['secondary_route']
                    ];
        
                    array_push($arr, $obj);
                } else {
                    $params = [
                        'destination_number' => $val['destination_number'],
                        'primary_route' => $val['primary_route'],
                        'secondary_route' => $val['secondary_route'],
                    ];
                    $this->store($params);
                }
            }

            $response = [
                'code' => '200',
                'message' => '',
                'data' => $arr
            ];

            return $response;
        } catch (Exception $e) {
            $response = [
                'code' => '400',
                'message' => $e
            ];
            return $response;
        }
    }

    public function export($data)
    {
        $params = '';

        if ($data != null) {
            $params = 'WHERE destination_number LIKE "%'.$data.'%" OR primary_route LIKE "%'.$data.'%" OR secondary_route LIKE "%'.$data.'%"';
        }

        $data = DB::select('SELECT destination_number, primary_route, secondary_route FROM testroutev2 ' . $params);

        return $data;
        // $data = DB::select('SELECT destination_number, 
        //                     CASE
        //                         WHEN primary_route = "141" then "TELIN_IP_HK"
        //                         WHEN primary_route = "112" then "TELIN_GP_HK"
        //                         WHEN primary_route = "110" then "TELIN_GP_SG"
        //                         ELSE primary_route
        //                     END primary_route,
        //                     secondary_route
        //                     FROM testroutev2 WHERE primary_route IN ('.$data.')');
        // return $data;
    }

    public function jobs_list()
    {
        $data = DB::table('jobs')->select('queue', 'attempts', 'created_at')->get();

        return $data;
    }

    public function failed_list()
    {
        $data = DB::table('failed_insert')->select('destination_number', 'reason')->get();
        
        $arr = [];

        if (count($data) != 0) {
            foreach($data as $key => $val) {
                $obj = [
                    'destination_number' => $val->destination_number,
                    'status' => 'Failed',
                    'reason' => $val->reason
                ];
    
                array_push($arr, $obj);
            }
        }

        return $arr;
    }

    public function data_master_primary()
    {
        $data = DB::table('master_primary')->select('id', 'name', 'is_active')->where('is_active', 1)->get();
        
        return $data;
    }
}
