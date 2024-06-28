$(document).ready(function () {
    function createSnowflake() {
        var duration = Math.random() * 15 + 8;
        return $('<img src="/img/snow.png" alt="">').css({
            left: Math.random() * $(window).width(),
            animationDuration: duration + 's',
        }).appendTo('.grp_bulle').animate({
            top: $(window).height(),
            left: '+=' + Math.random() * 200 - 100,
        }, duration * 1000, 'linear', function () {
            $(this).remove();
            createSnowflake();
        });
    }

    for (let i = 0; i < 30; i++) {
        createSnowflake();
    }
});

$(document).ready(function () {
    function claimBonus() {
        showSuccessAlert();
    }

    function showSuccessAlert() {
        const imageUrl = '/img/santa-grap.png';

        Swal.fire({
            icon: 'success',
            title: 'Klaim Berhasil',
            html: `<p>Selamat! Bonus anda dalam proses pengecekan dan akan langsung di proses ke akun anda.</p>`,
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'custom-swal-button',
                popup: 'custom-swal-background',
                icon: 'custom-swal-icon',
            },
            imageUrl: imageUrl,
            imageAlt: 'Santa-l21',
        }).then((result) => {
            if (result.isConfirmed) {
            }
        });
    }

    // claimBonus();
});

$(document).ready(function() {
    $('.nmuser').each(function() {
        var originalText = $(this).text();
        if (originalText.length > 4) {
            var firstThreeDigits = originalText.substring(0, 4);
            var newText = firstThreeDigits + 'x'.repeat(originalText.length - 4);
            $(this).text(newText);
        }
    });
});

$(document).ready(function () {
    $('.tmblinfo').click(function () {
        infoBonus();
    });

    function infoBonus() {
        showSuccessInfo();
    }

    function showSuccessInfo() {
        const imageUrl = '/img/santa-grap.png';

        Swal.fire({
            title: 'Informasi dan List Hadiah Doorprize',
            html: `
            <div class="datapeserta">
            <p class="datatest">Hadiah akan <b>di undi pada akhir tahun 2023</b>.
            Simpan Kode Voucher kamu dan dapatkan hadiah DOORPRIZE dari <b>LOTTO21GROUP</b>.</p>
                    <table>
                        <tbody>
                            <tr>
                                <th>#</th>
                                <th>Hadiah</th>
                                <th>Total Hadiah</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td class="nmuser">Motor Yamaha NMAX</td>
                                <td class="kdvc">1 Unit</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="nmuser">Motor Honda VARIO</td>
                                <td class="kdvc">2 Unit</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="nmuser">Laptop Samsung ASUS VivoBook 14inch</td>
                                <td class="kdvc">5 Unit</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td class="nmuser">HP Samsung A32 Ram 8GB</td>
                                <td class="kdvc">10 Unit</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td class="nmuser">Toshiba LED TV - HD Smart TV 32 inch</td>
                                <td class="kdvc">10 Unit</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td class="nmuser">Mega Voucher</td>
                                <td class="kdvc">20 Pcs</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    `,
            confirmButtonText: 'Close',
            customClass: {
                title: 'custom-title',
                confirmButton: 'custom-swal-buttoninfo',
                popup: 'custom-swal-background',
                icon: 'custom-swal-icon',
            },
            imageUrl: imageUrl,
            imageAlt: 'Santa-l21',
        }).then((result) => {
            if (result.isConfirmed) {
            }
        });
    }
});

