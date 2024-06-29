<div class="sec_box hgi-100">
    <form action="" method="POST" enctype="multipart/form-data" id="form">
        @csrf
        <div class="sec_form">
            <div class="sec_head_form">
                <h3>{{ $title }}</h3>
                <span>Edit {{ $title }} {{ $data->name }}</span>
            </div>
            <div class="list_form">
                <span class="sec_label">Nama</span>
                <input type="hidden" id="id" name="id" value={{ $data->id }}>
                <input type="text" id="name" name="name" placeholder="Masukkan Nama"
                    value={{ $data->name }} required>
            </div>
            <div class="list_form">
                <span class="sec_label">Username</span>
                <input type="text" id="username" name="username" placeholder="Masukkan Username"
                    value={{ $data->username }} disabled required>
            </div>
            <div class="list_form">
                <span class="sec_label">Change Password</span>
                <input type="password" id="password" name="password"
                    placeholder="Kosongkan Jika tidak ingin mengganti password anda">
            </div>
            <div class="list_form">
                <span class="sec_label">Konfirmasi Change Password</span>
                <input type="password" id="cpassword" name="cpassword" placeholder="Masukkan Konfirmasi Password">
            </div>
            <div class="list_form">
                <span class="sec_label">Gambar Profile</span>
                <div class="pilihan_gambar">
                    <input type="file" id="image" name="image">
                    <button type="button" class="img_gallery">Pilih Gallery</button>
                </div>
            </div>
        </div>
        <div class="sec_button_form">
            <button class="sec_botton btn_submit" type="submit" id="Contactsubmit">Submit</button>
            <a href="#" id="cancel"><button type="button" class="sec_botton btn_cancel">Cancel</button></a>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();

        $('#form').submit(function(event) {
            event.preventDefault();

            // Memeriksa apakah password dan konfirmasi password cocok
            const passwordInput = $('#password').val();
            const cpasswordInput = $('#cpassword').val();

            if (passwordInput !== cpasswordInput) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password dan konfirmasi password tidak cocok!',
                });
            } else {
                // Jika password cocok, lanjutkan dengan mengirimkan data formulir ke server

                // Menggunakan variabel FormData untuk mengumpulkan data formulir
                var formData = new FormData(this);

                // Mengambil token CSRF dari meta tag
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Menambahkan token CSRF dalam data formData
                formData.append('_token', csrfToken);

                $.ajax({
                    url: "/profile/update/",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(result) {
                        if (result.errors) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: result.errors
                            });
                        } else {
                            $('.alert-danger').hide();

                            // Tampilkan SweetAlert untuk sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Contactikasi berhasil dikirim!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {

                                // Lakukan perubahan halaman atau tindakan lainnya setelah contact berhasil dikirim
                                $('.aplay_code').load('/user', function() {
                                    adjustElementSize();
                                    localStorage.setItem('lastPage',
                                        '/user');
                                });
                            });
                        }
                    },
                    error: function(xhr) {
                        // Tampilkan SweetAlert untuk kesalahan
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat mengirim contact.'
                        });

                        console.log(xhr.responseText);
                    }
                });
            }
        });

        $(document).off('click', '#cancel').on('click', '#cancel', function(event) {
            event.preventDefault();
            var namabo = $(this).data('namabo');
            $('.aplay_code').load('/generatevoucher', function() {
                adjustElementSize();
                localStorage.setItem('lastPage', '/generatevoucher');
            });
        });
    });
</script>
