// SmoothScroll
//==============================================//
$(document).ready(function() {
  $('a[href^="#"]').click(function () {
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? "html" : href);
    var position = target.offset().top;
    $("html, body").animate({ scrollTop: position }, 500, "swing");
    return false;
  });
});

// Common
//==============================================//
$(function () {
  $(".accordion_head.is-open").next('.accordion_body').slideDown();
  $(".accordion_head").click(function () {
    $(this).toggleClass("is-open");
    $(this).next('.accordion_body').slideToggle();
  });
});
$(function () {
  $('.tab_nav li').on('click', function () {
    var idx = $('.tab_nav li').index(this);
    $(this).addClass('is-active').siblings('li').removeClass('is-active');
    $('.tab_box').eq(idx).addClass('is-active').siblings('div').removeClass('is-active');
  });
});

// Code Copy
//==============================================//
$(function () {
  $('.copycode').click(function() {
    let copyText = $(this).val();
    navigator.clipboard.writeText(copyText).then(function() {
        alert("コード「" + copyText + "」がコピーされました");
    });
  });
});

// LP
//==============================================//
$(function () {
  $(".search_list br").remove();
  $(".table_btn p, .table_btn>br").remove();
  $(".flx label input").after('<span>');
});

$(function() {
  $(".search_list:first").addClass("is-show");
  $(".search_list:first").children('dd').show();
  $('.search_body input').change( function() {
    $(this).parents('.search_list').next('.search_list').addClass('is-show').children('dd').slideDown();
  });
});

$(function() {
  $('.tab_nav li').on('click', function() {
    var tabWrap = $(this).parents('.tab');
    var tabBtn = tabWrap.find(".tab_nav li");
    var tabImg = tabWrap.find('.tab_image-box');
    var tabContents = tabWrap.find('.tab_content');
    tabBtn.removeClass('is-active');
    $(this).addClass('is-active');
    var elmIndex = tabBtn.index(this);
    tabImg.removeClass('is-show');
    tabImg.eq(elmIndex).addClass('is-show');
    tabContents.removeClass('is-show');
    tabContents.eq(elmIndex).addClass('is-show');
  });
});

const itemHeights = [];
let returnHeight;

$(function(){
  const openH = $('.open').height();
  $(".review_list").each(function () {
    const thisHeight = $(this).height();
    itemHeights.push(thisHeight);
    $(this).css('height', '300px');
    returnHeight = $(this).height();
    if ($(this).hasClass("open")) {
      $(this).css('height', openH);
    }
  });
});
$(".morebtn").click(function () {
  if (!$(this).hasClass("is-show")) {
    const index = $(this).index(".morebtn");
    const addHeight = itemHeights[index];
    $(this)
      .addClass("is-show")
      .prev()
      .animate({ height: addHeight }, 300)
  } else {
    $(this)
      .removeClass("is-show")
      .prev()
      .animate({ height: returnHeight }, 300)
  }
});


const init = 5
const more = 5
$(".relate li:nth-child(n+" + (init+1) + ")").hide()

$(".relate").filter(function(){
  return $(this).find("li").length <= init
}).find(".relate-more").hide()    
$(".relate-more").on("click",function(){
  let this_list = $(this).closest(".relate")
  this_list.find("li:hidden").slice(0,more).slideToggle()

  if(this_list.find("li:hidden").length == 0){
    $(this).fadeOut()
  }
})
