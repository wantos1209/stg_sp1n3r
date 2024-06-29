@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/urlevent/update" method="POST" id="form">
            @csrf
            @foreach ($data as $index => $item)
                <div class="sec_form">
                    <div class="sec_head_form">
                        <h3>{{ $title }}</h3>
                        <span>Edit {{ $title }}</span>
                        <input type="hidden" name="id[]" value="{{ $item['id'] }}">
                    </div>
                    <div class="list_form">
                        <span class="sec_label">URL</span>
                        <input type="text" id="url" name="url[]" placeholder="Masukkan URL" required
                            value="{{ $item['url'] }}">
                    </div>

                </div>
            @endforeach
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Contactsubmit">Submit</button>
                <a href="/urlevent/index" id="cancel"><button type="button"
                        class="sec_botton btn_cancel">Cancel</button></a>
            </div>
        </form>
    </div>
@endsection

<script>
    $(document).ready(function() {

        // $('#form').submit(function(event) {
        //     event.preventDefault();

        //     var formData = new FormData(this);

        //     $('input[type="checkbox"]', this).each(function() {
        //         var isChecked = $(this).is(':checked') ? 1 : 0;
        //         formData.append($(this).attr('name'), isChecked);
        //     });

        //     $.ajax({
        //         url: "/urlevent/update/" + id,
        //         method: "POST",
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         success: function(result) {
        //             if (result.errors) {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Oops...',
        //                     text: result.errors
        //                 });
        //             } else {
        //                 $('.alert-danger').hide();

        //                 Swal.fire({
        //                     icon: 'success',
        //                     title: 'Contactikasi berhasil dikirim!',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 }).then(function() {
        //                     $('.aplay_code').load('/urlevent/index/',
        //                         function() {
        //                             adjustElementSize();
        //                             localStorage.setItem('lastPage',
        //                                 '/urlevent/index/');
        //                         });
        //                 });
        //             }
        //         },
        //         error: function(xhr) {
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'Oops...',
        //                 text: 'Terjadi kesalahan saat mengirim contact.'
        //             });

        //             console.log(xhr.responseText);
        //         }
        //     });
        // });


    });
</script>
