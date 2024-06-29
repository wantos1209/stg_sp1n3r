@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/listprize/store" method="POST" id="form">
            @csrf

            <div class="sec_form">
                <div class="sec_head_form">
                    <h3>{{ $title }}</h3>
                    <span>Tambah {{ $title }}</span>
                </div>
                <div class="list_form">
                    <span class="sec_label">Nama Prize</span>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama prize" required>
                </div>
                <div class="list_form">
                    <span class="sec_label">Unit</span>
                    <input type="number" id="unit" name="unit" placeholder="0" min="0" required>
                </div>
            </div>
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Contactsubmit">Submit</button>
                <a href="/listprize/index" id="cancel"><button type="button"
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
