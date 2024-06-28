@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/dataevent/update/{{ $jenis_event }}/{{ $website }}" method="POST" enctype="multipart/form-data"
            id="form">
            @csrf
            @foreach ($data as $index => $item)
                <div class="sec_form">
                    <div class="sec_head_form">
                        <h3>{{ $title }}</h3>
                        <span>Edit {{ $title }}</span>
                        <input type="hidden" name="id[]" value="{{ $item->id }}">
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Device ID</span>
                        <input type="text" id="androidid" name="androidid[]" placeholder="Masukkan Device ID" required
                            value="{{ $item->androidid }}">
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Kode</span>
                        <input type="text" id="kode" name="kode[]" placeholder="Masukkan Kode" required
                            value="{{ $item->kode }}">
                    </div>
                    <div class="list_form">
                        <span class="sec_label">IP</span>
                        <input type="text" id="ip" name="ip[]" placeholder="Masukkan IP" required
                            value="{{ $item->ip }}">
                    </div>
                    <div class="list_form">
                        <span class="sec_label">username</span>
                        <input type="text" id="username" name="username[]" placeholder="Masukkan Username" required
                            value="{{ $item->username }}">
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Prize</span>
                        <select id="prize_id" name="prize_id[]">
                            <option value="0">Tidak ada hadiah</option>
                            @foreach ($dataprize['data'] as $index => $prize)
                                <option value="{{ $prize['id'] }}">{{ $prize['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="list_form">
                    <span class="sec_label">Hadiah</span>
                    <input type="text" id="hadiah[]" name="hadiah[]" placeholder="Masukkan Hadiah" required
                        value="{{ $item['hadiah'] }}">
                </div> --}}

                </div>
            @endforeach
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Contactsubmit">Submit</button>
                <a href="/dataevent/index/{{ $jenis_event }}/{{ $website }}" id="cancel"><button type="button"
                        class="sec_botton btn_cancel">Cancel</button></a>
            </div>
        </form>
    </div>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
@endsection
