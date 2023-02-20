jQuery(function($) {
    
    let State = {
        table: {
            list: ''
        }
    }

    let Roles = {}

    Roles.active = function() {
        Roles.API.List()
        Roles.Event.active()
    }

    Roles.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                ajax: {
                    url: '/api/user_manage/role_list',
                    method: 'GET',
                    data: {
                        access: permit
                    }
                },
                columns: [
                    { render: (data, type, row, meta) => meta.row + 1, },
                    {
                        render: function(data, type, row, meta) {
                            return `<span class="action-name" id="read-data" data-id="${row.id}">${row.name}</span>`
                        }
                    },
                    { data: 'created_at' },
                    { data: 'action' },
                ]
            })
        },
        Detail: function(params) {
            $.ajax({
                url: '/api/user_manage/role_detail',
                method: 'GET',
                data: {
                    id: params
                },
                success: function(resp) {
                    if (resp.meta.code == '200') {
                        let data = resp.data
                        
                        $('#upt-name').val(data.name)
                        $('#id-hide').val(data.id)
                    }

                    $('#modalDetail').modal('show')
                },
                error: function(e) {
                    console.log('error: ', e);
                }
            })
        },
        Create: function(params) {
            $.ajax({
                url: '/api/user_manage/role_add',
                method: 'POST',
                data: params,
                success: function(resp) {
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
                    $('#name').val('')
                    $('#modalCreate').modal('hide')
                    State.table.list.ajax.reload()
                },
                error: function(e) {
                    console.log('error: ', e);
                }
            })
        },
        Update: function(params) {
            $.ajax({
                url: '/api/user_manage/role_update',
                method: 'PUT',
                data: params,
                success: function(resp) {
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
                    $('#upt-name').val('')
                    $('#modalDetail').modal('hide')
                    State.table.list.ajax.reload()
                },
                error: function(e) {
                    console.log('error: ', e);
                }
            })
        },
        Delete: function(params) {
            $.ajax({
                url: '/api/user_manage/role_delete',
                method: 'PUT',
                data: params,
                success: function(resp) {
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
                    State.table.list.ajax.reload()
                },
                error: function(e) {
                    console.log('error: ', e);
                }
            })
        }
    }

    Roles.Event = {
        active: function() {
            $(document).on('click', '#btn-detail', function() {
                Roles.API.Detail($(this).data('id'))
            })

            $(document).on('click', '#create', function() {
                let params = {
                    name: $('#name').val()
                }

                Roles.API.Create(params)
            })

            $(document).on('click', '#update', function() {
                let params = {
                    id: $('#id-hide').val(),
                    name: $('#upt-name').val()
                }

                Roles.API.Update(params)
            })

            $(document).on('click', '#btn-delete', function() {
                let params = {
                    id: $(this).data('id')
                }
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
                        Roles.API.Delete(params)
                    }
                })
            })
        }
    }

    Roles.active()
})