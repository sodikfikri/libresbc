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
                    { data: 'name' },
                    { data: 'desc' },
                    { data: 'ip' },
                    { data: 'port' },
                    { data: 'transport' },
                    { data: 'action' },
                ]
            })
        }
    }

    Gateway.Event = {
        active: function() {

        }
    }

    Gateway.active()

})