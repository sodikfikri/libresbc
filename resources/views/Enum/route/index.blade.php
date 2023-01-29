@section('title', 'Route')

@extends('components.main')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Route</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <button class="btn btn-primary"><i class="fas fa-upload"></i></button>
                        <button class="btn btn-primary"><i class="fas fa-download"></i></button>
                        <button class="btn btn-primary" id="delete-multiple"><i class="fas fa-trash"></i></button>
                    </div>
                    <div class="col-6" style="text-align: right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">Add Data</button>
                        {{-- <button class="btn btn-primary" id="btn-test">Add Data</button> --}}
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th id="th-check" style="width: 10px!important;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="input-th-check">
                                        <label class="form-check-label" for="exampleCheck1"></label>
                                    </div>
                                </th>
                                <th class="">id</th>
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
                            <label for="">Primary Route</label>
                            <input type="text" class="form-control" id="primary-route" required>
                        </div>
                        <div class="form-group">
                            <label for="">Secondary Route</label>
                            <input type="text" class="form-control" id="secondary-route" required>
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
                                <input type="text" class="form-control" id="upt-dest-number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Primary Route</label>
                            <input type="text" class="form-control" id="upt-primary-route" required>
                        </div>
                        <div class="form-group">
                            <label for="">Secondary Route</label>
                            <input type="text" class="form-control" id="upt-secondary-route" required>
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

    </div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/custom/enum/route.js') }}"></script>
@endsection