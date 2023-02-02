<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Helper;

class ClusterApiController extends Controller
{
    public function List(Request $request)
    {
        try {
            $params = [
                'url' => '/libreapi/cluster',
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
