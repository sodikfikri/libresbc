<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Helper;

class ClassApiController extends Controller
{
    public function Media_list(Request $request)
    {
        try {
            $params = [
                'url' => '/libreapi/class/media',
            ];

            $helper = new Helper();
            $data = $helper->GetApi($params);

            return datatables()->of($data)
            // ->addIndexColumn()
            ->addColumn('action', function($row){
                $data = '<button type="button" class="btn btn-warning btn-sm waves-effect mr-2" id="btn-detail" data-name="'.$row->name.'"><i class="fas fa-edit"></i></button>';
                $data .= '<button type="button" class="btn btn-danger btn-sm waves-effect" id="btn-delete" data-id="'.$row->name.'"><i class="fas fa-trash"></i></button>';
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
    public function Media_detail(Request $request)
    {
        try {
            $params = [
                'url' => '/libreapi/class/media/' . $request->name
            ];

            $helper = new Helper();
            $data = $helper->GetApi($params);

            if (!$data) {
                $response = [
                    'meta' => [
                        'code' => '400',
                        'message' => 'Failed to get data'
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

    public function Capacity_list(Request $request) 
    {
        try {
            $params = [
                'url' => '/libreapi/class/capacity',
            ];

            $helper = new Helper();
            $data = $helper->GetApi($params);

            return datatables()->of($data)
            // ->addIndexColumn()
            ->addColumn('action', function($row){
                $data = '<button type="button" class="btn btn-warning btn-sm waves-effect mr-2" id="btn-detail" data-name="'.$row->name.'"><i class="fas fa-edit"></i></button>';
                $data .= '<button type="button" class="btn btn-danger btn-sm waves-effect" id="btn-delete" data-id="'.$row->name.'"><i class="fas fa-trash"></i></button>';
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
    public function Capacity_detail(Request $request)
    {
        try {
            $params = [
                'url' => '/libreapi/class/capacity/' . $request->name
            ];

            $helper = new Helper();
            $data = $helper->GetApi($params);

            if (!$data) {
                $response = [
                    'meta' => [
                        'code' => '400',
                        'message' => 'Failed to get data'
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

    public function Translation_list(Request $request)
    {
        try {
            $params = [
                'url' => '/libreapi/class/translation',
            ];

            $helper = new Helper();
            $data = $helper->GetApi($params);

            return datatables()->of($data)
            // ->addIndexColumn()
            ->addColumn('action', function($row){
                $data = '<button type="button" class="btn btn-warning btn-sm waves-effect mr-2" id="btn-detail" data-name="'.$row->name.'"><i class="fas fa-edit"></i></button>';
                $data .= '<button type="button" class="btn btn-danger btn-sm waves-effect" id="btn-delete" data-id="'.$row->name.'"><i class="fas fa-trash"></i></button>';
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
    public function Translation_detail(Request $request)
    {
        try {
            $params = [
                'url' => '/libreapi/class/translation/' . $request->name
            ];

            $helper = new Helper();
            $data = $helper->GetApi($params);

            if (!$data) {
                $response = [
                    'meta' => [
                        'code' => '400',
                        'message' => 'Failed to get data'
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

    public function Manipulation_list(Request $request)
    {
        try {
            $params = [
                'url' => '/libreapi/class/manipulation',
            ];

            $helper = new Helper();
            $data = $helper->GetApi($params);

            return datatables()->of($data)
            // ->addIndexColumn()
            ->addColumn('action', function($row){
                $data = '<button type="button" class="btn btn-warning btn-sm waves-effect mr-2" id="btn-detail" data-name="'.$row->name.'"><i class="fas fa-edit"></i></button>';
                $data .= '<button type="button" class="btn btn-danger btn-sm waves-effect" id="btn-delete" data-id="'.$row->name.'"><i class="fas fa-trash"></i></button>';
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
    public function Manipulation_detail(Request $request)
    {
        try {
            $params = [
                'url' => '/libreapi/class/manipulation/' . $request->name
            ];

            $helper = new Helper();
            $data = $helper->GetApi($params);

            if (!$data) {
                $response = [
                    'meta' => [
                        'code' => '400',
                        'message' => 'Failed to get data'
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
}
