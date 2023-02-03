jQuery(function($) {

    let State = {
        table: {
            list: ''
        }
    }

    let Capacity = {}

    Capacity.active = function() {
        Capacity.API.List()
        Capacity.Event.active()
    }

    Capacity.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                // serverSide: true,
                // order: [[1, 'desc']],
                ajax: {
                    url: '/api/class/capacity/list',
                    method: 'GET',
                },
                columns: [
                    { render: (data, type, row, meta) => meta.row + 1, },
                    { data: 'name' },
                    { data: 'desc' },
                    { data: 'action' },
                ]
            })
        }
    }

    Capacity.Event = {
        active: function() {

        }
    }

    Capacity.active()

})