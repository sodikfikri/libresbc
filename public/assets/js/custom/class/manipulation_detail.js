jQuery(function($) {
    
    let State = {
        name: localStorage.getItem('manipulation-name')
    }

    let Detail = {}

    Detail.active = function() {
        Detail.API.active()
        Detail.Event.active()
    }

    Detail.API = {
        active: function() {
            $.ajax({
                url: '/api/class/manipulation/detail',
                data: {
                    name: State.name
                },
                method: 'GET',
                success: function(resp) {
                    if (resp.meta.code == '200') {
                        let data = resp.data

                        $('#name').val(data.name)
                        $('#desc').val(data.desc)

                        if (data.actions) {
                            $.each(data.actions, function(key, val) {
                                let data = ''

                                $.each(val.values, function(_key, _val) {
                                    data += `<div class="row mb-2" id="value_wrapper">
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="" style="font-size: 13px" value="${_val}">
                                                </div>
                                                <div class="col-2">
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>`
                                })

                                $('#actions_wrapper').append(
                                    `<div class="col-4 actions-card mt-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <button class="btn btn-danger btn-sm" id="" style="float: right; margin-bottom: 7px">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <div class="form-group">
                                                    <label for="" style="font-size: 13px">Action</label>
                                                    <input type="text" class="form-control" id="" style="font-size: 13px" value="${val.action}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" style="font-size: 13px">Refervar</label>
                                                    <input type="text" class="form-control" id="" style="font-size: 13px" value="${val.refervar}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" style="font-size: 13px">Pattern</label>
                                                    <input type="text" class="form-control" id="" style="font-size: 13px" value="${val.pattern}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" style="font-size: 13px">Targetvar</label>
                                                    <input type="text" class="form-control" id="" style="font-size: 13px" value="${val.targetvar}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" style="font-size: 13px">Value</label>
                                                    ${data}
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                                )
                            })
                        }
                    }
                },
                error: function(e) {
                    console.log('error: ', e);
                }
            })
        }
    }

    Detail.Event = {
        active: function() {
            this.addAction()
        },
        addAction: function() {
            $('#btn-add-card-action').on('click', function() {
                $('#actions_wrapper').append(
                    `<div class="col-4 actions-card mt-2">
                        <div class="card">
                            <div class="card-body">
                                <button class="btn btn-danger btn-sm" id="" style="float: right; margin-bottom: 7px">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <div class="form-group">
                                    <label for="" style="font-size: 13px">Action</label>
                                    <input type="text" class="form-control" id="" style="font-size: 13px">
                                </div>
                                <div class="form-group">
                                    <label for="" style="font-size: 13px">Refervar</label>
                                    <input type="text" class="form-control" id="" style="font-size: 13px">
                                </div>
                                <div class="form-group">
                                    <label for="" style="font-size: 13px">Pattern</label>
                                    <input type="text" class="form-control" id="" style="font-size: 13px">
                                </div>
                                <div class="form-group">
                                    <label for="" style="font-size: 13px">Targetvar</label>
                                    <input type="text" class="form-control" id="" style="font-size: 13px">
                                </div>
                                <div class="form-group">
                                    <label for="" style="font-size: 13px">Value</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" class="form-control" id="" style="font-size: 13px">
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`
                )
            })
        }
    }

    Detail.active()

})