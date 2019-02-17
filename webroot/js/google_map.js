window.onload = function() {
	var geocoder = new google.maps.Geocoder();// 緯度経度変換器。
	var address = document.getElementById('map').val();
	geocoder.geocode({
		'address' : address,
		'language' : 'ja'
	}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			var latlng = results[0].geometry.location;// 緯度と経度を取得
			var mapOpt = {
				center : latlng,// 取得した緯度経度を地図の真ん中に
				zoom : 17,//　拡大率
				mapTypeId : google.maps.MapTypeId.ROADMAP
			// 普通の道路マップ
			};
			var map = new google.maps.Map(document.getElementById('map'),mapOpt);

			var marker = new google.maps.Marker({// 住所のポイントにマーカーを立てる
				position : map.getCenter(),
				map : map
			});
		} else {
			alert("Geocode was not successful for the following reason: "
					+ status);
		}
	});
}