jQuery(function($) {

    let State = {
        name: localStorage.getItem('sipprofile-name'),
        action_type: localStorage.getItem('action-type')
    }
    
    let Detail = {}

    Detail.active = function() {
        
        if (State.action_type === 'detail') {
            $('#update').addClass('display-0')
        } else {
            $('#update').removeClass('display-0')
        }

        Detail.API.active()
        Detail.Event.active()
    }

    Detail.API = {
        active: function() {
            $.ajax({
                url: '/api/sipprofile/detail',
                methos: 'GET',
                data: {
                    name: State.name
                },
                success: function(resp) {
                    if (resp.meta.code == '200') {
                        let data = resp.data

                        $('#name').val(data.name)
                        $('#desc').val(data.desc)
                        $('#user-agent').val(data.user_agent)
                        $('#sdp-user').val(data.sdp_user)
                        $('#local-network-acl').val(data.local_network_acl)
                        $('#address-detect').val(data.addrdetect)
                        $('#dtmf-type').val(data.dtmf_type)
                        $('#rtp-address').val(data.rtp_address)
                        $('#media-timeout').val(data.media_timeout)
                        $('#context').val(data.context)
                        $('#sip-port').val(data.sip_port)
                        $('#sip-address').val(data.sip_address)
                        $('#sips-port').val(data.sips_port)
                        $('#tls-version').val(data.tls_version)
                        $('#realm').val(data.realm)
                        $('#session-timeout').val(data.session_timeout)
                        $('#minum-session-exp').val(data.minimum_session_expires)

                        Detail.Funtion.btnSwitch('enable-100', data.enable_100rel)
                        Detail.Funtion.btnSwitch('ignore-180', data.ignore_183nosdp)
                        Detail.Funtion.btnSwitch('sip-opt-respond',data.sip_options_respond_503_on_busy)
                        Detail.Funtion.btnSwitch('disbale-transfer',data.disable_transfer)
                        Detail.Funtion.btnSwitch('manual-redirect',data.manual_redirect)
                        Detail.Funtion.btnSwitch('enable-3-pcc',data.enable_3pcc)
                        Detail.Funtion.btnSwitch('enable-compact-headers',data.enable_compact_headers)
                        Detail.Funtion.btnSwitch('rtp-rewrite',data.rtp_rewrite_timestamps)
                        Detail.Funtion.btnSwitch('tls',data.tls)
                        Detail.Funtion.btnSwitch('tls-only',data.tls_only)
                        Detail.Funtion.btnSwitch('enable-timer',data.enable_timer)

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

        }
    }

    Detail.Funtion = {
        btnSwitch: function(idElement, status) {
            if (status) {
                $(`#${idElement}`).val('1') // true
                $(`#${idElement}`).closest('.switch').removeClass('btn-light off')
                $(`#${idElement}`).closest('.switch').addClass('btn-primary')
            } else {
                $(`#${idElement}`).val('1') // true
                $(`#${idElement}`).closest('.switch').addClass('btn-light off')
                $(`#${idElement}`).closest('.switch').removeClass('btn-primary')
            }
        }
    }

    Detail.active()

})