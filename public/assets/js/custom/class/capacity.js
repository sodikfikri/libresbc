jQuery(function($) {

    let State = {
        table: {
            list: ''
        }
    }

    let Capacity = {}

    Capacity.active = function() {
        Capacity.API.List()
        Capacity.Event.active()
    }

    Capacity.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                // serverSide: true,
                // order: [[1, 'desc']],
                ajax: {
                    url: '/api/class/capacity/list',
                    method: 'GET',
                    data: {
                        access: permit
                    }
                },
                columns: [
                    { render: (data, type, row, meta) => meta.row + 1, },
                    // { data: 'name' },
                    {
                        render: function(data, type, row, meta) {
                            return `<span class="action-name" id="read-data" data-name="${row.name}">${row.name}</span>`
                        }
                    },
                    { data: 'desc' },
                    { data: 'action' },
                ]
            })
        },
        Detail: function(name) {
            $.ajax({
                url: '/api/class/capacity/detail?name='+name,
                method: 'GET',
                success: function(resp) {
                    if (resp.meta.code == '200') {
                        let data = resp.data
                        $('#upt-name').val(data.name)
                        $('#upt-desc').val(data.desc)
                        $('#upt-cps').val(data.cps)
                        $('#upt-cc').val(data.concurentcalls)
                    } else {
                        toastMixin.fire({
                            icon: "error",
                            title: resp.meta.message,
                        });
                    }
                },
                error: function(e) {
                    console.log('error: ', e);
                }
            })
        }
    }

    Capacity.Event = {
        active: function() {
            $(document).on('click', '#btn-detail', function() {
                $('#update').removeClass('display-0')
                Capacity.API.Detail($(this).data('name'))
                $('#modalDetail').modal('show')
            })

            $(document).on('click', '#read-data', function() {
                $('#update').addClass('display-0')
                Capacity.API.Detail($(this).data('name'))
                $('#modalDetail').modal('show')
            })
        }
    }

    Capacity.active()

})