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

    Manipulation.Event = {
        active: function() {
            $(document).on('click', '#btn-detail', function() {
                localStorage.setItem('manipulation-name', $(this).data('name'))
                localStorage.setItem('action-type', 'update')
                window.location.href = location.origin + '/class/manipulation/detail'
            })

            $(document).on('click', '#read-data', function() {
                localStorage.setItem('manipulation-name', $(this).data('name'))
                localStorage.setItem('action-type', 'detail')
                window.location.href = location.origin + '/class/manipulation/detail'
            })
        }
    }

    Manipulation.active()

})