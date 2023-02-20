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
    $sub_menu = Access('base', $data->sub_menu, 1);
    $child = Access('netalias', $sub_menu->child, 1);
    $permission = $child->access;
@endphp
@section('title', 'Netalias')

@extends('components.main')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Netalias</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                @if ($permission->is_create == 1)
                    <div class="mb-2" style="text-align: right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">Add Data</button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table" id="table" width="100%" cellspacing="0">
                        <thead>
                            <th style="width: 10px">No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="name" style="width: 50%">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="form-control" id="desc" style="width: 50%">
                        </div>
                        <div class="form-group" id="form-addresses">
                            <label for="">Address</label>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <input type="text" class="form-control" id="address-member">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="address-listen">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="address-advertisen">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="add-row">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="upt-name" style="width: 50%">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="form-control" id="upt-desc" style="width: 50%">
                        </div>
                        <div class="form-group" id="form-upt-addresses">
                            <label for="">Address</label>
                            {{-- <div class="row mb-3">
                                <div class="col-4">
                                    <input type="text" class="form-control" id="upt-address-member">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="upt-address-listen">
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="upt-address-advertisen">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-primary" id="add-row-update">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div> --}}
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

@endsection

@section('scripts')
<script>
    var permit = @json($permission);
</script>
<script src="{{ asset('assets/js/custom/base/natalias.js') }}"></script>
@endsection