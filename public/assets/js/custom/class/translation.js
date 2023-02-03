jQuery(function($) {

    let State = {
        table: {
            list: ''
        }
    }

    let Translation = {}

    Translation.active = function() {
        Translation.API.List()
        Translation.Event.active()
    }

    Translation.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                // serverSide: true,
                // order: [[1, 'desc']],
                ajax: {
                    url: '/api/class/translation/list',
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

    Translation.Event = {
        active: function() {

        }
    }

    Translation.active()

})