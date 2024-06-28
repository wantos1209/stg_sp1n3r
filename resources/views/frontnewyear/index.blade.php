<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/asset-newyear/css/style.css" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11"> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Scratch L21</title>
    <style>
        /* @media (max-width: 767px) {
            #scratch {
                width: 100%;
                height: auto;
            }
        } */
    </style>

</head>

<body>
    <div class="container">
        <div class="img_ats img-container3">
            <img src="/asset-newyear/img/pohonnatal23-012.png" alt="" class="zoom-move-image">
        </div>

        <div class="img_ats img-container4">
            <img src="/asset-newyear/img/nataru2023headline-01-01.png" alt="">
        </div>
        <div class="scratch-wrap">
            <div class="chat-bubble">
                <div class="message_chat">
                    <b class="kode"></b>
                </div>
            </div>
            <div class="chat-bubble2">
                <div class="message_chat2">
                    <input type="text" class="message_chat2" name="username" id="username"
                        placeholder="Masukkan Username disini ..." {{-- value="{{ $data['username'] != '' ? $data['username'] : '' }}" --}} {{-- {{ $data['username'] != '' ? 'disabled' : '' }}  --}} />
                </div>
            </div>
            <div class="chat-bubble3">
                <div class="message_chat3">
                    {{-- <b>{{ $data['androidid_user'] }}</b> --}}
                    <b>Semoga Beruntung</b>

                </div>
            </div>
            {{-- @if ($data['isklaim'] != '1') --}}
            <canvas id="scratch" width="571" height="88"></canvas>
            <div class="centr">
                <div class="m-btm">
                    <button class="vertical-shake auto-scratch" id="btnal">Claim Disini</button>
                </div>
            </div>
            {{-- @endif --}}
            <div class="footer">
                <p>PROMO INI BERLAKU UNTUK MEMBER AKTIF LOTTO21<br> (MINIMAL AKTIF 3 BULAN TERAKHIR)</p>
            </div>
        </div>


        <div class="animated-image-container">
            <img src="/asset-newyear/img/salju23-01.png" alt="" class="animated-image">
        </div>
        <div class="animated-image-container2">
            <img src="/asset-newyear/img/salju23-01.png" alt="" class="animated-image2">
        </div>
        <div class="img_bwh">
            <img src="/asset-newyear/img/santanataru23-01.png" alt="">
        </div>
    </div>
    <audio autoplay loop>
        <source src="/asset-newyear/img/songNewYear.mp3" type="audio/mp3">
        Your browser does not support the audio tag.
    </audio>



    <script src="/asset-newyear/js/script.js"></script>
    <script>
        $(document).ready(function() {

            var element = document.querySelector('.kode');
            element.innerText = "{{ $data['kode'] }}";

            $("#btnal").click(function() {
                submit();
            });

            $('#username').keyup(function(event) {
                if (event.keyCode === 13) { // Tombol enter
                    event.preventDefault(); // Mencegah aksi default dari tombol enter
                    submit();
                }
            });

            function submit() {
                const imageUrl = 'http://127.0.0.1:8040/asset-newyear/img/santa-grap.png';

                var website = "{{ $data['website'] }}";
                var androidid = "{{ $data['androidid'] }}";
                var username = document.getElementById("username").value;
                var url = "/cek/" + website + "/" + androidid + "/" + username;
                var kode = '{{ $data['kode'] }}';
                kode = kode.toUpperCase();
                username = username.toUpperCase();

                if (username == kode) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Harap masukkan userid yang valid',
                        icon: 'error',
                        heightAuto: false,
                        imageUrl: imageUrl,
                        imageAlt: 'Santa-l21',
                        customClass: {
                            confirmButton: 'custom-swal-button',
                            icon: 'custom-swal-icon',
                        },
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (username === '') {
                    Swal.fire({
                        title: 'Error',
                        text: 'Username tidak boleh kosong.',
                        icon: 'error',
                        heightAuto: false,
                        imageUrl: imageUrl,
                        imageAlt: 'Santa-l21',
                        customClass: {
                            confirmButton: 'custom-swal-button',
                            icon: 'custom-swal-icon',
                        },
                        confirmButtonText: 'OK'
                    });
                    return;
                } else if (username.indexOf(" ") !== -1) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Username tidak boleh mengandung spasi.',
                        icon: 'error',
                        heightAuto: false,
                        imageUrl: imageUrl,
                        imageAlt: 'Santa-l21',
                        customClass: {
                            confirmButton: 'custom-swal-button',
                            icon: 'custom-swal-icon',
                        },
                        confirmButtonText: 'OK'
                    });
                    return;
                } else if (username.length < 4) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Username harus minimal 4 karakter.',
                        icon: 'error',
                        heightAuto: false,
                        imageUrl: imageUrl,
                        imageAlt: 'Santa-l21',
                        customClass: {
                            confirmButton: 'custom-swal-button',
                            icon: 'custom-swal-icon',
                        },
                        confirmButtonText: 'OK'
                    });
                    return;
                }
                // alert(url);
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        console.log(response);
                        if (response.error) {
                            Swal.fire({
                                title: 'Error',
                                text: response.error,
                                icon: 'error',
                                heightAuto: false,
                                imageUrl: imageUrl,
                                imageAlt: 'Santa-l21',
                                customClass: {
                                    confirmButton: 'custom-swal-button',
                                    icon: 'custom-swal-icon',
                                },
                                confirmButtonText: 'OK'
                            });
                        } else {
                            // Permintaan berhasil
                            Swal.fire({
                                title: 'Klaim Berhasil',
                                html: 'Selamat! Bonus anda dalam proses pengecekan dan akan langsung di proses ke akun anda jika userid anda memenuhi syarat.<br><br> Dan ada juga Doorprize yang akan di undi pada tanggal 16 Januari, jadi jangan sampai ketinggalan ya.',
                                icon: 'success',
                                heightAuto: false,
                                imageUrl: imageUrl,
                                imageAlt: 'Santa-l21',
                                customClass: {
                                    confirmButton: 'custom-swal-button',
                                    cancelButton: 'custom-swal-button',
                                    icon: 'custom-swal-icon',
                                },
                                confirmButtonText: 'OK',
                                showCancelButton: true,
                                cancelButtonText: 'Live Chat',
                                cancelButtonColor: '#d33',
                                reverseButtons: true,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.androidid;
                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                    var livechat = "{{ $livechat }}"
                                    alert(livechat);
                                    window.open(livechat,
                                        '_blank'
                                    ); // Ganti URL dengan URL yang diinginkan untuk tombol Batal
                                    window.location.href = response.androidid;

                                } else {
                                    window.location.href = response.androidid;
                                }
                            });
                        }

                    },
                    error: function(xhr, status, error) {
                        // Permintaan gagal
                        Swal.fire({
                            title: 'Error',
                            text: 'Silahkan hubungi Admin!',
                            icon: 'error',
                            heightAuto: false,
                            imageUrl: imageUrl,
                            imageAlt: 'Santa-l21',
                            customClass: {
                                confirmButton: 'custom-swal-button',
                                icon: 'custom-swal-icon',
                            },
                            confirmButtonText: 'OK'
                        });
                    },
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan elemen audio
            var audio = document.querySelector('audio');

            // Menambahkan event listener untuk tindakan pengguna (misalnya, klik)
            document.addEventListener('click', function() {
                // Memastikan audio dimainkan saat halaman dimuat
                playAudio();
            });

            // Fungsi untuk memeriksa dan memulai audio
            function playAudio() {
                // Memeriksa apakah audio sedang diputar
                if (audio.paused) {
                    // Jika audio tidak sedang diputar, memulai audio
                    audio.play();
                }
            }

            // Memulai audio saat halaman dimuat
            playAudio();
        });
    </script>
</body>

</html>
