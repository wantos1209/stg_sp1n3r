<div class="sec_box hgi-100">
    <form action="" method="POST" enctype="multipart/form-data" id="form">
        @csrf
        @foreach ($data as $index => $item)
            <div class="sec_form">
                <div class="sec_head_form">
                    <h3>{{ $title }}</h3>
                    <span>Edit {{ $title }}</span>
                    <input type="hidden" name="id[]" value="{{ $item->id }}" {{ $disabled }}>
                </div>
                <div class="list_form">
                    <span class="sec_label">Username Shorten</span>
                    <input type="text" id="username_shorten" name="username_shorten[]"
                        placeholder="Masukkan Username Shorten" required {{ $disabled }}
                        value="{{ $item->username_shorten }}">
                </div>
                <div class="list_form">
                    <span class="sec_label">Link Awal</span>
                    <input type="text" id="link_awal" name="link_awal[]" placeholder="Masukkan Link Awal" required
                        {{ $disabled }} value="{{ $item->link_awal }}">
                </div>
                <div class="list_form">
                    <span class="sec_label">Link Hasil</span>
                    <input type="text" id="link_hasil" name="link_hasil[]" placeholder="Masukkan Link Hasil" required
                        {{ $disabled }} value="{{ $item->link_hasil }}">
                </div>
            </div>
        @endforeach
        <div class="sec_button_form">
            <button class="sec_botton btn_submit" type="submit" id="Contactsubmit" {{ $disabled }}>Submit</button>
            <a href="#" id="cancel"><button type="button" class="sec_botton btn_cancel">Cancel</button></a>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {

        $('#form').submit(function(event) {
            event.preventDefault();

            var formData = new FormData(this);
            $('input[type="checkbox"]', this).each(function() {
                var isChecked = $(this).is(':checked') ? 1 : 0;
                formData.append($(this).attr('name'), isChecked);
            });

            $.ajax({
                url: "/voucher/update",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.errors) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: result.errors
                        });
                    } else {
                        $('.alert-danger').hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Contactikasi berhasil dikirim!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            $('.aplay_code').load('/voucher',
                                function() {
                                    adjustElementSize();
                                    localStorage.setItem('lastPage',
                                        '/voucher');
                                });
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat mengirim contact.'
                    });

                    console.log(xhr.responseText);
                }
            });
        });

        $(document).off('click', '#cancel').on('click', '#cancel', function(event) {
            event.preventDefault();
            var namabo = $(this).data('namabo');
            $('.aplay_code').load('/voucher', function() {
                adjustElementSize();
                localStorage.setItem('lastPage', '/voucher');
            });
        });
    });
</script>
