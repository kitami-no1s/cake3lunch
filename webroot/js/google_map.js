window.onload = function() {
	var geocoder = new google.maps.Geocoder();// 緯度経度変換器。
	var cnt = document.getElementByName('cnt').value;
alert(cnt);
	for(var i=0;i<cnt;i++){
		var id = 'address'+i;
		var address = document.getElementById(id).innerHTML;
		alert(address);
		geocoder.geocode({
			'address' : address,
			'language' : 'ja'
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var latlng = results[0].geometry.location;// 緯度と経度を取得
				var mapOpt = {
						center : latlng,// 取得した緯度経度を地図の真ん中に
						zoom : 17,// 拡大率
						mapTypeId : google.maps.MapTypeId.ROADMAP
						// 普通の道路マップ
				};
				var eval("var map" + i) = new google.maps.Map(document.getElementById(eval('map'+i)),mapOpt);

				var marker = new google.maps.Marker({// 住所のポイントにマーカーを立てる
					position : map.getCenter(),
					map : eval(map + i)
				});
			} else {
				alert("Geocode was not successful for the following reason: "
					+ status);
		}
	}
	});
}