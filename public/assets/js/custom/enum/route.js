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
                responsive: true,
                serverSide: true,
                order: [[1, 'desc']],
                ajax: {
                    url: '/api/enum/route',
                    method: 'GET',
                    complete: function() {
                        $('#th-check').css('width', '10px')
                    }
                },
                columns: [
                    { data: 'check', orderable: false, className: "text-center" },
                    { data: 'id', className: "text-center display-0" },
                    { data: 'destination_number', className: "text-center" },
                    { data: 'primary_route', className: "text-center" },
                    { data: 'secondary_route', className: "text-center" },
                    { data: 'action', className: "text-center" },
                ]
            })
        },
        Store: function(params) {
            $.ajax({
                url: '/api/enum/route/add',
                method: 'POST',
                data: params,
                success: function(resp) {
                    if (resp.meta.code == 200) {
                        console.log('success');
                        // Ladda.stopAll();
                        toastMixin.fire({
                            icon: "success",
                            title: resp.meta.message,
                        });
                    } else {
                        console.log('failed');
                        // Ladda.stopAll();
                        toastMixin.fire({
                            icon: "error",
                            title: resp.meta.message,
                        });
                    }
                }
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

                Swal.fire('Any fool can use a computer')
                // let params = {
                //     destination_number: $('#dest-number').val(),
                //     primary_route: $('#primary-route').val(),
                //     secondary_route: $('#secondary-route').val()
                // }

                // Route.API.Store(params)
            })
        }
    }

    Route.active()

})