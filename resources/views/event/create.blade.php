@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/dataevent/store/{{ $jenis_event }}" method="POST" enctype="multipart/form-data" id="form">
            @csrf

            <div class="sec_form">
                <div class="sec_head_form">
                    <h3>{{ $title }}</h3>
                    <span>Tambah {{ $title }}</span>
                </div>
                <div class="list_form">
                    <span class="sec_label">Username</span>
                    <input type="text" id="username" name="username" placeholder="Masukkan Username" required>
                </div>
                <div class="list_form">
                    <span class="sec_label">Device ID</span>
                    <input type="text" id="androidid" name="androidid" placeholder="Masukkan Device ID" required>
                </div>
                <div class="list_form">
                    <span class="sec_label">IP Address</span>
                    <input type="text" id="ip" name="ip" placeholder="Masukkan Ip Address" required>
                </div>
                <div class="list_form">
                    <span class="sec_label">Website</span>
                    <select id="website" name="website">
                        @foreach ($datawebsite as $web)
                            <option value="{{ $web->nama }}" {{ $web->nama == $website ? 'selected' : '' }}>
                                {{ $web->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Contactsubmit">Submit</button>
                <a href="/dataevent/index/{{ $jenis_event }}/{{ $website }}" id="cancel"><button type="button"
                        class="sec_botton btn_cancel">Cancel</button></a>
            </div>
        </form>
    </div>
@endsection
