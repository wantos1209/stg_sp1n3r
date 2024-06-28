@extends('layouts.index')

@section('container')
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/themes/prism.css">
    <div class="sec_table">
        <h2>{{ $title }}</h2>
        <div class="group_act_butt">
            <a href="/user/add" id="add-user">
                <div class="sec_addnew">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-plus"
                        viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                        <path d="M9 12l6 0"></path>
                        <path d="M12 9l0 6"></path>
                    </svg>
                    <span>Add New</span>
                </div>
            </a>
            <div class="all_act_butt">
                <a href="#" id="update-user">
                    <div class="sec_edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                            viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                            <path d="M16 5l3 3"></path>
                        </svg>
                        <span>Edit</span>
                    </div>
                </a>
                <a href="#" id="delete-user">
                    <div class="sec_delete">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                            viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 7l16 0"></path>
                            <path d="M10 11l0 6"></path>
                            <path d="M14 11l0 6"></path>
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                        </svg>
                        <span>Delete</span>
                    </div>
                </a>
            </div>
        </div>
        <table>
            <tbody>
                <tr class="head_table">
                    <th class="check_box">
                        <input type="checkbox" id="myCheckbox" name="myCheckbox">
                    </th>
                    <th>Name</th>
                    <th>Divisi</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
                <tr class="filter_row">
                    <td></td>
                    <td>
                        <div class="grubsearchtable">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                                viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                <path d="M21 21l-6 -6"></path>
                            </svg>
                            <input type="text" placeholder="Cari data..." id="searchData-name">
                        </div>
                    </td>
                    <td>
                        <div class="grubsearchtable">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                                viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                <path d="M21 21l-6 -6"></path>
                            </svg>
                            <input type="text" placeholder="Cari data..." id="searchData-name">
                        </div>
                    </td>
                    <td>
                        <div class="grubsearchtable">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                                viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                <path d="M21 21l-6 -6"></path>
                            </svg>
                            <input type="text" placeholder="Cari data..." id="searchData-name">
                        </div>
                    </td>

                    <td></td>
                </tr>
                @foreach ($data as $index => $d)
                    <tr>
                        <td class="check_box">
                            <input type="checkbox" id="myCheckbox-{{ $index }}" name="myCheckbox-{{ $index }}"
                                data-id=" {{ $d->id }}">
                        </td>
                        <td><span class="name">{{ $d->name }}</span></td>
                        <td><span class="name">{{ $d->divisi }}</span></td>
                        <td><span class="name">{{ $d->username }}</span></td>
                        {{-- <td><span class="name">{{ date('d-m-Y H:i:s', strtotime($d->tgl_berita)) }}</span></td> --}}

                        <td class="kolom_action">
                            <div class="dot_action">
                                <span>•</span>
                                <span>•</span>
                                <span>•</span>
                            </div>
                            <div class="action_crud" id="1" style="display: none;">
                                <a href="#" id="view" data-id="{{ $d['id'] }}">
                                    <div class="list_action">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye"
                                            viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                            </path>
                                        </svg>
                                        <span>View</span>
                                    </div>
                                </a>
                                <a href="/user/edit/{{ $d['id'] }}" id="edit">
                                    <div class="list_action">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-edit-circle" viewBox="0 0 24 24"
                                            stroke-width="1.5" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z">
                                            </path>
                                            <path d="M16 5l3 3"></path>
                                            <path d="M9 7.07a7 7 0 0 0 1 13.93a7 7 0 0 0 6.929 -6"></path>
                                        </svg>
                                        <span>Edit</span>
                                    </div>
                                </a>
                                <a href="#" id="delete" data-id="{{ $d['id'] }}">
                                    <div class="list_action">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                            viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 7l16 0"></path>
                                            <path d="M10 11l0 6"></path>
                                            <path d="M14 11l0 6"></path>
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                        </svg>
                                        <span>Delete</span>
                                    </div>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            // Event handler untuk checkbox dengan ID myCheckbox
            $('#myCheckbox').change(function() {
                // Mendapatkan status ceklis checkbox myCheckbox
                var isChecked = $(this).is(':checked');

                $('tbody tr:not([style="display: none;"]) [id^="myCheckbox-"]').prop('checked', isChecked);
            });
        });

        $(document).ready(function() {
            // Sembunyikan elemen dengan ID update saat halaman dimuat
            // $('#update').hide();

            // Event handler untuk checkbox myCheckbox
            $('#myCheckbox, [id^="myCheckbox-"]').change(function() {
                // Periksa apakah setidaknya satu checkbox tercentang
                var isChecked = $('#myCheckbox:checked, [id^="myCheckbox-"]:checked').length > 0;

                // Tampilkan atau sembunyikan elemen update berdasarkan status checkbox tercentang
                if (isChecked) {
                    // $('#update').show();
                } else {
                    // $('#update').hide();
                }
            });

            $('#update-user').off('click').click(function(event) {
                event.preventDefault();

                var checkedValues = [];
                $('input[id^="myCheckbox-"]:checked').each(function() {
                    var value = $(this).data('id');
                    checkedValues.push(value);
                });
                if (checkedValues == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Silahkan pilih Data!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }


                var parameterString = $.param({
                    'values[]': checkedValues
                }, true);
                console.log(parameterString);
                $('.aplay_code').load('/user/edit/' + parameterString, function() {
                    adjustElementSize();
                    localStorage.setItem('lastPage', '/user/edit/' +
                        parameterString);
                });
            });


            $(document).on('click', '#delete-user', function(event) {
                event.preventDefault();

                var checkedValues = [];
                $('input[id^="myCheckbox-"]:checked').each(function() {
                    var value = $(this).data('id');
                    checkedValues.push(value);
                });

                if (checkedValues.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Silahkan pilih Data!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return; // Menghentikan eksekusi jika tidak ada item yang dipilih
                }

                var parameterString = $.param({
                    'values[]': checkedValues
                }, true);
                var url =
                    "/user/delete/";

                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus user ini ?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                values: checkedValues
                            },
                            success: function(result) {
                                // Tampilkan SweetAlert untuk sukses
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil dihapus!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    // Lakukan perubahan halaman atau tindakan lainnya setelah data berhasil dihapus
                                    $('.aplay_code').load(
                                        '/user',
                                        function() {
                                            adjustElementSize();
                                            localStorage.setItem('lastPage',
                                                '/user');
                                        });
                                });
                            },
                            error: function(xhr) {
                                // Tampilkan SweetAlert untuk kesalahan
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Terjadi kesalahan saat menghapus data.'
                                });

                                console.log(xhr.responseText);
                            }
                        });
                    }
                });
            });
            $(document).off('click', '#view').on('click', '#view', function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                $('.aplay_code').empty();
                $('.aplay_code').load('/user/view/' + id, function() {
                    adjustElementSize();
                    localStorage.setItem('lastPage', '/user/view/' + id);
                });
            });


            // $(document).off('click', '#edit').on('click', '#edit', function(event) {
            //     event.preventDefault();
            //     var id = $(this).data('id');
            //     $('.aplay_code').empty();
            //     $('.aplay_code').load('/user/edit/' + id, function() {
            //         adjustElementSize();
            //         localStorage.setItem('lastPage', '/user/edit/' + id);
            //     });
            // });

            $(document).on('click', '#delete', function(event) {
                event.preventDefault();

                var id = $(this).data('id');
                var url =
                    "/user/delete/"; // Ubah URL sesuai dengan endpoint delete yang sesuai

                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus User ini?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                values: id
                            },
                            success: function(result) {
                                // Tampilkan SweetAlert untuk sukses
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil dihapus!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    // Lakukan perubahan halaman atau tindakan lainnya setelah data berhasil dihapus
                                    $('.aplay_code').load(
                                        '/user',
                                        function() {
                                            adjustElementSize();
                                            localStorage.setItem('lastPage',
                                                '/user');
                                        });
                                });
                            },
                            error: function(xhr) {
                                // Tampilkan SweetAlert untuk kesalahan
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Terjadi kesalahan saat menghapus data.'
                                });

                                console.log(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
