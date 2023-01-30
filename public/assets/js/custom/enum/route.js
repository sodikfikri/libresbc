jQuery(function($) {
    
    let State = {
        table: {
            list: '',
            length: 10,
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
        Route.API.ListPrimaryRoute()
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
                pageLength: State.table.length,
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
        },
        Import: function(params) {
            // return console.log(JSON.stringify(params));
            $.ajax({
                url: '/api/enum/route/import',
                method: 'POST',
                data: {
                    data: params
                },
                beforeSend: function() {
                    $('#btn-icon-import').removeClass('fas fa-download')
                    $('#btn-icon-import').addClass('fas fa-circle-notch fa-spin')
                },
                success: function(resp) {
                    return console.log(resp);
                    if (resp.meta.code == '200') {
                        $('#total-data').html(resp.summary.total_data)
                        $('#total-success').html(resp.summary.success)
                        $('#total-failed').html(resp.summary.failed)

                        if (resp.failed_import.length != 0) {
                            $('#fail-data-import').removeClass('display-0')
                            $.each(resp.failed_import, function(key, val) {
                                $('#fail-data-import tbody').append(
                                    `<tr style="background-color: #e74a3b; color: white;">
                                        <td>${val.destination_number}</td>
                                        <td>${val.primary_route}</td>
                                        <td>${val.secondary_route}</td>
                                    </tr>`
                                )
                            })
                        }

                        toastMixin.fire({
                            icon: "success",
                            title: resp.meta.message,
                        });

                        setTimeout(() => {
                            $('#modalImport').modal('show')
                        }, 1000);
                    } else {
                        toastMixin.fire({
                            icon: "warning",
                            title: resp.meta.message,
                        });
                    }
                    Route.API.List()
                },
                complete: function() {
                    $('#btn-icon-import').removeClass('fas fa-circle-notch fa-spin')
                    $('#btn-icon-import').addClass('fas fa-download')
                },
                error: function(e) {
                    console.log('error: ',e);
                }
            })
        },
        Export: function(params) {
            $.ajax({
                url: '/api/enum/route/export_data',
                data: {
                    data: params
                },
                method: 'GET',
                beforeSend: function() {
                    $('#btn-icon-export').removeClass('fas fa-upload')
                    $('#btn-icon-export').addClass('fas fa-circle-notch fa-spin')
                },
                success: function(resp) {
                    $('#modalExport').modal('hide') 
                    if (resp.meta.code == '200') {
                        const items = resp.data
                        const replacer = (key, value) => value === null ? '' : value // specify how you want to handle null values here
                        const header = Object.keys(items[0])
                        const csv = [
                            header.join(','), // header row first
                            ...items.map(row => header.map(fieldName => JSON.stringify(row[fieldName], replacer)).join(','))
                        ].join('\r\n')
    
                        const blob = new Blob([csv], { type: 'text/csv' });
                        const url = window.URL.createObjectURL(blob)
                        const a = document.createElement('a')
                        a.setAttribute('href', url)
                        a.setAttribute('download', `Enum Route ${moment().format('YYYY-MM-DD')}.csv`);
                        a.click()

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
                },
                complete: function() {
                    $('#btn-icon-export').removeClass('fas fa-circle-notch fa-spin')
                    $('#btn-icon-export').addClass('fas fa-upload')
                },
                error: function() {
                    $('#modalExport').modal('hide') 
                }
            })
        },
        ListPrimaryRoute: function() {
            $.ajax({
                url: '/api/enum/route/primary_route',
                method: 'GET',
                success: function(resp) {
                    if (resp.meta.code == 200) {
                        $.each(resp.data, function(key, val) {
                            $('#p-route').append(
                                `<div class="col-3">
                                    <span style="font-weight: bold">${val.primary_route}</span>
                                </div>
                                <div class="col-1">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input type-export" value="${val.primary_route}">
                                            <label class="form-check-label" for="exampleCheck1"></label>
                                        </div>
                                    </div>
                                </div>`
                            )
                        })
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

            $('#import-data').on('click', function() {
                $('#input-file').trigger('click')
                // $('#modalImport').modal('show')
            })

            this.add()
            this.update()
            this.multidelete()
            this.import()
            this.export()
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
        },
        import: function() {
            $('#input-file').on('change', function() {
                let file = document.getElementById("input-file").files;
                // return console.log(file);
                let reader = new FileReader()

                reader.onload = function(e) {
                    let data = e.target.result
                    let workbook = XLSX.read(data, {type: 'binary'})
                    workbook.SheetNames.forEach(function(sheetName) {
                        let XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName])
                        let json_object = JSON.stringify(XL_row_object)
                        let arr_data = JSON.parse(json_object)
                        // return console.log(arr_data);
                        Route.API.Import(arr_data)
                    })
                }

                reader.onerror = function(err) {
                    console.log(err);
                }
        
                reader.readAsBinaryString(file[0])
            })
        },
        export: function() {
            $('#export-data').on('click', function() {
                $('#modalExport').modal('show')
            })

            $('#btn-export').on('click', function() {
                let data = $('.type-export').map(function() {
                    if ($(this).is(":checked")) {
                        idx = $(this).val()
                        return idx
                    }
                }).get();

                if (data.length == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'No data selected!',
                    })
                } else {
                    Route.API.Export(data)      
                }

            })
        }
    }

    Route.active()

})