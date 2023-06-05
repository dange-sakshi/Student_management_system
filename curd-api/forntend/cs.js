$(document).ready(function () {

$("#submit").click(function () {

var name = $("#name").val();
var rollNo = $("#rollNo").val();
var Class = $("#Class").val();
var hindi = $("#hindi").val();
var marathi = $("#marathi").val();
var math = $("#math").val();
var sci = $("#sci").val();
var history = $("#history").val();
var cs = $("#cs").val();

if (name == '' || rollNo == '' || Class == '' || hindi == '' || marathi == ''
|| math == '' || sci == '' || history == '' || cs == '') {
alert("Please fill all fields.");
return false;
}

$.ajax({
url: 'http://localhost:3000/curd-api/backend/insert.php',
type: "POST",
// dataType: 'json',
data: {
name: name,
rollNo: rollNo,
Class: Class,
hindi: hindi,
marathi: marathi,
math: math,
sci: sci,
histroy: history,
cs: cs,

},
cache: false,
success: function (data) {
console.log(data);
},
error: function (xhr, status, error) {
console.error(xhr);
}
});

});

});