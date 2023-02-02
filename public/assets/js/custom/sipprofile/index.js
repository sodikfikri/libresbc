jQuery(function($) {

    let State = {
        table: {
            list: ''
        }
    }

    let Sipprofile = {}

    Sipprofile.active = function() {
        Sipprofile.API.List()
        Sipprofile.Event.active()
    }

    Sipprofile.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                // serverSide: true,
                // order: [[1, 'desc']],
                ajax: {
                    url: '/api/sipprofile/list',
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

    Sipprofile.Event = {
        active: function() {

        }
    }

    Sipprofile.active()

})