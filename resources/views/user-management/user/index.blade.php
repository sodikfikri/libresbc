@php
    function Access($menu, $arr, $type) {
        foreach ($arr as $key => $el) {
            if ( $menu == $el->name ) {
                if ($type == 1) { // return data
                    return $el;
                } else { // return key
                    return $key;
                }
            }
        }
        return false;
    }

    $data = Access('user_management', json_decode(session()->get('access-menu')), 1);
    $sub_menu = Access('user', $data->sub_menu, 1);
    $permission = $sub_menu->access;
@endphp

@section('title', 'Users')

@extends('components.main')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    @if ($permission->is_create == 1)
                        <div class="mb-2" style="text-align: right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Add Data</button>
                        </div>
                    @endif
                    <table class="table" id="table" width="100%" cellspacing="0">
                        <thead>
                            <th style="width: 10px">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>role</th>
                            <th>Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-add" action="#">
                            <input type="hidden" id="id-hide">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Role</label>
                                <select class="form-control" id="role" required>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" id="username" required>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" id="password" required>
                                {{-- <small style="color: #e02d1b">optional fill out the form only if you want to change your password</small> --}}
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="create">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" id="id-hide">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" id="upt-name">
                            </div>
                            <div class="form-group">
                                <label for="">Role</label>
                                <select class="form-control" id="upt-role">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="upt-email">
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" id="upt-username">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" id="upt-password">
                                <small style="color: #e02d1b">optional fill out the form only if you want to change your password</small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="update">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
<script>
    var permit = @json($permission);
</script>
<script src="{{ asset('assets/js/custom/user-management/user_list.js') }}"></script>
@endsection