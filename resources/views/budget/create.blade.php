@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/budget/store" method="POST" id="form">
            @csrf
            <div class="sec_form">
                <div class="sec_head_form">
                    <h3>{{ $title }}</h3>
                    <span>Add {{ $title }}</span>
                </div>
                <div class="list_form">
                    <span class="sec_label">Nama Event</span>
                    <input type="text" id="nama_event" name="nama_event" placeholder="Masukkan Nama Event" required>
                </div>
                <div class="list_form">
                    <span class="sec_label">Jenis Event</span>
                    <select id="jenis_event" name="jenis_event">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="list_form">
                    <span class="sec_label">Budget</span>
                    <input type="text" id="budget" name="budget" placeholder="Masukkan Budget" required>
                </div>

            </div>
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Budget">Submit</button>
                <a href="/budget/index" id="cancel"><button type="button"
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

            $('.js-example-basic-multiple').select2();

        });
    </script>
@endsection
