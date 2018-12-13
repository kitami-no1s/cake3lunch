$(function(){
	$('#search').on('click',function(){
		//　検索ボタンをクリックしたときあいまい検索
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
		    		$("#stations").html(responce);
		    		return;
		    	}
		    	return;
		    },
		    error: function(response){
		    	alert('検索結果エラー');
		    }
		});
	});
	
	$('#akasa span').on('click',function(){
		//　五十音検索
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
		    		$("#stations").html(responce);
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
			$('#target').hide();
			$('#btn1').show();
			$('#btn2').hide();
			$("#stations div").hide();
		}else{
			$('#target').show();
			$('#btn1').hide();
			$('#btn2').show();
			$("#stations div").show();
		}
	});
});