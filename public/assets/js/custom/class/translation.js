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
        },
        Detail: function(name) {
            $.ajax({
                url: '/api/class/translation/detail?name=' + name,
                method: 'GET',
                success: function(resp) {
                    console.log(resp);
                    if (resp.meta.code == '200') {
                        let data = resp.data

                        $('#upt-name').val(data.name)
                        $('#upt-desc').val(data.desc)
                        $('#upt-caller-name').val(data.caller_name)
                        $('#upt-caller-num-pattern').val(data.caller_number_pattern)
                        $('#upt-caller-num-replacement').val(data.caller_number_replacement )
                        $('#upt-destination-num-pattern').val(data.destination_number_pattern)
                        $('#upt-destination-num-replacement').val(data.destination_number_replacement)
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

    Translation.Event = {
        active: function() {
            $(document).on('click', '#btn-detail', function() {
                $('#modalDetail').modal('show')
                Translation.API.Detail($(this).data('name'))
            })
        }
    }

    Translation.active()

})