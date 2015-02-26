function c_img(){
	var imgT = document.getElementById("img1");
	var selectV = document.getElementById("photo");
	imgT.src = "img/"+selectV.value+".gif";
}

/*登录模块*/
function login(){
	var user_email = $("#email").val(),
	    password = $("#pass").val(),
	    url = './login_b.php';

	$.ajax({
		url: url,
		type: "post",
		dataType: "json",
		data: {
			email: user_email,
			pass: password
		},
		success:function(data){
			console.log(data);
			console.log(decodeURI(data.msg));
			$("#login_info").text(decodeURI(data.msg));
		},
		error:function(data) {
			// body...
			console.log(data.msg);
		}
	})
	/*.done(function(data) {
		console.log("success");
		$("#login_info").text(data.msg);
	})
	.fail(function(data) {
		console.log("error");
		$("#login_info").text(data.msg);
	})*/
	return false;
}