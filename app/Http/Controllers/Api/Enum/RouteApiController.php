<?php

namespace App\Http\Controllers\Api\Enum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Enum\RouteModel;
use App\Jobs\DispatchDataRoute;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Import;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Carbon;

use Exception;

class RouteApiController extends Controller
{
    public function List(Request $req)
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
                '0' => 'destination_number',
                '1' => 'destination_number',
                '2' => 'destination_number',
                '3' => 'primary_route',
                '4' => 'secondary_route'
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
                    'column' => !empty($req->order[0]['column']) ? $listCheckerColumn[$req->order[0]['column']] : 'destination_number',
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
                    'code' => '400',
                    'message' => (string) $th->getMessage()
                ]
            ];

            return response()->json($response);
        }
    }

    public function Store(Request $req) 
    {
        try {
            $model = new RouteModel();

            $params = [
                'destination_number' => '+'.$req->destination_number,
                'primary_route' => $req->primary_route,
                'secondary_route' => $req->secondary_route,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ];
            $validate = $model->dst_chek('+'.$req->destination_number);
            
            if (count($validate) != 0) {
                $response = [
                    'meta' => [
                        'code' => '400',
                        'message' => 'Destination Number has been used!'
                    ]
                ];
                return response()->json($response, 200);
            }

            $store = $model->store($params);

            if (!$store) {
                $response = [
                    'meta' => [
                        'code' => '400',
                        'message' => 'Failed to store data!'
                    ]
                ];
                return response()->json($response, 200);
            }
            $response = [
                'meta' => [
                    'code' => 200,
                    'message' => 'Store data has success full!'
                ]
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

    public function Update(Request $req)
    {
        try {
            $model = new RouteModel();

            $params = [
                'destination_number' => '+'.$req->destination_number,
                'primary_route' => $req->primary_route,
                'secondary_route' => $req->secondary_route,
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ];
            $id = [
                'id' => $req->id
            ];

            if ($req->validate == '1') {
                $validate = $model->dst_chek($params['destination_number']);
                
                if (count($validate) != 0) {
                    $response = [
                        'meta' => [
                            'code' => '400',
                            'message' => 'Destination Number has been used!'
                        ]
                    ];
                    return response()->json($response, 200);
                }
            }

            $doChange = $model->update($id, $params);

            $response = [
                'meta' => [
                    'code' => 200,
                    'message' => 'Update data has success full!'
                ]
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

    public function Detail(Request $request)
    {
        try {
            $model = new RouteModel();

            $data = $model->detail($request->id);

            if (!$data) {
                $response = [
                    'meta' => [
                        'code' => 404,
                        'message' => 'Data not found!'
                    ]
                ];
                return response()->json($response, 200);
            }

            $response = [
                'meta' => [
                    'code' => 200,
                    'message' => 'Get data has success full!'
                ],
                'data' => $data[0]
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

    public function Destroy(Request $req)
    {
        try {
            $model = new RouteModel();

            $del = $model->delete_data($req->id);
            if (!$del) {
                $response = [
                    'meta' => [
                        'code' => 400,
                        'message' => 'Failed to delete data!'
                    ]
                ];
                return response()->json($response, 200);
            }

            $response = [
                'meta' => [
                    'code' => 200,
                    'message' => 'Delete data has success full!'
                ],
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

    public function PrimaryRoute(Request $request)
    {
        try {
            $model = new RouteModel();
            $data = $model->primary_route();

            if (count($data) == 0) {
                $response = [
                    'meta' => [
                        'code' => '404',
                        'message' => 'Data not found!'
                    ],
                    'data' => []
                ];
                return response()->json($response, 200);
            }
            $response = [
                'meta' => [
                    'code' => '200',
                    'message' => 'Get data has success full'
                ],
                'data' => $data
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

    public function Import(Request $request)
    {
        try {

            $data = Excel::import(new Import, request()->file('file'));
            $response = [
                'meta' => [
                    'code' => '200',
                    'message' => 'Success import data'
                ]
            ];
            return response()->json($response, 200);
            // $model = new RouteModel();
            // $import = $model->import($request->data);

            // if ($import['code'] == '200') {
            //     $fail_import = count($import['data']);
                
            //     $response = [
            //         'meta' => [
            //             'code' => '200',
            //             'message' => 'Success import data'
            //         ],
            //         'summary' => [
            //             'total_data' => $lng_data,
            //             'success' => $lng_data - $fail_import,
            //             'failed' => $fail_import,
            //         ],
            //         'failed_import' => $import['data']
            //     ];
            //     return response()->json($response, 200);
            // } else {
            //     $response = [
            //         'meta' => [
            //             'code' => '400',
            //             'message' => 'Failed to import data',
            //             'error' => $import['message']
            //         ]
            //     ];
            //     return response()->json($response, 200);
            // }
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

    public function Export(Request $request)
    {
        try {
            $model = new RouteModel();
            $data = $model->export($request->search);
            
            if (count($data) == 0) {
                $response = [
                    'meta' => [
                        'code' => '404',
                        'message' => 'Data not found!'
                    ],
                    'data' => []
                ];
                return response()->json($response, 200);
            }

            $response = [
                'meta' => [
                    'code' => '200',
                    'message' => 'Get data has success full'
                ],
                'data' => $data
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

    public function JobList(Request $request)
    {
        try {
            $model = new RouteModel();
            $data = $model->jobs_list();

            return datatables()->of($data)->make(true);
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

    public function FailedList(Request $request)
    {
        try {
            $model = new RouteModel();
            $data = $model->failed_list();
            
            return datatables()->of($data)->make(true);
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

    public function GetMasterPrimary(Request $request)
    {
        try {
            $model = new RouteModel();
            $data = $model->data_master_primary();
            // dd($data);
            if (!$data) {
                $response = [
                    'meta' => [
                        'code' => '404',
                        'message' => 'Data not found!'
                    ]
                ];
                return response()->json($response, 200);
            }

            $response = [
                'meta' => [
                    'code' => '200',
                    'message' => 'Get data has success full!'
                ],
                'data' => $data
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
