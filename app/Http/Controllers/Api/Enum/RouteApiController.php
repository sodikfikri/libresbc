<?php

namespace App\Http\Controllers\Api\Enum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Enum\RouteModel;

use Exception;

class RouteApiController extends Controller
{
    public function list(Request $req)
    {
        try {
            $start = $req->start;
            $search = ($req->search['value'] ? $req->search['value'] : '');
            $length = $req->length;
            $draw = $req->draw;
            $numPerPage = ((int)$length ? (int)$length : 20);
            $page = ($start > 1 ? ((int)$start / (int)$length)+1 : $start+1);
            $skip = ($page === 1 ? 0 : $page-1) * $numPerPage;
            $limit = $skip . ',' . $numPerPage;

            $listCheckerColumn = [
                '0' => 'id',
                '1' => 'destination_number',
                '2' => 'primary_route',
                '3' => 'secondary_route'
            ];
            
            $option = [
                'page' => $page,
                'perpage' => $length,
                'search' => $search,
                'limit' => [
                    'limit' => $numPerPage,
                    'offset' => $skip
                ],
                'order' => [
                    'column' => !empty($req->order[0]['column']) ? $listCheckerColumn[$req->order[0]['column']] : 'id',
                    'dir' => $req->order[0]['dir'] ?? 'desc',
                ],
            ];

            $model = new RouteModel();

            $count = $model->routev2_count($option);
            $list = $model->routev2_list($option);

            if (count($list) !== 0) {
                # success response
                $response = [
                    'meta' => [
                        'type' => 'success',
                        'code' => '200_200',
                        'msg'  => 'Success: Get data successfully'
                    ],
                    'draw' => $draw,
                    'recordsTotal' => $count[0]->total,
                    'recordsFiltered' => $count[0]->total,
                    'data' => $list
                ];
            } else {
                # fail response
                $response = [
                    'meta' => [
                        'type' => 'failed',
                        'code' => '200_202',
                        'msg'  => 'Failed: Data not found'
                    ],
                    'draw' => $draw,
                    'recordsTotal' => '0',
                    'recordsFiltered' => '0',
                    'data' => []
                ];
            }
            # Set Respond
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = [
                'meta' => [
                    'code' => 400,
                    'message' => (string) $th->getMessage()
                ]
            ];

            return response()->json($response);
        }
    }

    public function store(Request $req) 
    {
        try {
            $params = [
                'destination_number' => $req->destination_number,
                'primary_route' => $req->primary_route,
                'secondary_route' => $req->secondary_route
            ];

            $model = new RouteModel();

            $store = $model->store($params);

            dd($store);
        } catch (\Throwable $th) {
            $response = [
                'meta' => [
                    'code' => 400,
                    'message' => (string) $th->getMessage()
                ]
            ];

            return response()->json($response);
        }
    }
}
