jQuery(function($) {

    let State = {
        table: {
            list: ''
        },
        action_type: ''
    }

    let Media = {}

    Media.active = function() {
        Media.API.List()
        Media.Event.active()
    }

    Media.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                // serverSide: true,
                // order: [[1, 'desc']],
                ajax: {
                    url: '/api/class/media/list',
                    method: 'GET',
                    data: {
                        access: permit
                    }
                },
                columns: [
                    { render: (data, type, row, meta) => meta.row + 1, },
                    // { data: 'name' },
                    {
                        render: function(data, type, row, meta) {
                            return `<span class="action-name" id="read-data" data-name="${row.name}">${row.name}</span>`
                        }
                    },
                    { data: 'desc' },
                    { data: 'action' },
                ]
            })
        },
        Detail: function(name) {
            $.ajax({
                url: '/api/class/media/detail?name=' + name,
                method: 'GET',
                success: function(resp) {
                    if (resp.meta.code == '200') {
                        $('#form-codecs').find('.codecs_wrapper').remove()

                        let data = resp.data

                        $('#upt-name').val(data.name)
                        $('#upt-desc').val(data.desc)
                        $('#upt-code-negotiation').val(data.codec_negotiation)
                        $('#upt-media-mode').val(data.media_mode)

                        if (data.cng) {
                            $('#upt-cng').val('1') // true
                            $('#upt-cng').closest('.switch').removeClass('btn-light off')
                            $('#upt-cng').closest('.switch').addClass('btn-primary')
                        } else {
                            $('#upt-cng').val('0') // false
                            $('#upt-cng').closest('.switch').addClass('btn-light off')
                            $('#upt-cng').closest('.switch').removeClass('btn-primary')
                        }

                        if (data.vad) {
                            $('#upt-vad').val('1') // true
                            $('#upt-vad').closest('.switch').removeClass('btn-light off')
                            $('#upt-vad').closest('.switch').addClass('btn-primary')
                        } else {
                            $('#upt-vad').val('0') // false
                            $('#upt-vad').closest('.switch').addClass('btn-light off')
                            $('#upt-vad').closest('.switch').removeClass('btn-primary')
                        }
                        
                        if (data.codecs) {
                            $.each(data.codecs, function(key, val) {
                                if (key == 0) {
                                    $('#form-codecs').append(
                                        `<div class="codecs_wrapper">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control upt-codecs" value="${val}">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <button class="btn btn-danger remove-row-update ${State.action_type == 'detail' ? 'display-0' : ''}">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button class="btn btn-primary add-row-update ${State.action_type == 'detail' ? 'display-0' : ''}">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`
                                    )
                                } else {
                                    $('#form-codecs').append(
                                        `<div class="codecs_wrapper">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control upt-codecs" value="${val}">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <button class="btn btn-danger remove-row-update ${State.action_type == 'detail' ? 'display-0' : ''}">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`
                                    )
                                }
                            })
                        }
                    }
                },
                complete: function() {
                    $('#modalDetail').modal('show')
                },
                error: function(e) {
                    console.log('error: ', e);
                }
            })
        }
    }

    Media.Event = {
        active: function() {
            $(document).on('click', '#btn-detail', function() {
                $('#update').removeClass('display-0')
                State.action_type = 'update'
                Media.API.Detail($(this).data('name'))
            })

            $(document).on('click', '#read-data', function() {
                $('#update').addClass('display-0')
                State.action_type = 'detail'
                Media.API.Detail($(this).data('name'))
            })

            this.addRowUpdate()
            this.removerRowUpdate()
        },
        addRowUpdate: function() {
            $(document).on('click', '.add-row-update', function() {
                $('#form-codecs').append(
                    `<div class="codecs_wrapper">
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
                                </div>
                            </div>
                        </div>
                    </div>`
                )
            })
        },
        removerRowUpdate: function() {
            $(document).on('click', '.remove-row-update', function() {
                $(this).closest('.codecs_wrapper').remove()
            })
        }
    }

    Media.active()

})