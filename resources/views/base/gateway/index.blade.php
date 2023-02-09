@section('title', 'Gateway')

@extends('components.main')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gateway</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table" width="100%" cellspacing="0">
                        <thead>
                            <th style="width: 10px">No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>IP</th>
                            <th>Port</th>
                            <th>Transport</th>
                            <th>Action</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <form> --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" id="upt-name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input type="text" class="form-control" id="upt-desc">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-upt-addresses">
                                    <label>Username</label>
                                    <input type="text" class="form-control" id="upt-username">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-upt-addresses">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" id="upt-password">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Proxy</label>
                                    <input type="text" class="form-control" id="upt-proxy">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Port</label>
                                    <input type="text" class="form-control" id="upt-port">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-upt-addresses">
                                    <label for="">Do Register</label> <br>
                                    <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="upt-do-regist" name="upt-do-regist" data-size="sm">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Caller ID In From</label> <br>
                                    <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="upt-call-id" name="upt-call-id" data-size="sm">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-upt-addresses">
                                    <label for="">Transport</label>
                                    <input type="text" class="form-control" id="upt-transport">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">CID Type</label>
                                    <input type="text" class="form-control" id="upt-cid-type">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-upt-addresses">
                                    <label for="">Ping</label>
                                    <input type="text" class="form-control" id="upt-ping">
                                </div>
                            </div>
                        </div>
                    {{-- </form> --}}
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
<script src="{{ asset('assets/js/custom/base/gateway.js') }}"></script>
@endsection