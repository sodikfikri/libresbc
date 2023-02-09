$(document).ready(function ($) {

    toastMixin = Swal.mixin({
        toast: true,
        icon: "success",
        title: "General Title",
        animation: false,
        position: "top-right",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    let State = {
        sidebar: {
            dataType: ''
        },
        pathName: ''
    }

    let Component = {}

    Component.active = function() {
        Component.Event.active()
    }

    Component.Event = {
        active: function() {
            this.subSelect()
            this.menuActivate()
        },
        subSelect: function() {
            // enevet sub select side bar
            $('#sub-base').on('click', function() {
                State.sidebar.dataType = $(this).data('type')

                if (State.sidebar.dataType == 1) {
                    $(this).data('type', '2')
                    
                    $('.child-sub-base').delay(200).fadeIn()
                } else {
                    $(this).data('type', '1')
                    $('.child-sub-base').delay(100).fadeOut()
                }
            })
            $('#sub-cls').on('click', function() {
                State.sidebar.dataType = $(this).data('type')

                if (State.sidebar.dataType == 1) {
                    $(this).data('type', '2')
                    
                    $('.child-sub-cls').delay(200).fadeIn()
                } else {
                    $(this).data('type', '1')
                    $('.child-sub-cls').delay(100).fadeOut()
                }
            })
            $('#sub-inter').on('click', function() {
                State.sidebar.dataType = $(this).data('type')

                if (State.sidebar.dataType == 1) {
                    $(this).data('type', '2')
                    
                    $('.child-sub-inter').delay(200).fadeIn()
                } else {
                    $(this).data('type', '1')
                    $('.child-sub-inter').delay(100).fadeOut()
                }
            })
            $('#sub-routing').on('click', function() {
                State.sidebar.dataType = $(this).data('type')

                if (State.sidebar.dataType == 1) {
                    $(this).data('type', '2')
                    
                    $('.child-sub-routing').delay(200).fadeIn()
                } else {
                    $(this).data('type', '1')
                    $('.child-sub-routing').delay(100).fadeOut()
                }
            })
            $('#sub-access').on('click', function() {
                State.sidebar.dataType = $(this).data('type')

                if (State.sidebar.dataType == 1) {
                    $(this).data('type', '2')
                    
                    $('.child-sub-access').delay(200).fadeIn()
                } else {
                    $(this).data('type', '1')
                    $('.child-sub-access').delay(100).fadeOut()
                }
            })
        },
        menuActivate: function() {
            State.pathName = window.location.pathname.split('/')

            switch (State.pathName[1]) {
                case 'cluster':
                    $('#menu-configuration').trigger('click')
                    break;
                case 'base':
                    $('#menu-configuration').trigger('click')

                    if (State.pathName[2] == 'natalias' || State.pathName[2] == 'firewall' || State.pathName[2] == 'gateway' || State.pathName[2] == 'acl') {
                        $('#sub-base').trigger('click')
                    }
                    break;
                case 'sipprofile':
                    $('#menu-configuration').trigger('click')
                    break;
                case 'class':
                    $('#menu-configuration').trigger('click')

                    if (State.pathName[2] == 'capacity' || State.pathName[2] == 'media' || State.pathName[2] == 'manipulation' || State.pathName[2] == 'translation' || State.pathName[2] == 'preanswer') {
                        $('#sub-cls').trigger('click')
                    }
                    break;
                case 'inter-conncection':
                    $('#menu-configuration').trigger('click')

                    if (State.pathName[2] == 'in-bound' || State.pathName[2] == 'out-bound') {
                        $('#sub-inter').trigger('click')
                    }
                    break;
                case 'routing':
                    $('#menu-configuration').trigger('click')

                    if (State.pathName[2] == 'table' || State.pathName[2] == 'record') {
                        $('#sub-routing').trigger('click')
                    }
                    break;
                case 'route':
                    $('#menu-configuration').trigger('click')
                    break;
                default:
                    break;
            }
        }
    }

    Component.active()

})