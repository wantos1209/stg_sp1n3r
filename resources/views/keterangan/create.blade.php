@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/keterangan/store" method="POST" id="form">
            @csrf

            <div class="sec_form">
                <div class="sec_head_form">
                    <h3>{{ $title }}</h3>
                    <span>Tambah {{ $title }}</span>
                </div>
                <div class="list_form">
                    <span class="sec_label">Nama Keterangan</span>
                    <input type="text" id="keterangan" name="keterangan" placeholder="Masukkan Keterangan" required>
                </div>
            </div>
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Contactsubmit">Submit</buton>
                    <a href="/keterangan" id="cancel"><button type="button"
                            class="sec_botton btn_cancel">Cancel</button></a>
            </div>
        </form>
    </div>
@endsection
