$(document).ready(function() {
    audioClick = new Audio('/assets/sound/buttonclikc.mp3');
    audioHover = new Audio('/assets/sound/hover-button.mp3');

    $("#Submit, .buttonacak, .forelist").mouseenter(function () {
        // audioHover.play();
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
        const url = '/l21imlek';
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var userid = document.getElementById("userid").value;
        var website = document.getElementById("website").value;
        var androidid = document.getElementById("androidid").value;
        var ip = document.getElementById("ip").value;
        var jenis_event = document.getElementById("jenis_event").value;
        var formData = new FormData(); // Buat objek FormData baru
      
        // Tambahkan data ke objek FormData
        formData.append('_token', csrfToken);
        formData.append('userid', userid);
        formData.append('website', website);
        formData.append('androidid', androidid);
        formData.append('ip', ip);
        formData.append('jenis_event', jenis_event);

      
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

    function showSuccessAlert() {
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

    $("#myForm").submit(function(event) {
        event.preventDefault();
    });
});

$(document).ready(function () {

    audioRandom = new Audio('/assets/sound/swapcard.mp3');
    audioBarongsai = new Audio('/assets/sound/barongsai.mp3');
    audioYee = new Audio('/assets/sound/yee.mp3');
    audioNoo = new Audio('/assets/sound/noo.mp3');
    audioDrum = new Audio('/assets/sound/drumroll.mp3');
    audioDrum.volume = 0.5;
    var audioKlik = document.createElement("audio");
    audioKlik.src = '/assets/sound/backsound.mp3';
    audioKlik.controls = true;
    audioKlik.style.display = 'none';
    audioKlik.addEventListener('error', function(error) {
        console.error('Gagal memuat audio: ', error);
    });

    audioKlik.volume = 0.2;

    document.addEventListener('click', function() {
        if (audioKlik.paused) {
            audioKlik.play();
        }
    });

    document.body.appendChild(audioKlik);

    // var nominalValues = [10000000, 2000, 0, 10000, 50000, 100000];
    var nominalValue;
    showLoadingOverlay();
    getDataHadiah().then(function(response) {
        hideLoadingOverlay();
        nominalValues = response;
        nominalValues = $.map(nominalValues, function(item) {
             return item.hadiah;
        });
        var savedValue = $('.misterybox').data('savedvalue');
        var originalSavedValue = 'RP ' + savedValue.toLocaleString('id-ID') + ',-';
        if (parseFloat(savedValue) === 0) {
            originalSavedValue = "zonk!";
        }
        var valuesWithoutSavedValue = nominalValues.filter(function (value) {
            return value !== savedValue;
        });
        var maxElementsPerRow = 3;
        var totalForelists = $('.forelist').length;
        var initialPositions = [];
        var forelistClicked = false;
        var acakangpaoClicked = false;
    
        $('[data-klaim="1"]').each(function() {
            var rawValue = savedValue;
    
            if (rawValue >= 1000000) {
                rawValue = rawValue / 1000000;
                savedValue = 'rp ' + rawValue + 'jt';
            } else if (rawValue >= 1000) {
                rawValue = rawValue / 1000;
                savedValue = 'rp ' + rawValue + 'rb';
            } else if (rawValue == 0) {
                rawValue = 'zonk!';
                savedValue = rawValue;
            }
    
            $('.popuphasilinvo').css({
                'display': 'flex',
            });
    
            $('.silahkanpilih').text('Selamat atas hadiah angpao Anda!').css({
                'animation': 'none'
            });
            $('.hadiahnya').text(originalSavedValue);
            $('.closeinfo').remove();
        });
    
        $('.hadiahhd').each(function(index) {
            $(this).find('.hdnilai').text(nominalValues[index]);
        });
    
        $('.hdnilai').each(function() {
            var nilai = parseInt($(this).text());
            if (nilai >= 1000000) {
                nilai = nilai / 1000000;
                $(this).text('rp ' + nilai + 'jt');
            } else if (nilai >= 1000) {
                nilai = nilai / 1000;
                $(this).text('rp ' + nilai + 'rb');
            } else if (nilai == 0) {
                nilai = 'zonk!';
                $(this).text(nilai);
            }
        });
    
        function setInitialPositions() {
            var topPosition = 0;
            var leftPosition = 0;
    
            $('.forelist').each(function (index) {
                $(this).css({
                    'top': topPosition + 'px',
                    'left': leftPosition + 'px'
                });
    
                if ((index + 1) % maxElementsPerRow === 0) {
                    topPosition += 120;
                    leftPosition = 0;
                } else {
                    leftPosition += 80;
                }
            });
    
            initialPositions = [];
            $('.forelist').each(function () {
                initialPositions.push({
                    top: $(this).css('top'),
                    left: $(this).css('left')
                });
            });
            audioRandom.play();
        }
    
        function shuffleArray(array) {
            for (var i = array.length - 1; i > 0; i--) {
                var j = Math.floor(Math.random() * (i + 1));
                var temp = array[i];
                array[i] = array[j];
                array[j] = temp;
            }
            return array;
        }
    
        function gatherToCenter() {
            audioRandom.play();
            var forelists = $('.forelist');
            var centerPosition = {
                top: (120 * Math.floor(totalForelists / maxElementsPerRow - 1)) / 2,
                left: (80 * (maxElementsPerRow - 1)) / 2
            };
    
            forelists.animate({
                'top': centerPosition.top + 'px',
                'left': centerPosition.left + 'px'
            }, 1000);
        }
    
        function scatterFromCenter() {
            var forelists = $('.forelist');
            forelists.each(function (index) {
                $(this).animate({
                    'top': initialPositions[index].top,
                    'left': initialPositions[index].left
                }, 1000);
            });
        }
    
        function doRandomSwap() {
            audioRandom.play();
            var forelists = $('.forelist');
            var randomOrder = shuffleArray(Array.from({ length: totalForelists }, (_, i) => i));
            var finalPositions = [];
    
            forelists.each(function (index) {
                finalPositions.push({
                    top: initialPositions[randomOrder[index]].top,
                    left: initialPositions[randomOrder[index]].left
                });
            });
    
            forelists.each(function (index) {
                $(this).animate({
                    'top': finalPositions[index].top,
                    'left': finalPositions[index].left
                }, 1000);
            });
        }
    
        $('.acakangpao').one('click', function () {
            var isklaim = $('.misterybox').data('isklaim');
            
            if(isklaim == '0'){
                return false;
            }
            
            $('.hadiahhd').css({
                'animation': 'popsme 3s',
                'pointer-events': 'none',
                'animation-fill-mode': 'forwards'
            });
    
            $('.isihadiah img').css({
                'animation': 'hideheigh 0.5s',
                'animation-delay': '3s',
                'animation-fill-mode': 'forwards'
            });
    
            $('.tutupamplop').css({
                'animation': 'flipclose 0.5s',
                'animation-delay': '3.8s',
                'animation-fill-mode': 'forwards'
            });
    
            $('.continput.buttonacak').css({
                'animation': 'none',
                'pointer-events': 'none',
                'filter': 'brightness(0.5)'
            });
    
            setTimeout(function () {
                gatherToCenter();
    
                setTimeout(function () {
                    scatterFromCenter();
                }, 1000);
    
                setTimeout(function () {
                    $('.hdnilai').empty();
                    for (var i = 0; i < 5; i++) {
                        setTimeout(function () {
                            doRandomSwap();
                        }, i * 1000);
                    }
                    setTimeout(function () {
                        audioDrum.play();
                        acakangpaoClicked = true;
                        setTimeout(function () {
                            $('.silahkanpilih').css({
                                'display': 'block',
                            });
                        }, 1000);
                    }, 5 * 1000);
                }, 1000);
            }, 4200);
        });
    
        setTimeout(function () {
            setInitialPositions();
        }, 11000);
    
        setInitialPositions();
    
        $('.forelist').click(function () {
    
            if (!acakangpaoClicked) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oopss!',
                    text: 'Silahkan klik "MULAI ACAK" terlebih dahulu!',
                    customClass: {
                        confirmButton: 'custom-swal-button',
                        popup: 'custom-swal-background',
                        icon: 'custom-swal-icon',
                    },
                    timer: 3000,
                });
                return;
            }
    
            if (!forelistClicked) {
                forelistClicked = true;

                $(".valuekoin").text("0");
                postDataHadiah();
    
                var rawValue = savedValue;
    
                if (rawValue >= 1000000) {
                    rawValue = rawValue / 1000000;
                    savedValue = 'rp ' + rawValue + 'jt';
                } else if (rawValue >= 1000) {
                    rawValue = rawValue / 1000;
                    savedValue = 'rp ' + rawValue + 'rb';
                } else if (rawValue == 0) {
                    rawValue = 'zonk!';
                    savedValue = rawValue;
                }
    
                $(this).find('.hadiahhd').text(savedValue).css({
                    'transform': 'rotateZ(345deg) scale(0)',
                    'animation': 'gosme 3s',
                    'animation-delay': '1s',
                    'animation-fill-mode': 'forwards'
                });
    
                $(this).find('.isihadiah img').css({
                    'bottom': '-50px',
                    'animation': 'showheigh 0.5s',
                    'animation-delay': '0.5s',
                    'animation-fill-mode': 'forwards'
                });
    
                $(this).find('.tutupamplop').css({
                    'top': '-1px',
                    'animation': 'flipopen 0.5s',
                    'animation-fill-mode': 'forwards'
                });
    
                $(this).find('.listbox').css({
                    'transform': 'scale(1.2)',
                    'box-shadow': '0 0 20px white',
                    'z-index': '2',
                    'pointer-events': 'none',
                });
    
                $('.hadiahnya').text(originalSavedValue);
    
                setTimeout(function () {
    
                    audioDrum.pause();
                    audioKlik.volume = 0.1;
                    audioBarongsai.play();
                    if (savedValue === 'zonk!') {
                        audioNoo.play();
                        $('.grouppop img').attr('src', '/assets/img/popup_angpao-zonk2024S.png');
                    } else {
                        audioYee.play();
                    }
                    $('.popuphasilinvo').css({
                        'display': 'flex',
                    });
                    $('.silahkanpilih').text('Selamat atas hadiah angpao Anda!').css({
                        'animation': 'none'
                    });
                }, 8000);
    
                $('.forelist').not(this).each(function (index) {
                    var otherValue = valuesWithoutSavedValue[index];
                    var otherRawValue = otherValue;
    
                    if (otherRawValue >= 1000000) {
                        otherRawValue = otherRawValue / 1000000;
                        otherValue = 'RP ' + otherRawValue + 'jt';
                    } else if (otherRawValue >= 1000) {
                        otherRawValue = otherRawValue / 1000;
                        otherValue = 'RP ' + otherRawValue + 'rb';
                    } else if (otherRawValue == 0) {
                        otherRawValue = 'zonk!';
                        otherValue = otherRawValue;
                    }
    
                    $(this).find('.hadiahhd').text(otherValue).css({
                        'transform': 'rotateZ(345deg) scale(0)',
                        'animation': 'gosme 3s',
                        'animation-delay': '5s',
                        'animation-fill-mode': 'forwards'
                    });
    
                    $(this).find('.isihadiah img').css({
                        'bottom': '-50px',
                        'animation': 'showheigh 0.5s',
                        'animation-delay': '4.5s',
                        'animation-fill-mode': 'forwards'
                    });
    
                    $(this).find('.tutupamplop').css({
                        'transform': 'rotateX(180deg)',
                        'top': '-1px',
                        'animation': 'flipopen 0.5s',
                        'animation-delay': '4s',
                        'animation-fill-mode': 'forwards'
                    });
    
                    $(this).find('.listbox').css({
                        'filter': 'brightness(0.5)',
                        'pointer-events': 'none',
                    });
                });
            }
        });
    
        $('.closeinfo').on('click', function () {
            $('.popuphasilinvo').css('display', '');
            audioBarongsai.pause();
            audioKlik.volume = 0.2;
        });
    }).catch(function(error) {
        hideLoadingOverlay();
        console.error(error);
    });

    function getDataHadiah() {
        return $.ajax({
          url: "/getDataHadiah",
          type: "GET",
          dataType: "json",
          async: true
        });
    }

    function postDataHadiah() {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var id = $('.misterybox').data('id');
        var website = $('.misterybox').data('website');
        var isklaim = $('.misterybox').data('isklaim');

        if(isklaim == '0'){
            return false;
        }

        $.ajax({
            url: "/postDataHadiah",
            type: "POST",
            dataType: "json",
            data: {
              _token: csrfToken,
              vote: '1',
              id: id,
              website: website
            },
            success: function(response) {
              console.log(response);
            },
            error: function(xhr, status, error) {
              console.error(error);
            }
        });
    }

    function showLoadingOverlay() {
        $("#overlay").fadeIn();
    }
      
    function hideLoadingOverlay() {
        $("#overlay").fadeOut();
    }
});