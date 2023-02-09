jQuery(function($) {

    let State = {
        name: localStorage.getItem('outbound-name')
    }

    let Detail = {}

    Detail.active = function() {
        Detail.API.active()
        Detail.Event.active()
    }

    Detail.API = {
        active: function() {
            $.ajax({
                url: '/api/inter/outbound/detail',
                data: {
                    name: State.name
                },
                method: 'GET',
                success: function(resp) {
                    console.log(resp);
                    if (resp.meta.code == '200') {
                        let data = resp.data

                        $('#name').val(data.name)
                        $('#desc').val(data.desc)
                        $('#media-class').val(data.media_class)
                        $('#capacity-class').val(data.capacity_class)
                        $('#sipprofile').val(data.sipprofile)
                        $('#distribution').val(data.distribution)
                        $('#cid-type').val(data.cid_type)

                        if (data.enable) {
                            $('#enable').val('1') // true
                            $('#enable').closest('.switch').removeClass('btn-light off')
                            $('#enable').closest('.switch').addClass('btn-primary')
                        } else {
                            $('#enable').val('0') // true
                            $('#enable').closest('.switch').addClass('btn-light off')
                            $('#enable').closest('.switch').removeClass('btn-primary')
                        }

                        if (data.rtpaddrs) {
                            $.each(data.rtpaddrs, function(key, val) {
                                $('#rtp_wrapper').append(
                                    `<div class="rtp_child">
                                        <div class="row">
                                            <div class="col-8 mb-2">
                                                <input type="text" class="form-control" name="rtp-address" id="" value="${val}">
                                            </div>
                                            <div class="col-4">
                                                <button class="btn btn-danger remove-row-rtp">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>`
                                )
                            })
                        }

                        if (data.privacy) {
                            $.each(data.privacy, function(key, val) {
                                $('#privacy_wrapper').append(
                                    `<div class="privacy_child">
                                        <div class="row">
                                            <div class="col-8 mb-2">
                                                <input type="text" class="form-control" name="privacy" id="" value="${val}">
                                            </div>
                                            <div class="col-4">
                                                <button class="btn btn-danger remove-row-privacy">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>`
                                )
                            })
                        }

                        if (data.nodes) {
                            $.each(data.nodes, function(key, val) {
                                $('#nodes_wrapper').append(
                                    `<div class="nodes_child">
                                        <div class="row">
                                            <div class="col-8 mb-2">
                                                <input type="text" class="form-control" name="nodes" id="" value="${val}">
                                            </div>
                                            <div class="col-4">
                                                <button class="btn btn-danger remove-row-nodes">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>`
                                )
                            })
                        }

                        if (data.gateways) {
                            $.each(data.gateways, function(key, val) {
                                $('#gateways_wrapper').append(
                                    `<div class="col-4 gateway-card">
                                        <div class="card mt-3">
                                            <div class="card-body">
                                                <div style="float: right; padding-bottom: 7px">
                                                    <button class="btn btn-danger btn-sm remove-gateway">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                                <div class="pb-3">
                                                    <label for="" style="font-size: 13px">Name</label>
                                                    <input type="text" class="form-control" name="gateway-name" id="" value="${val.name}" style="font-size: 13px">
                                                </div>
                                                <div class="pb-3">
                                                    <label for="" style="font-size: 13px">Weight</label>
                                                    <input type="text" class="form-control" name="gateway-weight" id="" value="${val.weight}" style="font-size: 13px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                                )
                            })
                        }
                    }
                },
                error: function(e) {
                    console.log('error: ', e);
                }
            })
        }
    }

    Detail.Event = {
        active: function() {
            // remove gateway
            $(document).on('click', '.remove-gateway', function() {
                $(this).closest('.gateway-card').remove()
            })

            $(document).on('click', '.remove-row-nodes', function() {
                $(this).closest('.nodes_child').remove()
            })

            $(document).on('click', '.remove-row-privacy', function() {
                $(this).closest('.privacy_child').remove()
            })

            $(document).on('click', '.remove-row-rtp', function() {
                $(this).closest('.rtp_child').remove()
            })

            this.addGateway()
            this.addRtp()
            this.addPrivacy()
            this.addNodes()
        },
        addGateway: function() {
            $('#btn-add-card-gatewas').on('click', function() {
                $('#gateways_wrapper').append(
                    `<div class="col-4 gateway-card">
                        <div class="card mt-3">
                            <div class="card-body">
                                <div style="float: right; padding-bottom: 7px">
                                    <button class="btn btn-danger btn-sm remove-gateway">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <div class="pb-3">
                                    <label for="" style="font-size: 13px">Name</label>
                                    <input type="text" class="form-control" name="gateway-name" id="" value="" style="font-size: 13px">
                                </div>
                                <div class="pb-3">
                                    <label for="" style="font-size: 13px">Weight</label>
                                    <input type="text" class="form-control" name="gateway-weight" id="" value="" style="font-size: 13px">
                                </div>
                            </div>
                        </div>
                    </div>`
                )
            })
        },
        addRtp: function() {
            $('#btn-add-rtp').on('click', function() {
                $('#rtp_wrapper').append(
                    `<div class="rtp_child">
                        <div class="row">
                            <div class="col-8 mb-2">
                                <input type="text" class="form-control" name="rtp-address" id="" value="">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-danger remove-row-rtp">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>`
                )
            })
        },
        addPrivacy: function() {
            $('#btn-add-privacy').on('click', function() {
                $('#privacy_wrapper').append(
                    `<div class="privacy_child">
                        <div class="row">
                            <div class="col-8 mb-2">
                                <input type="text" class="form-control" name="privacy" id="" value="">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-danger remove-row-privacy">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>`
                )
            })
        },
        addNodes: function() {
            $('#btn-add-nodes').on('click', function() {
                $('#nodes_wrapper').append(
                    `<div class="nodes_child">
                        <div class="row">
                            <div class="col-8 mb-2">
                                <input type="text" class="form-control" name="nodes" id="" value="">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-danger remove-row-nodes">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>`
                )
            })
        }
    }

    Detail.active()

})