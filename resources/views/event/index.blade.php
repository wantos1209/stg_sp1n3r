@extends('layouts.index')

@section('container')
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.24.1"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.24.1/themes/prism.css">
    <div class="sec_table">
        <h2>{{ $title }}</h2>
        @if ($divisi == 'admin')
            <div class="group_act_butt">
                <span class="badge badge-danger bg-gradient-success"
                    style="
        border: 3px solid #ffffff75;
        padding: 5px;
        width: 20%;
        border-radius: 6px;
        background-image: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%);
        ">
                    <p
                        style="
        margin: 0;
        color: #000000c9;
        font-weight: 700;
        border-bottom: 1px solid #0000004f;
        font-size: 12px;
        ">
                        TOTAL BUDGET</p>
                    <h5
                        style="
        margin: 5px 0 0 0;
        letter-spacing: 1px;
        color: white;
        text-shadow: 0.5px 1px 1px #0000005e;
        font-size: 15px;
        ">
                        <span class="totalakhir2">Rp {{ number_format($totalbudget, 0, ',', '.') }}</span>

                    </h5>

                </span>

                <span class="badge badge-danger bg-gradient-success"
                    style="
        border: 3px solid #ffffff75;
        padding: 5px;
        width: 20%;
        border-radius: 6px;
        background-image: linear-gradient(310deg, #ad1717 0%, #ec712d 100%);
        ">
                    <p
                        style="
        margin: 0;
        color: #000000c9;
        font-weight: 700;
        border-bottom: 1px solid #0000004f;
        font-size: 12px;
        ">
                        SALDO TERPAKAI</p>
                    <h5
                        style="
        margin: 5px 0 0 0;
        letter-spacing: 1px;
        color: white;
        text-shadow: 0.5px 1px 1px #0000005e;
        font-size: 15px;
        ">
                        <span class="totalakhir2">Rp
                            {{ number_format($saldoterpakai, 0, ',', '.') . ' ( ACC : ' . $countApprove . ')' . ' ( ' . strtoupper($website) . ' )' }}</span>
                        <br>
                        <br>
                        <span class="totalakhir2" style="color: #00ffa8;">Rp
                            {{ number_format($allsadloterpakai, 0, ',', '.') . ' ( ACC : ' . $countTotalAll . ')' . ' ( ALL WEBSITE )' }}</span>

                        {{-- <span class="totalakhir2">Approve :
                        {{ number_format($saldoterpakai, 0, ',', '.') . ' ( ' . strtoupper($website) . ' )' }}</span>
                    <br>
                    <br>
                    <span class="totalakhir2" style="color: #00ffa8;">Approve :
                        {{ $countTotalAll . ' ( ALL WEBSITE )' }}</span> --}}

                    </h5>

                </span>

                <span class="badge badge-danger bg-gradient-success"
                    style="
        border: 3px solid #ffffff75;
        padding: 5px;
        width: 20%;
        border-radius: 6px;
        background-image: linear-gradient(310deg, #1817ad 0%, #2dc9ec 100%);
        ">
                    <p
                        style="
        margin: 0;
        color: #000000c9;
        font-weight: 700;
        border-bottom: 1px solid #0000004f;
        font-size: 12px;
        ">
                        SISA SALDO</p>
                    <h5
                        style="
        margin: 5px 0 0 0;
        letter-spacing: 1px;
        color: white;
        text-shadow: 0.5px 1px 1px #0000005e;
        font-size: 15px;
        ">
                        <span class="totalakhir2">Rp
                            {{ number_format($totalbudget - $allsadloterpakai, 0, ',', '.') }}</span>
                        {{-- <span class="totalakhir2">Rp 0</span> --}}
                    </h5>

                </span>
            </div>
        @endif
        <div class="group_act_butt">
            @if ($divisi == 'admin' || $divisi == 'superadmin')
                <a href="/dataevent/add/{{ $jenis_event }}/{{ $website }}" id="add-event">
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
                        <span>Add New</span>
                    </div>
                </a>
            @endif
            <select id="search_website" name="search_website">
                @foreach ($datawebsite as $web)
                    <option value="{{ $web->nama }}" {{ $web->nama == $website ? 'selected' : '' }}>{{ $web->nama }}
                    </option>
                @endforeach
            </select>
            @if (auth()->user()->divisi == 'superadmin' || auth()->user()->divisi == 'admin')
                <a href="#" id="exportdownload" onclick="confirmDownload()">
                    <div class="sec_edit" style="margin-right: 10px">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-spreadsheet"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                            <path d="M8 11h8v7h-8z" />
                            <path d="M8 15h8" />
                            <path d="M11 11v7" />
                        </svg>
                        <span>Exprot</span>
                    </div>
                </a>
            @endif
            <div class="all_act_butt">
                <a href="" id="update-event">
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
                @if ($divisi == 'admin')
                    <a href="#" id="delete-event">
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
            </div>
        </div>
        <table>
            <tbody>
                <tr class="head_table">
                    <th class="check_box">
                        <input type="checkbox" id="myCheckbox" name="myCheckbox">
                    </th>
                    <th>Username</th>
                    <th>
                        @if ($jenis_event == '1')
                            Hadiah
                        @endif
                    </th>
                    <th>Keterangan</th>
                    <th>Website</th>
                    <th>Device ID</th>
                    {{-- <th>Guest ID</th> --}}
                    <th>Kode</th>

                    <th>Link</th>
                    <th></th>
                    <th>IP</th>
                    <th>Status Klaim</th>
                    <th>Status Approve</th>
                    <th>Prize</th>
                    <th>Approved By</th>
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
                        @if ($jenis_event == '1')
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
                        @endif
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
                    {{-- @dd($d) --}}
                    <tr>
                        <td class="check_box">
                            <input type="checkbox" id="myCheckbox-{{ $index }}"
                                name="myCheckbox-{{ $index }}" data-id=" {{ $d['id'] }}">
                        </td>
                        <td><span class="name">{{ $d['username'] == '' ? '{ Belum diisi }' : $d['username'] }}</span>

                        <td>
                            @if ($jenis_event == '1')
                                <span
                                    class="name">{{ $d['isklaim'] == '1' && $d['status'] != '2' ? $d['hadiah'] : '{ Random }' }}</span>
                            @endif
                        </td>

                        <td><span class="name">{{ $d['keterangan'] }}</span></td>
                        <td><span class="name">{{ $d['website'] }}</span></td>
                        <td><span class="name">{{ $d['androidid'] }}</span></td>
                        {{-- <td><span class="name">{{ 'guest_' . substr($d['androidid'], -5) }}</span></td> --}}
                        <td><span class="name">{{ $d['kode'] }}</span></td>

                        <td>
                            <span
                                class="name text-link">{{ '127.0.0.1:8000/' . ($jenis_event == 0 ? 'l21pemilu' : ($jenis_event == 1 ? 'l21imlek' : 'l21newyear')) . '/' . $jenis_event . '/' . $d['website'] . '/' . $d['androidid'] }}</span>
                        </td>
                        <td><span class="name"><button class="sec_botton btn_secondary btn-copy">COPY</button></span>
                        </td>
                        <td><span class="name">{{ $d['ip'] }}</span></td>

                        </td>
                        <td><span class="name">{{ $d['isklaim'] == '1' ? 'Sudah Klaim' : 'Belum Klaim' }}</span></td>
                        <td><span class="name ">
                                @php
                                    if ($d['status'] == 2) {
                                        echo '<button class="sec_botton btn_danger btn-width">BATAL</button>';
                                    } elseif ($d['isklaim'] == 0) {
                                        echo '<button class="sec_botton btn_secondary btn-width">BL KLM</button>';
                                    } elseif ($d['status'] == 0) {
                                        if ($d['jenis_event'] == '1' && $d['vote'] == '0') {
                                            echo '<button class="sec_botton btn_default btn-width">VOTE</button>';
                                        } else {
                                            echo '<button class="sec_botton btn_primary btn-width">WAIT</button>';
                                        }
                                    } elseif ($d['status'] == 1) {
                                        echo '<button class="sec_botton btn_success btn-width">APRV</button>';
                                    }
                                @endphp
                            </span>
                        </td>
                        <td><span class="name">{{ $d['prize'] == '0' ? '{ Belum diset }' : $d['prize'] }}</span></td>
                        <td style="overflow: unset">
                            @if ($d['approve_by'] != '')
                                <div class="tooltip">
                                    <span class="name">
                                        {{ $d['approve_by'] }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-info-circle" width="10" height="10"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                        <path d="M12 9h.01"></path>
                                        <path d="M11 12h1v4h1"></path>
                                    </svg>
                                    <span class="tooltiptext"> <span
                                            class="name">{{ date('d-m-Y H:i:s', strtotime($d['updated_at'])) }}</span>
                                    </span>
                                </div>
                            @else
                                <span class="name"> - </span>
                            @endif
                        </td>
                        {{-- <td><span class="name">{{ date('d-m-Y H:i:s', strtotime($d["tgl_berita)) }}</span></td> --}}

                        <td class="kolom_action">
                            <div class="dot_action">
                                <span>•</span>
                                <span>•</span>
                                <span>•</span>
                            </div>
                            <div class="action_crud" id="1" style="display: none;">
                                <a href="/dataevent/view/{{ $jenis_event }}/{{ $website }}/{{ $d['id'] }}"
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
                                <a href="/dataevent/edit/{{ $jenis_event }}/{{ $website }}/{{ $d['id'] }}">
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
                                @if ($d['status'] > 0 && $d['status'] != '1')
                                    {{-- <a href="#" id="waiting" data-id="{{ $d['id'] }}"
                                    data-website="{{ $d['website'] }}">
                                    <div class="list_action">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-clock-pause" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
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
                                @if ($divisi == 'admin')
                                    <a href="#" id="delete" data-id="{{ $d['id'] }}"
                                        data-website="{{ $d['website'] }}">
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
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
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
        function confirmDownload() {
            event.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin ingin mendownload?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    exportArrayToExcel();
                }
            });
        }

        function exportArrayToExcel() {
            var title = "{{ $title }}";
            var jenis_event = "<?= $jenis_event ?>";
            var url = "/event_print/" + jenis_event; // Ganti dengan URL rute yang sesuai

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    var groupedData = {};
                    var headerRow = []; // Define the headerRow variable here

                    // Mengelompokkan data berdasarkan website
                    data.forEach((item, index) => {
                        if (index === 0) {
                            // Menggunakan indeks 0 sebagai header
                            headerRow = item; // Assign the header data to headerRow
                            return;
                        }

                        var website = item[3]; // Menggunakan indeks 3 untuk kolom "Website"
                        if (!groupedData[website]) {
                            groupedData[website] = [];
                        }
                        groupedData[website].push(item);
                    });

                    var workbook = XLSX.utils.book_new();

                    // Membuat sheet untuk setiap website
                    for (var website in groupedData) {
                        var worksheetData = [headerRow].concat(groupedData[
                            website]); // Combine headerRow and worksheetData
                        var worksheet = XLSX.utils.aoa_to_sheet(worksheetData);
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
                            {
                                wch: 20
                            },
                        ];

                        // Mengatur lebar kolom pada sheet
                        worksheet["!cols"] = columnWidths;

                        XLSX.utils.book_append_sheet(workbook, worksheet, website);
                    }

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
                    downloadLink.download = "AllData.xlsx"; // Ganti dengan nama file yang diinginkan
                    downloadLink.click();
                })
                .catch(error => {
                    // Tangani kesalahan jika terjadi
                    console.log(error);
                });
        }

        $(document).ready(function() {
            $('.btn-copy').click(function() {
                var textToCopy = $(this).closest('tr').find('.text-link').text();

                var tempElement = $('<textarea>');
                $('body').append(tempElement);

                tempElement.val(textToCopy).select();
                document.execCommand('copy');

                tempElement.remove();

                Swal.fire({
                    title: 'Berhasil',
                    text: 'Link telah disalin: ' + textToCopy,
                    icon: 'success'
                });
            });
        });

        $(document).ready(function() {
            $('#search_website').change(function(event) {
                event.preventDefault();
                var website = $(this).val();
                var jenis_event = "<?= $jenis_event ?>";

                var url = '/dataevent/index/' + jenis_event + '/' + website;
                window.location.href = url;
            });
        });

        $(document).ready(function() {
            $('#myCheckbox').change(function() {
                var isChecked = $(this).is(':checked');
                $('tbody tr:not([style="display: none;"]) [id^="myCheckbox-"]').prop('checked', isChecked);
            });
        });

        $(document).ready(function() {
            $('#myCheckbox, [id^="myCheckbox-"]').change(function() {
                var isChecked = $('#myCheckbox:checked, [id^="myCheckbox-"]:checked').length > 0;

                if (isChecked) {
                    $('.all_act_butt').css('display', 'flex');
                } else {
                    $('.all_act_butt').hide();
                }
            });

            $('#update-event').off('click').click(function(event) {
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
                var website = "{{ $website }}";
                var jenis_event = "<?= $jenis_event ?>";
                window.location.href = '/dataevent/edit/' + jenis_event + '/' + website + '/' +
                    parameterString;
            });

            $(document).on('click', '#delete-event', function(event) {
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
                var search_website = $('#search_website').val();
                var website = "{{ $website }}";
                if (website == '') {
                    website = search_website;
                }
                var jenis_event = "<?= $jenis_event ?>";
                var url =
                    "/dataevent/delete/" + jenis_event + '/' +
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
                                        '/dataevent/index/' + jenis_event +
                                        '/' + website,
                                        function() {
                                            adjustElementSize();
                                            localStorage.setItem('lastPage',
                                                '/dataevent/index/' +
                                                jenis_event + '/' +
                                                website
                                            );
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

            $(document).on('click', '#delete', function(event) {
                event.preventDefault();

                var id = $(this).data('id');
                var website = $(this).data('website');
                var jenis_event = "<?= $jenis_event ?>";

                var url =
                    "/dataevent/delete/" + jenis_event + "/" +
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
                                        '/dataevent/index/' + jenis_event,
                                        function() {
                                            adjustElementSize();
                                            localStorage.setItem('lastPage',
                                                '/dataevent/index/' +
                                                jenis_event);
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


            // $(document).on('click', '#waiting', function(event) {
            //     event.preventDefault();

            //     var csrfToken = $('meta[name="csrf-token"]').attr('content');
            //     var website = $(this).data('website');

            //     var checkedValues = [];
            //     var value = $(this).data('id');
            //     checkedValues.push(value);

            //     Swal.fire({
            //         icon: 'question',
            //         title: 'Apakah Anda yakin?',
            //         text: 'Anda akan mengembalikan data ini menjadi waiting kembali.',
            //         showCancelButton: true,
            //         confirmButtonText: 'Ya, Setujui!',
            //         cancelButtonText: 'Batal'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             executeAjaxRequest(csrfToken, website, checkedValues, '0');
            //         }
            //     });
            // });

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
                    url: "/dataevent/changestatus/" + jenis_event + "/" + website + '/' + status,
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
                                    $('.aplay_code').load('/prosesevent/indexproses/' + website,
                                        function() {
                                            adjustElementSize();
                                            localStorage.setItem('lastPage',
                                                '/prosesevent/indexproses/' + website);
                                        });
                                });
                            } else if (status == '0') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil dikembalikan!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    $('.aplay_code').load('/prosesevent/indexproses/' + website,
                                        function() {
                                            adjustElementSize();
                                            localStorage.setItem('lastPage',
                                                '/prosesevent/indexproses/' + website);
                                        });
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil dibatalkan!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    $('.aplay_code').load('/prosesevent/indexproses/' + website,
                                        function() {
                                            adjustElementSize();
                                            localStorage.setItem('lastPage',
                                                '/prosesevent/indexproses/' + website);
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
        });
    </script>
@endsection
