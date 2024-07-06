$(function () {
  // 矢印をクリックすると
  $(".js-accordion-title").on("click", function () {
    // コンテンツを開閉
    $(this).next().slideToggle(0);
    // 矢印にopenクラスをつけ外し
    $(this).toggleClass("open", 0);
  });
});
