jQuery(function($) {

    let State = {
        table: {
            list: ''
        }
    }

    let Gateway = {}

    Gateway.active = function() {
        Gateway.API.List()
        Gateway.Event.active()
    }

    Gateway.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                // serverSide: true,
                // order: [[1, 'desc']],
                ajax: {
                    url: '/api/base/gateway/list',
                    method: 'GET',
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
                    { data: 'ip' },
                    { data: 'port' },
                    { data: 'transport' },
                    { data: 'action' },
                ]
            })
        },
        Detail: function(name) {
            $.ajax({
                url: '/api/base/gateway/detail?name='+name,
                method: 'GET',
                success: function(resp) {
                    if (resp.meta.code == '200') {
                        let data = resp.data
                        $('#upt-name').val(data.name)
                        $('#upt-desc').val(data.desc)
                        $('#upt-username').val(data.username)
                        $('#upt-password').val(data.password)
                        $('#upt-proxy').val(data.proxy)
                        $('#upt-port').val(data.port)
                        $('#upt-transport').val(data.transport)
                        $('#upt-cid-type').val(data.cid_type)
                        $('#upt-ping').val(data.ping)

                        if (data.do_register) {
                            $('#upt-do-regist').val('1') // true
                            $('#upt-do-regist').closest('.switch').removeClass('btn-light off')
                            $('#upt-do-regist').closest('.switch').addClass('btn-primary')
                        } else {
                            $('#upt-do-regist').val('0') // false
                            $('#upt-do-regist').closest('.switch').removeClass('btn-primary')
                            $('#upt-do-regist').closest('.switch').addClass('btn-light off')
                        }

                        if (data.caller_id_in_from) {
                            $('#upt-call-id').val('1') // true
                            $('#upt-call-id').closest('.switch').removeClass('btn-light off')
                            $('#upt-call-id').closest('.switch').addClass('btn-primary')
                        } else {
                            $('#upt-call-id').val('0') // false
                            $('#upt-call-id').closest('.switch').removeClass('btn-primary')
                            $('#upt-call-id').closest('.switch').addClass('btn-light off')
                        }

                    }
                },
                error: function(err) {
                    console.log('error: ', err);
                }
            })
        }
    }

    Gateway.Event = {
        active: function() {

            $(document).on('change', '#upt-do-regist', function() {
                if ($(this).is(':checked')) {
                    $(this).val('1')
                } else {
                    $(this).val('0')
                }
            })

            $(document).on('change', '#upt-call-id', function() {
                if ($(this).is(':checked')) {
                    $(this).val('1')
                } else {
                    $(this).val('0')
                }
            })

            $(document).on('click', '#btn-detail', function() {
                $('#update').removeClass('display-0')

                Gateway.API.Detail($(this).data('name'))
                $('#modalDetail').modal('show')
            })

            $(document).on('click', '#read-data', function() {
                $('#update').addClass('display-0')

                Gateway.API.Detail($(this).data('name'))
                $('#modalDetail').modal('show')
            })
        }
    }

    Gateway.active()

})