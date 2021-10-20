<?php

function custom_alert($title,$message,$type){


    if($type=="success"){
        $bodycolor="#e3ffe8";
        $textcolor="#13351a";
    }
    else if($type=="warning"){
        $bodycolor="#fff5c8";
        $textcolor="#4d2e1a";
    }
    else if($type=="danger"){
        $bodycolor="";
        $textcolor="";
    }
    else {
        $bodycolor="white";
        $textcolor="Black";
    }

?>


    <script>
$.notify({
	// options
	icon: 'glyphicon glyphicon-warning-sign',
	title: '<?php echo $title; ?>',
	message: '<?php echo $message; ?>',
	url: 'https://github.com/mouse0270/bootstrap-notify',
	target: '_blank'
},{
	// settings
	element: 'body',
	position: null,
	type: "info",
	allow_dismiss: true,
	newest_on_top: false,
	showProgressbar: false,
	placement: {
		from: "top",
		align: "center"
	},
	offset: 20,
	spacing: 10,
	z_index: 1031,
	delay: 5000,
	timer: 2000,
	url_target: '_blank',
	mouse_over: null,
	animate: {
		enter: 'animated fadeInDown',
		exit: 'animated fadeOutUp'
	},
	onShow: null,
	onShown: null,
	onClose: null,
	onClosed: null,
	icon_type: 'class',
	template: '<div style="background-color:<?php echo $bodycolor; ?>" data-notify="container" class="col-xs-11 col-sm-3 alert alert-<?php echo $type; ?>" role="alert">' +
		'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
		'<span data-notify="icon"></span> ' +
		'<span data-notify="title">{1}</span> ' +
		'<span style="color:<?php echo $textcolor; ?>" data-notify="message">{2}</span>' +
		'<div class="progress" data-notify="progressbar">' +
			'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
		'</div>' +
		'<a href="{3}" target="{4}" data-notify="url"></a>' +
	'</div>' 
});
</script>

<?php
}
?>