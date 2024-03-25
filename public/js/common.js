// フッター：コピーライトの年号
const displayCurrentYear = () => {
    const now = new Date();
    const year = now.getFullYear();
    document.getElementById('currentYear').textContent = year;
};
displayCurrentYear();

// トップへ戻る
function PageTopAnime() {
    var scroll = $(window).scrollTop();
    if (scroll >= 200) { // 上から200pxスクロールしたら
        $('#page-top').removeClass('DownMove'); // #page-topについているDownMoveというクラス名を除く
        $('#page-top').addClass('UpMove'); // #page-topについているUpMoveというクラス名を付与
        $('#page-top').css('display', 'block'); // #page-topを表示する（念のため）
    } else {
        if ($('#page-top').hasClass('UpMove')) { // すでに#page-topにUpMoveというクラス名がついていたら
            $('#page-top').removeClass('UpMove'); // UpMoveというクラス名を除き
            $('#page-top').addClass('DownMove'); // DownMoveというクラス名を#page-topに付与
        }
        if (scroll <= 0) { // スクロール位置が0のとき、つまり一番上にいるとき
            $('#page-top').css('display', 'none'); // #page-topを非表示にする
        }
    }
}
$(window).scroll(function () {
    PageTopAnime(); // スクロールした際の動きの関数を呼ぶ
});
$(window).on('load', function () {
    PageTopAnime(); // スクロールした際の動きの関数を呼ぶ
});
$('#page-top a').click(function () {
    $('body,html').animate({
        scrollTop: 0 // ページトップまでスクロール
    }, 500); // ページトップスクロールの速さ。数字が大きいほど遅くなる
    return false; // リンク自体の無効化
});

// ヘッダートグル Vanilla JS
const spMenuBtn2 = document.getElementById("spMenuBtn2");
const headerNavBtn = document.getElementsByClassName("headerNavBtn")[0];
const navUl = document.querySelector(".nav-ul");
spMenuBtn2.addEventListener("click", () => {
    headerNavBtn.classList.toggle("active");
    navUl.classList.toggle("active");
});

// ソート機能
function sortShops() {
    var selectElement = document.getElementById("sort-select");
    var selectedValue = selectElement.options[selectElement.selectedIndex].value;
    var currentUrl = window.location.pathname + window.location.search;
    var newUrl;
    if (currentUrl.includes("?")) {
        newUrl = currentUrl + "&" + selectedValue;
    } else {
        newUrl = currentUrl + "?" + selectedValue;
    }
    window.location.href = newUrl;
}
