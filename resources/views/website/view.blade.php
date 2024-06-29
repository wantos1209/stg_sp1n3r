@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="" method="POST" enctype="multipart/form-data" id="form">
            @csrf

            @foreach ($data['data'] as $index => $item)
                <div class="sec_form">
                    <div class="sec_head_form">
                        <h3>{{ $title }}</h3>
                        <span>Edit {{ $title }}</span>
                        <input type="hidden" name="id[]" value="{{ $item['id'] }}">
                    </div>
                    {{-- <div class="list_form">
                    <span class="sec_label">Hadiah</span>
                    <input type="text" id="website" name="website" placeholder="Masukkan Hadiah" required
                        value="{{ $item['website'] }}" disabled>
                </div> --}}
                    <div class="list_form">
                        <span class="sec_label">Website</span>
                        <input type="text" id="website" name="website" placeholder="Masukkan Website" required
                            value="{{ $item['website'] }}" disabled>
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Livechat</span>
                        <input type="text" id="livechat" name="livechat" placeholder="Masukkan Livechat" required
                            value="{{ $item['livechat'] }}" disabled>
                    </div>

                    <div class="list_form">
                        <span class="sec_label">Whatsapp</span>
                        <input type="text" id="whatsapp" name="whatsapp" placeholder="Masukkan Whatsapp" required
                            value="{{ $item['whatsapp'] }}" disabled>
                    </div>
                </div>
            @endforeach
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Websitesubmit" disabled>Submit</button>
                <a href="/website/index" id="cancel"><button type="button"
                        class="sec_botton btn_cancel">Cancel</button></a>
            </div>
        </form>
    </div>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: '<ul>' +
                    @foreach ($errors->all() as $error)
                        '<li>{{ $error }}</li>' +
                    @endforeach
                '</ul>',
            });
        @endif
    </script>
@endsection
