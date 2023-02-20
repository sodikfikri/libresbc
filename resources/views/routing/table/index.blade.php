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

    $data = Access('configuration', json_decode(session()->get('access-menu')), 1);
    $sub_menu = Access('routing', $data->sub_menu, 1);
    $child = Access('table', $sub_menu->child, 1);
    $permission = $child->access;
@endphp
@section('title', 'Table')

@extends('components.main')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Table</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                @if ($permission->is_create == 1)
                    <div class="mb-2" style="text-align: right">
                        <button class="btn btn-primary">Add Data</button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table" id="table" width="100%" cellspacing="0">
                        <thead>
                            <th style="width: 10px">No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Act</th>
                            <th>Routes</th>
                            <th>Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" id="upt-name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Description</label>
                                <input type="text" class="form-control" id="upt-desc">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Action</label>
                                <input type="text" class="form-control" id="upt-action">
                            </div>
                        </div>
                        <div class="col-md-12 display-0" id="routes-data">
                            <div class="form-group">
                                <label for="" class="">Routes</label> <br>
                                <div class="row">
                                    <div class="col-md-2" style="padding-left: 20px">
                                        <span style="font-size: 14px;">Primary</span>
                                    </div>
                                    <div class="col-md-10 mb-2">
                                        <input type="text" class="form-control" id="upt-route-primary" style="font-size: 13px; width: 50%;">
                                    </div>
                                    <div class="col-md-2" style="padding-left: 20px">
                                        <span style="font-size: 14px;">Secondary</span>
                                    </div>
                                    <div class="col-md-10 mb-2">
                                        <input type="text" class="form-control" id="upt-route-secondary" style="font-size: 13px; width: 50%;">
                                    </div>
                                    <div class="col-md-2" style="padding-left: 20px">
                                        <span style="font-size: 14px;">Load</span>
                                    </div>
                                    <div class="col-md-10 mb-2">
                                        <input type="text" class="form-control" id="upt-route-load" style="font-size: 13px; width: 50%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 display-0" id="record-data">
                            <label for="">Records</label>
                            <button class="btn btn-primary btn-sm" id="">
                                <i class="fas fa-plus"></i>
                            </button>
                            <div class="row record_wrapper mt-2">
                                {{-- <div class="col-md-4 record_child">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group" style="margin-bottom: 0">
                                                <label for="" style="font-size: 13px;">Match</label>
                                                <input type="text" class="form-control" id="upt-action" style="font-size: 13px;">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 0">
                                                <label for="" style="font-size: 13px;">Value</label>
                                                <input type="text" class="form-control" id="upt-action" style="font-size: 13px;">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 0">
                                                <label for="" style="font-size: 13px;">Action</label>
                                                <input type="text" class="form-control" id="upt-action" style="font-size: 13px;">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 0">
                                                <label for="" class="" style="font-size: 13px;">Routes</label> <br>
                                                <div class="row">
                                                    <div class="col-md-4" style="padding-left: 20px">
                                                        <span style="font-size: 13px;">Primary</span>
                                                    </div>
                                                    <div class="col-md-8 mb-2">
                                                        <input type="text" class="form-control" id="upt-route-primary" style="font-size: 13px;">
                                                    </div>
                                                    <div class="col-md-4" style="padding-left: 20px">
                                                        <span style="font-size: 13px;">Secondary</span>
                                                    </div>
                                                    <div class="col-md-8 mb-2">
                                                        <input type="text" class="form-control" id="upt-route-secondary" style="font-size: 13px;">
                                                    </div>
                                                    <div class="col-md-4" style="padding-left: 20px">
                                                        <span style="font-size: 13px;">Load</span>
                                                    </div>
                                                    <div class="col-md-8 mb-2">
                                                        <input type="text" class="form-control" id="upt-route-load" style="font-size: 13px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        {{-- <div class="col-md-6"></div> --}}
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="">Variables</label>
                                <button class="btn btn-primary btn-sm" id="">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <div class="" id="variable_wrapper">
        
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update">Update</button>
            </div>
        </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    var permit = @json($permission);
</script>
<script src="{{ asset('assets/js/custom/routing/table/table_list.js') }}"></script>
@endsection