

$(function () {
	/* 高级选项中的展开 */
	$(".open").click(function () {
		$(".open .moretext").text($(".lineshidden").is(":hidden") ? "收起" : "展开");
		$(".open .fa-sort-down").toggleClass("fa-sort-up");
		$(".lineshidden").slideToggle();

	});
	/* 点击返回所选元素 */
	$(".lines li a").click(function () {
		var tag = $(this).html();
		var title = $(this).parent().parent().parent().parent().children(0).html();

		$(".selected").show();
		$(".choosed").show();
		$(".selected").append("<div class='selected-item'><span class='choosetitle'>" + title + "</span><span  class='choosedetail'>" + tag + "</span><span class='glyphicon glyphicon-remove'></span></div>");
		// $(this).parent().parent().parent().parent().remove();

		$(".glyphicon-remove").click(function () {
			$(this).parent().remove();
			var length = $(".selected").children(".selected-item").length;
			if (length < 1) {
				$(".selected").hide();
			}
		})
	});

	/* 清空全部 */
	$(".clearchoose").click(function () {
		$(".selected").hide();
	});
})

/* 第一个选项中的展开 */
$(function () {
	// 多选
	$(".btn-more").click(function () {
		$(".check").slideToggle(); //复选框
		$(".none").slideToggle();
		$(this).hide();
		$(".tool").show();

	});
	// 展开
	$(".cmore").click(function () {
		$(".cmore .moretext").text($(".none").is(":hidden") ? "收起" : "展开");
		$(".cmore .fa-sort-down").toggleClass("fa-sort-up");
		$(".none").slideToggle();
	})
	// 确定
	$(".sure").click(function () {
		$(this).hide();
		$(".none").hide();
		$(".check").hide();
	})
})