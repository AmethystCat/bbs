$(function(){
	var editor = KindEditor.create('#p_content', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
				});
	editor.sync();
	console.log($('#p_content').html());

	$("#sidebar").on("click","a",function(){
		// $(this).siblings().removeClass('active');
		// $(this).addClass('active');
		// var tid = $(this).attr("id");
	// 	//ajax选择查看对应类别的内容
	// 	$.ajax({
	// 		url: '/index.php',
	// 		type: 'GET',
	// 		dataType: 'json',
	// 		data: {tid: tid},
	// 	})
	// 	.done(function(data) {
	// 		console.log(data);
	// 	})
	// 	.fail(function() {
	// 		console.log("error");
	// 	})
	// 	.always(function() {
	// 		console.log("complete");
	// 	});
		
		
	});

	$(".del").click(function(){
		if (confirm("删除帖子时同时会删除评论，是否确定要执行删除操作？")) {
			return true;
		}else{
			return false;
		}
	});

});

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