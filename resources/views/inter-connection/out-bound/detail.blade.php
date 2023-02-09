@section('title', 'Out Bound Detail')

@extends('components.main')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Out Bound / Detail</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header">
                
            </div>
            <div class="card-body">
                {{-- <form> --}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="form-control" id="desc">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Media Class</label>
                            <input type="text" class="form-control" id="media-class">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Capacity Class</label>
                            <input type="text" class="form-control" id="capacity-class">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Sipprofile</label>
                            <input type="text" class="form-control" id="sipprofile">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">distribution</label>
                            <input type="text" class="form-control" id="distribution">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">CID Type</label>
                            <input type="text" class="form-control" id="cid-type">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Enable</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="enable" data-size="sm">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" style="padding-top: 8px">Gateway</label>
                            <button class="btn btn-primary btn-sm" id="btn-add-card-gatewas">
                                <i class="fas fa-plus"></i>
                            </button>
                            <div class="row" id="gateways_wrapper">
                                {{-- <div class="col-4">
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <div style="float: right; padding-bottom: 7px">
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                            <div class="pb-3">
                                                <label for="" style="font-size: 13px">Name</label>
                                                <input type="text" class="form-control" id="" style="font-size: 13px">
                                            </div>
                                            <div class="pb-3">
                                                <label for="" style="font-size: 13px">Weight</label>
                                                <input type="text" class="form-control" id="" style="font-size: 13px">
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" style="padding-top: 8px">Rtp Address</label>
                            <button class="btn btn-primary btn-sm" id="btn-add-rtp">
                                <i class="fas fa-plus"></i>
                            </button>
                            <div class="mt-2" id="rtp_wrapper">
                                {{-- <div class="col-8">
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-danger remove-row-update">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button class="btn btn-primary remove-row-update">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" style="padding-top: 8px">Privacy</label>
                            <button class="btn btn-primary btn-sm" id="btn-add-privacy">
                                <i class="fas fa-plus"></i>
                            </button>
                            <div class="mt-2" id="privacy_wrapper">
                                {{-- <div class="col-8">
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-danger remove-row-update">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button class="btn btn-primary remove-row-update">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" style="padding-top: 8px">Nodes</label>
                            <button class="btn btn-primary btn-sm" id="btn-add-nodes">
                                <i class="fas fa-plus"></i>
                            </button>
                            <div class="mt-2" id="nodes_wrapper">
                                {{-- <div class="col-8">
                                    <input type="text" class="form-control" id="">
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-danger remove-row-update">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button class="btn btn-primary remove-row-update">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </form> --}}
            </div>
        </div>

    </div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/custom/inter/out_bound_detail.js') }}"></script>

@endsection