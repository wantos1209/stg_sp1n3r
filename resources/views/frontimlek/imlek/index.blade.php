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
    <section>
        <img class="judulpemilus" src="/asset-imlek/assets/img/logoimlek2024.png" alt="judul pemilu l21">
        <img class="gmbbawah" src="/asset-imlek/assets/img/asset_imlek2024_before&login.png" alt="coin imlek l21">
        <div class="groupuser">
            <label for="judulform">masukan user id</label>
            <form action="" id="myForm">
                @csrf
                <div class="continput">
                    <input type="hidden" id="website" name="website" value="{{ $website }}" />
                    <input type="hidden" id="androidid" name="androidid" value="{{ $androidid }}" />
                    <input type="hidden" id="ip" name="ip" value="{{ $ip }}" />
                    <input type="hidden" id="jenis_event" name="jenis_event" value="{{ $jenis_event }}" />
                    <input type="text" id="userid" value="">
                </div>
                <div class="continput btnsubmit">
                    <button type="submit" id="Submit" name="Submit">masuk</button>
                </div>
            </form>
        </div>
    </section>

    <script src="/asset-imlek/assets/script.js"></script>
</body>

</html>
