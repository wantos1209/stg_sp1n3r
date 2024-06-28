@extends('layouts.index')

@section('container')
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/themes/prism.css">
    <style>
        .d-none {
            display: none;
        }

        .d-opacity {
            opacity: 0;
        }

        .btn-back {
            width: 10%;
        }

        .form-kode {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 5px;
            padding-bottom: unset;
        }

        .form-kode svg {
            stroke: rgba(var(--rgba-white));
        }

        .form-kode button svg {
            position: relative;
            right: 8px;
            stroke: rgba(var(--rgba-white));
        }

        .form-kode input {
            padding: 10px;
            text-align: center;
        }

        .name {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .name form {
            padding-bottom: unset;
        }

        .name.d-opacity {
            font-size: 0px;
        }
    </style>
    <div class="sec_table">
        <h2>{{ $title }}</h2>
        {{-- <button class="sec_botton btn_success" onclick="confirmDownloads({{ $id }})">
                Export </button> --}}

        <table id="tabel-data">
            <tbody>
                <tr class="head_table">
                    {{-- <th class="check_box">
                    <input type="checkbox" id="myCheckbox" name="myCheckbox">
                </th> --}}
                    <th>Jumlah Hadiah</th>
                    <th>Keterangan</th>
                    <th>Kode Voucher</th>
                    <th></th>
                    <th>User Kode</th>

                    <th style="width: 100%;">No Rekening</th>
                    <th>Tanggal Klaim</th>
                    <th>Status Bayar</th>
                    <th>Tanggal Exp</th>
                    <th>Log</th>
                </tr>
                <tr class="filter_row">
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
                {{-- isi data --}}
                @foreach ($data as $index => $d)
                    <tr id="tr_{{ $d->id }}"
                        style="{{ $d->keterangan == 'BONUS PEMILU' ? 'color: #f9d53cc9;' : '' }}">
                        <td><span class="name"
                                style="font-size: 22px;
            font-weight: 600;">{{ $d->jenis_voucher }}</span>
                        </td>
                        <td><span class="name">{{ $d->keterangan }}</span></td>
                        <td><span class="name">{{ $d->kode_voucher }}</span></td>
                        <td><span class="name">
                                <button class="sec_botton btn_secondary"
                                    onclick="salinTeks('{{ $d->user_kode . '_' . $d->kode_voucher }}')">
                                    COPY </button>
                            </span></td>
                        </span></td>
                        <td><span class="name">{{ $d->user_kode }}</span></td>

                        <td><span class="name">
                                <form method="POST" class="form-kode" data-index="{{ $index }}">
                                    @csrf
                                    <input type="hidden" class="id" name="id" value="{{ $d->id }}">
                                    <input type="text" class="userklaim" name="userklaim"
                                        placeholder="Masukkan No.Rek" required="" style="width: 50%; font-size: 10px;"
                                        value="{{ $d->userklaim }}" {{ $d->userklaim == '' ? '' : 'readonly' }}
                                        data-userklaim="{{ $d->userklaim }}">
                                    <button class="sec_botton btn_secondary wdi-20 btn_submit btn-submit d-none"
                                        type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l5 5l10 -10" />
                                        </svg>
                                    </button>
                                    <button class="sec_botton btn_warning wdi-20 btn_submit btn-cancel d-none"
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
                                        class="sec_botton btn_primary wdi-20 btn_submit btn-edit {{ $d->userklaim == '' ? 'd-none' : '' }}"
                                        type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                            viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
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
                                        class="sec_botton btn_danger wdi-20 btn_submit btn-delete {{ $d->userklaim == '' ? 'd-none' : '' }}"
                                        type="button" data-tglklaim="{{ $d->tgl_klaim }}">
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
                                    </button>
                                </form>
                            </span>
                            <span class="name userklaim-span_{{ $d->id }} d-opacity">{{ $d->userklaim }}</span>
                        </td>
                        <td><span class="name">{{ $d->tgl_klaim == null ? '{ Belum Spin }' : $d->tgl_klaim }}</span>
                        </td>

                        <td><span class="name">
                                <form method="POST">
                                    @csrf
                                    <input type="checkbox" id="checkbox_status_bayar_{{ $d->id }}"
                                        name="checkbox_status_bayar" {{ $d->status_transfer == '1' ? 'checked' : '' }}
                                        data-id="{{ $d->id }}"
                                        onchange="handleCheckboxChange('{{ $d->id }}')"
                                        {{ $d->tgl_klaim != '' || $d->tgl_klaim != null ? '' : 'disabled' }}>
                                </form>
                                <span
                                    class="name userklaim-span_{{ $d->id }} d-opacity">{{ $d->status_transfer == '1' ? 'sudah bayar' : 'belum_bayar' }}</span>
                            </span>
                        </td>

                        <td><span
                                style="{{ $d->tgl_exp < date('Y-m-d') ? 'color: rgba(var(--rgba-danger));' : 'color: green;' }}"
                                class="name">{{ $d->tgl_exp < date('Y-m-d') ? date('d-m-Y', strtotime($d->tgl_exp)) . ' ( Expired )' : date('d-m-Y', strtotime($d->tgl_exp)) . ' ( Valid )' }}</span>
                        </td>
                        <td><span class="name">{{ $d->username }}</span></td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <script>
        //CHECK BOX STATUS BAYAR
        function handleCheckboxChange(id) {
            const checkbox = $('#checkbox_status_bayar_' + id);
            const isChecked = checkbox.prop('checked');

            $.ajax({
                url: '/voucher_updatestatus',
                method: 'POST',
                data: {
                    id: id,
                    isChecked: isChecked,
                    _token: '{{ csrf_token() }}' // Ini akan menyertakan token CSRF dari Laravel
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                success: function(response) {
                    loadCountProses();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(errorThrown);
                }
            });
        }

        function createRow(data) {
            var newTr = '<tr id="tr_' + data.id + '">' +
                '<td><span class="name">' + data.jenis_voucher + '</span></td>' +
                '<td><span class="name">' + data.keterangan + '</span></td>' +
                '<td><span class="name">' + data.kode_voucher + '</span></td>' +
                '<td><span class="name">' +
                '<button class="sec_botton btn_secondary" onclick="salinTeks(\'' + data.user_kode + '_' + data
                .kode_voucher + '\')">COPY </button>' +
                '</span></td>' +
                '<td><span class="name">' + data.user_kode + '</span></td>' +
                '<td><span class="name">' +
                '<form method="POST" class="form-kode" data-index="' + data.index + '">' +
                '@csrf' +
                '<input type="hidden" class="id" name="id" value="' + data.id + '">' +
                '<input type="text" class="userklaim" name="userklaim" placeholder="Masukkan No.Rek" required="" style="width: 50%; font-size: 10px;" value="' +
                data.userklaim + '"' +
                (data.userklaim == '' ? '' : 'readonly') + ' data-userklaim="' + data.userklaim + '">' +
                '<button class="sec_botton btn_secondary wdi-20 btn_submit btn-submit d-none" type="submit">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">' +
                '<path stroke="none" d="M0 0h24v24H0z" fill="none" />' +
                '<path d="M5 12l5 5l10 -10" />' +
                '</svg>' +
                '</button>' +
                '<button class="sec_botton btn_warning wdi-20 btn_submit btn-cancel d-none" type="button">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">' +
                '<path stroke="none" d="M0 0h24v24H0z" fill="none" />' +
                '<path d="M18 6l-12 12" />' +
                '<path d="M6 6l12 12" />' +
                '</svg>' +
                '</button>' +
                '<button class="sec_botton btn_primary wdi-20 btn_submit btn-edit ' + (data.userklaim == '' ? 'd-none' :
                    '') + '" type="button">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">' +
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>' +
                '<path d="M12 20h9"></path>' +
                '<path d="M16 3h4v4"></path>' +
                '<path d="M4.5 12l4 -4a.48 .48 0 0 1 .7 0l5 5"></path>' +
                '<path d="M11 14h-4l-1 -4"></path>' +
                '</svg>' +
                '</button>' +
                '</form>' +
                '</span></td>' +
                '</tr>';

            $('#myTable').append(newTr);
        }

        $(document).ready(function() {
            $('.form-kode').on('submit', function(e) {
                e.preventDefault();

                var form = $(this); // Ambil form yang sedang disubmit
                var userklaimInput = form.find('.userklaim');
                var userklaim = form.find('.userklaim').val();
                var id = form.find('.id').val();
                var submitButton = form.find('.btn-submit');
                var cancelButton = form.find('.btn-cancel');
                var editButton = form.find('.btn-edit');
                var deleteButton = form.find('.btn-delete');

                if (userklaim !== '') {
                    $.ajax({
                        url: '/voucher_updateuserklaim',
                        method: 'POST',
                        data: {
                            id: id,
                            userklaim: userklaim,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            submitButton.hide();
                            cancelButton.hide();
                            editButton.show();
                            deleteButton.show();

                            userklaimInput.addClass('readonly');
                            userklaimInput.prop('readonly', true);
                            userklaimInput.data('userklaim', userklaim);

                            // $('#tr_' + id).remove();
                            $('.userklaim-span_' + id).text(userklaim);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error(errorThrown);
                        }
                    });
                }
            });

            $('.userklaim').on('input', function() {
                const form = $(this).closest('.form-kode');
                const inputValue = $(this).val();
                const submitButton = form.find('.btn-submit');
                const cancelButton = form.find('.btn-cancel');
                const editButton = form.find('.btn-edit');
                const deleteButton = form.find('.btn-delete');
                const userklaimInput = form.find('.userklaim');
                const dataUserklaim = userklaimInput.data('userklaim');

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
                        userklaimInput.val(dataUserklaim);
                    }
                }
            });

            $('.btn-cancel').on('click', function() {
                const form = $(this).closest('.form-kode');
                const userklaimInput = form.find('.userklaim');
                const submitButton = form.find('.btn-submit');
                const cancelButton = form.find('.btn-cancel');
                const editButton = form.find('.btn-edit');
                const deleteButton = form.find('.btn-delete');
                const dataUserklaim = userklaimInput.data('userklaim');

                if (dataUserklaim == '') {
                    userklaimInput.val('');
                    submitButton.hide();
                    cancelButton.hide();
                    deleteButto.hide();
                    editButton.hide();
                    userklaimInput.addClass('readonly');
                    userklaimInput.prop('readonly', true);
                } else {
                    userklaimInput.val(dataUserklaim);
                    submitButton.hide();
                    cancelButton.hide();
                    editButton.show();
                    deleteButton.show();
                    userklaimInput.addClass('readonly');
                    userklaimInput.prop('readonly', true);
                }


            });

            $('.btn-edit').on('click', function() {
                const form = $(this).closest('.form-kode');
                const userklaimInput = form.find('.userklaim');
                const submitButton = form.find('.btn-submit');
                const cancelButton = form.find('.btn-cancel');
                const editButton = form.find('.btn-edit');
                const deleteButton = form.find('.btn-delete');

                submitButton.show();
                cancelButton.hide();
                editButton.hide();
                deleteButton.hide();

                // Menghapus atribut "readonly" dari input userklaim
                userklaimInput.removeClass('readonly');
                userklaimInput.prop('readonly', false);

                // Fokus pada input userklaim
                userklaimInput.focus();
            });


            // $('.btn-delete').on('click', function() {
            //     var form = $(this).closest('.form-kode');
            //     var userklaimInput = form.find('.userklaim');
            //     var userklaim = form.find('.userklaim').val();
            //     var id = form.find('.id').val();
            //     var submitButton = form.find('.btn-submit');
            //     var cancelButton = form.find('.btn-cancel');
            //     var editButton = form.find('.btn-edit');
            //     var deleteButton = form.find('.btn-delete');
            //     var datatglklaim = $(this).data('tglklaim')

            //     if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
            //         $.ajax({
            //             url: '/voucher/deleteuserklaim',
            //             method: 'POST',
            //             data: {
            //                 id: id,
            //                 _token: '{{ csrf_token() }}'
            //             },
            //             success: function(response) {
            //                 submitButton.hide();
            //                 cancelButton.hide();
            //                 editButton.hide();
            //                 deleteButton.hide();

            //                 userklaimInput.removeClass('readonly');
            //                 userklaimInput.prop('readonly', false);
            //                 userklaimInput.val('');
            //                 userklaimInput.data('userklaim', '');
            //                 if (datatglklaim == '' || datatglklaim == null) {
            //                     $('#tr_' + id).remove();
            //                 }

            //                 $('.userklaim-span_' + id).text('');
            //                 console.log(response);
            //             },
            //             error: function(jqXHR, textStatus, errorThrown) {
            //                 console.error(errorThrown);
            //             }
            //         });
            //     }
            // });

            $('.btn-delete').on('click', function() {
                var form = $(this).closest('.form-kode');
                var userklaimInput = form.find('.userklaim');
                var userklaim = form.find('.userklaim').val();
                var id = form.find('.id').val();
                var submitButton = form.find('.btn-submit');
                var cancelButton = form.find('.btn-cancel');
                var editButton = form.find('.btn-edit');
                var deleteButton = form.find('.btn-delete');
                var datatglklaim = $(this).data('tglklaim');

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
                            url: '/voucher_deleteuserklaim',
                            method: 'POST',
                            data: {
                                id: id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                submitButton.hide();
                                cancelButton.hide();
                                editButton.hide();
                                deleteButton.hide();

                                userklaimInput.removeClass('readonly');
                                userklaimInput.prop('readonly', false);
                                userklaimInput.val('');
                                userklaimInput.data('userklaim', '');
                                if (datatglklaim == '' || datatglklaim == null) {
                                    $('#tr_' + id).remove();
                                }

                                $('.userklaim-span_' + id).text('');
                                console.log(response);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error(errorThrown);
                            }
                        });
                    }
                });
            });

        });

        function confirmDownloads(dataId) {
            event.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin ingin mendownload?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    exportArrayToExcels(dataId);
                }
            });
        }

        function exportArrayToExcels(dataId) {
            var title = "{{ $title }}";
            var isproses = "{{ $isproses }}";
            var url;
            if (isproses) {
                url = "/voucher_printproses/" + dataId;
            } else {
                url = "/voucher_printview/" + dataId;
            }
            // Ganti dengan URL rute yang sesuai
            console.log(url);
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    var worksheet = XLSX.utils.aoa_to_sheet(data);
                    var columnWidths = [{
                            wch: 5
                        },
                        {
                            wch: 20
                        },
                        {
                            wch: 20
                        },
                        {
                            wch: 20
                        },
                        {
                            wch: 20
                        },
                        {
                            wch: 20
                        },
                        {
                            wch: 20
                        },
                        {
                            wch: 20
                        },
                        {
                            wch: 20
                        },
                    ];

                    // Mengatur lebar kolom pada sheet
                    worksheet["!cols"] = columnWidths;

                    var workbook = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet 1");

                    var excelBuffer = XLSX.write(workbook, {
                        bookType: "xlsx",
                        type: "array",
                    });

                    var blob = new Blob([excelBuffer], {
                        type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                    });

                    var downloadLink = document.createElement("a");
                    document.body.appendChild(downloadLink);
                    downloadLink.href = window.URL.createObjectURL(blob);
                    downloadLink.download = "data.xlsx"; // Ganti dengan nama file yang diinginkan
                    downloadLink.click();
                })
                .catch(error => {
                    // // Tangani kesalahan jika terjadi
                    console.error('Terjadi kesalahan:', error);
                });
        }
    </script>
@endsection
