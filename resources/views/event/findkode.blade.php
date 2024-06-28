@extends('layouts.index')

@section('container')
    <style>
        .hadiah-event {
            font-size: 22px;
            font-weight: 600;
        }

        .notif_proses_count {
            color: rgba(var(--rgba-danger)) !important;
        }

        form {
            padding-bottom: unset;
        }

        .d-none {
            display: none;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/themes/prism.css">
    <div class="sec_table">
        <h2>{{ $title }}</h2>
        <div class="group_act_butt">
            <a href="#" id="add-proses">
                {{-- <div class="sec_addnew">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-plus"
                    viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                    <path d="M9 12l6 0"></path>
                    <path d="M12 9l0 6"></path>
                </svg>
                <span>Add New</span>
            </div> --}}
            </a>
            <div class="list_form" style="margin-left: auto;
                    width: max-content;">
                <input type="text" id="search_kode" name="search_kode" min="1" placeholder="Ketik disini ..."
                    required="" style="border: var(--border-primary);" value = "{{ $search }}">
                <button class="sec_botton btn_danger" id="btn-search">CARI</button>
            </div>

            <div class="all_act_butt">
                <a href="#" id="approve-proses">
                    <div class="sec_edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                        <span>Approve</span>
                    </div>
                </a>
                <a href="#" id="batal-proses">
                    <div class="sec_delete">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 6l-12 12" />
                            <path d="M6 6l12 12" />
                        </svg>
                        <span>Batal</span>
                    </div>
                </a>
            </div>
        </div>
        <table>
            <tbody>
                <tr class="head_table">
                    {{-- <th class="check_box">
                    <input type="checkbox" id="myCheckbox" name="myCheckbox">
                </th> --}}
                    <th>Username</th>
                    {{-- <th>Hadiah</th> --}}
                    <th style="width: 100%">{{ $jenis_event == '0' ? 'URL Spin' : 'Hadiah' }}</th>
                    <th style="width: 100%">Keterangan</th>
                    <th>Website</th>
                    <th>Device ID</th>
                    {{-- <th>Guest ID</th> --}}
                    <th>Kode</th>

                    <th>IP</th>
                    <th>Status Klaim</th>
                    <th>Status Approve</th>
                    <th>Approved By</th>
                    <th>Action</th>
                </tr>
                <tr class="filter_row">
                </tr>
                @foreach ($data as $index => $d)
                    <tr>
                        <td><span class="name hadiah-event">{{ $d['username'] }}</span></td>
                        {{-- <td><span
                class="name hadiah-event">{{ $d['isklaim'] == '1' && $d['status'] != '2' ? $d['hadiah'] : '{Random}' }}</span>
        </td> --}}
                        <td><span class="name">
                                @if ($jenis_event == '0')
                                    <form method="POST" class="form-url" data-index="{{ $index }}"
                                        data-website="{{ $d['website'] }}">
                                        @csrf
                                        <input type="hidden" class="id" name="id" value="{{ $d['id'] }}">
                                        <input type="text" class="url_spinner" name="url_spinner"
                                            placeholder="Masukkan url_spinner" required="" style="width: 50%"
                                            value="{{ $d['url_spinner'] }}" {{ $d['url_spinner'] == '' ? '' : 'readonly' }}
                                            data-url_spinner="{{ $d['url_spinner'] }}">
                                        <button class="sec_botton btn_secondary wdi-20 btn_submit btn-submit-url d-none"
                                            type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-check" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l5 5l10 -10" />
                                            </svg>
                                        </button>
                                        <button class="sec_botton btn_warning wdi-20 btn_submit btn-cancel-url d-none"
                                            type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M18 6l-12 12" />
                                                <path d="M6 6l12 12" />
                                            </svg>
                                        </button>
                                        <button
                                            class="sec_botton btn_primary wdi-20 btn_submit btn-edit-url {{ $d['url_spinner'] == '' ? 'd-none' : '' }}"
                                            type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-edit" viewBox="0 0 24 24"
                                                stroke-width="1.5" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                </path>
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                </path>
                                                <path d="M16 5l3 3"></path>
                                            </svg>
                                        </button>
                                        <button
                                            class="sec_botton btn_danger wdi-20 btn_submit btn-delete-url {{ $d['url_spinner'] == '' ? 'd-none' : '' }}"
                                            type="button" data-website="{{ $d['website'] }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-trash" viewBox="0 0 24 24"
                                                stroke-width="1.5" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 7l16 0"></path>
                                                <path d="M10 11l0 6"></path>
                                                <path d="M14 11l0 6"></path>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    {{ $d['isklaim'] == '1' && $d['status'] != '2' ? $d['hadiah'] : '{Random}' }}
                                @endif
                            </span>
                        </td>
                        <td><span class="name">{{ $d['keterangan'] }}</td>
                        <td><span class="name">{{ $d['website'] }}</span></td>
                        <td><span class="name">{{ $d['androidid'] }}</span></td>
                        {{-- <td><span class="name">{{ 'guest_' . substr($d['androidid'], -5) }}</span></td> --}}
                        <td><span class="name">{{ $d['kode'] }}</span></td>

                        <td><span class="name">{{ $d['ip'] }}</span></td>
                        <td><span class="name">{{ $d['isklaim'] == '1' ? 'Sudah Klaim' : 'Belum Klaim' }}</span></td>
                        <td><span class="name ">
                                @php
                                    if ($d['isklaim'] == '0') {
                                        echo '<button class="sec_botton btn_secondary btn-width">BL KLM</button>';
                                    } elseif ($d['status'] == 0) {
                                        if ($d['jenis_event'] == '1' && $d['vote'] == '0') {
                                            echo '<button class="sec_botton btn_default btn-width">VOTE</button>';
                                        } else {
                                            echo '<button class="sec_botton btn_primary btn-width">WAIT</button>';
                                        }
                                    } elseif ($d['status'] == 1) {
                                        echo '<button class="sec_botton btn_success btn-width">APRV</button>';
                                    } elseif ($d['status'] == 2) {
                                        echo '<button class="sec_botton btn_danger btn-width">BATAL</button>';
                                    }
                                @endphp
                            </span>
                        </td>
                        <td style="overflow: unset">
                            <span class="name">
                                {{ $d['approve_by'] }}<br>
                                {{ date('d-m-Y H:i:s', strtotime($d['updated_at'])) }}
                            </span>
                        </td>


                        {{-- <td><span class="name">{{ date('d-m-Y H:i:s', strtotime($d["tgl_berita)) }}</span></td> --}}

                        <td class="kolom_action">
                            <div class="dot_action">
                                <span>•</span>
                                <span>•</span>
                                <span>•</span>
                            </div>
                            <div class="action_crud" id="1" style="display: none;">
                                <a href="/findkodeview/view/{{ $jenis_event }}/{{ $d['website'] }}/{{ $d['id'] }}/{{ $search }}"
                                    id="view">
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
                                <a href="/findkodeedit/edit/{{ $jenis_event }}/{{ $d['website'] }}/{{ $d['id'] }}/{{ $search }}"
                                    id="edit" data-id="{{ $d['id'] }}" data-website="{{ $d['website'] }}">
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
                                @if ($d['status'] > 0)
                                    {{-- <a href="#" id="waiting" data-id="{{ $d['id'] }}"
                        data-website="{{ $d['website'] }}">
                        <div class="list_action">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-pause"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M20.942 13.018a9 9 0 1 0 -7.909 7.922" />
                                <path d="M12 7v5l2 2" />
                                <path d="M17 17v5" />
                                <path d="M21 17v5" />
                            </svg>
                            <span>Waiting</span>
                        </div>
                    </a> --}}
                                @endif
                                <a href="#" id="delete" data-id="{{ $d['id'] }}"
                                    data-website="{{ $d['website'] }}">
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


    <script>
        // $(document).ready(function() {
        //     $('#search_website').change(function(event) {
        //         event.preventDefault();
        //         // var website = $(this).val();
        //         var jenis_event = "<?= $jenis_event ?>";

        //         $('.aplay_code').load('/prosesevent/indexproses/' + jenis_event, function() {
        //             adjustElementSize();
        //             localStorage.setItem('lastPage', '/prosesevent/indexproses/' + jenis_event);
        //         });
        //     });
        // });


        // $(document).ready(function() {
        //     // Event handler untuk checkbox dengan ID myCheckbox
        //     $('#myCheckbox').change(function() {
        //         // Mendapatkan status ceklis checkbox myCheckbox
        //         var isChecked = $(this).is(':checked');

        //         $('tbody tr:not([style="display: none;"]) [id^="myCheckbox-"]').prop('checked',
        //             isChecked);
        //     });
        // });

        $(document).ready(function() {
            // Sembunyikan elemen dengan ID update saat halaman dimuat
            // $('#update').hide();

            // $('#approve-proses').off('click').click(function(event) {
            //     event.preventDefault();

            //     var checkedValues = [];
            //     $('input[id^="myCheckbox-"]:checked').each(function() {
            //         var value = $(this).data('id');
            //         checkedValues.push(value);
            //     });
            //     if (checkedValues == 0) {
            //         Swal.fire({
            //             icon: 'warning',
            //             title: 'Silahkan pilih Data!',
            //             showConfirmButton: false,
            //             timer: 1500
            //         });
            //     }


            //     var parameterString = $.param({
            //         'values[]': checkedValues
            //     }, true);
            //     var website = $('#search_website').val();
            //     $('.aplay_code').load('/dataevent/approve/' + website + '/' + parameterString,
            //         function() {
            //             adjustElementSize();
            //             localStorage.setItem('lastPage', '/dataevent/approve/' + website +
            //                 '/' +
            //                 parameterString);
            //         });
            // });

            // $('#approve-proses').off('click').click(function(event) {
            //     event.preventDefault();

            //     var csrfToken = $('meta[name="csrf-token"]').attr('content');
            //     var website = $('#search_website').val();

            //     var checkedValues = [];
            //     $('input[id^="myCheckbox-"]:checked').each(function() {
            //         var value = $(this).data('id');
            //         checkedValues.push(value);
            //     });

            //     if (checkedValues.length === 0) {
            //         Swal.fire({
            //             icon: 'warning',
            //             title: 'Silahkan pilih Data!',
            //             showConfirmButton: false,
            //             timer: 1500
            //         });
            //     } else {
            //         Swal.fire({
            //             icon: 'question',
            //             title: 'Apakah Anda yakin?',
            //             text: 'Anda akan mengaprove data ini.',
            //             showCancelButton: true,
            //             confirmButtonText: 'Ya, Setujui!',
            //             cancelButtonText: 'Batal'
            //         }).then((result) => {
            //             if (result.isConfirmed) {
            //                 executeAjaxRequest(csrfToken, website, checkedValues, '1');
            //             }
            //         });
            //     }
            // });

            // $('#batal-proses').off('click').click(function(event) {
            //     event.preventDefault();

            //     var csrfToken = $('meta[name="csrf-token"]').attr('content');
            //     var website = $('#search_website').val();

            //     var checkedValues = [];
            //     $('input[id^="myCheckbox-"]:checked').each(function() {
            //         var value = $(this).data('id');
            //         checkedValues.push(value);
            //     });

            //     if (checkedValues.length === 0) {
            //         Swal.fire({
            //             icon: 'warning',
            //             title: 'Silahkan pilih Data!',
            //             showConfirmButton: false,
            //             timer: 1500
            //         });
            //     } else {
            //         Swal.fire({
            //             icon: 'question',
            //             title: 'Apakah Anda yakin?',
            //             text: 'Anda akan membatalkan data ini.',
            //             showCancelButton: true,
            //             confirmButtonText: 'Ya, Setujui!',
            //             cancelButtonText: 'Batal'
            //         }).then((result) => {
            //             if (result.isConfirmed) {
            //                 executeAjaxRequest(csrfToken, website, checkedValues, '2');
            //             }
            //         });
            //     }
            // });

            // function executeAjaxRequest(csrfToken, website, checkedValues, status) {
            //     var parameterString = $.param({
            //         'values[]': checkedValues
            //     }, true);

            //     var requestData = {
            //         '_token': csrfToken,
            //         'id': parameterString,
            //     };

            //     var jenis_event = "<?= $jenis_event ?>";

            //     $.ajax({
            //         url: "/dataevent/changestatus/" + jenis_event + '/' + website + '/' + status,
            //         method: "POST",
            //         data: requestData,
            //         success: function(result) {
            //             if (result.errors) {
            //                 Swal.fire({
            //                     icon: 'error',
            //                     title: 'Oops...',
            //                     text: result.errors
            //                 });
            //             } else {
            //                 $('.alert-danger').hide();
            //                 if (status == '1') {
            //                     Swal.fire({
            //                         icon: 'success',
            //                         title: 'Data berhasil diapprove!',
            //                         showConfirmButton: false,
            //                         timer: 1500
            //                     }).then(function() {
            //                         $('.aplay_code').load('/prosesevent/indexproses/' +
            //                             jenis_event + '/' + website,
            //                             function() {
            //                                 adjustElementSize();
            //                                 localStorage.setItem('lastPage',
            //                                     '/prosesevent/indexproses/' +
            //                                     jenis_event + '/' + website);
            //                             });
            //                     });
            //                 } else {
            //                     Swal.fire({
            //                         icon: 'success',
            //                         title: 'Data berhasil dibatalkan!',
            //                         showConfirmButton: false,
            //                         timer: 1500
            //                     }).then(function() {
            //                         $('.aplay_code').load('/prosesevent/indexproses/' + website,
            //                             function() {
            //                                 adjustElementSize();
            //                                 localStorage.setItem('lastPage',
            //                                     '/prosesevent/indexproses/' + website);
            //                             });
            //                     });
            //                 }
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
            // }


            // $(document).off('click', '#add-proses').on('click', '#add-proses', function(event) {
            //     event.preventDefault();
            //     $('.aplay_code').load('/dataevent/add', function() {
            //         adjustElementSize();
            //         localStorage.setItem('lastPage', '/dataevent/add');
            //     });
            // });
            // $(document).on('click', '#delete', function(event) {
            //     event.preventDefault();
            //     $('.aplay_code').load('/dataevent/delete', function() {
            //         adjustElementSize();
            //         localStorage.setItem('lastPage', '/dataevent/delete');
            //     });
            // })


            // $(document).off('click', '#view').on('click', '#view', function(event) {
            //     event.preventDefault();
            //     var id = $(this).data('id');
            //     $('.aplay_code').empty();
            //     $('.aplay_code').load('/dataevent/', function() {
            //         adjustElementSize();
            //         localStorage.setItem('lastPage', '/dataevent');
            //     });
            // });


            // $(document).off('click', '#edit').on('click', '#edit', function(event) {
            //     event.preventDefault();
            //     var id = $(this).data('id');
            //     $('.aplay_code').empty();
            //     $('.aplay_code').load('/dataevent', function() {
            //         adjustElementSize();
            //         localStorage.setItem('lastPage', '/dataevent');
            //     });
            // });

            // $(document).on('click', '#delete', function(event) {
            //     event.preventDefault();

            //     var id = $(this).data('id');
            //     var url =
            //         "/dataevent"; // Ubah URL sesuai dengan endpoint delete yang sesuai

            //     Swal.fire({
            //         title: 'Apakah Anda yakin ingin menghapus data ini?',
            //         text: "Data yang dihapus tidak dapat dikembalikan!",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#d33',
            //         cancelButtonColor: '#3085d6',
            //         confirmButtonText: 'Ya, Hapus!',
            //         cancelButtonText: 'Batal'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $.ajax({
            //                 url: url,
            //                 method: 'DELETE',
            //                 data: {
            //                     _token: '{{ csrf_token() }}',
            //                     values: id
            //                 },
            //                 success: function(result) {
            //                     // Tampilkan SweetAlert untuk sukses
            //                     Swal.fire({
            //                         icon: 'success',
            //                         title: 'Data berhasil dihapus!',
            //                         showConfirmButton: false,
            //                         timer: 1500
            //                     }).then(function() {
            //                         // Lakukan perubahan halaman atau tindakan lainnya setelah data berhasil dihapus
            //                         $('.aplay_code').load(
            //                             '/dataevent/index/',
            //                             function() {
            //                                 adjustElementSize();
            //                                 localStorage
            //                                     .setItem(
            //                                         'lastPage',
            //                                         '/dataevent/index/'
            //                                     );
            //                             });
            //                     });
            //                 },
            //                 error: function(xhr) {
            //                     // Tampilkan SweetAlert untuk kesalahan
            //                     Swal.fire({
            //                         icon: 'error',
            //                         title: 'Oops...',
            //                         text: 'Terjadi kesalahan saat menghapus data.'
            //                     });

            //                     console.log(xhr.responseText);
            //                 }
            //             });
            //         }
            //     });
            // });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Sembunyikan elemen dengan ID update saat halaman dimuat
            // $('#update').hide();

            // Event handler untuk checkbox myCheckbox
            $('#myCheckbox, [id^="myCheckbox-"]').change(function() {
                // Periksa apakah setidaknya satu checkbox tercentang
                var isChecked = $('#myCheckbox:checked, [id^="myCheckbox-"]:checked').length >
                    0;

                // Tampilkan atau sembunyikan elemen update berdasarkan status checkbox tercentang
                if (isChecked) {
                    $('.all_act_butt').css('display', 'flex');
                } else {
                    $('.all_act_butt').hide();
                }
            });

            $('.url_spinner').on('input', function() {
                const form = $(this).closest('.form-url');
                const inputValue = $(this).val();
                const submitButton = form.find('.btn-submit-url');
                const cancelButton = form.find('.btn-cancel-url');
                const editButton = form.find('.btn-edit-url');
                const deleteButton = form.find('.btn-delete-url');
                const url_spinnerInput = form.find('.url_spinner');
                const dataUserklaim = url_spinnerInput.data('url_spinner');

                if (inputValue !== '') {
                    submitButton.show();
                    cancelButton.show();
                    editButton.hide();
                    deleteButton.hide();
                } else {
                    if (dataUserklaim == '') {
                        submitButton.hide();
                        cancelButton.hide();
                        editButton.hide();
                        deleteButton.hide();
                    } else {
                        submitButton.show();
                        cancelButton.show();
                        editButton.hide();
                        deleteButton.hide();
                        url_spinnerInput.val(dataUserklaim);
                    }

                }
            });

            $('.btn-cancel-url').on('click', function() {
                const form = $(this).closest('.form-url');
                const url_spinnerInput = form.find('.url_spinner');
                const submitButton = form.find('.btn-submit-url');
                const cancelButton = form.find('.btn-cancel-url');
                const editButton = form.find('.btn-edit-url');
                const deleteButton = form.find('.btn-delete-url');
                const dataUserklaim = url_spinnerInput.data('url_spinner');

                if (dataUserklaim == '') {
                    url_spinnerInput.val('');
                    submitButton.hide();
                    cancelButton.hide();
                    deleteButto.hide();
                    editButton.hide();
                    url_spinnerInput.addClass('readonly');
                    url_spinnerInput.prop('readonly', true);
                } else {
                    url_spinnerInput.val(dataUserklaim);
                    submitButton.hide();
                    cancelButton.hide();
                    editButton.show();
                    deleteButton.show();
                    url_spinnerInput.addClass('readonly');
                    url_spinnerInput.prop('readonly', true);
                }


            });


            $('.form-url').on('submit', function(e) {
                e.preventDefault();
                var form = $(this); // Ambil form yang sedang disubmit
                var url_spinnerInput = form.find('.url_spinner');
                var url_spinner = form.find('.url_spinner').val();
                var id = form.find('.id').val();
                var submitButton = form.find('.btn-submit-url');
                var cancelButton = form.find('.btn-cancel-url');
                var editButton = form.find('.btn-edit-url');
                var deleteButton = form.find('.btn-delete-url');
                var website = form.data('website');
                var jenis_event = "<?= $jenis_event ?>";

                if (url_spinner !== '') {
                    $.ajax({
                        url: '/event/updateurl_spinner/' + jenis_event + '/' + website + '/' + id,
                        method: 'POST',
                        data: {
                            id: id,
                            url_spinner: url_spinner,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            submitButton.hide();
                            cancelButton.hide();
                            editButton.show();
                            deleteButton.show();

                            url_spinnerInput.addClass('readonly');
                            url_spinnerInput.prop('readonly', true);
                            url_spinnerInput.data('url_spinner', url_spinner);

                            // $('#tr_' + id).remove();
                            $('.url_spinner-span_' + id).text(url_spinner);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error(errorThrown);
                        }
                    });
                }
            });

            $('.btn-edit-url').on('click', function() {
                const form = $(this).closest('.form-url');
                const url_spinnerInput = form.find('.url_spinner');
                const submitButton = form.find('.btn-submit-url');
                const cancelButton = form.find('.btn-cancel-url');
                const editButton = form.find('.btn-edit-url');
                const deleteButton = form.find('.btn-delete-url');

                submitButton.show();
                cancelButton.hide();
                editButton.hide();
                deleteButton.hide();

                // Menghapus atribut "readonly" dari input url_spinner
                url_spinnerInput.removeClass('readonly');
                url_spinnerInput.prop('readonly', false);

                // Fokus pada input url_spinner
                url_spinnerInput.focus();
            });

            $('.btn-delete-url').on('click', function() {
                var form = $(this).closest('.form-url');
                var url_spinnerInput = form.find('.url_spinner');
                var url_spinner = form.find('.url_spinner').val();
                var id = form.find('.id').val();
                var submitButton = form.find('.btn-submit-url');
                var cancelButton = form.find('.btn-cancel-url');
                var editButton = form.find('.btn-edit-url');
                var deleteButton = form.find('.btn-delete-url');
                var datatglklaim = $(this).data('tglklaim');
                var website = $(this).data('website');
                var jenis_event = "<?= $jenis_event ?>";

                Swal.fire({
                    title: 'Apakah anda ingin menghapus nomor rekeing voucher?',
                    // text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/event/updateurl_spinner/' + jenis_event + '/' + website +
                                '/' + id,
                            method: 'POST',
                            data: {
                                id: id,
                                url_spinner: '',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                submitButton.hide();
                                cancelButton.hide();
                                editButton.hide();
                                deleteButton.hide();

                                url_spinnerInput.removeClass('readonly');
                                url_spinnerInput.prop('readonly', false);
                                url_spinnerInput.val('');
                                url_spinnerInput.data('url_spinner', '');
                                if (datatglklaim == '' || datatglklaim == null) {
                                    $('#tr_' + id).remove();
                                }

                                $('.url_spinner-span_' + id).text('');
                                console.log(response);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error(errorThrown);
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#delete', function(event) {
                event.preventDefault();

                var id = $(this).data('id');
                var website = $(this).data('website');
                var search = "{{ $search }}";
                var jenis_event = "<?= $jenis_event ?>";
                var url =
                    "/findkodedelete/delete/" + jenis_event + '/' +
                    website; // Ubah URL sesuai dengan endpoint delete yang sesuai


                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus data ini?',
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
                                        '/findkodeevent/' + jenis_event +
                                        '/' + search,
                                        function() {
                                            adjustElementSize();
                                            localStorage.setItem('lastPage',
                                                '/findkodeevent/' +
                                                jenis_event + '/' +
                                                search);
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


            $(document).on('click', '#waiting', function(event) {
                event.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var website = $(this).data('website');

                var checkedValues = [];
                var value = $(this).data('id');
                checkedValues.push(value);

                Swal.fire({
                    icon: 'question',
                    title: 'Apakah Anda yakin?',
                    text: 'Anda akan mengembalikan data ini menjadi waiting kembali.',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Setujui!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        executeAjaxRequest(csrfToken, website, checkedValues, '0');
                    }
                });
            });

            function executeAjaxRequest(csrfToken, website, checkedValues, status) {
                var parameterString = $.param({
                    'values[]': checkedValues
                }, true);

                var requestData = {
                    '_token': csrfToken,
                    'id': parameterString,
                };

                var jenis_event = "<?= $jenis_event ?>";

                $.ajax({
                    url: "/dataevent/changestatus/" + jenis_event + '/' + website + '/' + status,
                    method: "POST",
                    data: requestData,
                    success: function(result) {
                        if (result.errors) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: result.errors
                            });
                        } else {
                            $('.alert-danger').hide();
                            if (status == '1') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil diapprove!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    $('.aplay_code').load('/prosesevent/indexproses/' +
                                        jenis_event + '/' + website,
                                        function() {
                                            adjustElementSize();
                                            localStorage.setItem('lastPage',
                                                '/prosesevent/indexproses/' +
                                                jenis_event + '/' + website);
                                        });
                                });
                            } else if (status == '0') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil dikembalikan!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    $('.aplay_code').load('/prosesevent/indexproses/' +
                                        jenis_event + '/' + website,
                                        function() {
                                            adjustElementSize();
                                            localStorage.setItem('lastPage',
                                                '/prosesevent/indexproses/' +
                                                jenis_event + '/' + website);
                                        });
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil dibatalkan!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    $('.aplay_code').load('/prosesevent/indexproses/' +
                                        jenis_event + '/' + website,
                                        function() {
                                            adjustElementSize();
                                            localStorage.setItem('lastPage',
                                                '/prosesevent/indexproses/' +
                                                jenis_event + '/' + website);
                                        });
                                });
                            }
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
            }

            function performSearch() {
                var searchQuery = $('#search_kode').val();
                var jenis_event = "<?= $jenis_event ?>";

                var currentUrl = window.location.href;
                var newUrl = '/findkodeevent/' + jenis_event + '/' + encodeURIComponent(searchQuery);
                window.location.href = newUrl;
            }

            $('#btn-search').on('click', function() {
                performSearch();
            });

            $('#search_kode').on('keypress', function(event) {
                if (event.which === 13) {
                    event.preventDefault();
                    performSearch();
                }
            });

        });
    </script>
@endsection
