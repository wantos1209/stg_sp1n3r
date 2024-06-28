@extends('layouts.index')

@section('container')

    <style>
        .group_act_butt {
            display: flex;
            align-items: flex-end;
            justify-content: flex-start;
            gap: 10px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/themes/prism.css">
    <div class="sec_table">
        <h2>{{ $title }}</h2>

        <div class="centered-div">
            <div class="group_act_butt">
                @if (auth()->user()->divisi === 'admin' || auth()->user()->divisi === 'superadmin')
                    <a href="/generatevoucheradd/{{ $isdemo }}" id="add-generatevoucher">
                        <div class="sec_addnew">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-plus"
                                viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z">
                                </path>
                                <path d="M9 12l6 0"></path>
                                <path d="M12 9l0 6"></path>
                            </svg>
                            <span>Generate</span>
                        </div>
                    </a>
                @endif
                @if (auth()->user()->divisi === 'admin' || auth()->user()->divisi === 'superadmin')
                    <a href="/" id="delete-generatevoucher">
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
                @endif
                {{-- <div class="list_form" style="margin-left: auto;
            width: max-content;">
                <input type="text" id="search_data" name="search_data" min="1" placeholder="Search ..."
                    required="" style="border: var(--border-primary);" value={{ $search_data }}>
        </div> --}}
            </div>
            @if (auth()->user()->divisi === 'admin' || auth()->user()->divisi === 'superadmin')
                <select id="filter_website" onchange="setFilter()">
                    <option value="">ALL</option>
                    @foreach ($dataWebsite as $web)
                        @if ($web->nama != 'admin')
                            <option value="{{ $web->nama }}" {{ $web->nama == $website ? 'selected' : '' }}>
                                {{ $web->nama }}</option>
                        @endif
                    @endforeach
                </select>
                <select id="filter_keterangan" onchange="setFilter()">
                    <option value="">ALL</option>
                    @foreach ($dataKeterangan as $ket)
                        <option value="{{ $ket->keterangan }}" {{ $ket->keterangan == $keterangan ? 'selected' : '' }}>
                            {{ $ket->keterangan }}</option>
                    @endforeach
                </select>

                <span class="badge badge-danger bg-gradient-success"
                    style="
        border: 3px solid #ffffff75;
        padding: 5px;
        width: 50%;
        border-radius: 6px;
        background-image: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%);
        ">
                    <p style="
        margin: 0;
        color: #000000c9;
        font-weight: 700;
        border-bottom: 1px solid #0000004f;
        font-size: 12px;
        "
                        class="total_pengeluaran">
                        TOTAL PENGELUARAN <span style='color: red'>(ALL)</span></p>
                    <h5
                        style="
        margin: 5px 0 0 0;
        letter-spacing: 1px;
        color: white;
        text-shadow: 0.5px 1px 1px #0000005e;
        font-size: 15px;
        ">
                        <span class="totalakhir2">Rp 0</span>
                    </h5>

                </span>
            @endif

        </div>
        <div class="div-search">
            <table>
                <tbody>
                    <tr class="head_table">
                        <th class="check_box">
                            <input type="checkbox" id="myCheckbox" name="myCheckbox">
                        </th>
                        <th>Website</th>
                        <th>Target Website</th>
                        <th>Agen ID</th>
                        <th>Jenis Voucher</th>
                        <th>Keterangan</th>
                        <th>Tanggal Buat</th>
                        <th>Tanggal Exp</th>
                        <th>User Klaim</th>
                        <th>Jumlah</th>
                        @if (auth()->user()->divisi === 'admin' || auth()->user()->divisi === 'superadmin')
                            <th>Budget</th>
                            <th>Pengeluaran</th>
                        @endif
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
                        {{-- <td>
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
                        </td> --}}
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

                                <input type="text" placeholder="Cari data..." id="searchData-name" name="search_data"
                                    value="{{ $search_data }}">
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
                    @foreach ($data as $index => $d)
                        @php
                            if ($d->keterangan == 'BONUS PEMILU') {
                                $color = 'color: #f9d53cc9';
                            } elseif ($d->keterangan == 'BONUS TELEGRAM') {
                                $color = 'color: #00ebff91';
                            } elseif ($d->keterangan == 'BONUS APK') {
                                $color = 'color: #1aff0091';
                            } else {
                                $color = '';
                            }
                        @endphp
                        <tr style="{{ $color }}">
                            <td class="check_box">
                                <input type="checkbox" id="myCheckbox-{{ $index }}"
                                    name="myCheckbox-{{ $index }}" data-id=" {{ $d->id }}">
                            </td>
                            <td class="view" data-id="{{ $d->id }}" data-isdemo="{{ $d->isdemo }}"><span
                                    class="name">{{ $d->bo }}</span></td>
                            <td class="view" data-id="{{ $d->id }}" data-isdemo="{{ $d->isdemo }}"><span
                                    class="name">{{ $d->target_bo }}</span></td>
                            <td class="view" data-id="{{ $d->id }}"><span
                                    class="name">{{ $d->agentid }}</span></td>
                            <td style="overflow:unset;" class="view" data-id="{{ $d->id }}"
                                data-isdemo="{{ $d->isdemo }}">
                                @if (auth()->user()->divisi == 'superadmin' || auth()->user()->divisi == 'admin')
                                    <div class="tooltip">
                                        <span
                                            class="name">{{ $d->tipe_generate == '1' ? '{ Random }' : $d->nama }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-info-circle" width="10"
                                            height="10" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                            <path d="M12 9h.01"></path>
                                            <path d="M11 12h1v4h1"></path>
                                        </svg>
                                        <span class="tooltiptext">{{ $d->jen_voucher }}</span>
                                    </div>
                                @else
                                    <span class="name">{{ $d->tipe_generate == '1' ? '{ Random }' : $d->nama }}</span>
                                @endif
                            </td>
                            <td class="view" data-id="{{ $d->id }}" data-isdemo="{{ $d->isdemo }}">
                                <span class="name">{{ $d->keterangan }}</span>
                            </td>
                            <td class="view" data-id="{{ $d->id }}" data-isdemo="{{ $d->isdemo }}"><span
                                    class="name">{{ date('d-m-Y', strtotime($d->tgl_create)) }}</span>

                            <td class="view" data-id="{{ $d->id }}" data-isdemo="{{ $d->isdemo }}"><span
                                    style="{{ $d->tgl_exp < date('Y-m-d') ? 'color: rgba(var(--rgba-danger));' : 'color: green;' }}"
                                    class="name">{{ $d->tgl_exp < date('Y-m-d') ? date('d-m-Y', strtotime($d->tgl_exp)) . ' ( Expire )' : date('d-m-Y', strtotime($d->tgl_exp)) . ' ( Valid )' }}</span>
                            </td>
                            <td class="view" data-id="{{ $d->id }}" data-isdemo="{{ $d->isdemo }}">
                                <span class="name"
                                    style="{{ $d->isexp == 1 ? 'color: rgba(var(--rgba-danger));' : ($d->total_klaim >= 1 ? 'color: green;' : '') }}">
                                    {{ $d->total_klaim }}
                                </span>
                            </td>
                            <td class="view" data-id="{{ $d->id }}" data-isdemo="{{ $d->isdemo }}"><span
                                    class="name"
                                    style="{{ $d->ishabis == 1 ? 'color: orange;' : '' }}">{{ $d->jumlah . ($d->ishabis == '1' ? ' (Habis)' : '') }}</span>
                            </td>
                            @if (auth()->user()->divisi == 'superadmin' || auth()->user()->divisi == 'admin')
                                <td class="view" data-id="{{ $d->id }}" data-isdemo="{{ $d->isdemo }}">
                                    <span class="name">{{ number_format($d->total_budget, 0, ',', '.') }}</span>
                                </td>
                                <td class="view" data-id="{{ $d->id }}" data-isdemo="{{ $d->isdemo }}">
                                    <span class="name">{{ number_format($d->total, 0, ',', '.') }}</span>
                                </td>
                                {{-- <td><span class="name">{{ date('d-m-Y H:i:s', strtotime($d->tgl_berita)) }}</span></td> --}}
                            @endif
                            <td class="kolom_action">
                                <div class="dot_action">
                                    <span>•</span>
                                    <span>•</span>
                                    <span>•</span>
                                </div>
                                <div class="action_crud" id="1" style="display: none;">
                                    <a href="/voucher/{{ $d->id }}/{{ $isdemo }}" id="view"
                                        data-isdemo="{{ $d->isdemo }}">
                                        <div class="list_action">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-eye" viewBox="0 0 24 24"
                                                stroke-width="1.5" fill="none" stroke-linecap="round"
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
                                    {{-- <a href="#" id="proses" data-id="{{ $d->id }}"
                                        data-totalklaim="{{ $d->total_klaim }}">
                                        <div class="list_action">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-arrow-bar-to-right"
                                                viewBox="0 0 24 24" stroke-width="1.5" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M14 12l-10 0" />
                                                <path d="M14 12l-4 4" />
                                                <path d="M14 12l-4 -4" />
                                                <path d="M20 4l0 16" />
                                            </svg>
                                            <span>Proses</span>
                                        </div>
                                    </a> --}}
                                    @if (auth()->user()->divisi == 'superadmin' || auth()->user()->divisi == 'admin')
                                        <a href="/generatevoucheredit/{{ $d->id }}" id="edit">
                                            <div class="list_action">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-edit-circle" viewBox="0 0 24 24"
                                                    stroke-width="1.5" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z">
                                                    </path>
                                                    <path d="M16 5l3 3"></path>
                                                    <path d="M9 7.07a7 7 0 0 0 1 13.93a7 7 0 0 0 6.929 -6"></path>
                                                </svg>
                                                <span>Edit</span>
                                            </div>
                                        </a>
                                    @endif
                                    {{-- <a href="#" id="edit" data-id="{{ $d->id }}">
            <div class="list_action">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit-circle" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 15l8.385 -8.415a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z">
                    </path>
                    <path d="M16 5l3 3"></path>
                    <path d="M9 7.07a7 7 0 0 0 1 13.93a7 7 0 0 0 6.929 -6"></path>
                </svg>
                <span>Edit</span>
            </div>
            </a> --}}
                                    @if (auth()->user()->divisi == 'superadmin' || auth()->user()->divisi == 'admin')
                                        <a href="#" id="delete" data-id="{{ $d->id }}">
                                            <div class="list_action">
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
                                                <span>Delete</span>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php
                            $total_kalimvoucher += $d->total_kalimvoucher;
                            $total_voucher += $d->total_voucher;
                            $total_pengeluaran += $d->total;
                        @endphp
                    @endforeach
                    <tr style="background: var(--black-color);">
                        <td></td>
                        <td colspan="5"><span class="name" style=" float: right;">Total</span></td>
                        <td><span class="name">{{ $total_kalimvoucher . '/' . $total_voucher }}</span></td>
                        @if (auth()->user()->divisi == 'superadmin' || auth()->user()->divisi == 'admin')
                            <td><span class="totalakhir1"
                                    colspan="2">{{ number_format($total_pengeluaran, 0, ',', '.') }}</span>
                        @endif
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div id="loading-spinner" class="loading-spinner" style="display: none;">
                <!-- Tambahkan elemen loading spinner di sini (contoh: animasi putar) -->
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

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

    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script>
        function setFilter() {
            var website = $('#filter_website').val();
            var keterangan = $('#filter_keterangan').val();

            var url = '/generatevoucher/0?' +
                'website=' + encodeURIComponent(website) +
                '&keterangan=' + encodeURIComponent(keterangan);
            window.location.href = url;
        }

        $(document).ready(function() {
            $('#myCheckbox').change(function() {
                var isChecked = $(this).is(':checked');

                $('tbody tr:not([style="display: none;"]) [id^="myCheckbox-"]').prop('checked', isChecked);
            });
        });

        $(document).on('click', '#delete', function(event) {
            event.preventDefault();

            var id = $(this).data('id');
            var url =
                "/generatevoucher/delete/"; // Ubah URL sesuai dengan endpoint delete yang sesuai

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
                                window.location.href = '/generatevoucher';
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

        $(document).on('click', '#delete-generatevoucher', function(event) {
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
                "/generatevoucher/delete/"; // Ubah URL sesuai dengan endpoint delete yang sesuai

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
                                window.location.href = '/generatevoucher';
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

        $('.view').on('click', function() {
            var id = $(this).data('id');
            var isdemo = $(this).data('isdemo');
            var url = '/voucher/' + id + '/' + isdemo;
            window.location.href = url;
        });
    </script>


@endsection
