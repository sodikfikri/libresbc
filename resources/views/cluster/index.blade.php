@section('title', 'Cluster')

@extends('components.main')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cluster</h1>
        </div>

        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    RTP Start Port</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="rtp-start-port">0</div>
                            </div>
                            {{-- <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    RTP End Port</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="rtp-end-port">0</div>
                            </div>
                            {{-- <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Max Call Per Second</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="max-call">0</div>
                            </div>
                            {{-- <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Max Concurrent Call</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="max-concurrent">0</div>
                            </div>
                            {{-- <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script>
        let count_data = () => {
            $.ajax({
                url: '/api/cluster/list',
                method: 'GET',
                success: function(resp) {
                    console.log(resp);
                    if (resp.meta.code == '200') {
                        $('#rtp-start-port').html(resp.data.rtp_start_port)
                        $('#rtp-end-port').html(resp.data.rtp_end_port)
                        $('#max-call').html(resp.data.max_calls_per_second)
                        $('#max-concurrent').html(resp.data.max_concurrent_calls)
                    } else {
                        console.log(resp.meta.message);
                    }
                },
                error: function(e) {
                    console.log('error: ', e);
                }
            })
        }
        count_data()
    </script>
@endsection