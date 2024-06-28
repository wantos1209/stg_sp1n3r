@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/user/update" method="POST" enctype="multipart/form-data" id="form">
            @csrf
            @foreach ($data as $index => $item)
                <div class="sec_form">
                    <div class="sec_head_form">
                        <h3>{{ $title }}</h3>
                        <span>Edit {{ $title }}</span>
                        <input type="hidden" name="id[]" value="{{ $item->id }}" {{ $disabled }}>
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Nama</span>
                        <input type="text" id="name" name="name[]" placeholder="Masukkan Nama" {{ $disabled }}
                            value={{ $item->name }} required>
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Divisi</span>
                        <select id="divisi" name="divisi[]" {{ $disabled }}>
                            @if (auth()->user()->divisi === 'superadmin' || auth()->user()->divisi === 'admin')
                                <option value="superadmin">superadmin</option>
                            @endif
                            @foreach ($datawebsite as $website)
                                <option value="{{ $website->nama }}"
                                    {{ $website->nama == $item->divisi ? 'selected' : '' }}>
                                    {{ $website->nama }}
                                </option>
                            @endforeach
                            <option value="admin" {{ $item->divisi == 'admin' ? 'selected' : '' }}>admin</option>
                        </select>
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Username</span>
                        <input type="text" id="username" name="username[]" placeholder="Masukkan Username"
                            {{ $disabled }} value={{ $item->username }} required>
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Password</span>
                        <input type="password" id="password" name="password[]"
                            placeholder="Masukkan Password Jika Ingin Mengganti Password , Kosongkan jika tidak"
                            {{ $disabled }}>
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Konfirmasi Password</span>
                        <input type="password" id="cpassword" name="cpassword[]" placeholder="Masukkan Konfirmasi Password"
                            {{ $disabled }}>
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Gambar Profile</span>
                        <div class="pilihan_gambar">
                            <input type="file" id="image" name="image[]" {{ $disabled }}>
                            <button type="button" class="img_gallery">Pilih Gallery</button>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Contactsubmit" {{ $disabled }}>Submit</button>
                <a href="/user" id="cancel"><button type="button" class="sec_botton btn_cancel">Cancel</button></a>
            </div>
        </form>
    </div>
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan:',
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#form').on('submit', function(e) {
                var valid = true;
                $('[name="password[]"]').each(function(index) {
                    var password = $(this).val();
                    var cpassword = $('[name="cpassword[]"]').eq(index).val();

                    if (password !== cpassword) {
                        valid = false;
                        alert('Password dan Konfirmasi Password tidak sama');
                        return false;
                    }
                });

                if (!valid) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
