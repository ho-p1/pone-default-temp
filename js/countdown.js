function clock() {
	today = new Date;
	var t = today.getHours(),
		s = ("0" + today.getMinutes()).slice(-2),
		e = ("0" + today.getSeconds()).slice(-2);
	$(".clock").length > 0 && ($(".clock .h").text(t), $(".clock .min").text(s), $(
		".clock .sec").text(e)), $(".timerBox").each(function() {
		var s = new Date,
			e = $(this).attr("data-timer");
		s.setHours(e, 0, 0), t >= e && s.setDate(s.getDate() + 1);
		var n = "0" + Math.floor((s - today) % 864e5 / 36e5),
			i = "0" + Math.floor((s - today) % 864e5 / 6e4) % 60,
			a = "0" + Math.floor((s - today) % 864e5 / 1e3) % 60 % 60;
		if ($(this).find(".h span").length > 0) {
			var c = n.substring(n.length - 2, n.length - 1);
			$(this).find(".h span:first-child").text(c).attr("class", "n" + c), n = n.slice(-
				1), $(this).find(".h span:nth-child(2)").text(n).attr("class", "n" + n)
		} else n = n.slice(-2), hClass = n.slice(-1), $(this).find(".h").text(n).attr(
			"class", "h n" + hClass);
		$(this).find(".h span:nth-child(2)").text(n).attr("class", "n" + n);
		var l = i.substring(i.length - 2, i.length - 1);
		$(this).find(".min span:first-child").text(l).attr("class", "n" + l), i = i
			.slice(-1), $(this).find(".min span:nth-child(2)").text(i).attr("class",
				"n" + i);
		var h = a.substring(a.length - 2, a.length - 1);
		$(this).find(".sec span:first-child").text(h).attr("class", "n" + h), a = a
			.slice(-1), $(this).find(".sec span:nth-child(2)").text(a).attr("class",
				"n" + a)
	}), setTimeout("clock()", 100)
}
$(document).ready(function() {
	$(".timerBox, .clock").length > 0 && clock()
}), $(function() {
	var t = (new Date).getHours();
	t >= 8 && 14 > t ? $(".time1").css("display", "block") : (t >= 14 || 8 > t) &&
		$(".time1").css("display", "none")
}), $(function() {
	var t = (new Date).getHours();
	t >= 14 && 22 > t ? $(".time2").css("display", "block") : (t >= 22 || 14 > t) &&
		$(".time2").css("display", "none")
}), $(function() {
	var t = (new Date).getHours();
	t >= 8 && 22 > t ? $(".time3").css("display", "none") : (t >= 22 || 8 > t) &&
		$(".time3").css("display", "block")
});
