$(function(){
	$('#akasa span').on('click',function(){	
		event.stopPropagation();
		var word = $(this).text();
		$.ajax({
			url: "/cake3lunch/stores/gojyuon",
		    type: "POST",
		    data: {'word':word},
		    dataType: "json",
		    success : function(responce){
		    	console.log(responce);
		    	//通信が成功した場合
		    	if(responce != false){
		    		$('#akasa span').hide();
		    		//$('#stations').children().remove();
		    		$("#stations").append(responce);
		    		return;
		    	}
		    	return;
		    },
		    error: function(response){
		    	alert('検索結果エラー');
		    }
		});
	});
	
	$('#target div').on('click',function(){
		var span = $(this).children("span");
		if(span.css('display') == 'none'){
			$('#akasa span').hide();
			span.show();
		}else{
			$('#akasa span').hide();
		}
	});
	
	$(document).on("click","#stations div",function(){
		$("#station").val($(this).text());
	});
	
	$('#btn').on('click',function(){
		if($('#target').css('display') == 'block'){
			$("#stations div").hide();
		}else{
			$("#stations div").show();
		}
	});
	/*
	$('#search').on('click',function(){
		var word = $('#station').val();
		
		$.ajax({
			url: "/cake3lunch/stores/search",
		    type: "POST",
		    data: {'word':word},
		    dataType: "json",
		    success : function(responce){
		    	console.log(responce);
		    	//通信が成功した場合
		    	if(responce != false){
		    		$('#akasa span').hide();
		    		$('#stations').children().remove();
		    		$("#stations").append(responce);
		    		return;
		    	}
		    	return;
		    },
		    error: function(response){
		    	alert('検索結果エラー');
		    }
		});
	});*/
});