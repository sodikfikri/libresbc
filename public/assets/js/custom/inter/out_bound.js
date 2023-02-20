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
                    data: {
                        access: permit
                    }
                },
                columns: [
                    { render: (data, type, row, meta) => meta.row + 1, },
                    {
                        render: function(data, type, row, meta) {
                            return `<span class="action-name" id="read-data" data-name="${row.name}">${row.name}</span>`
                        }
                    },
                    { data: 'desc' },
                    { data: 'sipprofile' },
                    { data: 'action' },
                ]
            })
        }
    }

    OutBound.Event = {
        active: function() {
            $(document).on('click', '#btn-detail', function() {
                localStorage.setItem('outbound-name', $(this).data('name'))
                localStorage.setItem('action-type', 'update')
                window.location.href = location.origin + '/inter-conncection/out-bound/detail'
            })

            $(document).on('click', '#read-data', function() {
                localStorage.setItem('outbound-name', $(this).data('name'))
                localStorage.setItem('action-type', 'detail')
                window.location.href = location.origin + '/inter-conncection/out-bound/detail'
            })
        }
    }

    OutBound.active()

})