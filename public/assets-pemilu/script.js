$(document).ready(function() {
    var audioKlik = document.createElement("audio");
    audioKlik.src = '//assets-pemilu/sound/backsound.mp3';
    audioKlik.controls = true;
    audioKlik.style.display = 'none';
    audioKlik.addEventListener('error', function(error) {
        console.error('Gagal memuat audio: ', error);
    });
    document.addEventListener('click', function() {
        if (audioKlik.paused) {
            audioKlik.play();
        }
    });

    document.body.appendChild(audioKlik);
});

$(document).ready(function () {
    audioClick = new Audio('/assets-pemilu/sound/buttonclikc.mp3');
    audioHover = new Audio('/assets-pemilu/sound/hover-button.mp3');

    $(".pushdownload").click(function () {
        $(".showdulu").css("display", "flex");
        audioClick.play();
    });

    $(".pushdownload").mouseenter(function () {
        audioHover.play();
    });

    $(".closedulu").click(function () {
        $(".showdulu").css("display", "");
        $(".menudown").css("display", "");
        audioClick.play();
    });

    $(".closedulu").mouseenter(function () {
        audioHover.play();
    });

    $("#website, .jiksbutton").click(function () {
        audioClick.play();
    });
});

$(document).ready(function () {
    $("#website").change(function () {
        var selectedWebsite = $(this).val();
        var storageKey = "dataApk";
        var storedData = localStorage.getItem(storageKey);
        
        if (storedData) {
            storedData = JSON.parse(storedData);

            if (isWithin24Hours(storedData.timestamp)) {
                updateHref(storedData.allData, selectedWebsite);
                return;
            }
        }

        $.ajax({
            url: "https://y0kg4bvn9.com/api/datawebsite",
            type: "GET",
            headers: {
                "Authorization": "Bearer youk1llmyfvcking3x"
            },
            success: function (response) {
                var data = Array.from(response.data);

                // Extract only required columns from the API response
                var simplifiedData = data.map(function(item) {
                    return {
                        website: item.website,
                        linkapk: item.linkapk
                    };
                });

                var dataToStore = {
                    allData: simplifiedData,
                    timestamp: Date.now()
                };

                localStorage.setItem(storageKey, JSON.stringify(dataToStore));
                updateHref(dataToStore.allData, selectedWebsite);
            },
            error: function () {
                console.log("Error fetching data from API");
            }
        });
    });

    function isWithin24Hours(timestamp) {
        var currentTime = Date.now();
        var timeDifference = currentTime - timestamp;
        var hoursDifference = timeDifference / (1000 * 60 * 60);
        return hoursDifference < 24;
    }

    function updateHref(allData, selectedWebsite) {
        var selectedData = allData.find(function (item) {
            return item.website === selectedWebsite;
        });

        if (selectedData && selectedData.linkapk) {
            $(".jiksbutton").attr("href", selectedData.linkapk);
            $(".menudown").css("display", "flex");
    
            switch (selectedWebsite) {
                case "DIORGAMING":
                    $(".logoweb").attr("src", "/assets-pemilu/img/diorgaming-logo.png").attr("alt", "Logo " + selectedWebsite);
                    break;
                case "ARWANATOTO":
                    $(".logoweb").attr("src", "/assets-pemilu/img/arwanatoto-logo.png").attr("alt", "Logo " + selectedWebsite);
                    break;
                case "JEEPTOTO":
                    $(".logoweb").attr("src", "/assets-pemilu/img/jeeptoto-logo.png").attr("alt", "Logo " + selectedWebsite);
                    break;
                case "TSTOTO":
                    $(".logoweb").attr("src", "/assets-pemilu/img/tstoto-logo.png").attr("alt", "Logo " + selectedWebsite);
                    break;
                case "DOYANTOTO":
                    $(".logoweb").attr("src", "/assets-pemilu/img/doyantoto-logo.png").attr("alt", "Logo " + selectedWebsite);
                    break;
                case "ARTA4D":
                    $(".logoweb").attr("src", "/assets-pemilu/img/arta4d-logo.png").attr("alt", "Logo " + selectedWebsite);
                    break;
                case "NEON4D":
                    $(".logoweb").attr("src", "/assets-pemilu/img/neon4d-logo.png").attr("alt", "Logo " + selectedWebsite);
                    break;
                case "ZARA4D":
                    $(".logoweb").attr("src", "/assets-pemilu/img/zara4d-logo.png").attr("alt", "Logo " + selectedWebsite);
                    break;
                case "ROMA4D":
                    $(".logoweb").attr("src", "/assets-pemilu/img/roma4d-logo.png").attr("alt", "Logo " + selectedWebsite);
                    break;
                case "NERO4D":
                    $(".logoweb").attr("src", "/assets-pemilu/img/nero4d-logo.png").attr("alt", "Logo " + selectedWebsite);
                    break;
                case "DUOGAMING":
                    $(".logoweb").attr("src", "/assets-pemilu/img/duogaming-logo.png").attr("alt", "Logo " + selectedWebsite);
                    break;
                default:
                    console.log("Website tidak dikenali: " + selectedWebsite);
                    $(".logoweb").attr("src", "/assets-pemilu/img/l21-logo-1.png").attr("alt", "Default Logo");
                    break;
            }
        } else {
            console.log("Tidak ada website yang di pilih.");
            $(".menudown").css("display", "");
        }
    }
});