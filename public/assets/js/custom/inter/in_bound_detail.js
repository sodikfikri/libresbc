jQuery(function($) {

    let State = {
        name: localStorage.getItem('inbound-name'),
        action_type: localStorage.getItem('action-type')
    }

    if (State.action_type == 'detail') {
        $('#btn-add-rtp').addClass('display-0')
        $('#btn-add-sipaddrs').addClass('display-0')
        $('#btn-add-nodes').addClass('display-0')
    }
    
    let Detail = {}

    Detail.active = function() {
        Detail.API.active()
        Detail.Event.active()
    }

    Detail.API = {
        active: function() {
            $.ajax({
                url: '/api/inter/inbound/detail',
                data: {
                    name: State.name
                },
                method: 'GET',
                success: function(resp) {
                    if (resp.meta.code == '200') {
                        let data = resp.data

                        $('#name').val(data.name)
                        $('#desc').val(data.desc)
                        $('#media-class').val(data.media_class)
                        $('#capacity-class').val(data.capacity_class)
                        $('#sipprofile').val(data.sipprofile)
                        $('#routing').val(data.routing)
                        $('#authscheme').val(data.authscheme)

                        if (data.enable) {
                            $('#enable').val('1') // true
                            $('#enable').closest('.switch').removeClass('btn-light off')
                            $('#enable').closest('.switch').addClass('btn-primary')
                        } else {
                            $('#enable').val('0') // true
                            $('#enable').closest('.switch').addClass('btn-light off')
                            $('#enable').closest('.switch').removeClass('btn-primary')
                        }

                        if (data.ringready) {
                            $('#ringready').val('1') // true
                            $('#ringready').closest('.switch').removeClass('btn-light off')
                            $('#ringready').closest('.switch').addClass('btn-primary')
                        } else {
                            $('#ringready').val('0') // true
                            $('#ringready').closest('.switch').addClass('btn-light off')
                            $('#ringready').closest('.switch').removeClass('btn-primary')
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
                                                <button class="btn btn-danger remove-row-rtp ${State.action_type == 'detail' ? 'display-0' : ''}">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>`
                                )
                            })
                        }

                        if (data.sipaddrs) {
                            $.each(data.sipaddrs, function(key, val) {
                                $('#sipaddrs_wrapper').append(
                                    `<div class="sipaddrs_child">
                                        <div class="row">
                                            <div class="col-8 mb-2">
                                                <input type="text" class="form-control" name="sipaddrs" id="" value="${val}">
                                            </div>
                                            <div class="col-4">
                                                <button class="btn btn-danger remove-row-sipaddrs ${State.action_type == 'detail' ? 'display-0' : ''}">
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
                                                <button class="btn btn-danger remove-row-nodes ${State.action_type == 'detail' ? 'display-0' : ''}">
                                                    <i class="fas fa-minus"></i>
                                                </button>
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
            $(document).on('click', '.remove-row-rtp', function() {
                $(this).closest('.rtp_child').remove()
            })

            $(document).on('click', '.remove-row-nodes', function() {
                $(this).closest('.nodes_child').remove()
            })

            $(document).on('click', '.remove-row-sipaddrs', function() {
                $(this).closest('.sipaddrs_child').remove()
            })

            this.addNodes()
            this.addSipaddrs()
            this.addRtp()
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
        addSipaddrs: function() {
            $('#btn-add-sipaddrs').on('click', function() {
                $('#sipaddrs_wrapper').append(
                    `<div class="sipaddrs_child">
                        <div class="row">
                            <div class="col-8 mb-2">
                                <input type="text" class="form-control" name="sipaddrs" id="" value="">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-danger remove-row-sipaddrs">
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