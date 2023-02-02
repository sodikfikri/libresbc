jQuery(function($) {

    let State = {
        table: {
            list: ''
        }
    }

    let Natalias = {}

    Natalias.active = function() {
        Natalias.API.List()
        Natalias.Event.active()
    }

    Natalias.API = {
        List: function() {
            $('#table').dataTable().fnDestroy();
            State.table.list = $('#table').DataTable({
                paging: true,
                processing: true,
                responsive: true,
                // serverSide: true,
                // order: [[1, 'desc']],
                ajax: {
                    url: '/api/base/natalias/list',
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
                url: '/api/base/natalias/detail/?name='+name,
                method: 'GET',
                success: function(resp) {
                    if (resp.meta.code == '200') {
                        $('#upt-name').val(resp.data.name)
                        $('#upt-desc').val(resp.data.desc)

                        if (resp.data.addresses.length != 0) {
                            let addresses = resp.data.addresses
                            $.each(addresses, function(key, val) {
                                if (key == 0) {
                                    $('#form-upt-addresses').append(
                                        `<div class="address_wrapper mb-3">
                                            <div class="row">
                                                <div class="col-4">
                                                    <input type="text" class="form-control" id="upt-address-member" value="${val.member}">
                                                </div>
                                                <div class="col-3">
                                                    <input type="text" class="form-control" id="upt-address-listen" value="${val.listen}">
                                                </div>
                                                <div class="col-3">
                                                    <input type="text" class="form-control" id="upt-address-advertise" value="${val.advertise}">
                                                </div>
                                                <div class="col-2">
                                                    <button class="btn btn-danger remove-row-update">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button class="btn btn-primary add-row-update">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>`
                                    )
                                } else {
                                    $('#form-upt-addresses').append(
                                        `<div class="address_wrapper mb-3">
                                            <div class="row">
                                                <div class="col-4">
                                                    <input type="text" class="form-control" id="upt-address-member">
                                                </div>
                                                <div class="col-3">
                                                    <input type="text" class="form-control" id="upt-address-listen">
                                                </div>
                                                <div class="col-3">
                                                    <input type="text" class="form-control" id="upt-address-advertisen">
                                                </div>
                                                <div class="col-2">
                                                    <button class="btn btn-danger remove-row-update">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>`
                                    )
                                }
                            })
                        }

                        $('#modalDetail').modal('show')
                    } else {
                        toastMixin.fire({
                            icon: "warning",
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

    Natalias.Event = {
        active: function() {
            $(document).on('click', '#btn-detail', function() {
                Natalias.API.Detail($(this).data('name'))
            })
            
            this.addRowUpdate()
            this.removeRowUpdate()
        },
        addRowUpdate: function() {
            $(document).on('click', '.add-row-update', function(e) {
                e.preventDefault()

                $('#form-upt-addresses').append(
                    `<div class="address_wrapper mb-3">
                        <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control" id="upt-address-member">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" id="upt-address-listen">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" id="upt-address-advertisen">
                            </div>
                            <div class="col-2">
                                <button class="btn btn-danger remove-row-update">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>`
                )
            })
        },
        removeRowUpdate: function() {
            $(document).on('click', '.remove-row-update', function(e) {
                e.preventDefault()

                $(this).closest('.address_wrapper').remove()
            })
        }
    }

    Natalias.active()

})