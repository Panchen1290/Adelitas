<script type="text/javascript">

$('#').click(function() {
	data=$('#').serialize();
	$.ajax({
		type:"POST",
		data:data, 
		url:"../processes/",
		success:function(r) {

		}
	});
});

function validateFormEmpty(form) {
	data=$('#' + form).serialize();
	d=data.split('&');
	empty=0;
	for (i = 0; i < d.length; i++) {
		controls = d[i].split("=");
		if (controls[1]=="A" || controls[1]=="") {
			empty++;
		}
	}
	return empty;
} 


</script>