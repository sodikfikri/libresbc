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
    $sub_menu = Access('route_list', $data->sub_menu, 1);
    $permission = $sub_menu->access;
@endphp

@section('title', 'Route')

@extends('components.main')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Route</h1>
        </div>

        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div> --}}
            <div class="card-body">
                <ul class="nav nav-tabs" style="margin-bottom: 20px;">
                    <li class="nav-item">
                      <a class="nav-link active" href="#list" data-type="tab-list" style="font-weight: bold">List</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#jobs" data-type="tab-jobs" style="font-weight: bold">Jobs</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#ins-failed" data-type="tab-failed" style="font-weight: bold">Failed</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="list" aria-expanded="true">
                        <div class="row mb-3">
                            <div class="col-6">
                                @if ($permission->is_import === 1)
                                    <form class="display-0" id="form-input-file" action="" enctype="multipart/form-data">
                                        <input type="file" name="file" class="display-0" id="input-file">
                                        <button type="submit" id="btn-submit-input-file"></button>
                                    </form>
                                    <button class="btn btn-primary" id="import-data">
                                        <i class="fas fa-download" id="btn-icon-import"></i>
                                    </button>
                                @endif
                                @if ($permission->is_export === 1)
                                    <button class="btn btn-primary" id="export-data">
                                        <i class="fas fa-upload" id="btn-icon-export"></i>
                                    </button>
                                @endif
                                @if ($permission->is_delete === 1)
                                    <button class="btn btn-primary" id="delete-multiple"><i class="fas fa-trash"></i></button>
                                @endif
                            </div>
                            @if ($permission->is_create === 1)
                                <div class="col-6" style="text-align: right">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">Add Data</button>
                                    {{-- <button class="btn btn-primary" id="btn-test">Add Data</button> --}}
                                </div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th id="th-check" style="width: 10px!important;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="input-th-check">
                                                <label class="form-check-label" for="exampleCheck1"></label>
                                            </div>
                                        </th>
                                        {{-- <th class="">id</th> --}}
                                        <th>Destination Number</th>
                                        <th>Primary Route</th>
                                        <th>Secondary Route</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="jobs" aria-expanded="true">
                        <div class="table-responsive">
                            <table class="table" id="table-jobs" width="100%" cellspacing="0">
                                <thead>
                                    <th style="width: 10px">No</th>
                                    <th>Queue</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="ins-failed" aria-expanded="true">
                        <div class="table-responsive">
                            <table class="table" id="table-failed" width="100%" cellspacing="0">
                                <thead>
                                    <th>No</th>
                                    <th>Destination Number</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Add Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="">Destination Number</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+</div>
                                </div>
                                <input type="text" class="form-control" id="dest-number">
                            </div>

                            {{-- <input type="text" class="form-control" id="dest-number" required> --}}
                        </div>
                        <div class="form-group">
                            {{-- <label for="">Primary Route</label>
                            <input type="text" class="form-control" id="primary-route" required> --}}
                            <label for="">Primary Route</label>
                            <select class="form-control" id="primary-route">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Secondary Route</label>
                            {{-- <input type="text" class="form-control" id="secondary-route" required> --}}
                            <select class="form-control" id="secondary-route">
                                
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id=save-route>Save</button>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Update Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="upt-id" value="">
                        <div class="form-group">
                            <label class="" for="">Destination Number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">+</div>
                                </div>
                                <input type="text" class="form-control" id="upt-dest-number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Primary Route</label>
                            {{-- <input type="text" class="form-control" id="upt-primary-route" required> --}}
                            <select class="form-control" id="upt-primary-route" required>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Secondary Route</label>
                            {{-- <input type="text" class="form-control" id="upt-secondary-route" required> --}}
                            <select class="form-control" id="upt-secondary-route" required>
                                
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id=update-route>Save</button>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Response</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Total Data
                                    <div class="text-white-50 small" id="total-data" style="font-weight: bold">0</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Success
                                    <div class="text-white-50 small" id="total-success" style="font-weight: bold">0</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="card bg-danger text-white shadow">
                                <div class="card-body">
                                    Failed
                                    <div class="text-white-50 small" id="total-failed" style="font-weight: bold">0</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-bordered class display-0" id="fail-data-import" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Destination Number</th>
                                        <th>Primary Route</th>
                                        <th>Secondary Route</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr style="background-color: #e74a3b; color: white;">
                                        <td>+111</td>
                                        <td>+112</td>
                                        <td>+113</td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="modalExport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        {{-- <label for="">Primary Route</label> --}}
                        <div class="row" id="p-route">
                            
                        </div>

                        {{-- <input type="checkbox" data-toggle="switchbutton" checked data-style="ios"> --}}

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id=btn-export>Export</button>
                </div>
            </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js" integrity="sha512-r22gChDnGvBylk90+2e/ycr3RVrDi8DIOkIGNhJlKfuyQM4tIRAI062MaV8sfjQKYVGjOBaZBOA87z+IhZE9DA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var permit = @json($permission);
</script>
<script src="{{ asset('assets/js/custom/enum/route.js') }}"></script>
@endsection