window.onload = function(){
	var target = document.getElementById("target");
	var btn1 = document.getElementById("btn1");
	var btn2 = document.getElementById("btn2");
	var stations = document.getElementById("stations");
	
	btn.onclick = function() {
		if(target.style.display == "block"){
		    target.style.display = "none";
		    btn1.style.display = "block";
		    btn2.style.display = "none";
		}else{ 
			target.style.display = "block";
			btn1.style.display = "none";
			btn2.style.display = "block";
			//stations.children.style.display = "block";
		}
	};
};