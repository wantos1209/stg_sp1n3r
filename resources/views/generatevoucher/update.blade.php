@extends('layouts.index')

@section('container')
    <div class="sec_box hgi-100">
        <form action="/generatevoucherupdate" method="POST" id="form">
            @csrf
            @foreach ($data as $index => $item)
                <div class="sec_form">
                    <div class="sec_head_form">
                        <h3>{{ $title }}</h3>
                        <span>Edit {{ $title }}</span>
                        <input type="hidden" name="id[]" value="{{ $item->id }}" {{ $disabled }}>
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Website</span>
                        <select id="bo" name="bo[]">
                            @foreach ($website as $web)
                                <option value="{{ $web }}" {{ $item->bo == $web ? 'selected' : '' }}>
                                    {{ $web }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Target Website</span>
                        <select id="target_bo" name="target_bo[]">
                            @foreach ($website as $web)
                                <option value="{{ $web }}" {{ $item->target_bo == $web ? 'selected' : '' }}>
                                    {{ $web }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="list_form">
                        <span class="sec_label">Keterangan</span>
                        <select id="keterangan" name="keterangan[]">
                            @foreach ($dataKeterangan as $ket)
                                <option value="{{ $ket->keterangan }}"
                                    {{ $item->keterangan == $ket->keterangan ? 'selected' : '' }}>
                                    {{ $ket->keterangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="list_form">
                        <span class="sec_label">Tanggal Exp</span>
                        <input type="date" id="tgl_exp" name="tgl_exp[]" value="{{ $item->tgl_exp }}">
                    </div>
                </div>
            @endforeach
            <div class="sec_button_form">
                <button class="sec_botton btn_submit" type="submit" id="Contactsubmit" {{ $disabled }}>Submit</button>
                <a href="/generatevoucher" id="cancel"><button type="button"
                        class="sec_botton btn_cancel">Cancel</button></a>
            </div>
        </form>
    </div>
@endsection
