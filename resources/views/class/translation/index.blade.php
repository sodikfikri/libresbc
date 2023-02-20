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
    $sub_menu = Access('class', $data->sub_menu, 1);
    $child = Access('translation', $sub_menu->child, 1);
    $permission = $child->access;
@endphp
@section('title', 'Translation')

@extends('components.main')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Translation</h1>
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

        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
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
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="form-control" id="desc">
                        </div>
                        <div class="form-group">
                            <label for="">Caller Name</label>
                            <input type="text" class="form-control" id="caller-name">
                        </div>
                        <div class="form-group">
                            <label for="">Caller Number Pattern</label>
                            <input type="text" class="form-control" id="caller-num-pattern">
                        </div>
                        <div class="form-group">
                            <label for="">Caller Number Replacement</label>
                            <input type="text" class="form-control" id="caller-num-replacement">
                        </div>
                        <div class="form-group">
                            <label for="">Destination Number Pattern</label>
                            <input type="text" class="form-control" id="destination-num-pattern">
                        </div>
                        <div class="form-group">
                            <label for="">Destination Number Replacement</label>
                            <input type="text" class="form-control" id="destination-num-replacement">
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
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="upt-name">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="form-control" id="upt-desc">
                        </div>
                        <div class="form-group">
                            <label for="">Caller Name</label>
                            <input type="text" class="form-control" id="upt-caller-name">
                        </div>
                        <div class="form-group">
                            <label for="">Caller Number Pattern</label>
                            <input type="text" class="form-control" id="upt-caller-num-pattern">
                        </div>
                        <div class="form-group">
                            <label for="">Caller Number Replacement</label>
                            <input type="text" class="form-control" id="upt-caller-num-replacement">
                        </div>
                        <div class="form-group">
                            <label for="">Destination Number Pattern</label>
                            <input type="text" class="form-control" id="upt-destination-num-pattern">
                        </div>
                        <div class="form-group">
                            <label for="">Destination Number Replacement</label>
                            <input type="text" class="form-control" id="upt-destination-num-replacement">
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
<script src="{{ asset('assets/js/custom/class/translation.js') }}"></script>
@endsection