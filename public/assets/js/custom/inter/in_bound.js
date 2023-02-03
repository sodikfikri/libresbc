jQuery(function($) {

    let State = {
        table: {
            list: ''
        }
    }

    let InBound = {}

    InBound.active = function() {
        InBound.API.List()
        InBound.Event.active()
    }

    InBound.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                // serverSide: true,
                // order: [[1, 'desc']],
                ajax: {
                    url: '/api/inter/inbound/list',
                    method: 'GET',
                },
                columns: [
                    { render: (data, type, row, meta) => meta.row + 1, },
                    { data: 'name' },
                    { data: 'desc' },
                    { data: 'sipprofile' },
                    { data: 'routing' },
                    { data: 'action' },
                ]
            })
        }
    }

    InBound.Event = {
        active: function() {

        }
    }

    InBound.active()

})