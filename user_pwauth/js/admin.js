$(document).ready(function(){
	var saveSettings = {
		success: function() {
			OC.msg.finishedSaving('#user-pwauth-settings-msg', {status: 'success', data: {
				'message': 'OK'
			}});
		},
		error: function() {
			OC.msg.finishedSaving('#user-pwauth-settings-msg', {status: 'failure', data: {
				'message': 'Error!'
			}});
		}
	}
	$('#user-pwauth-pwauth-path').focusout(function() {
		OC.msg.startSaving('#user-pwauth-settings-msg');
		OCP.AppConfig.setValue('user_pwauth', 'pwauth_path', $(this).val(), saveSettings);
	});
	$('#user-pwauth-uid-list').focusout(function() {
		OC.msg.startSaving('#user-pwauth-settings-msg');
		OCP.AppConfig.setValue('user_pwauth', 'uid_list', $(this).val(), saveSettings);
	});
});
