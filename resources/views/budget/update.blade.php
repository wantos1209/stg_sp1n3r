@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/budget/update" method="POST" id="form">
            @csrf
            @foreach ($data as $index => $item)
                <div class="sec_form">
                    <div class="sec_head_form">
                        <h3>{{ $title }}</h3>
                        <span>Edit {{ $title }}</span>
                        <input type="hidden" name="id[]" value="{{ $item['id'] }}">
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Nama Event</span>
                        <input type="text" id="nama_event" name="nama_event[]" placeholder="Masukkan Nama Event" required
                            value="{{ $item['nama_event'] }}">
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Jenis Event</span>
                        <select id="jenis_event" name="jenis_event[]">
                            <option value="0" {{ $item['jenis_event'] == '0' ? 'selected' : '' }}>0</option>
                            <option value="1" {{ $item['jenis_event'] == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ $item['jenis_event'] == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ $item['jenis_event'] == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ $item['jenis_event'] == '4' ? 'selected' : '' }}>4</option>
                        </select>
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Budget</span>
                        <input type="text" id="budget" name="budget[]" placeholder="Masukkan Budget" required
                            value="{{ $item['budget'] }}">
                    </div>

                </div>
            @endforeach
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Contactsubmit">Submit</button>
                <a href="/budget/index" id="cancel"><button type="button"
                        class="sec_botton btn_cancel">Cancel</button></a>
            </div>
        </form>
    </div>
@endsection
