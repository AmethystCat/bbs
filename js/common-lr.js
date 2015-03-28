/*工具封装*/
(function(w){
	var U = {
		goIndex : function(){
			window.location.href = "index.php";
		},
		c_img : function(){
			var imgT = document.getElementById("img1");
			var selectV = document.getElementById("photo");
			imgT.src = "img/"+selectV.value+".jpg";
		},
		pop : function(msg,bool){
			$(".modal-title").html(msg);
			$("#popBox").modal("show");
			setTimeout(function() {
				//this -> window
				// console.dir(this);
				if (bool) {
					U.goIndex();
				}
				$("#popBox").modal("hide");
			},2000)
		}
	};
	return w.Util = U;
})(window)

$(function(){
	/*登录操作*/
	$("#login_form").submit(function() {
		/* Act on the event */
		$.ajax({
			url: 'login_or_regist.php?action=login',
			type: 'POST',
			dataType:'JSON',
			data: $("#login_form").serialize()
		})
		.done(function(data) {
			console.log("success");
			console.log(data.msg);
			Util.pop(data.msg,true);
		})
		.fail(function(data) {
			console.log("error");
			console.log(data.responseText);
			Util.pop(data.responseText,false);
		});
		return false;
	});
	/*注册操作*/
	$("#regist_form").submit(function(){
		$.ajax({
			url: 'login_or_regist.php?action=regist',
			type: 'POST',
			dataType: 'JSON',
			data: $("#regist_form").serialize(),
		})
		.done(function(data) {
			console.log("success");
			Util.pop(data.msg,true);
		})
		.fail(function(data) {
			Util.pop(data.responseText,false);
		});
		return false;
	});
});