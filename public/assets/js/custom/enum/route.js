jQuery(function($) {
    
    let State = {
        table: {
            list: ''
        }
    }

    let Route = {}

    Route.active = function() {
        Route.Evenet.active()
        Route.API.List()
    }

    Route.API = {
        List: function() {
            $('#dataTable').dataTable().fnDestroy();
            State.table.list = $('#dataTable').DataTable({
                paging: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'http://localhost:8000/api/enum/route',
                    method: 'GET',
                    complete: function() {
                        $('#th-check').css('width', '10px')
                    }
                },
                columns: [
                    { data: 'check', orderable: false, className: "text-center" },
                    { data: 'destination_number', className: "text-center" },
                    { data: 'primary_route', className: "text-center" },
                    { data: 'secondary_route', className: "text-center" },
                    { data: 'action', className: "text-center" },
                ]
            })
        }
    }

    Route.Evenet = {
        active: function() {
            $(document).on('click', '#input-th-check', function() {
                if ($(this).is(":checked")) {
                    $('.route-check').prop('checked', true)
                } else {
                    $('.route-check').prop('checked', false)
                }
            })

            this.add()
        },
        add: function() {
            $('#save-route').on('click', function() {
                alert(9999)
            })
        }
    }

    Route.active()

})