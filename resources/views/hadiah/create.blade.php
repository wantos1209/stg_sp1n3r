@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/hadiah/store" method="POST" id="form">
            @csrf

            <div class="sec_form">
                <div class="sec_head_form">
                    <h3>{{ $title }}</h3>
                    <span>Tambah {{ $title }}</span>
                </div>
                <div class="list_form">
                    <span class="sec_label">Hadiah</span>
                    <input type="number" id="hadiah" name="hadiah" placeholder="0" required>
                </div>
                <div class="list_form">
                    <span class="sec_label">Persentase</span>
                    <input type="number" id="persentase" name="persentase" placeholder="0" required min="0"
                        max="100">
                </div>
            </div>
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Contactsubmit">Submit</button>
                <a href="/hadiah/index/" id="cancel"><button type="button"
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
