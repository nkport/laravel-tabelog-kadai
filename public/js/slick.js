// トップページ：新着の予約店舗
$('.new-reservation').slick({
	arrows: false,//左右の矢印はなし
	autoplay: true,//自動的に動き出すか。初期値はfalse。
	autoplaySpeed: 0,//自動的に動き出す待ち時間。初期値は3000ですが今回の見せ方では0
	speed: 6900,//スライドのスピード。初期値は300。
	infinite: true,//スライドをループさせるかどうか。初期値はtrue。
	pauseOnHover: false,//オンマウスでスライドを一時停止させるかどうか。初期値はtrue。
	pauseOnFocus: false,//フォーカスした際にスライドを一時停止させるかどうか。初期値はtrue。
	cssEase: 'linear',//動き方。初期値はeaseですが、スムースな動きで見せたいのでlinear
	slidesToShow: 4,//スライドを画面に4枚見せる
	slidesToScroll: 1,//1回のスライドで動かす要素数
	responsive: [
		{
			breakpoint: 769,//モニターの横幅が769px以下の見せ方
			settings: {
				slidesToShow: 3,//スライドを画面に2枚見せる
			}
		},
		{
			breakpoint: 426,//モニターの横幅が426px以下の見せ方
			settings: {
				slidesToShow: 1.5,//スライドを画面に1.5枚見せる
			}
		}
	]
});

// トップページ：フッター直前の画像ギャラリー
$('.shops-feature').slick({
	arrows: false,
	autoplay: true,
	autoplaySpeed: 0,
	speed: 6900,
	infinite: true,
	draggable: false,
	pauseOnHover: false,
	pauseOnFocus: false,
	cssEase: 'linear',
	slidesToShow: 4,
	slidesToScroll: 1,
	responsive: [
		{
			breakpoint: 769,//モニターの横幅が769px以下の見せ方
			settings: {
				slidesToShow: 2,//スライドを画面に2枚見せる
			}
		},
		{
			breakpoint: 426,//モニターの横幅が426px以下の見せ方
			settings: {
				slidesToShow: 1.5,//スライドを画面に1.5枚見せる
			}
		}
	]
});

// 店舗詳細ページ：show
$('.shops-image').slick({
	autoplay: true,//自動的に動き出すか。初期値はfalse。
	infinite: true,//スライドをループさせるかどうか。初期値はtrue。
	slidesToShow: 1,//スライドを画面に3枚見せる
	slidesToScroll: 1,//1回のスクロールで3枚の写真を移動して見せる
	prevArrow: '<div class="slick-prev"></div>',//矢印部分PreviewのHTMLを変更
	nextArrow: '<div class="slick-next"></div>',//矢印部分NextのHTMLを変更
	dots: false,//下部ドットナビゲーションの表示
	speed: 500,
	responsive: [
		{
			breakpoint: 769,//モニターの横幅が769px以下の見せ方
			settings: {
				slidesToShow: 1,//スライドを画面に2枚見せる
				slidesToScroll: 1,//1回のスクロールで2枚の写真を移動して見せる
			}
		},
		{
			breakpoint: 426,//モニターの横幅が426px以下の見せ方
			settings: {
				slidesToShow: 1,//スライドを画面に1枚見せる
				slidesToScroll: 1,//1回のスクロールで1枚の写真を移動して見せる
			}
		}
	]
});