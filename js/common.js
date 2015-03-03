$(function(){
	/*初始化富文本编辑器*/
	var editor = KindEditor.create('#p_content', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
				});

	$("#sidebar").on("click","a",function(){
		// $(this).siblings().removeClass('active');
		// $(this).addClass('active');
		// var tid = $(this).attr("id");
	});

	/*管理员删除帖子的请求*/
	$(".container").on("click",".del",function(e){
		e.stopPropagation();
		var self = $(this);
		var del_id = self.attr("id").slice(3);
		console.log(del_id);
		if (confirm("删除帖子时同时会删除评论，是否确定要执行删除操作？")) {
			$.ajax({
				url: 'delete.php',
				type: 'POST',
				dataType: 'JSON',
				data: {del: del_id},
			})
			.done(function(data) {
				if(data.msg === "success"){
				//不能以.row,负责单条帖子删除的时候，整个页面中的帖子都会消失，可能是因为bt的原因。重新设置一个class，可解决该问题
					self.parents(".section-post-wraper").animate({"height": 0,"opacity": 0},500, function() {
						//由于后台在生成"(最新)"文案的时候php代码是折行的，所以会产生空格，在获取small标签的时候
						//一定要注意去掉空格，否则包含空格也视为有值。
						if ($(this).find("small").text().trim()) {
							$(this).next(".section-post-wraper").find("small").text("(最新)");
						};
						$(this).remove();
					});;
				}
			})
			.fail(function(data) {
				console.log("error");
				console.log(data);
			})
			.always(function() {
				console.log("complete");
			});
			
			return true;
		}else{
			return false;
		}
	});
});

/*发帖操作*/
$("#p_form").submit(function(event) {
	$.ajax({
		url: 'post.php',
		type: 'POST',
		data: $("#p_form").serialize(),
	})
	.done(function(data) {
		if (confirm(data)) {
			window.location.href = "index.php";
		};
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	return false;
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
	});
	return false;
}