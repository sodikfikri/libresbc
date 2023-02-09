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
                    // { data: 'name' },
                    {
                        render: function(data, type, row, meta) {
                            return `<span id="read-data" data-name="${row.name}" style="cursor: pointer">${row.name}</span>`
                        }
                    },
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
            $(document).on('click', '#btn-detail', function() {
                localStorage.setItem('inbound-name', $(this).data('name'))
                localStorage.setItem('action-type', 'update')
                window.location.href = location.origin + '/inter-conncection/in-bound/detail'
            })

            $(document).on('click', '#read-data', function() {
                localStorage.setItem('inbound-name', $(this).data('name'))
                localStorage.setItem('action-type', 'detail')
                window.location.href = location.origin + '/inter-conncection/in-bound/detail'
            })
        }
    }

    InBound.active()

})