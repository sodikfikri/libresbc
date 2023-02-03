jQuery(function($) {

    let State = {
        table: {
            list: ''
        }
    }

    let Manipulation = {}

    Manipulation.active = function() {
        Manipulation.API.List()
        Manipulation.Event.active()
    }

    Manipulation.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                // serverSide: true,
                // order: [[1, 'desc']],
                ajax: {
                    url: '/api/class/manipulation/list',
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

    Manipulation.Event = {
        active: function() {
            
        }
    }

    Manipulation.active()

})