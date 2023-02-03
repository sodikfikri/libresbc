jQuery(function($) {

    let State = {
        table: {
            list: ''
        }
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

    Media.Event = {
        active: function() {

        }
    }

    Media.active()

})