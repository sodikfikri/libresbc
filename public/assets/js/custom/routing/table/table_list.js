jQuery(function($) {

    let State = {
        table: {
            list: ''
        }
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
                    { data: 'name' },
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
        }
    }

    Routing.Event = {
        active: function() {

        }
    }

    Routing.active()

})