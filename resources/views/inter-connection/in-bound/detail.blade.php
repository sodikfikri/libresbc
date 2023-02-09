@section('title', 'In Bound Detail')

@extends('components.main')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">In Bound / Detail</h1>
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
                            <label for="">Routing</label>
                            <input type="text" class="form-control" id="routing">
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Preanswer Class</label>
                            <input type="text" class="form-control" id="preanswer">
                        </div>
                    </div> --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Auth Scheme</label>
                            <input type="text" class="form-control" id="authscheme">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Enable</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="enable" data-size="sm">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Ringready</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="ringready" data-size="sm">
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
                            <label for="" style="padding-top: 8px">Sip Address</label>
                            <button class="btn btn-primary btn-sm" id="btn-add-sipaddrs">
                                <i class="fas fa-plus"></i>
                            </button>
                            <div class="mt-2" id="sipaddrs_wrapper">
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
<script src="{{ asset('assets/js/custom/inter/in_bound_detail.js') }}"></script>
@endsection