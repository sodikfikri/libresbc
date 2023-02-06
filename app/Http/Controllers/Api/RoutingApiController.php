<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class RoutingApiController extends Controller
{
    public function Table_list(Request $request)
    {
        try {
            $params = [
                'url' => '/libreapi/routing/table',
            ];

            $helper = new Helper();
            $data = $helper->GetApi($params);

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
}
