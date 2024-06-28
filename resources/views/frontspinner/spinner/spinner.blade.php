<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/asset-spinner/china/js/style-small.css" />
    <link rel="stylesheet" href="/asset-spinner/china/js/loader.css" />
    <link rel="stylesheet"href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    </link>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/asset-spinner/js/phaser.js"></script>
</head>

<main class="loaderpage">
    <div class="dank-ass-loader">
        <div class="row">
            <div class="arrow up outer outer-18"></div>
            <div class="arrow down outer outer-17"></div>
            <div class="arrow up outer outer-16"></div>
            <div class="arrow down outer outer-15"></div>
            <div class="arrow up outer outer-14"></div>
        </div>
        <div class="row">
            <div class="arrow up outer outer-1"></div>
            <div class="arrow down outer outer-2"></div>
            <div class="arrow up inner inner-6"></div>
            <div class="arrow down inner inner-5"></div>
            <div class="arrow up inner inner-4"></div>
            <div class="arrow down outer outer-13"></div>
            <div class="arrow up outer outer-12"></div>
        </div>
        <div class="row">
            <div class="arrow down outer outer-3"></div>
            <div class="arrow up outer outer-4"></div>
            <div class="arrow down inner inner-1"></div>
            <div class="arrow up inner inner-2"></div>
            <div class="arrow down inner inner-3"></div>
            <div class="arrow up outer outer-11"></div>
            <div class="arrow down outer outer-10"></div>
        </div>
        <div class="row">
            <div class="arrow down outer outer-5"></div>
            <div class="arrow up outer outer-6"></div>
            <div class="arrow down outer outer-7"></div>
            <div class="arrow up outer outer-8"></div>
            <div class="arrow down outer outer-9"></div>
        </div>
    </div>
</main>

<script>
    var loader = document.querySelector(".loaderpage");
    document.onreadystatechange = function() {
        if (document.readyState === "complete") {
            setTimeout(function() {
                loader.style.display = "none";
            }, 3000);

            const canvas = document.querySelector("body");
            canvas.style.display = "flex";

            canvas.addEventListener("dblclick", function(event) {
                event.preventDefault();
            });
        }
    };
</script>

<body style="display:none;">
</body>

</html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spinner | L21</title>
</head>
<style>
    .boddyy {
        background-image: url(asset-spinner/china/png/BGSPIN.jpg);
        background-size: cover;
        background-position: top;
    }

    @media screen and (max-width: 768px) {
        .bgapinyala {
            width: 410px;
            top: 0px;
        }

        .textreddgame .animtextgiff {
            width: 550px;
        }

        .insertcoin .balance {
            top: 145px;
        }

        .insertcoin {
            width: 400px;
        }

        .animzonk {
            width: 400px;
        }

        .listtextpart1 h1 {
            font-size: 11px;
        }

        .textpart2 {
            width: 405px;
            padding: 5px;
        }

        .textgr1 p,
        .textgr3 p {
            font-size: 7px;
            line-height: 11px;
        }

        .textgr3 .groupl21,
        .textgr1 .groupl21 {
            font-size: 7px;
        }

        .textgr1 .imglic img {
            width: 85%;
        }

        .textgr3 .imglic .textjk {
            width: 30px;
        }

        .textgr3 .imglic .textjl {
            width: 70px;
        }

        .textgr1 .textlice {
            gap: 5px;
        }

        .textgr3 .textlice {
            gap: 5px;
        }

        .notifhadiah {
            width: 430px;
        }

        .horn1 {
            left: 75px;
        }

        .horn2 {
            left: 75px;
        }

        .horn3 {
            right: 70px;
        }

        .horn4 {
            right: 70px;
        }

        .svvg5 {
            bottom: 45px;
        }

        .svvg5 .sypkiri {
            left: 60px;
        }

        .svvg5 .sypkanan {
            right: 65px;
        }

        .svvg8 {
            bottom: -115px;
        }

        .jackpottext {
            bottom: 67px;
            font-size: 35px;
        }

        .buttonnotif {
            width: 95%;
            gap: 20px;
        }

        .buttonnotif .canv {
            font-size: 15px;
            padding: 15px;
        }

        .buttonnotif a {
            width: 40%;
        }

        .textss1 .reddtxt1 {
            top: -6px;
        }

        .buttonnotif .canv.buttred {
            border: 1px solid #22ff5045;
        }

        .buttonnotif .canv.buttyell {
            border: 1px solid #ffdb9959;
        }

        .svvg6 {
            top: -9px;
        }

        .svvg6 .bnt2 {
            top: -20px;
        }

        .svvg6 .bnt1 {
            width: 15%;
        }

        .sypkiri .sypkr2 {
            bottom: -65px;
        }

        .sypkiri .sypkr1 {
            bottom: -90px;
        }

        .sypkanan .sypkn2 {
            bottom: -65px;
        }

        .sypkanan .sypkn1 {
            bottom: -90px;
        }
    }

    @media screen and (max-width: 389px) {
        .apikanan {
            position: relative;
            right: -8px;
        }

        .apikiri {
            left: -13px;
        }

        .insertcoin {
            width: 350px;
        }

        .animzonk {
            width: 350px;
        }

        .svvg8 {
            bottom: -105px;
        }

        .jackpottext {
            bottom: 57px;
            font-size: 27px;
            left: -12px;
        }

        .svvg8 {
            left: 18px;
        }

        .testsvg img {
            width: 95%;
        }

        .horn1 {
            left: 77px;
        }

        .horn2 {
            left: 77px;
        }

        .textreddgame {
            padding: 0 0 5px 0;
        }

        .textpart2 {
            width: 370px;
        }

        .textpart2 {
            grid-template-columns: 12fr 1fr 12fr;
        }

        .textgr1 p,
        .textgr3 p {
            font-size: 6px;
        }

        .textgr3 .imglic .textjk {
            width: 25px;
        }

        .textgr3 .imglic .textjl {
            width: 60px;
        }

        .buttonnotif .canv {
            font-size: 13px;
        }

        .svvg5 {
            width: 95%;
        }

        .textgr1 .imglic {
            bottom: 5px;
        }

        .textgr3 .imglic {
            bottom: 5px;
        }
    }
</style>

<body class="boddyy">
    <div class="body2">
        <div class="bgapinyala">
            <div class="listapinyala">
                <img class="apikiri" src="/asset-spinner/china/png/api-l21.gif" alt="">
                <img class="apikanan" src="/asset-spinner/china/png/api-l21.gif" alt="">
            </div>
        </div>
        <div class="notifhadiah" style="display:none">
            <div class="testsvg">
                <div class="elementsvg">
                    <img class="svvg1" src="/asset-spinner/china/png/img/BASE-01.svg" alt="" />
                    <img class="svvg4" src="/asset-spinner/china/png/img/PIALA-01.svg" alt="" />
                    <div class="svvg2">
                        <img class="horn1" src="/asset-spinner/china/png/img/TEROMPETKIRI2-01.svg" alt="" />
                        <img class="horn2" src="/asset-spinner/china/png/img/TEROMPETKIRI2-01.svg" alt="" />
                        <img class="horn3" src="/asset-spinner/china/png/img/TEROMPETKIRI2-01.svg" alt="" />
                        <img class="horn4" src="/asset-spinner/china/png/img/TEROMPETKIRI2-01.svg" alt="" />
                    </div>
                    <div class="svvg5">
                        <div class="sypkiri">
                            <img class="sypkr1" src="/asset-spinner/china/png/img/SAYAPKIRI1-01.svg" alt="" />
                            <img class="sypkr2" src="/asset-spinner/china/png/img/SAYAPKIRI1-01.svg" alt="" />
                            <img class="sypkr3" src="/asset-spinner/china/png/img/SAYAPKIRI1-01.svg" alt="" />
                        </div>
                        <div class="sypkanan">
                            <img class="sypkn1" src="/asset-spinner/china/png/img/SAYAPKANAN1-01.svg" alt="" />
                            <img class="sypkn2" src="/asset-spinner/china/png/img/SAYAPKANAN1-01.svg" alt="" />
                            <img class="sypkn3" src="/asset-spinner/china/png/img/SAYAPKANAN1-01.svg" alt="" />
                        </div>
                    </div>
                    <div class="svvg6">
                        <img class="bnt1" src="/asset-spinner/china/png/img/BINTANGBSR-01.svg" alt="" />
                        <img class="bnt2" src="/asset-spinner/china/png/img/BINTANGKCL-01.svg" alt="" />
                    </div>
                </div>
                <div class="svvg7">
                    <div class="textss1">
                        <img class="reddtxt1" src="/asset-spinner/china/png/img/selamat-01.svg" alt="" />
                        <img class="reddtxt2" src="/asset-spinner/china/png/img/andamenang-01.svg" alt="" />
                    </div>
                    <div class="reddtxt3">
                        <img class="textss2" src="/asset-spinner/china/png/img/JACKPOT-01-01.svg" alt="" />
                    </div>
                </div>
                <div class="svvg8">
                    <img class="textss2" src="/asset-spinner/china/png/img/PITABAWAH-01.svg" alt="" />
                    <span class="jackpottext" data-value=""></span>
                </div>
            </div>
            <div class="buttonnotif">
                <a id="loginLink" href="#"><button class="canv buttred"><i
                            class='fas fa-user'></i>LOGIN</button></a>
                <a id="livechatLink" href="#"><button class="canv buttyell"><i
                            class='fas fa-comments'></i>LIVECHAT</button></a>
            </div>
        </div>
        <div class="insertcoin">
            <div class="balance">
                <img src="/asset-spinner/china/png/expired-01.png" alt="">
            </div>
            <div class="buttonnotif" style="animation-delay: 1s !important;">
                <a id="loginLink1" href="#"><button class="canv buttred"><i
                            class='fas fa-user'></i>LOGIN</button></a>
                <a id="livechatLink1" href="#"><button class="canv buttyell"><i
                            class='fas fa-comments'></i>LIVECHAT</button></a>
            </div>
        </div>
        <div class="animzonk">
            <div class="isizonk">
                <div class="partzonk1">
                    <img src="/asset-spinner/china/png/img/BASE_GRAY-01.svg" alt="">
                    <div class="partzonk3">
                        <img src="/asset-spinner/china/png/img/ZONK-01.svg" alt="">
                    </div>
                    <div class="partzonk4">
                        <img src="/asset-spinner/china/png/img/COBALAGI-01.svg" alt="">
                    </div>
                </div>
                <div class="partzonk2">
                    <div class="greyhorn top">
                        <img class="top1" src="/asset-spinner/china/png/img/TROMPET_GRAY-01.svg" alt="">
                        <img class="top2" src="/asset-spinner/china/png/img/TROMPET_GRAY-01.svg" alt="">
                    </div>
                    <div class="greyhorn bottom">
                        <img class="bottom1" src="/asset-spinner/china/png/img/TROMPET_GRAY-01.svg" alt="">
                        <img class="bottom2" src="/asset-spinner/china/png/img/TROMPET_GRAY-01.svg" alt="">
                    </div>
                </div>
            </div>
            <div class="buttonnotif btnzonk">
                <a id="loginLink2" href="#"><button class="canv buttred"><i
                            class='fas fa-user'></i>LOGIN</button></a>
                <a id="livechatLink2" href="#"><button class="canv buttyell"><i
                            class='fas fa-comments'></i>LIVECHAT</button></a>
            </div>
        </div>

        <div class="textreddgame">
            <div class="winner-popup" style="display: none;">
                <h2>Selamat!</h2>
                <p class="winner-name"></p>
            </div>
            <div class="listtextpart1">
                <h1>Mega jackpot pada tanggal 21 setiap bulannya</h1>
            </div>
            <div class="animtextgiff">
                <img src="/asset-spinner/china/png/MEGAWHEEL21.gif" alt="">
            </div>
            <div class="textpart2">
                <div class="textgr1">
                    <p><i class='fas fa-circle-dot'></i>Satu kode voucher hanya dapat
                        melakukan spin 1 kali</p>
                    <div class="textlice">
                        <p>Licensed by</p>
                        <div class="imglic">
                            <img src="/asset-spinner/china/png/l21-logo.svg" alt="">
                            <img src="/asset-spinner/china/png/mga-malta.svg" alt="">
                        </div>
                    </div>
                    <p class="groupl21">WWW.LOTTO21GROUP.COM</p>
                </div>
                <div class="textgr2"></div>
                <div class="textgr3">
                    <p>Silahkan klik tombol login atau livechat <i class='fas fa-circle-dot'></i>
                        claim hadiah anda sekarang</p>
                    <div class="textlice">
                        <p>Certified by</p>
                        <div class="imglic">
                            <img class="textjk" src="/asset-spinner/china/png/g21-logo.svg" alt="">
                            <img class="textjl" src="/asset-spinner/china/png/bmm-logo.svg" alt="">
                        </div>
                    </div>
                    <p class="groupl21"><i class='fas fa-copyright'></i>SPIN WHEEL ALL RIGHTS RESERVED</p>
                </div>
            </div>
        </div>
    </div>
    <script src="/asset-spinner/js/datafetch.js"></script>
    <script src="/asset-spinner/china/js/wheel_config_14.js"></script>
    <script src="/asset-spinner/js/animCoins.js"></script>
    <script src="/asset-spinner/js/wheelGame.js"></script>

</body>

</html>
