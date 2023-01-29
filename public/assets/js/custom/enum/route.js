jQuery(function($) {
    
    let State = {
        table: {
            list: ''
        },
        validate: {
            update: {
                dst_num: ''
            }
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
                    if (resp.meta.code == '200') {
                        console.log('success');
                        toastMixin.fire({
                            icon: "success",
                            title: resp.meta.message,
                        });
                    } else {
                        console.log('failed');
                        toastMixin.fire({
                            icon: "error",
                            title: resp.meta.message,
                        });
                    }
                    $('#modalAdd').modal('hide')
                    State.table.list.ajax.reload()
                }
            })
        },
        Detail: function(id) {
            $.ajax({
                url: '/api/enum/route/detail',
                method: 'GET',
                data: {
                    id: id
                },
                success: function(resp) {
                    return console.log(resp);
                    if (resp.meta.code == '200') {
                        let data = resp.data
                        let destnum = data.destination_number
                        if (destnum.charAt(0) == '+') {
                            $('#upt-dest-number').val(destnum.slice(1))
                            State.validate.update.dst_num = destnum.slice(1)
                        } else {
                            $('#upt-dest-number').val(destnum)
                            State.validate.update.dst_num = destnum
                        }

                        $('#upt-id').val(data.id)
                        $('#upt-primary-route').val(data.primary_route)
                        $('#upt-secondary-route').val(data.secondary_route)

                        $('#modalUpdate').modal('show')
                    } else {
                        toastMixin.fire({
                            icon: "warning",
                            title: resp.meta.message,
                        });
                    }
                }
            })
        },
        Update: function(params) {
            $.ajax({
                url: '/api/enum/route/update',
                method: 'PUT',
                data: params,
                success: function(resp) {
                    console.log(resp);
                    if (resp.meta.code == '200') {
                        toastMixin.fire({
                            icon: "success",
                            title: resp.meta.message,
                        });
                    } else {
                        toastMixin.fire({
                            icon: "error",
                            title: resp.meta.message,
                        });
                    }
                    $('#modalUpdate').modal('hide')
                    State.table.list.ajax.reload()
                }
            })
        },
        Delete: function(id) {
            $.ajax({
                url: '/api/enum/route/delete',
                method: 'DELETE',
                data: {
                    id: id
                },
                success: function(resp) {
                    console.log(resp);
                    if (resp.meta.code == '200') {
                        toastMixin.fire({
                            icon: "success",
                            title: resp.meta.message,
                        });
                    } else {
                        toastMixin.fire({
                            icon: "error",
                            title: resp.meta.message,
                        });
                    }
                    Route.API.List()
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

            $(document).on('click', '#btn-detail', function() {
                Route.API.Detail($(this).data('id'))
            })
            $(document).on('click', '#btn-delete', function() {
                let idx = $(this).data('id')
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancel: false
                }).then(function(result) {
                    if (result.isConfirmed) {
                        Route.API.Delete([idx])
                    }
                })

            })

            this.add()
            this.update()
            this.multidelete()
        },
        add: function() {
            $('#save-route').on('click', function() {

                let params = {
                    destination_number: $('#dest-number').val(),
                    primary_route: $('#primary-route').val(),
                    secondary_route: $('#secondary-route').val()
                }

                Route.API.Store(params)
            })
        },
        update: function() {
            $('#update-route').on('click', function() {

                let params = {
                    id: $('#upt-id').val(),
                    destination_number: $('#upt-dest-number').val(),
                    primary_route: $('#upt-primary-route').val(),
                    secondary_route: $('#upt-secondary-route').val(),
                    validate: $('#upt-dest-number').val() == State.validate.update.dst_num ? '0' : '1'
                }
                // return console.log(params);
                Route.API.Update(params)
            })
        },
        multidelete: function() {
            $('#delete-multiple').on('click', function() {
                let data = $('.route-check').map(function() {
                    if ($(this).is(":checked")) {
                        idx = $(this).data("id")
                        return idx
                    }
                }).get();

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancel: false
                }).then(function(result) {
                    if (result.isConfirmed) {
                        if (data.length == 0) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'No data selected!',
                            })
                        } else {
                            Route.API.Delete(data)
                        }
                    }
                })
                // console.log(data);
            })
        }
    }

    Route.active()

})