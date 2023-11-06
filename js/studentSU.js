/*
	var firstNBtn = document.getElementById('FPSUDetail');
	var secondPBtn = document.getElementById('SPBtn');
	var secondNBtn = document.getElementById('SNBtn');
	var thirdPBtn = document.getElementById('TPBtn');
	var thirdSBtn = document.getElementById('TNBtn');
	var mobile = document.getElementById('NIMNo');


	//firstNBtn.addEventListener("click", function() {alert("hellow bitch")}, false);
	function filter() {
		if (!(/\d/.test())) {
			document.getElementById('NIMNo').value = "";
		} else {}
	}

*/
// next and previous bottons of the sign up pages

	function showNext1() {
		document.getElementById('FSSApp').style.display = "none";
		document.getElementById('SSUinput').style.display = "block";
	}
	function showPrevious1() {
		document.getElementById('FSSApp').style.display = "block";
		document.getElementById('SSUinput').style.display = "none";
	}
	function showNext2() {
		document.getElementById('SSUinput').style.display = "none";
		document.getElementById('LSUinput').style.display = "block";
	}
	function showPrevious2() {
		document.getElementById('SSUinput').style.display = "block";
		document.getElementById('LSUinput').style.display = "none";
	}



//adding new section of previous school
function addSchool() {
	var preSchool = document.getElementById('PSContainer');
	document.getElementById('NUASec').prepend(preSchool);
	//preSchool.append(preSchool);
}