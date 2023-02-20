jQuery(function($) {

    let State = {
        table: {
            list: ''
        }
    }

    let User = {}

    User.active = function() {
        User.API.List()
        User.API.RoleSelect()
        User.Event.active()
    }

    User.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                // serverSide: true,
                // order: [[1, 'desc']],
                ajax: {
                    url: '/api/user_manage/user_list',
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
                            return `<span class="action-name" id="read-data" data-id="${row.id}">${row.fullname}</span>`
                        }
                    },
                    { data: 'email' },
                    { data: 'role_name' },
                    { data: 'action' },
                ]
            })
        },
        RoleSelect: function() {
            $.ajax({
                url: '/api/user_manage/role_select',
                method: 'GET',
                success: function(resp) {
                    if (resp.meta.code == '200') {
                        $('#upt-role').empty()

                        $.each(resp.data, function(key, val) {
                            $('#role').append(
                                `<option value="${val.id}">${val.name}</option>`
                            )
                            $('#upt-role').append(
                                `<option value="${val.id}">${val.name}</option>`
                            )
                        })
                    }
                },
                error: function(e) {
                    console.log('erorr: ', e);
                }
            })
        },
        Create: function(params) {
            $.ajax({
                url: '/api/user_manage/user_add',
                method: 'POST',
                data: params,
                success: function(resp) {
                    if (resp.meta.code == '200') {
                        $('#name').val('')
                        $('#email').val('')
                        $('#role').val('')
                        $('#username').val('')
                        $('#password').val('')

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

                    $('#modalCreate').modal('hide')
                    State.table.list.ajax.reload()
                },
                error: function(e) {
                    console.log('error: ', e);
                }
            })
        },
        Detail: function(params) {
            $.ajax({
                url: '/api/user_manage/user_detail',
                data: {
                    id: params
                },
                method: 'GET',
                success: function(resp) {
                    if (resp.meta.code == '200') {
                        let data = resp.data

                        $('#id-hide').val(data.id)
                        $('#upt-name').val(data.fullname)
                        $('#upt-role').val(data.role_id)
                        $('#upt-email').val(data.email)
                        $('#upt-username').val(data.username)

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
        },
        Update: function(params) {
            $.ajax({
                url: '/api/user_manage/user_update',
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
                url: '/api/user_manage/user_delete',
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
                            icon: "success",
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

    User.Event = {
        active: function() {
            $(document).on('click', '#btn-detail', function() {
                User.API.Detail($(this).data('id'))
                $('#modalDetail').modal('show')
            })

            $(document).on('click', '#create', function() {
                let params = {
                    fullname: $('#name').val(),
                    email: $('#email').val(),
                    role: $('#role').val(),
                    username: $('#username').val(),
                    password: $('#password').val(),
                }  

                User.API.Create(params)
            })

            $(document).on('click', '#update', function() {
                let params = {
                    id: $('#id-hide').val(),
                    fullname: $('#upt-name').val(),
                    email: $('#upt-email').val(),
                    role: $('#upt-role').val(),
                    username: $('#upt-username').val(),
                    password: $('#upt-password').val()
                }

                User.API.Update(params)
            })

            $(document).on('click', '#btn-delete', function() {
                let parmas = {
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
                        User.API.Delete(parmas)
                    }
                })
                
            })
        }
    }

    User.active()

})