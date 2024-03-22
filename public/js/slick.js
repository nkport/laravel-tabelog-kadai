// mv：画像の設定
var windowwidth = window.innerWidth || document.documentElement.clientWidth || 0;
if (windowwidth > 768) {
	var responsiveImage = [//PC用の画像
		{ src: "{{ asset('img/img_01.jpg') }}" },
		{ src: "{{ asset('img/img_02.jpg') }}" },
		{ src: "{{ asset('img/img_03.jpg') }}" },
		{ src: "{{ asset('img/img_04.jpg') }}" },
		{ src: "{{ asset('img/img_05.jpg') }}" }
	];
} else {
	var responsiveImage = [//タブレットサイズ（768px）以下用の画像
		{ src: "{{ asset('img/img_01.jpg') }}" },
		{ src: "{{ asset('img/img_02.jpg') }}" },
		{ src: "{{ asset('img/img_03.jpg') }}" },
		{ src: "{{ asset('img/img_04.jpg') }}" },
		{ src: "{{ asset('img/img_05.jpg') }}" }
	];
}

//Vegas全体の設定
$('#slider').vegas({
	overlay: true,//画像の上に網線やドットのオーバーレイパターン画像を指定。
	transition: 'fade2',//切り替わりのアニメーション。http://vegas.jaysalvat.com/documentation/transitions/参照。fade、fade2、slideLeft、slideLeft2、slideRight、slideRight2、slideUp、slideUp2、slideDown、slideDown2、zoomIn、zoomIn2、zoomOut、zoomOut2、swirlLeft、swirlLeft2、swirlRight、swirlRight2、burnburn2、blurblur2、flash、flash2が設定可能。
	transitionDuration: 2000,//切り替わりのアニメーション時間をミリ秒単位で設定
	delay: 5000,//スライド間の遅延をミリ秒単位で。
	animationDuration: 20000,//スライドアニメーション時間をミリ秒単位で設定
	animation: 'random',//スライドアニメーションの種類。http://vegas.jaysalvat.com/documentation/transitions/参照。kenburns、kenburnsUp、kenburnsDown、kenburnsRight、kenburnsLeft、kenburnsUpLeft、kenburnsUpRight、kenburnsDownLeft、kenburnsDownRight、randomが設定可能。
	slides: responsiveImage,//画像設定を読む
	timer: false,// プログレスバーを非表示したい場合はこのコメントアウトを外してください
});

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