<style>
    .notif_proses {
        color: rgba(var(--rgba-danger)) !important;
    }

    .notif_proses_voucher {
        color: rgba(var(--rgba-danger)) !important;
    }

    .notif_proses_voucher-2 {
        color: rgba(var(--rgba-danger)) !important;
    }

    .notif_approval_voucher-2 {
        color: rgba(var(--rgba-danger)) !important;
    }
</style>
<div class="sec_logo">
    <a href="" id="codeDashboardLink"><img class="gmb_logo" src="{{ asset('img/utama/lucky-wheel-l21.png') }}"
            alt="l21" /></a>
    <svg id="icon_expand" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-category"
        viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M4 4h6v6h-6z" />
        <path d="M14 4h6v6h-6z" />
        <path d="M4 14h6v6h-6z" />
        <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
    </svg>
</div>
<div class="sec_list_sidemenu">
    <div class="bagsearch side">
        <div class="grubsearchnav">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" viewBox="0 0 24 24"
                stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                <path d="M21 21l-6 -6" />
            </svg>
            <input type="text" placeholder="Cari Tabel..." id="searchTabel" />
        </div>
    </div>

    <div class="nav_group">
        <span class="title_Nav">Vouchers</span>
        <div class="list_sidejsx">
            <div class="data_sidejsx active" style="display: block">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-gift" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 8m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z"></path>
                        <path d="M12 8l0 13"></path>
                        <path d="M19 12v7a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-7"></path>
                        <path d="M7.5 8a2.5 2.5 0 0 1 0 -5a4.8 8 0 0 1 4.5 5a4.8 8 0 0 1 4.5 -5a2.5 2.5 0 0 1 0 5">
                        </path>
                    </svg>
                    <span class="nav_title1">Vouchers</span>
                    <div class="arrow_side">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right"
                            viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M13 18l6 -6" />
                            <path d="M13 6l6 6" />
                        </svg>
                    </div>
                </a>
            </div>
            <div class="sub_data_sidejsx" style="display: block">
                <a href="/generatevoucher" id="Generatevoucher">
                    <div class="list_subdata active">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Data</span>
                    </div>
                </a>
                <a href="/voucherprosesall" id="Prosesvoucher">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Proses (<span class="notif_proses">{{ $totalSpin }}</span>)</span>
                    </div>
                </a>
                <a href="/generatevoucherdemo/1" id="GeneratevoucherDemo">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Demo</span>
                    </div>
                </a>
                <a href="/voucher_search/0" id="GeneratevoucherFind">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Find Kode</span>
                    </div>
                </a>
            </div>
            <div class="data_sidejsx">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-stats"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                        <path d="M18 14v4h4" />
                        <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M15 3v4" />
                        <path d="M7 3v4" />
                        <path d="M3 11h16" />
                    </svg>
                    <span class="nav_title1">Events (Pemilu)</span>
                    <div class="arrow_side">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right"
                            viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M13 18l6 -6" />
                            <path d="M13 6l6 6" />
                        </svg>
                    </div>
                </a>
            </div>
            <div class="sub_data_sidejsx active" style="display: block">
                {{-- @foreach ($datawebsite as $index => $website)
                @if ($website->nama != 'admin')
                    <a href="#" id="event_{{ $website->nama }}">
                        <div class="list_subdata">
                            <div class="dotsub"></div>
                            <span class="sub_title1">{{ $website->nama }}</span>
                        </div>
                    </a>
                @endif
            @endforeach --}}
                <a href="/dataevent/index/0" id="Data-event">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Data</span>
                    </div>
                </a>
                <a href="/prosesevent/indexproses/0" id="Proses-event">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Proses (<span
                                class="notif_proses_voucher">{{ $totalPemilu }}</span>)</span>
                    </div>
                </a>
                <a href="/findkodeevent/0" id="Findkode-event">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Find Kode</span>
                    </div>
                </a>


            </div>
            <div class="data_sidejsx">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-stats"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                        <path d="M18 14v4h4" />
                        <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M15 3v4" />
                        <path d="M7 3v4" />
                        <path d="M3 11h16" />
                    </svg>
                    <span class="nav_title1">Events (Imlek)</span>
                    <div class="arrow_side">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right"
                            viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M13 18l6 -6" />
                            <path d="M13 6l6 6" />
                        </svg>
                    </div>
                </a>
            </div>
            <div class="sub_data_sidejsx active" style="display: block">
                {{-- @foreach ($datawebsite as $index => $website)
                @if ($website->nama != 'admin')
                    <a href="#" id="event_{{ $website->nama }}">
                        <div class="list_subdata">
                            <div class="dotsub"></div>
                            <span class="sub_title1">{{ $website->nama }}</span>
                        </div>
                    </a>
                @endif
            @endforeach --}}
                <a href="/dataevent/index/1" id="Data-event-2">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Data</span>
                    </div>
                </a>
                <a href="/approvalevent/indexapproval/1" id="Approval-event-2">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Approval (<span
                                class="notif_approval_voucher-2">{{ $totalAppImlek }}</span>)</span>
                    </div>
                </a>
                <a href="/prosesevent/indexproses/1" id="Proses-event-2">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Proses (<span
                                class="notif_proses_voucher-2">{{ $totalProImlek }}</span>)</span>
                    </div>
                </a>
                <a href="/findkodeevent/1" id="Findkode-event-2">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Find Kode</span>
                    </div>
                </a>


            </div>
            <div class="data_sidejsx">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-stats"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                        <path d="M18 14v4h4" />
                        <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M15 3v4" />
                        <path d="M7 3v4" />
                        <path d="M3 11h16" />
                    </svg>
                    <span class="nav_title1">Events (New Year)</span>
                    <div class="arrow_side">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right"
                            viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M13 18l6 -6" />
                            <path d="M13 6l6 6" />
                        </svg>
                    </div>
                </a>
            </div>
            <div class="sub_data_sidejsx active" style="display: block">
                {{-- @foreach ($datawebsite as $index => $website)
                @if ($website->nama != 'admin')
                    <a href="#" id="event_{{ $website->nama }}">
                        <div class="list_subdata">
                            <div class="dotsub"></div>
                            <span class="sub_title1">{{ $website->nama }}</span>
                        </div>
                    </a>
                @endif
            @endforeach --}}
                <a href="/dataevent/index/2" id="Data-event">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Data</span>
                    </div>
                </a>
                <a href="/prosesevent/indexproses/2" id="Proses-event">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Proses (<span
                                class="notif_proses_voucher">{{ $totalNewYear }}</span>)</span>
                    </div>
                </a>
                <a href="/findkodeevent/2" id="Findkode-event">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Find Kode</span>
                    </div>
                </a>


            </div>
        </div>
    </div>
    {{-- @if (isAdmin() && auth()->user()->username != 'admin-mt') --}}
    <div class="nav_group">
        <span class="title_Nav">CONFIG</span>
        <div class="list_sidejsx">
            <div class="data_sidejsx">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-adjustments-horizontal" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                        <path d="M4 6l8 0"></path>
                        <path d="M16 6l4 0"></path>
                        <path d="M8 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                        <path d="M4 12l2 0"></path>
                        <path d="M10 12l10 0"></path>
                        <path d="M17 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                        <path d="M4 18l11 0"></path>
                        <path d="M19 18l1 0"></path>
                    </svg>
                    <span class="nav_title1">Vouchers</span>
                    <div class="arrow_side">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right"
                            viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M13 18l6 -6" />
                            <path d="M13 6l6 6" />
                        </svg>
                    </div>
                </a>
            </div>
            <div class="sub_data_sidejsx">
                <a href="/jenisvoucher" id="Jenisvoucher">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Setting</span>
                    </div>
                </a>
                <a href="/urlspin/index" id="Url_spin">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">URL</span>
                    </div>
                </a>
                <a href="/keterangan" id="Keterangan">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Keterangan</span>
                    </div>
                </a>

            </div>

            <div class="data_sidejsx">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tool" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5" />
                    </svg>
                    <span class="nav_title1">Events</span>
                    <div class="arrow_side">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right"
                            viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M13 18l6 -6" />
                            <path d="M13 6l6 6" />
                        </svg>
                    </div>
                </a>
            </div>
            <div class="sub_data_sidejsx">
                <a href="/urlevent/index" id="Urlevent">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">URL</span>
                    </div>
                </a>
                <a href="/hadiah/index" id="Hadiahevent">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Hadiah</span>
                    </div>
                </a>
                <a href="/budget/index" id="Budgetevent">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Budget</span>
                    </div>
                </a>
                <a href="/gambar/index" id="Gambarevent">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Gambar</span>
                    </div>
                </a>
                <a href="/listprize/index" id="ListPrizeevent">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">List Prize</span>
                    </div>
                </a>
                <a href="/website/index" id="Contactevent">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Contact</span>
                    </div>
                </a>
                <a href="/buttonsetting/index" id="Buttonevent">
                    <div class="list_subdata">
                        <div class="dotsub"></div>
                        <span class="sub_title1">Button</span>
                    </div>
                </a>
            </div>

            <div class="data_sidejsx">
                <a href="/linksettings" id="Linksettings">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 15l6 -6"></path>
                        <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path>
                        <path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463">
                        </path>
                    </svg>
                    <span class="nav_title1">Link Settings</span>
                </a>
            </div>
            {{-- <div class="data_sidejsx">
                <a href="#" id="Allowedip">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-analytics"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z">
                        </path>
                        <path d="M7 20l10 0"></path>
                        <path d="M9 16l0 4"></path>
                        <path d="M15 16l0 4"></path>
                        <path d="M8 12l3 -3l2 2l3 -3"></path>
                    </svg>
                    <span class="nav_title1">Allowed IP</span>
                </a>
            </div> --}}
            <div class="data_sidejsx">
                <a href="/user" id="Usermanagement">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path
                            d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                        </path>
                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                    </svg>
                    <span class="nav_title1">User Management</span>
                </a>
            </div>


        </div>
    </div>
    {{-- @endif --}}

</div>
