<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserManagementModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class UserManagementApiController extends Controller
{
    public function user_list(Request $request)
    {
        try {
            $permit = [
                'is_update' => $request->access['is_update'],
                'is_delete' => $request->access['is_delete']
            ];

            $model = new UserManagementModel();
            $data = $model->UserList();
            
            return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) use ($permit){
                $data = '';
                if ($permit['is_update'] == '1') {
                    $data .= '<button type="button" class="btn btn-warning btn-sm waves-effect mr-2" id="btn-detail" data-id="'.$row->id.'"><i class="fas fa-edit"></i></button>';
                }
                if ($permit['is_delete'] == '1') {
                    $data .= '<button type="button" class="btn btn-danger btn-sm waves-effect" id="btn-delete" data-id="'.$row->id.'"><i class="fas fa-trash"></i></button>';
                }
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

    public function user_detail(Request $request) 
    {
        try {
            $model = new UserManagementModel();
            $data = $model->UserDetail($request->id);

            if (count($data) == 0) {
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
                    'message' => 'Get data has success full'
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

    public function user_create(Request $request) 
    {
        try {
            $params = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'role_id' => $request->role,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'created_at' => Carbon::now('Asia/Jakarta')->timestamp
            ];

            $model = new UserManagementModel();
            $add = $model->UserAdd($params);

            $response = [
                'meta' => [
                    'code' => '200',
                    'message' => 'Add data has success full'
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

    public function user_update(Request $request) 
    {
        try {
            $params = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'username' =>$request->username,
                'role_id' => $request->role,
                'updated_at' => Carbon::now('Asia/Jakarta')->timestamp
            ];
            if ($request->password) {
                $params['password'] = bcrypt($request->password);
            }
            
            $model = new UserManagementModel();
            $data = $model->UserUpdate($request->id, $params);

            $response = [
                'meta' => [
                    'code' => '200',
                    'message' => 'Update data has success full'
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

    public function user_delete(Request $request)
    {
        try {
            $params = [
                'deleted_at' => Carbon::now('Asia/Jakarta')->timestamp
            ];

            $model = new UserManagementModel();
            $data = $model->UserUpdate($request->id, $params);

            $response = [
                'meta' => [
                    'code' => '200',
                    'message' => 'Delete data has success full'
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

    public function role_select(Request $request)
    {
        try {
            $model = new UserManagementModel();
            $data = $model->RoleSelect();

            if (count($data) == 0) {
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

    public function role_list(Request $request)
    {
        try {
            $permit = [
                'is_update' => $request->access['is_update'],
                'is_delete' => $request->access['is_delete']
            ];

            $model = new UserManagementModel();
            $data = $model->RoleList();
            // dd($data);
            return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) use ($permit) {
                $data = '';
                if ($permit['is_update'] == '1') {
                    $data .= '<button type="button" class="btn btn-warning btn-sm waves-effect mr-2" id="btn-detail" data-id="'.$row->id.'"><i class="fas fa-edit"></i></button>';
                }
                if ($permit['is_delete'] == '1') {
                    $data .= '<button type="button" class="btn btn-danger btn-sm waves-effect" id="btn-delete" data-id="'.$row->id.'"><i class="fas fa-trash"></i></button>';
                }
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

    public function role_detail(Request $request)
    {
        try {
            $model = new UserManagementModel();
            $data = $model->RoleDetail($request->id);
            
            if (count($data) == 0) {
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
                    'message' => 'Get data has success full'
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

    public function role_create(Request $request)
    {
        try {
            $params = [
                'name' => $request->name,
                'created_at' => Carbon::now('Asia/Jakarta')->timestamp
            ];

            $model = new UserManagementModel();
            $data = $model->RoleAdd($params);

            if (!$data) {
                $response = [
                    'meta' => [
                        'code' => '400',
                        'message' => 'Fail to create data!'
                    ]
                ];
                return response()->json($response, 200);
            }

            $response = [
                'meta' => [
                    'code' => '200',
                    'message' => 'Add data has success full'
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

    public function role_update(Request $request)
    {
        try {
            $params = [
                'name' => $request->name,
                'updated_at' => Carbon::now('Asia/Jakarta')->timestamp
            ];

            $model = new UserManagementModel();
            $data = $model->RoleUpdate($request->id, $params);

            if (!$data) {
                $response = [
                    'meta' => [
                        'code' => '400',
                        'message' => 'Fail to update data!'
                    ]
                ];
                return response()->json($response, 200);
            }

            $response = [
                'meta' => [
                    'code' => '200',
                    'message' => 'Update data has success full'
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

    public function role_delete(Request $request)
    {
        try {
            $params = [
                'deleted_at' => Carbon::now('Asia/Jakarta')->timestamp
            ];

            $model = new UserManagementModel();
            $data = $model->RoleUpdate($request->id, $params);

            if (!$data) {
                $response = [
                    'meta' => [
                        'code' => '400',
                        'message' => 'Fail to delete data!'
                    ]
                ];
                return response()->json($response, 200);
            }

            $response = [
                'meta' => [
                    'code' => '200',
                    'message' => 'Delete data has success full'
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
}
