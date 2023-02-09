@section('title', 'Sipprofile Detail')

@extends('components.main')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sipprofile / Detail</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header"></div>
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
                            <label for="">User Agent</label>
                            <input type="text" class="form-control" id="user-agent">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">SDP User</label>
                            <input type="text" class="form-control" id="sdp-user">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Local Network ACL</label>
                            <input type="text" class="form-control" id="local-network-acl">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Address Detect</label>
                            <input type="text" class="form-control" id="address-detect">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">DTMF Type</label>
                            <input type="text" class="form-control" id="dtmf-type">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Media Timeout</label>
                            <input type="text" class="form-control" id="media-timeout">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Context</label>
                            <input type="text" class="form-control" id="context">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Sip Port</label>
                            <input type="text" class="form-control" id="sip-port">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Sip Address</label>
                            <input type="text" class="form-control" id="sip-address">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">RTP Address</label>
                            <input type="text" class="form-control" id="rtp-address">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Sips Port</label>
                            <input type="text" class="form-control" id="sips-port">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">TLS Version</label>
                            <input type="text" class="form-control" id="tls-version">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Realm</label>
                            <input type="text" class="form-control" id="realm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Session Timeout</label>
                            <input type="text" class="form-control" id="session-timeout">
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
                            <label for="">Minimum Session Expires</label>
                            <input type="text" class="form-control" id="minum-session-exp">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Enable 100 rel</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="enable-100" data-size="sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Ignore 180 nosdp</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="ignore-180" data-size="sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Sip Options Respond 503 On Busy</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="sip-opt-respond" data-size="sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Disable Transfer</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="disbale-transfer" data-size="sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Manual Redirect</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="manual-redirect" data-size="sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Enable 3 pcc</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="enable-3-pcc" data-size="sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Enable Compact Headers</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="enable-compact-headers" data-size="sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">RTP Rewrite Timestamps</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="rtp-rewrite" data-size="sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">TLS</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="tls" data-size="sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">TLS Only</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="tls-only" data-size="sm">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Enable Timer</label> <br>
                            <input type="checkbox" data-toggle="switchbutton" data-style="ios" id="enable-timer" data-size="sm">
                        </div>
                    </div>
                {{-- </form> --}}
            </div>

            <button class="btn btn-primary" style="float: right" id="update">Update</button>
        </div>

    </div>

@endsection

@section('scripts')
<script src="{{ asset('assets/js/custom/sipprofile/detail.js') }}"></script>
@endsection