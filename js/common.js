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

/*发帖操作*/
$("#p_form").submit(function(event) {
	//[2015-3-5]在序列化表单数据的时候要先将富文本编辑器中的内容与textarea同步，否则
	//正确取得用户输入的值
	// Util.editorSync(editor);
	editor.sync();
	console.log("aa");
	$.ajax({
		url: 'post.php',
		type: 'POST',
		data: $("#p_form").serialize()
	})
	.done(function(data) {
		//data:发布成功啦，亲
		Util.pop(data,true);
	})
	.fail(function() {
		Util.pop(data.responseText);
	})
	
	return false;
});

/*发帖回复*/
	$("#response_form").submit(function(event) {
		editor.sync();
		$.ajax({
			url: 'posts_response.php',
			type: 'POST',
			dataType: 'JSON',
			data: $("#response_form").serialize()
		})
		.done(function(data) {
			console.log("success");
			Util.pop(data.msg,true,"refresh");
		})
		.fail(function() {
			console.log("error");
			Util.pop(data.responseText,false)
		})
		.always(function() {
			console.log("complete");
		});
		return false;
	});

});

/*工具封装*/
(function(w){
	var U = {
		editorSync : function(et){
			et.sync();
		},
		goIndex : function(page){
			(page === "refresh") ? window.location.reload() : window.location.href = page || "index.php";
		},
		pop : function(msg,bool,page){
			$(".modal-title").html(msg);
			$("#popBox").modal("show");
			setTimeout(function() {
				//this -> window
				// console.dir(this);
				if (bool) {
					U.goIndex(page);
				}
				$("#popBox").modal("hide");
			},2000)
		}
	};
	return w.Util = U;
})(window)