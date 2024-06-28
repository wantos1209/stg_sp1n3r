<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/assets-pemilu-lain/img/logo-vote.png" />
    <title>L21 | TEBAK PEMILU 2024</title>
    <link rel="stylesheet" href="/assets-pemilu-lain/style.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <section>
        <img class="judulpemilus" src="/assets-pemilu-lain/img/judulpemilu.png" alt="judul pemilu l21" />
        <div class="group1">
            <label for="judulform">masukan user id</label>
            <form action="" id="myForm">
                <input type="hidden" id="website" name="website" value="{{ $website }}" />
                <input type="hidden" id="androidid" name="androidid" value="{{ $androidid }}" />
                <input type="hidden" id="ip" name="ip" value="{{ $ip }}" />
                <input type="hidden" id="jenis_event" name="jenis_event" value="{{ $jenis_event }}" />
                <input type="text" id="userid" name="userid" />
                <button type="submit" id="Submit" name="Submit">masuk</button>
            </form>
        </div>
    </section>

    <script src="/assets-pemilu-lain/script.js"></script>
</body>

</html>
