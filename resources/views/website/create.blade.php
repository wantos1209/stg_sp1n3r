@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/website/store" method="POST" enctype="multipart/form-data" id="form">
            @csrf

            <div class="sec_form">
                <div class="sec_head_form">
                    <h3>{{ $title }}</h3>
                    <span>Tambah {{ $title }}</span>
                </div>
                <div class="list_form">
                    <span class="sec_label">Nama</span>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama website" required>
                </div>
                <div class="list_form">
                    <span class="sec_label">Link</span>
                    <input type="text" id="link" name="link" placeholder="Masukkan link" required>
                </div>
                <div class="list_form">
                    <span class="sec_label">Livechat</span>
                    <input type="text" id="livechat" name="livechat" placeholder="Masukkan link livechat"
                        max="100">
                </div>
                <div class="list_form">
                    <span class="sec_label">Whatsapp</span>
                    <input type="text" id="whatsapp" name="whatsapp" placeholder="Masukkan link whatsapp"
                        max="100">
                </div>
            </div>
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Websitesubmit">Submit</button>
                <a href="/website/index" id="cancel"><button type="button"
                        class="sec_botton btn_cancel">Cancel</button></a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {

            $('#persentase').on('input', function() {
                var persentaseValue = $(this).val();
                // Validasi jika nilai melebihi 100
                if (persentaseValue > 100 || persentaseValue < 0) {

                    if (persentaseValue > 100) {
                        $(this).val(100);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Max persentase adalah 100%',
                        });

                    }

                    if (persentaseValue < 0) {
                        $(this).val(0);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Min persentase adalah 0%',
                        });

                    }

                }
            });

        });
    </script>
@endsection
