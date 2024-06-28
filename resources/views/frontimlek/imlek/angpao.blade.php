<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/asset-imlek/assets/img/logo-imlek.png">
    <title>L21 | BAGI BAGI ANGPAO 2024</title>
    <link rel="stylesheet" href="/asset-imlek/assets/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div id="overlay">
        <div id="loader"></div>
    </div>
    <section>
        <img class="judulpemilus" src="/asset-imlek/assets/img/logoimlek2024.png" alt="judul pemilu l21">
        <div class="veriuser">
            <label for="judulform">user id</label>
            <div class="continput username">
                <p>{{ $username }}</p>
            </div>
            <div class="continput buttonacak">
                <button class="acakangpao">mulai acak</button>
            </div>
        </div>
        <div class="misterybox" data-klaim="{{ $vote }}" data-id="{{ $id }}"
            data-savedvalue="{{ str($savedValue) }}" data-website="{{ $website }}"
            data-isklaim="{{ $isklaim }}">
            <div class="groupbox">
                <div class="forelist">
                    <div class="listbox">
                        <img class="tutupamplop" src="/asset-imlek/assets/img/head_amplop_close_0.png" alt="">
                        <div class="isihadiah">
                            <img src="/asset-imlek/assets/img/popup_hadiah_angpao2024.png" alt="">
                        </div>
                        <p class="hadiahhd"> <span class="hdnilai"></span></p>
                    </div>
                </div>
                <div class="forelist">
                    <div class="listbox">
                        <img class="tutupamplop" src="/asset-imlek/assets/img/head_amplop_close_0.png" alt="">
                        <div class="isihadiah">
                            <img src="/asset-imlek/assets/img/popup_hadiah_angpao2024.png" alt="">
                        </div>
                        <p class="hadiahhd"> <span class="hdnilai"></span></p>
                    </div>
                </div>
                <div class="forelist">
                    <div class="listbox">
                        <img class="tutupamplop" src="/asset-imlek/assets/img/head_amplop_close_0.png" alt="">
                        <div class="isihadiah">
                            <img src="/asset-imlek/assets/img/popup_hadiah_angpao2024.png" alt="">
                        </div>
                        <p class="hadiahhd"> <span class="hdnilai"></span></p>
                    </div>
                </div>
                <div class="forelist">
                    <div class="listbox">
                        <img class="tutupamplop" src="/asset-imlek/assets/img/head_amplop_close_0.png" alt="">
                        <div class="isihadiah">
                            <img src="/asset-imlek/assets/img/popup_hadiah_angpao2024.png" alt="">
                        </div>
                        <p class="hadiahhd"> <span class="hdnilai"></span></p>
                    </div>
                </div>
                <div class="forelist">
                    <div class="listbox">
                        <img class="tutupamplop" src="/asset-imlek/assets/img/head_amplop_close_0.png" alt="">
                        <div class="isihadiah">
                            <img src="/asset-imlek/assets/img/popup_hadiah_angpao2024.png" alt="">
                        </div>
                        <p class="hadiahhd"> <span class="hdnilai"></span></p>
                    </div>
                </div>
                <div class="forelist">
                    <div class="listbox">
                        <img class="tutupamplop" src="/asset-imlek/assets/img/head_amplop_close_0.png" alt="">
                        <div class="isihadiah">
                            <img src="/asset-imlek/assets/img/popup_hadiah_angpao2024.png" alt="">
                        </div>
                        <p class="hadiahhd"> <span class="hdnilai"></span></p>
                    </div>
                </div>
            </div>
            <p class="silahkanpilih">Silahkan Pilih Salah Satu Angpao!</p>
        </div>
        <div class="popuphasilinvo">
            <div class="grouppop">
                <p class="closeinfo">x</p>
                <img src="/asset-imlek/assets/img/popup_hadiah_angpao-kita2024.png" alt="popup hadiah">
                <span class="hadiahnya"></span>
                <div class="kontakadmin">
                    <a class="whatsapp" href="{{ $whatsapp }}" target="_blank">whatsapp</a>
                    <a class="livechat" href="{{ $livechat }}" target="_blank">livechat</a>
                </div>
            </div>
        </div>
        <div class="coinaktif">
            <p>koin: <span class="valuekoin">{{ $vote == '0' ? '1' : '0' }}</span></p>
        </div>
    </section>

    <script src="/asset-imlek/assets/script.js"></script>
    <script>
        $(document).ready(function() {
            var status = "<?php echo $status; ?>";
            var isklaim = "<?php echo $isklaim; ?>";
            var vote = "<?php echo $vote; ?>";
            var username = "<?php echo $username; ?>";

            if (status == '0' && isklaim == '0') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Sedang Diproses',
                    html: 'Mohon tunggu, userid "<strong>' + username +
                        '</strong>" sedang dalam pengecekan admin kami.',
                    customClass: {
                        popup: 'custom-swal-background',
                        icon: 'custom-swal-icon',
                    },
                    showConfirmButton: false, // Menyembunyikan tombol "OK"
                    allowOutsideClick: false, // Mencegah menutup dengan mengklik di luar SweetAlert
                });
            } else if (status == '2') {
                Swal.fire({
                    icon: 'error',
                    title: 'Klaim Gagal',
                    text: 'Mohon maaf, userid anda tidak memenuhi persyaratan untuk mengikuti event ini!',
                    customClass: {
                        popup: 'custom-swal-background',
                        icon: 'custom-swal-icon',
                    },
                    showConfirmButton: false, // Menyembunyikan tombol "OK"
                    allowOutsideClick: false, // Mencegah menutup dengan mengklik di luar SweetAlert
                });
            } else if (status == '0' && vote == '0' && isklaim == '1') {
                var vote = "<?php echo $vote; ?>";

                var message =
                    `<p>
                        Terimakasih sudah berpartisipasi dalam event ini yah, Silahkan klik tombol MULAI ACAK untuk memilih salah satu Angpao!
                    </p>`;

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    html: message,
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'custom-swal-button',
                        popup: 'custom-swal-background',
                        icon: 'custom-swal-icon',
                    },
                }).then((result) => {
                    if (result.isConfirmed) {

                    }
                });
            }
        });
    </script>
</body>

</html>
