@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="" method="POST" enctype="multipart/form-data" id="form">
            @csrf

            @foreach ($data as $index => $item)
                <div class="sec_form">
                    <div class="sec_head_form">
                        <h3>{{ $title }}</h3>
                        <span>Edit {{ $title }}</span>
                        <input type="hidden" name="id[]" value="{{ $item['id'] }}">
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Hadiah</span>
                        <input type="text" id="hadiah" name="hadiah" placeholder="Masukkan Hadiah" required
                            value="{{ $item['hadiah'] }}" disabled>
                    </div>

                </div>
            @endforeach
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Contactsubmit" disabled>Submit</button>
                <a href="/hadiah/index/" id="cancel"><button type="button"
                        class="sec_botton btn_cancel">Cancel</button></a>
            </div>
        </form>
    </div>
@endsection