$(document).ready(function(){
	var store_id = $('#store_id').val();

	if(store_id !== undefined){
		$('#switch').show();
	}

	$('#switch').on('click',function(){
		window.location.href = "/cake3lunch/comments/add/"+store_id;
	});
});