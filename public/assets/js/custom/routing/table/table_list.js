jQuery(function($) {

    let State = {
        table: {
            list: ''
        },
        action_type: ''
    }

    let Routing = {}

    Routing.active = function() {
        Routing.API.List()
        Routing.Event.active()
    }

    Routing.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                // serverSide: true,
                // order: [[1, 'desc']],
                ajax: {
                    url: '/api/routing/table/list',
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
                    { 
                        render: (data, type, row, meta) => {
                            let routes = ''
                            if (row.routes) {
                                routes = row.routes
                            }

                            return routes;
                        }
                    },
                    {
                        render: (data, type, row, meta) => {
                            let action = `<button type="button" class="btn btn-warning btn-sm waves-effect mr-2" id="btn-detail" data-name="${row.name}"><i class="fas fa-edit"></i></button>`
                                action += `<button type="button" class="btn btn-danger btn-sm waves-effect" id="btn-delete" data-id="${row.name}"><i class="fas fa-trash"></i></button>`

                            return action;
                        }
                    },
                ]
            })
        },
        Detail: function(data) {
            $.ajax({
                url: '/api/routing/table/detail',
                method: 'GET',
                data: {
                    name: data
                },
                success: function(resp) {
                    if (resp.meta.code == '200') {
                        let data = resp.data

                        $('#variable_wrapper').empty()
                        $('#variable_wrapper').empty()
                        $('.record_wrapper').empty()

                        $('#upt-name').val(data.name)
                        $('#upt-desc').val(data.desc)
                        $('#upt-action').val(data.action)

                        if (data.routes) {
                            $('#routes-data').removeClass('display-0')
                            $('#upt-route-primary').val(data.routes.primary)
                            $('#upt-route-secondary').val(data.routes.secondary)
                            $('#upt-route-load').val(data.routes.load)
                        } else {
                            $('#routes-data').addClass('display-0')
                            $('#upt-route-primary').val('')
                            $('#upt-route-secondary').val('')
                            $('#upt-route-load').val('')
                        }

                        if (data.records) {
                            $('#record-data').removeClass('display-0')
                            if (data.records.length != 0) {
                                $.each(data.records, function(key, val) {
                                    $('.record_wrapper').append(
                                        `<div class="col-md-4 record_child mb-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div style="float: right; padding-bottom: 7px">
                                                        <button class="btn btn-danger btn-sm ${State.action_type == 'detail' ? 'display-0' : ''}">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 0">
                                                        <label for="" style="font-size: 13px;">Match</label>
                                                        <input type="text" class="form-control" id="" style="font-size: 13px;" value="${val.match}">
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 0">
                                                        <label for="" style="font-size: 13px;">Value</label>
                                                        <input type="text" class="form-control" id="" style="font-size: 13px;" value="${val.value}">
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 0">
                                                        <label for="" style="font-size: 13px;">Action</label>
                                                        <input type="text" class="form-control" id="" style="font-size: 13px;" value="${val.action}">
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 0">
                                                        <label for="" class="" style="font-size: 13px;">Routes</label> <br>
                                                        <div class="row">
                                                            <div class="col-md-4" style="padding-left: 20px">
                                                                <span style="font-size: 13px;">Primary</span>
                                                            </div>
                                                            <div class="col-md-8 mb-2">
                                                                <input type="text" class="form-control" id="upt-route-primary" style="font-size: 13px;" value="${val.routes.primary}">
                                                            </div>
                                                            <div class="col-md-4" style="padding-left: 20px">
                                                                <span style="font-size: 13px;">Secondary</span>
                                                            </div>
                                                            <div class="col-md-8 mb-2">
                                                                <input type="text" class="form-control" id="upt-route-secondary" style="font-size: 13px;" value="${val.routes.secondary}">
                                                            </div>
                                                            <div class="col-md-4" style="padding-left: 20px">
                                                                <span style="font-size: 13px;">Load</span>
                                                            </div>
                                                            <div class="col-md-8 mb-2">
                                                                <input type="text" class="form-control" id="upt-route-load" style="font-size: 13px;" value="${val.routes.load}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`
                                    )
                                })
                            } else {
                                $('#record-data').addClass('display-0')
                            }
                        } else {
                            $('#record-data').addClass('display-0')
                        }

                        $.each(data.variables, function(key, val) {
                            $('#variable_wrapper').append(
                                `<div class="variable_child mb-2">
                                    <div class="row ${key == 0 ? 'mt-2' : ''}">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="upt-variables" value="${val}">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-danger ${State.action_type == 'detail' ? 'display-0' : ''}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>`
                            )
                        })

                        $('#modalDetail').modal('show')
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

    Routing.Event = {
        active: function() {
            $(document).on('click', '#btn-detail', function() {
                $('#update').removeClass('display-0')

                State.action_type = 'update'
                Routing.API.Detail($(this).data('name'))
            })

            $(document).on('click', '#read-data', function() {
                $('#update').addClass('display-0')

                State.action_type = 'detail'
                Routing.API.Detail($(this).data('name'))
            })
        }
    }

    Routing.active()

})