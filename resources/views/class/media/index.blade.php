@section('title', 'Media')

@extends('components.main')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Media</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
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
                                <div class="form-group">
                                    <label for="">Codec Negotiation</label>
                                    <input type="text" class="form-control" id="upt-code-negotiation">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Media Mode</label>
                                    <input type="text" class="form-control" id="upt-media-mode">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group" id="form-upt-addresses">
                                    <label for="">CNG</label> <br>
                                    <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="upt-cng" data-size="sm">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">VAD </label> <br>
                                    <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="upt-vad" data-size="sm">
                                </div>
                            </div>
                            <div class="col-12" id="form-codecs">
                                <label for="">Codecs</label>
                                {{-- <div class="codecs_wrapper">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control upt-codecs">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <button class="btn btn-danger remove-row-update">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button class="btn btn-primary add-row-update">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
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
<script src="{{ asset('assets/js/custom/class/media.js') }}"></script>
@endsection