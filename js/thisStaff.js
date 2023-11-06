//to calculate student input result my lecture at post result
function runResult() {
	var i = 0;
	var kay = document.getElementById("lastSn").innerHTML;
	var studentLength = kay - 1;
	while(i < studentLength) {
		var caId = "stu"+i;
		var examId = "stu"+i+""+i;
		var totalId = "stu"+i+""+i+""+i;
		var gradeId = "stu"+i+""+i+""+i+""+i;
		var caValue = document.getElementById(caId).value;
		var examValue = document.getElementById(examId).value;
		var total = parseInt(caValue) + parseInt(examValue);
		document.getElementById(totalId).value = total;
		if (total > 69 && total < 101) {
			document.getElementById(gradeId).value = "A";
		} else if (total > 59 && total < 70) {
			document.getElementById(gradeId).value = "B";
		} else if (total > 49 && total < 60) {
			document.getElementById(gradeId).value = "C";
		} else if (total > 44 && total < 50) {
			document.getElementById(gradeId).value = "D";
		} else if (total > 39 && total < 45) {
			document.getElementById(gradeId).value = "E";
		} else if (total >= 0 && total < 40) {
			document.getElementById(gradeId).value = "F";
		} else {
			document.getElementById(gradeId).value = "--";
		}
		++i;
	}	
}
//to calculate gpa of student at student result
function runPoint() {
	var i = 0;
	var lengthKay = document.getElementById('hiddenVal').innerHTML;
	var totalGradePoint = 0;
	var totalUnit = 0;
	while (i < lengthKay) {
		var gradeId = "result"+i;
		var unitId = "result"+i+""+i;
		var point = 0;
		var eachUnit = document.getElementById(unitId).value;
		totalUnit += parseInt(eachUnit);
		var grade = document.getElementById(gradeId).value;
		if (grade == "A") {
			point = parseInt(5 * eachUnit);
			totalGradePoint += parseInt(point);
		} else if (grade == "B") {
			point = parseInt(4 * eachUnit);
			totalGradePoint += parseInt(point);
		} else if (grade == "C") {
			point = parseInt(3 * eachUnit);
			totalGradePoint += parseInt(point);
		} else if (grade == "D") {
			point = parseInt(2 * eachUnit);
			totalGradePoint += parseInt(point);
		} else if (grade == "E") {
			point = parseInt(1 * eachUnit);
			totalGradePoint += parseInt(point);
		} else if (grade == "F") {
			point = parseInt(0 * eachUnit);
			totalGradePoint += parseInt(point);
		} else {
			point = 0;
			totalGradePoint += parseInt(point);
		}
		++i;
	}
	var gpa = totalGradePoint / totalUnit;
	document.getElementById('gpa').value = gpa;
}
