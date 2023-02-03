jQuery(function($) {

    let State = {
        table: {
            list: ''
        }
    }
    // alert(999)

    let OutBound = {}

    OutBound.active = function() {
        OutBound.API.List()
        OutBound.Event.active()
    }

    OutBound.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                // serverSide: true,
                // order: [[1, 'desc']],
                ajax: {
                    url: '/api/inter/outbound/list',
                    method: 'GET',
                },
                columns: [
                    { render: (data, type, row, meta) => meta.row + 1, },
                    { data: 'name' },
                    { data: 'desc' },
                    { data: 'sipprofile' },
                    { data: 'action' },
                ]
            })
        }
    }

    OutBound.Event = {
        active: function() {

        }
    }

    OutBound.active()

})