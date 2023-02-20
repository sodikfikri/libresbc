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
                    { data: 'action' },
                ]
            })
        }
    }

    Sipprofile.Event = {
        active: function() {
            $(document).on('click', '#btn-detail', function() {
                localStorage.setItem('sipprofile-name', $(this).data('name'))
                localStorage.setItem('action-type', 'update')
                window.location.href = location.origin + '/sipprofile/detail'
            })

            $(document).on('click', '#read-data', function() {
                localStorage.setItem('sipprofile-name', $(this).data('name'))
                localStorage.setItem('action-type', 'detail')
                window.location.href = location.origin + '/sipprofile/detail'
            })
        }
    }

    Sipprofile.active()

})