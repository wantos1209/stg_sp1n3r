<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/asset-newyear/img/logo-cristmas.png">
    <title>L21 | NATAL dan TAHUN BARU 2023</title>
    <link rel="stylesheet" href="/asset-newyear/css/style_halaman.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

    <style>
        .tmbllivedraw {
            z-index: 1;
            width: 30%;
            border-radius: 6px;
            padding: 7px;
            outline: none;
            border: none;
            box-shadow: 3px 3px 3px #00000066;
            background: linear-gradient(45deg, #013a18, #1bff00);
            color: white;
            text-shadow: 1px 1px 1px black;
            letter-spacing: 1px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tmbllivedraw:hover {
            box-shadow: 0 7px 7px #0000005e !important;
            filter: brightness(1.5);
            transform: scale(1.1);
        }

        @media screen and (max-width: 768px) {
            .tmbllivedraw {
                width: 50%;
            }
        }
    </style>
</head>

<body>
    <?php //$datenow = '2024-01-16';
    ?>
    <div class="ovalls">
        <div class="grp_bulle">
        </div>
    </div>
    <section>
        <img class="logol21" src="/asset-newyear/img/l21-logo-1.png" alt="logo lotto21">
        <img class="img1" src="/asset-newyear/img/nataru2023.png" alt="Hadiah Doorprize l21">
        <p class="textkode">Kode Voucher Kamu</p>
        <input id="vouchernn" type="text" value="{{ $data['kode'] }}" disabled>

        @if ($datenow < '2024-01-16')
            <button class="tmblinfo">Informasi Lengkap</button>
        @else
            {{-- <button class="tmbdoorprize" onclick="openDoorprize()">{{ $button_title }}</button> --}}
            <button class="tmbllivedraw" onclick="openDoorprize()">{{ $button_title }}</button>
        @endif
        <div class="datapeserta">
            @if ($datenow < '2024-01-16')
                <h3>20 List Peserta Undian Terbaru</h3>
                <input type="text" id="cari-kode" value="{{ $data['kode'] }}" class="search-kode"
                    placeholder="cari kode">
                <button class="btn-cari"><svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                    </svg></button>
            @else
                <h3>List Pemenang undian DOORPRIZE L21</h3>
            @endif

            <table>
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Userid</th>
                        <th>Kode Voucher</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <div class="showpemenang">
        <div class="bungkuspemenang">
            <img class="coin1" src="/asset-newyear/img/pemenang/coin-l21.png" alt="coin-l21">
            <img class="coin2" src="/asset-newyear/img/pemenang/coin-l21.png" alt="coin-l21">
            <img class="coin3" src="/asset-newyear/img/pemenang/coin-l21.png" alt="coin-l21">
            <img class="coin4" src="/asset-newyear/img/pemenang/coin-l21.png" alt="coin-l21">
            <img class="coin5" src="/asset-newyear/img/pemenang/coin-l21.png" alt="coin-l21">
            <img class="coin6" src="/asset-newyear/img/pemenang/coin-l21.png" alt="coin-l21">
            <img class="coin7" src="/asset-newyear/img/pemenang/coin-l21.png" alt="coin-l21">
            <img class="coin8" src="/asset-newyear/img/pemenang/coin-l21.png" alt="coin-l21">
            <img class="coin9" src="/asset-newyear/img/pemenang/coin-l21.png" alt="coin-l21">
            <img class="coin10" src="/asset-newyear/img/pemenang/coin-l21.png" alt="coin-l21">
            <img class="pemenangl21" src="/asset-newyear/img/pemenang/pemenang-l21.png" alt="pemenang-l21">
            <div class="detailpemenang">
                <div class="cont-draw">
                    <img class="mark" src="/asset-newyear/img/pemenang/l21-logo-1.png" alt="l21">
                    <span class="textpm">pemenang hadiah <span class="tempatvalue">{{ $data['prize'] }}</span></span>
                    <img class="wing1" src="{{ $pathgambar }}" alt="voucher-l21" style="">
                    <div class="rekppemen">
                        <span class="textselamat">userid <span class="hasil-pen">{{ $data['username'] }}</span></span>
                    </div>
                    <span class="vouchergen">{{ $data['kode'] }}</span>

                    {{-- <p class="cekkode">Cek kode voucher aplikasi kamu sekarang!</p> --}}
                </div>
                <div class="groupinfot">
                    <span class="text-deskripsi">Silahkan konfirmasi data lengkap anda untuk claim hadiah DOORPIRZE
                        L21</span>
                    <div class="btn-wa-livechat">
                        <button class="btn-livechat" onclick="openLivechat()">LIVECHAT</button>
                        <button class="btn-wa" onclick="openWhatsapp()">WHATSAPP</button>
                    </div>
                </div>
                <button class="closeshow">CLOSE</button>
            </div>
        </div>
    </div>
    <script src="/asset-newyear/js/script_halaman.js"></script>
    <script>
        $(document).ready(function() {
            const status = "{{ $data['status'] }}";

            function cancelAlrrt() {
                showCancelAlert();
            }

            function waitingAlert() {
                showWaitingAlert();
            }

            function approveAlert() {
                showApproveAlert();
            }

            function showHadiahAlert() {
                const imageUrl = '/asset-newyear/img/santa-grap.png';
                var hadiah = "{{ $data['hadiah'] }}";
                Swal.fire({
                    title: 'Selamat',
                    html: `<p>Anda mendapatkan saldo sebesar <b>Rp.` + hadiah +
                        `</b> dan sudah di proseskan ke userid anda. 
                        <br>
                        <br>
                        Lalu untuk kode voucher anda nanti akan di undi, dan akan disiarkan secara langsung pada <b> 16 Januari 2024 </b>, jadi jangan sampai terlewatkan ya. 
                        </p>`,
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

                }).then((result) => {
                    if (result.isConfirmed) {}
                });
            }

            function showApproveAlert() {
                const imageUrl = '/asset-newyear/img/santa-grap.png';
                var hadiah = "{{ $data['hadiah'] }}";
                Swal.fire({
                    title: 'Selamat',
                    html: `<p>Anda mendapatkan saldo sebesar <b>Rp.` + hadiah +
                        `</b> dan sudah di proseskan ke userid anda. 
                        <br>
                        <br>
                        Lalu untuk kode voucher anda nanti akan di undi, dan akan disiarkan secara langsung pada <b> 16 Januari 2024 </b>, jadi jangan sampai terlewatkan ya. 
                        </p>`,
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

                }).then((result) => {
                    if (result.isConfirmed) {}
                });
            }

            function showWaitingAlert() {
                const imageUrl = '/asset-newyear/img/santa-grap.png';

                Swal.fire({
                    icon: 'warning',
                    title: 'Sedang Diproses',
                    html: `<p>Mohon tunggu, userid anda sedang dalam pengecekan admin kami.</p>`,
                    confirmButtonText: 'OK',
                    showCloseButton: false,
                    showConfirmButton: false,
                    showCancelButton: false,
                    allowOutsideClick: false,
                    customClass: {
                        // confirmButton: 'custom-swal-button',
                        popup: 'custom-swal-background',
                        // icon: 'custom-swal-icon',
                    },
                    imageUrl: imageUrl,
                    imageAlt: 'Santa-l21',
                }).then((result) => {
                    if (result.isConfirmed) {}
                });
            }

            function showCancelAlert() {
                const imageUrl = '/asset-newyear/img/santa-grap.png';

                Swal.fire({
                    icon: 'error',
                    title: 'Klaim Gagal',
                    html: `<p>Mohon maaf, userid anda tidak memenuhi persyaratan untuk mengikuti event ini!</p>`,
                    confirmButtonText: 'OK',
                    showCloseButton: false,
                    showConfirmButton: false,
                    showCancelButton: false,
                    allowOutsideClick: false,
                    customClass: {
                        // confirmButton: 'custom-swal-button',
                        popup: 'custom-swal-background',
                        // icon: 'custom-swal-icon',
                    },
                    imageUrl: imageUrl,
                    imageAlt: 'Santa-l21',
                }).then((result) => {
                    if (result.isConfirmed) {}
                });
            }
            alert(status);
            if (status == '2') {
                cancelAlrrt();
            } else if (status == '0') {
                waitingAlert();
            } else {
                var prize = "{{ $data['prize'] }}";

                if (prize != '' && prize != 0) {
                    $('.showpemenang').css({
                        'display': 'block',
                        'overflow': 'hidden'
                    });
                    $('body').css('overflow', 'hidden');

                } else {
                    approveAlert();
                }

            }

            $(".closeshow").click(function() {
                $('.showpemenang').css({
                    'display': 'none',
                    'overflow': 'auto'
                });
                $('body').css('overflow', 'auto');
            });

            var data = <?php echo $alldata; ?>;

            var dateNow = "<?php echo $datenow; ?>";
            if (dateNow > '2024-01-15') {
                data = data.filter(function(item) {
                    return item.prize_id !== 0;
                });
            }



            // Fungsi untuk membuat baris tabel dari data
            function createTableRow(data, index) {
                var row = document.createElement('tr');

                // Membuat sel untuk nomor urut
                var numberCell = document.createElement('td');
                numberCell.textContent = index + 1;
                row.appendChild(numberCell);

                // Membuat sel untuk Userid
                var useridCell = document.createElement('td');
                // useridCell.textContent = data.username;
                if (data.username.length > 4) {
                    var firstThreeDigits = data.username.substring(0, 4);
                    var newText = firstThreeDigits + 'x'.repeat(data.username.length - 4);
                    useridCell.textContent = newText;
                } else {
                    useridCell.textContent = data.username;
                }
                row.appendChild(useridCell);

                // Membuat sel untuk Kode Voucher
                var kodeCell = document.createElement('td');
                kodeCell.textContent = data.kode;
                row.appendChild(kodeCell);

                return row;
            }

            // Fungsi untuk membuat baris header tabel
            function createTableHeader() {
                var headerRow = document.createElement('tr');

                // Membuat sel untuk nomor urut
                var numberCell = document.createElement('th');
                numberCell.textContent = '#';
                headerRow.appendChild(numberCell);

                // Membuat sel untuk Userid
                var useridCell = document.createElement('th');
                useridCell.textContent = 'Userid';
                headerRow.appendChild(useridCell);

                // Membuat sel untuk Kode Voucher
                var kodeVoucherCell = document.createElement('th');
                kodeVoucherCell.textContent = 'Kode Voucher';
                headerRow.appendChild(kodeVoucherCell);

                return headerRow;
            }

            // Fungsi untuk menampilkan tabel dari data array
            function renderTable(data) {
                var tableBody = document.querySelector('table tbody');

                // Menghapus semua baris tabel dan header sebelumnya
                while (tableBody.firstChild) {
                    tableBody.removeChild(tableBody.firstChild);
                }

                // Membuat baris header tabel
                var headerRow = createTableHeader();
                tableBody.appendChild(headerRow);

                var limitedData = data;

                // Membuat baris tabel untuk setiap data
                limitedData.forEach(function(item, index) {
                    var row = createTableRow(item, index);
                    tableBody.appendChild(row);
                });
            }

            // Menampilkan tabel saat pertama kali dimuat
            renderTable(data);

            // Fungsi untuk melakukan filter berdasarkan kata kunci
            function filterTable(keyword) {
                var filteredData = data.filter(function(item) {
                    var lowerKeyword = keyword.toLowerCase();
                    return item.username.toLowerCase().includes(lowerKeyword) || item.kode.toLowerCase()
                        .includes(lowerKeyword);
                });

                // Menampilkan tabel dengan data yang telah difilter
                renderTable(filteredData);
            }

            var dateNow = "<?php echo $datenow; ?>";
            if (dateNow <= '2024-01-15') {
                // Menggunakan input teks untuk melakukan filter
                var searchInput = document.getElementById('cari-kode');
                searchInput.addEventListener('input', function() {
                    var keyword = this.value;
                    filterTable(keyword);
                });

                $(".btn-cari").on("click", function() {
                    filterTable(searchInput.value);
                });
            }



        });

        function openDoorprize() {
            var doorprizeUrl = '{{ $button_url }}';
            window.open(doorprizeUrl, '_blank');
        }

        function openLivechat() {
            const livechat = '<?php echo $livechat; ?>';
            window.open(livechat, "_blank");
        }

        function openWhatsapp() {
            const whatsapp = '<?php echo $whatsapp; ?>';
            window.open(whatsapp, "_blank");
        }
    </script>
</body>

</html>
