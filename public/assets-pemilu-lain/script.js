$(document).ready(function() {
    var audioKlik = document.createElement("audio");
    audioKlik.src = '/assets-pemilu-lain/sound/backsound.mp3';
    audioKlik.controls = true;
    audioKlik.style.display = 'none';
    audioKlik.addEventListener('error', function(error) {
        console.error('Gagal memuat audio: ', error);
    });

    audioKlik.volume = 0.3;

    document.addEventListener('click', function() {
        if (audioKlik.paused) {
            audioKlik.play();
        }
    });

    document.body.appendChild(audioKlik);
});

$(document).ready(function() {
    audioClick = new Audio('/assets-pemilu-lain/sound/buttonclikc.mp3');
    audioHover = new Audio('/assets-pemilu-lain/sound/hover-button.mp3');

    $("#Submit").mouseenter(function () {
        audioHover.play();
    });

    $("#Submit").on("click", function(event) {
        audioClick.play();
        event.preventDefault();
        var useridInput = $("#userid");
        if (useridInput.length > 0 && useridInput.val().trim() === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Userid tidak boleh kosong!',
                customClass: {
                    confirmButton: 'custom-swal-button',
                    popup: 'custom-swal-background',
                    icon: 'custom-swal-icon',
                },
            });
        } else {
            kirimData();
        }
    });

    function kirimData() {
        const url = '/l21pemilu/' +  document.getElementById("jenis_event").value;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var userid = document.getElementById("userid").value;
        var website = document.getElementById("website").value;
        var androidid = document.getElementById("androidid").value;
        var ip = document.getElementById("ip").value;
        var formData = new FormData(); // Buat objek FormData baru
      
        // Tambahkan data ke objek FormData
        formData.append('_token', csrfToken);
        formData.append('userid', userid);
        formData.append('website', website);
        formData.append('androidid', androidid);
        formData.append('ip', ip);

      
        $.ajax({
          url: url,
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            showSuccessAlert();
          },
          error: function(xhr, status, error) {
            if (xhr.responseJSON && xhr.responseJSON.error) {
                showAlertError(xhr.responseJSON.error);
            } else {
                // Jika struktur respons tidak sesuai, menampilkan pesan default
                showAlertError('Terjadi kesalahan.');
            }
          }
        });
      }

    function showSuccessAlert() {
        const imageUrl = '/assets-pemilu-lain/img/santa-grap.png';
        var useridValue = $("#userid").val();
        var alertText = `<p>Userid <b>${useridValue}</b> sedang dalam proses pengecekan admin. Silahkan cek beberapa saat lagi untuk melakukan vote dan claim hadiah anda.</p>`;
    
        Swal.fire({
            icon: 'success',
            title: 'Klaim Berhasil',
            html: alertText,
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'custom-swal-button',
                popup: 'custom-swal-background',
                icon: 'custom-swal-icon',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    }    

    function showAlertError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            customClass: {
                confirmButton: 'custom-swal-button',
                popup: 'custom-swal-background',
                icon: 'custom-swal-icon',
            },
        });
    }

    $("#myForm").submit(function(event) {
        event.preventDefault();
    });
});

$(document).ready(function () {
    audioClick = new Audio('/assets-pemilu-lain/sound/buttonclikc.mp3');
    audioHover = new Audio('/assets-pemilu-lain/sound/hover-button.mp3');
    audioYee = new Audio('/assets-pemilu-lain/sound/yee.mp3');
    // var animasiTelahBerjalan = true;

    $(".pushvote, .grouppop a, .closeinfo").mouseenter(function () {
        audioHover.play();
    });

    $('.listnilai').each(function () {
        var $angkavote = $(this).find('.angkavote');
        var $diagram = $(this).find('.diagram');

        $angkavote.data('initial-value', parseInt($angkavote.text()));
        $diagram.data('initial-height', parseInt($diagram.css('height')));
        $angkavote.text('0%');
        $diagram.css('height', '0%');
    });

    $('.pushvote').on('click', function () {
        audioHover.play();
        var id = $(this).attr('data-id');
        var website = $(this).attr('data-website');
        var vote = $(this).attr('data-paselon');

        if (!animasiTelahBerjalan) {
            updateVote(website, id, vote);
            
            animasiTelahBerjalan = true;

            $('.pushvote').prop('disabled', false).removeClass('clicked').text('VOTE');
            $(this).addClass('clicked').addClass('choice').text('KLAIM');

            var spinnuserValue = $(this).data('spinnuser');
            var imgPaslonValue = $(this).data('imgpaslon');
            $('.grouppop a').attr('href', spinnuserValue);
            $('.grouppop img').attr('src', imgPaslonValue);

            smoothCountAndGrow(function () {
                $('.popuphasilinvo').css('display', 'flex');
                $('.pushvote:not(.clicked)').prop('disabled', true);
                audioYee.play();
            });
        } else {
            var spinnuserValue = $(this).data('spinnuser');
            var imgPaslonValue = $(this).data('imgpaslon');
            $('.grouppop a').attr('href', spinnuserValue);
            $('.grouppop img').attr('src', imgPaslonValue);
            $('.popuphasilinvo').css('display', 'flex');
            audioYee.play();
        }
    });

    $('.closeinfo').on('click', function () {
        $('.popuphasilinvo').css('display', '');
    });
});

function updateVote(website, id, vote) {
    const url = '/l21pemilu';
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var data = {
        _token: csrfToken,
        id: id,
        website: website,
        vote: vote
    };

    $.ajax({
        url: url,
        type: "PUT",
        data: data,
        success: function(response) {
            var pointpilihanElement = document.querySelector('.pointpilihan');
            pointpilihanElement.innerHTML = '0';
        },
        error: function(xhr, status, error) {
            if (xhr.responseJSON && xhr.responseJSON.error) {
                // showAlertError(xhr.responseJSON.error);
            } else {
                // showAlertError('Terjadi kesalahan.');
            }
        }
    });
}

$(document).ready(function () {
    var pilihan = $('.grouppaslon').data('pilihan');

    if (pilihan > 0) {
        $('.listpaslon').each(function (index) {
            var nomorPaslon = index + 1;
            var $pushvote = $(this).find('.pushvote');

            if (nomorPaslon === pilihan) {
                $(this).attr('data-opsi', '1');
                $pushvote.text('KLAIM').addClass('choice');
            } else {
                $(this).attr('data-opsi', '0');
                $pushvote.attr('disabled', true).removeClass('clicked');
            }
        });
        smoothCountAndGrow(function () {
        });
    } else {
        // console.log("pilihan is 0");
    }
});


function smoothCountAndGrow(callback) {
    var animationCount = $('.listnilai').length;
    var audioProgress = new Audio('/assets-pemilu-lain/sound/progress.mp3');

    $('.listnilai').each(function () {
        var $angkavote = $(this).find('.angkavote');
        var targetValue = parseInt($angkavote.data('initial-value'));
        var $diagram = $(this).find('.diagram');
        var initialHeight = parseInt($diagram.data('initial-height'));

        $({ count: 0, height: initialHeight }).animate({ count: targetValue }, {
            duration: 2000,
            step: function () {
                $angkavote.text(Math.round(this.count) + "%");
                $diagram.css('height', Math.round(this.count) + "%");
                audioProgress.play();
            },
            complete: function () {
                animationCount--;
                if (animationCount === 0 && typeof callback === 'function') {
                    callback();
                    audioProgress.pause();
                }
            }
        });
    });
}
