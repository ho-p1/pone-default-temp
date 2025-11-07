$(function() {

  //==============================================
  // SmoothScroll
  //==============================================
  $('a[href^="#"]').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr("href");
    const target = $(href === "#" || href === "" ? "html" : href);
    const position = target.offset()?.top || 0;
    $("html, body").animate({ scrollTop: position }, 500, "swing");
  });


  //==============================================
  // Accordion
  //==============================================
  $(".accordion_head.is-open").next('.accordion_body').show();
  $(".accordion_head").on("click", function() {
    $(this).toggleClass("is-open").next('.accordion_body').slideToggle();
  });


  //==============================================
  // Tabs
  //==============================================
  $(".tab_nav li").on("click", function() {
    const $tab = $(this).closest('.tab');
    const index = $(this).index();

    // タブボタン
    $tab.find('.tab_nav li')
      .removeClass('is-active')
      .eq(index).addClass('is-active');

    // 画像ボックス
    $tab.find('.tab_image-box')
      .removeClass('is-show')
      .eq(index).addClass('is-show');

    // コンテンツ
    $tab.find('.tab_content')
      .removeClass('is-show')
      .eq(index).addClass('is-show');
  });


  //==============================================
  // Code Copy
  //==============================================
  $(".copycode").on("click", function() {
    const copyText = $(this).val();
    navigator.clipboard.writeText(copyText).then(() => {
      alert(`コード「${copyText}」がコピーされました`);
    });
  });


  //==============================================
  // LP DOM 調整
  //==============================================
  $(".search_list br, .table_btn p, .table_btn>br").remove();
  $(".flx label input").after('<span>');

  $(".search_list:first")
    .addClass("is-show")
    .children('dd').show();

  $('.search_body input').on('change', function() {
    $(this).closest('.search_list')
      .next('.search_list')
      .addClass('is-show')
      .children('dd').slideDown();
  });


  //==============================================
  // Review More Toggle
  //==============================================
  const itemHeights = [];
  const openH = $('.open').height();
  let returnHeight;

  $(".review_list").each(function() {
    const thisHeight = $(this).height();
    itemHeights.push(thisHeight);
    $(this).css('height', '300px');
    returnHeight = $(this).height();
    if ($(this).hasClass("open")) {
      $(this).css('height', openH);
    }
  });

  $(".morebtn").on("click", function() {
    const index = $(this).index(".morebtn");
    const target = $(this).prev();

    if (!$(this).hasClass("is-show")) {
      $(this).addClass("is-show");
      target.animate({ height: itemHeights[index] }, 300);
    } else {
      $(this).removeClass("is-show");
      target.animate({ height: returnHeight }, 300);
    }
  });


  //==============================================
  // Relate List - 「もっと見る」
  //==============================================
  const init = 5;
  const more = 5;

  $(".relate li:nth-child(n+" + (init + 1) + ")").hide();

  $(".relate").each(function() {
    const $this = $(this);
    if ($this.find("li").length <= init) {
      $this.find(".relate-more").hide();
    }
  });

  $(".relate-more").on("click", function() {
    const $list = $(this).closest(".relate");
    $list.find("li:hidden").slice(0, more).slideToggle();

    if ($list.find("li:hidden").length === 0) {
      $(this).fadeOut();
    }
  });

});
