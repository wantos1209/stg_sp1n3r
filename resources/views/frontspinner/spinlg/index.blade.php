<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L21 - Superspin</title>
    <link rel="stylesheet" href="/asset-spinner/assets/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    <link rel="stylesheet" href="/asset-spinner/china/js/loader.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- <h1>web1</h1> -->
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
    <div class="hitamtimpa"></div>
    <section class="bgwheel">
        <div class="outspinwheel">
            <img class="bgspn" src="/asset-spinner/assets/img/red_bingkai.png" alt="">
            <img class="rodaspn" src="/asset-spinner/assets/img/red_wheel.png" alt="">
            <img class="pointerspn" src="/asset-spinner/assets/img/red_pointer.png" alt="">
        </div>
    </section>
    <div class="buttonwheel" data-target="modalspin">
        <img src="/asset-spinner/assets/img/red_button_1.png" alt="Superspin">
    </div>
    <div id="modalspin" class="moodalspinwl" style="display: none;">

        <div class="bodymodalspin">
            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                </div>
            @endif
            <div class="groupspin">
                <div class="listwheel">
                    <img class="bgroda" src="/asset-spinner/assets/img/red_bingkai.png" alt="">
                    <img class="bagianroda" src="/asset-spinner/assets/img/red_wheel.png" alt="">
                    <img class="bagianpointer" src="/asset-spinner/assets/img/red_pointer.png" alt="">
                </div>
            </div>
            <h3>CLAIM HADIAH</h3>
            <form class="formredeem" role="form" action="/spinner/auth" method="post">
                @csrf
                <div class="redduser">

                    <input type="username" name="username" class="form-control  @error('username') is-invalid @enderror"
                        id="username" placeholder="User ID" autofocus required value="{{ old('username') }}">
                    <i style="padding: 10px 17px;" class='fas fa-user'></i>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="redduser">
                    <input type="voucher" name="voucher" class="form-control" id="voucher" placeholder="Kode Voucher"
                        required> <i class='fas fa-ticket'></i>
                </div>
                <div class="ruangbtn">
                    <button type="submit" class="btn bg-gradient-primary w-100 mt-4 mb-0"
                        style="
                    background-color: transparent;
                    border: 0;
                ">
                        <img src="/asset-spinner/assets/img/red_button_1.png" alt=""></button>
                </div>
                <p>Note: Silahkan klik Hubungi Admin Lotto21Group untuk informasi lanjut dan jika terjadi kendala.
                    <a class="kontkadmin" href=""><i class='fab fa-whatsapp'></i>Hubungi Admin</a>
                </p>
            </form>
            <div class="logol21">
                <img src="/asset-spinner/assets/img/l21-logo-1.png" alt="">
            </div>
        </div>
    </div>

    <script src="/asset-spinner/assets/script.js"></script>
</body>

</html>
