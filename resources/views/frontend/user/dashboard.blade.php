@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
{{ \GeniusTS\HijriDate\Hijri::setDefaultAdjustment(-1) }}
<div class="row mb-4" >
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col col-sm-3 order-2 order-sm-1  mb-4">
                        <div class="card mb-4">
                            {{-- <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture"> --}}
                            <div style="text-align: center; padding-top: 15px">
                                <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture"
                                style="
                                object-fit: cover;
                                height: 120px;
                                width: 120px;
                                border-radius: 50%;
                                ">
                            </div>

                            <div class="card-body">
                                <h4 class="card-title">
                                    {{ $logged_in_user->first_name }}<br/>
                                </h4>

                                <p class="card-text">
                                    <small>
                                        <i class="fas fa-envelope"></i> {{ $logged_in_user->email }}<br/>
                                        <i class="fas fa-suitcase"></i> {{ ucwords(strtolower($logged_in_user->last_name)) }}<br/>
                                        <i class="fas fa-user"></i> {{ ucwords(strtolower($logged_in_user->jenis)) }}<br/>
                                        <i class="fas fa-check"></i> {{ ucwords(strtolower($logged_in_user->status)) }}<br/>
                                        <i class="fas fa-calendar-check"></i> @lang('strings.frontend.general.joined') {{ timezone()->convertToLocal($logged_in_user->created_at, 'F jS, Y') }}
                                    </small>
                                </p>

                                <p class="card-text">

                                    <a href="{{ route('frontend.user.account')}}" class="btn btn-info btn-sm mb-1">
                                        <i class="fas fa-user-circle"></i> @lang('navs.frontend.user.account')
                                    </a>

                                    @can('view backend')
                                    &nbsp;<a href="{{ route('admin.dashboard')}}" class="btn btn-danger btn-sm mb-1">
                                        <i class="fas fa-user-secret"></i> @lang('navs.frontend.user.administration')
                                    </a>
                                    @endcan
                                </p>
                            </div>
                        </div>
                    </div><!--col-md-4-->

                    <div class="col-md-9 order-1 order-sm-2">
                        <div class="row" style="padding-bottom: 30px">
                            <div class="col">
                                <div class="" style="font-size: 24px">
                                    Ahlan Wa Sahlan, {{ $logged_in_user->first_name }}
                                </div>
                            </div><!--col-md-6-->
                        </div><!--row-->

                        <div class="row" style="padding-bottom: 20px">
                            <div class="col">
                                    <img src="{{ asset('img/banner-1.png') }}" class="img-fluid" />
                            </div>
                        </div>

                        <div class="row">
                                <div class="col">
                                <div class="text-center" style="font-size: 20px; weight:500">
                                    Amal Yaumiah Ramadhan 1441
                                </div>
                                <div class="text-center text-muted">
                                    Program Ar-Rahmah Balikpapan
                                </div>
                            </div><!--col-md-6-->
                        </div><!--row-->

                        <div class="row" style="padding-top:20px">
                            <div class="col">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12 text-center" style="font-weight: 800; padding-bottom: 20px ">
                                                @php
                                                $hari_ = array(
                                                "Ahad",
                                                "Senin",
                                                "Selasa",
                                                "Rabu",
                                                "Kamis",
                                                "Jum'at",
                                                "Sabtu"
                                                );

                                                $hari_hijriyah      = \GeniusTS\HijriDate\Date::now()->format('w');
                                                $tanggal_hijriyah   = \GeniusTS\HijriDate\Date::now()->format('d');
                                                $bulan_hijriyah     = \GeniusTS\HijriDate\Date::now()->format('m');
                                                $tahun_hijriyah     = \GeniusTS\HijriDate\Date::now()->format('o');
                                                $hijriyah           = \GeniusTS\HijriDate\Date::now();

                                                $tgl = !empty(request('tgl')) ? request('tgl') : $tanggal_hijriyah;

                                                $masehi_select = \GeniusTS\HijriDate\Hijri::convertToGregorian($tgl, $bulan_hijriyah, $tahun_hijriyah);
                                                $hijriyah_select = \GeniusTS\HijriDate\Hijri::convertToHijri($masehi_select->format('o-m-d'));

                                                @endphp
                                                <div class="tgl">
                                                    <select class="tglselect" id="tgl" name="tanggal" required>
                                                        <option value="{{ $tgl }}">
                                                            {{ $hari_[$masehi_select->format('w')] }}, {{ $hijriyah_select->format('d F o') }}
                                                        </option>
                                                        <option>-------------------</option>
                                                        @for ($i = $hijriyah->format('d'); $i >= 1; $i--)
                                                        @php
                                                        $masehi_ = \GeniusTS\HijriDate\Hijri::convertToGregorian($i, $bulan_hijriyah, $tahun_hijriyah);
                                                        $hijriyah_ = \GeniusTS\HijriDate\Hijri::convertToHijri($masehi_->format('o-m-d'));
                                                        @endphp
                                                        <option value="{{ intval($hijriyah_->format('d')) }}">
                                                            {{ $hari_[$masehi_->format('w')] }}, {{ $hijriyah_->format('d F o') }}
                                                        </option>
                                                        @endfor
                                                    </select>
                                                    <div id="txt"></div>
                                                </div><!--form-group-->
                                            </div>

                                            <table class="table-bordered text-center">
                                                <thead>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $amalan_lists = DB::table('amalans_lists')->where('id_amalan', '=', '1')->paginate(100);
                                                    @endphp
                                                    @foreach($amalan_lists as $key=> $amalan_list)
                                                    <tr>
                                                        <td class="align-middle">{{ $amalan_list->nama_amalan_list }}</td>
                                                        @php
                                                        $amalan_list_absen = DB::table('amalans_lists_absens')
                                                                                ->where('id_amalan_list', '=', $amalan_list->id)
                                                                                ->where('user_amalan_list', '=', $logged_in_user->id)
                                                                                ->where('tanggal_hijriyah_amalan_list', '=', $tgl)
                                                                                ->first();
                                                        @endphp

                                                        @if ( empty($amalan_list_absen->tanggal_hijriyah_amalan_list) )
                                                        <form action="{{ route('frontend.amalans.tambahabsen') }}" method="post">
                                                            @csrf
                                                            <td>
                                                                <select name="ket_hijriyah_amalan_list" class="form-control">
                                                                    <option value=" ">-</option>
                                                                    <option value="SAKIT">Sakit</option>
                                                                    @if ($logged_in_user->jenis == 'AKHWAT')
                                                                        <option value="HAID">Haid</option>
                                                                    @endif
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input hidden="hidden" name="id_amalan_list" value="{{ $amalan_list->id }}">
                                                                <input hidden="hidden" name="user_amalan_list" value="{{ $logged_in_user->id }}">
                                                                <input hidden="hidden" name="waktu_hijriyah_amalan_list" value="{{ $hijriyah_select->format('F-o') }}">
                                                                <input hidden="hidden" name="tanggal_hijriyah_amalan_list" value="{{ intval($hijriyah_select->format('d')) }}">
                                                                <button class="btn btn-light btn-sm" style="font-size:14px; padding: 0px 15px 0px 15px; margin: 5px 20px 5px 20px;"><i class="fas fa-check"></i></button>
                                                            </td>
                                                        </form>
                                                        @else
                                                            <td></td>
                                                            <td>
                                                                <button disabled class="btn btn-primary btn-sm" style="font-size:14px; padding: 0px 15px 0px 15px; margin: 5px 20px 5px 20px;"><i class="fas fa-check"></i></button>
                                                            </td>
                                                        @endif

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>

                                        <div class="ab" >
                                            <table class="table table-bordered table-striped table-sm" style="min-width: 800px; margin: 5px">
                                                <thead >
                                                    <tr>
                                                        <th width="200"></th>
                                                        @for ($i = 1; $i <= 30; $i++)
                                                        <th width="200" class="text-center">{{ $i }}</th>
                                                        @endfor
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($amalan_lists as $key=> $amalan_list)
                                                    <tr>
                                                        <td style="z-index: 50;">{{ $amalan_list->nama_amalan_list }}</td>
                                                        @for ($i = 1; $i <= 30; $i++)
                                                            @php
                                                            $amalan_list_absen = DB::table('amalans_lists_absens')
                                                                                    ->where('id_amalan_list', '=', $amalan_list->id)
                                                                                    ->where('user_amalan_list', '=', $logged_in_user->id)
                                                                                    ->where('tanggal_hijriyah_amalan_list', '=', $i)
                                                                                    ->first();

                                                            if (isset($amalan_list_absen->tanggal_hijriyah_amalan_list)) {
                                                                $check = $amalan_list_absen->tanggal_hijriyah_amalan_list;
                                                            } else {
                                                                $check = '';
                                                            }

                                                            @endphp

                                                            @if ($check == $i || is_null($check) )
                                                                <td>
                                                                    <form action="{{ route('frontend.amalans.hapusabsen') }}" onsubmit="return confirm('{{ $amalan_list->nama_amalan_list }} Tanggal {{ $i }}, Apakah anda yakin untuk menghapusnya?');" method="post">
                                                                        @csrf
                                                                        <input hidden="hidden" name="id" value="{{ $amalan_list_absen->id }}" />
                                                                        <center>
                                                                        @if ($amalan_list_absen->ket_hijriyah_amalan_list == "HAID")
                                                                            <button type="submit" class="btn" style="color: rgb(255, 56, 156); border: 0px; padding: 0px;">
                                                                                <i class="fas fa-venus"></i>
                                                                            </button>
                                                                        @elseif ($amalan_list_absen->ket_hijriyah_amalan_list == "SAKIT")
                                                                            <button type="submit" class="btn" style="color: rgb(83, 163, 28); border: 0px; padding: 0px;">
                                                                                <i class="fas fa-user-times"></i>
                                                                            </button>
                                                                        @else
                                                                            <button type="submit" class="btn" style="color: rgb(0, 184, 255); border: 0px; padding: 0px;">
                                                                                <i class="fas fa-check-circle"></i>
                                                                            </button>
                                                                        @endif
                                                                        </center>

                                                                    </form>
                                                                </td>
                                                            @else
                                                                <td></td>
                                                            @endif

                                                        @endfor
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!--card-body-->
                                </div><!--card-->
                            </div><!--col-md-6-->
                        </div><!--row-->
                    </div><!--col-md-8-->
                </div><!-- row -->
            </div> <!-- card-body -->
        </div><!-- card -->
    </div><!-- row -->
</div><!-- row -->
@stack('before-scripts')
<script type="text/javascript">
$(function() {
    $('.tglselect').on('change', function (){
        var url = "{{ request()->url() }}";
        if($("#tgl").val()!="{{ $tgl }}") {
            url_ = url+'?tgl='+$("#tgl").val();
            window.location=url_;
        }
    });
});
</script>
@stack('after-scripts')
@endsection
