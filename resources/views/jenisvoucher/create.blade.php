@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/jenisvoucher/store" method="POST" enctype="multipart/form-data" id="form">
            @csrf

            <div class="sec_form">
                <div class="sec_head_form">
                    <h3>{{ $title }}</h3>
                    <span>Tambah {{ $title }}</span>
                </div>
                <div class="list_form">
                    <span class="sec_label">Username Shorten</span>
                    <input type="text" id="username_shorten" name="username_shorten"
                        placeholder="Masukkan Username Shorten" required>
                </div>
                <div class="list_form">
                    <span class="sec_label">Link Awal</span>
                    <input type="text" id="link_awal" name="link_awal" placeholder="Masukkan Link Awal" required>
                </div>
                <div class="list_form">
                    <span class="sec_label">Link Hasil</span>
                    <input type="text" id="link_hasil" name="link_hasil" placeholder="Masukkan Link Hasil" required>
                </div>
            </div>
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Contactsubmit">Submit</button>
                <a href="/jenisvoucher" id="cancel"><button type="button"
                        class="sec_botton btn_cancel">Cancel</button></a>
            </div>
        </form>
    </div>

    <script></script>
@endsection
