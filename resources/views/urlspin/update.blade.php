@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/urlspin/update/{{ $data->id }}" method="POST" id="form">
            @csrf
            <div class="sec_form">
                <div class="sec_head_form">
                    <h3>{{ $title }}</h3>
                    <span>Edit {{ $title }}</span>
                    <input type="hidden" name="id[]" value="{{ $data->id }}">
                </div>
                <div class="list_form">
                    <span class="sec_label">URL</span>
                    <input type="text" id="url" name="url[]" placeholder="Masukkan URL" required
                        value="{{ $data->url }}" {{ $disabled }}>
                </div>

            </div>
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Contactsubmit" {{ $disabled }}>Submit</button>
                <a href="/urlspin/index" id="cancel"><button type="button"
                        class="sec_botton btn_cancel">Cancel</button></a>
            </div>
        </form>
    </div>
@endsection
