@section('title', 'Manipulation Detail')

@extends('components.main')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manipulation / Detail</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="form-control" id="desc">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Actions</label>
                        <button class="btn btn-primary btn-sm" id="btn-add-card-action">
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="row" id="actions_wrapper">
                            {{-- <div class="col-4 actions-card mt-2">
                                <div class="card">
                                    <div class="card-body">
                                        <button class="btn btn-danger btn-sm" id="" style="float: right; margin-bottom: 7px">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <div class="form-group">
                                            <label for="" style="font-size: 13px">Action</label>
                                            <input type="text" class="form-control" id="" style="font-size: 13px">
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size: 13px">Refervar</label>
                                            <input type="text" class="form-control" id="" style="font-size: 13px">
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size: 13px">Pattern</label>
                                            <input type="text" class="form-control" id="" style="font-size: 13px">
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size: 13px">Targetvar</label>
                                            <input type="text" class="form-control" id="" style="font-size: 13px">
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size: 13px">Value</label>
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="" style="font-size: 13px">
                                                </div>
                                                <div class="col-2">
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Antiactions</label>
                        <button class="btn btn-primary btn-sm" id="">
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="row" id="antiactions_wrapper">
                            <div class="col-4 actions-card mt-2">
                                <div class="card">
                                    <div class="card-body">
                                        <button class="btn btn-danger btn-sm" id="" style="float: right; margin-bottom: 7px">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <div class="form-group">
                                            <label for="" style="font-size: 13px">Action</label>
                                            <input type="text" class="form-control" id="" style="font-size: 13px">
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size: 13px">Refervar</label>
                                            <input type="text" class="form-control" id="" style="font-size: 13px">
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size: 13px">Pattern</label>
                                            <input type="text" class="form-control" id="" style="font-size: 13px">
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size: 13px">Targetvar</label>
                                            <input type="text" class="form-control" id="" style="font-size: 13px">
                                        </div>
                                        <div class="form-group">
                                            <label for="" style="font-size: 13px">Value</label>
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="" style="font-size: 13px">
                                                </div>
                                                <div class="col-2">
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Conditions</label>
                        <div class="col-4 condition-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="" style="font-size: 13px">Rules</label>
                                        <button class="btn btn-primary btn-sm" id="">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <div class="row" style="margin-top: 8px">
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" style="font-size: 13px" id="">
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" style="font-size: 13px">Logic</label>
                                        <input type="text" class="form-control" style="font-size: 13px" id=""> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/custom/class/manipulation_detail.js') }}"></script>
@endsection