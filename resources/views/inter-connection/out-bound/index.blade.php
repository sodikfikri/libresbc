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
    $sub_menu = Access('inter_connection', $data->sub_menu, 1);
    $child = Access('out_bound', $sub_menu->child, 1);
    $permission = $child->access;
    
@endphp
@section('title', 'Out Bound')

@extends('components.main')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Out Bound</h1>
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
                            <th>Sipprofile</th>
                            <th>Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
<script>
    var permit = @json($permission);
</script>
<script src="{{ asset('assets/js/custom/inter/out_bound.js') }}"></script>
@endsection