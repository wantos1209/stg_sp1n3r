<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/assets-pemilu-lain/img/logo-vote.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>L21 | TEBAK PEMILU 2024</title>
    <link rel="stylesheet" href="/assets-pemilu-lain/style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <section class="votesec">
        <div class="group2">
            <div class="groupnilai">
                <div class="listnilai">
                    <p class="angkavote">20%</p>
                    <div class="diagram" style="height: 20%"></div>
                </div>
                <div class="listnilai">
                    <p class="angkavote">55%</p>
                    <div class="diagram" style="height: 55%"></div>
                </div>
                <div class="listnilai">
                    <p class="angkavote">25%</p>
                    <div class="diagram" style="height: 25%"></div>
                </div>
            </div>
            <div class="grouppaslon" data-pilihan="{{ $vote }}">
                <div class="listpaslon" data-opsi="">
                    <img class="imgpaslon" src="/assets-pemilu-lain/img/paslon1.png" alt="paslon 1" />
                    <p class="nomorpaslon">1</p>
                    <p class="textpaslon">paslon nomor</p>
                    <button class="pushvote clicked" data-spinnuser="{{ $url_spinner }}"
                        data-imgpaslon="/assets-pemilu-lain/img/popup-paslon1.png" data-id="{{ $id }}"
                        data-website="{{ $website }}" data-paselon="1">
                        vote
                    </button>
                </div>
                <div class="listpaslon" data-opsi="">
                    <img class="imgpaslon" src="/assets-pemilu-lain/img/paslon2.png" alt="paslon 2" />
                    <p class="nomorpaslon">2</p>
                    <p class="textpaslon">paslon nomor</p>
                    <button class="pushvote clicked" data-spinnuser="{{ $url_spinner }}"
                        data-imgpaslon="/assets-pemilu-lain/img/popup-paslon2.png" data-id="{{ $id }}"
                        data-website="{{ $website }}" data-paselon="2">
                        vote
                    </button>
                </div>
                <div class="listpaslon" data-opsi="">
                    <img class="imgpaslon" src="/assets-pemilu-lain/img/paslon3.png" alt="paslon 3" />
                    <p class="nomorpaslon">3</p>
                    <p class="textpaslon">paslon nomor</p>
                    <button class="pushvote clicked" data-spinnuser="{{ $url_spinner }}"
                        data-imgpaslon="/assets-pemilu-lain/img/popup-paslon3.png" data-id="{{ $id }}"
                        data-website="{{ $website }}" data-paselon="3">
                        vote
                    </button>
                </div>
            </div>
            <div class="datapemilih">
                <label class="judulvott">user id pemilih</label>
                <p class="namapemilih">{{ $username }}</p>
                <div class="chancevote">
                    <p>kesempatan memilih anda :</p>
                    <span class="pointpilihan">{{ $vote == '0' ? '1' : '0' }}</span>
                </div>
            </div>
        </div>
        <div class="popuphasilinvo">
            <div class="grouppop">
                <p class="closeinfo">x</p>
                <img src="" alt="popup paslon" />
                <a href="">disini</a>
            </div>
        </div>
        <p class="infoputaran">
            jika terdapat lebih dari 1 putaran maka jumlah vote akan di reset.
        </p>
    </section>
    <script>
        var vote = "<?php echo $vote; ?>";
        var animasiTelahBerjalan = vote == '0' ? false : true;
    </script>
    <script src="/assets-pemilu-lain/script.js"></script>
    <script>
        $(document).ready(function() {
            var status = "<?php echo $status; ?>";
            var username = "<?= $username ?>";
            if (status == '0') {
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
            } else {
                var vote = "<?php echo $vote; ?>";

                var message =
                    `<p>
                        Terimakasih sudah berpartisipasi dalam event ini yah, silahkan lakukan vote untuk mendapatkan hadiah!
                        
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
