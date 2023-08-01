<x-app-layout>
    <!--begin::Content-->
    <div class="content-body">
        <!-- Ajax Sourced Server-side -->
        <section id="datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body mt-2 pb-0">
                            <form class="dt_adv_search" method="POST" id="search_form">
                                @csrf
                                <div class="row g-1 mb-md-0">
                                    <div class="col-md-3">
                                        <div class="mb-1 row">
                                            <label for="date" class="col-sm-3 col-form-label-lg text-end"
                                                   style="padding-top: 10px">{{__('date')}}</label>
                                            <div class="col-sm-9" style="padding-left: 0">
                                                <input type="text" class="form-control flatpickr" id="date" name="date" placeholder="YYYY-MM-DD" required tabindex="1" data-index="1"
                                                       value="{{date('Y-m-d')}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1 row">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="keyword" name="keyword" tabindex="3" data-index="3"
                                                       placeholder="{{__('please-input-name-phone-mail')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn mr-2 background-dark-blue color-white" id="btn_get_table"
                                                onclick="event.preventDefault();getTableData('{{route('reservation-table')}}')">{{__('search')}}
                                        </button>
                                    </div>
                                    <div class="col-md-3 text-end">
                                        <button id="create_noti" type="button" class="btn background-dark-blue color-white"
                                                data-bs-toggle="modal" data-bs-target="#editTime"> {{__('control-reservation')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body pt-0" id="table-part">

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Time Control Info Modal -->
    <div class="modal fade" id="editTime" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <div class="text-center mt-1">
                        <h3>{{__('control-reservation')}}</h3>
                    </div>
                </div>
                <div class="modal-body pb-2 px-3 pt-0">
                    <div class="row">
                        <div class="col-12">
                            <div id="content">
                                <input type="hidden" id="reservation_unit" value="{{$data['reservation_unit']}}">

                                <div id="first_week_part">
                                    <div id="time-btn">
                                        <a id="next_week_btn" class="right-btn no2click">{{__('next-week')}}</a>
                                    </div><!-- time-btn -->

                                    <div class="component">
                                        <div class="sticky-wrap">
                                            <table class="sticky-enabled" style="margin: 0px;">
                                                <thead>
                                                <tr>
                                                    <th rowspan="2" style="width:10% !important;">{{__('day-time')}}</th>
                                                    <th colspan="{{$data['first_week_divide_span']}}">{{$data['first_week_month']}}</th>
                                                    @if($data['first_week_divide'])
                                                        <th colspan="{{7 - $data['first_week_divide_span']}}">{{$data['first_week_divide_month']}}</th>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    @for($i = 0; $i < 7; $i++)
                                                        <th style="width: 12%"
                                                            class="{{$data['weekdays'][$i] == "土" ? 'sat' : ($data['weekdays'][$i] == "日" ? 'sun' : "")}}">{{$data['first_week_days'][$i]}}
                                                            <br>（{{$data['weekdays'][$i]}}）
                                                        </th>
                                                    @endfor
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @for($i = 0,$iMax = count($data['time_array']); $i < $iMax; $i++)
                                                    <tr>
                                                        <td class="time">{{$data['time_array'][$i]}}</td>
                                                        @for($j = 0; $j < 7; $j++)
                                                            <td>
                                                                <a href="javascript:void(0);" data-week="{{$j}}" data-date="{{$data['first_week_days'][$j]}}" data-weekday="{{$data['weekdays'][$j]}}" data-time="{{$data['time_array'][$i]}}"
                                                                   data-month="{{$data['first_week_divide'] ? ($j + 1 > $data['first_week_divide_span'] ? $data['first_week_divide_month'] : $data['first_week_month']) : $data['first_week_month']}}"
                                                                   class="{{$data['first_week_arr'][$i][$j] == 0 ? 'off' : ($data['first_week_arr'][$i][$j] == 1 ? 'reserveDate maru' : 'reserveDate nai')}}">{{$data['first_week_arr'][$i][$j] == 1 ? '◎' : '×'}}</a>
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- component -->
                                </div><!-- time -->
                                <div id="second_week_part" style="display: none">
                                    <div id="time-btn">
                                        <a id="prev_week_btn" class="left-btn no2click">{{__('prev-week')}}</a>
                                    </div><!-- time-btn -->

                                    <div class="component">
                                        <div class="sticky-wrap">
                                            <table class="sticky-enabled" style="margin: 0px;">
                                                <thead>
                                                <tr>
                                                    <th rowspan="2" style="width:10% !important;">{{__('day-time')}}</th>
                                                    <th colspan="{{$data['second_week_divide_span']}}">{{$data['second_week_month']}}</th>
                                                    @if($data['second_week_divide'])
                                                        <th colspan="{{7 - $data['second_week_divide_span']}}">{{$data['second_week_divide_month']}}</th>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    @for($i = 0; $i < 7; $i++)
                                                        <th style="width: 12%"
                                                            class="{{$data['weekdays'][$i] == "土" ? 'sat' : ($data['weekdays'][$i] == "日" ? 'sun' : "")}}">{{$data['second_week_days'][$i]}}
                                                            <br>（{{$data['weekdays'][$i]}}）
                                                        </th>
                                                    @endfor
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @for($i = 0,$iMax = count($data['time_array']); $i < $iMax; $i++)
                                                    <tr>
                                                        <td class="time">{{$data['time_array'][$i]}}</td>
                                                        @for($j = 0; $j < 7; $j++)
                                                            <td>
                                                                <a href="javascript:void(0);" data-week="{{$j}}" data-date="{{$data['second_week_days'][$j]}}" data-weekday="{{$data['weekdays'][$j]}}" data-time="{{$data['time_array'][$i]}}"
                                                                   data-month="{{$data['second_week_divide'] ? ($j + 1 > $data['second_week_divide_span'] ? $data['second_week_divide_month'] : $data['second_week_month']) : $data['second_week_month']}}"
                                                                   class="{{$data['second_week_arr'][$i][$j] == 0 ? 'off' : ($data['second_week_arr'][$i][$j] == 1 ? 'reserveDate maru' : 'reserveDate nai')}}">{{$data['second_week_arr'][$i][$j] == 1 ? '◎' : '×'}}</a>
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- component -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-12 text-center">
                            <button type="button" class="btn waves-effect background-dark-blue color-white me-1 btn_submit" id="save_time">{{__('register')}}</button>
                            <label class="btn waves-effect background-dark-blue color-white cursor-pointer"
                                   tabindex="15" data-bs-dismiss="modal" aria-label="Close">{{__('close')}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Modal -->
    <!--end::Content-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reservation.css') }}">
    <script>
        addEventListener('pageshow', (event) => {
            getTableDataReservation('{{route('reservation-table')}}')
        });
        $(document).ready(function () {
            let queryString = window.location.search
            let urlParams = new URLSearchParams(queryString)
            if(urlParams.has('shop_id')){
                let shop_id = urlParams.get('shop_id')
                console.log(shop_id)
                $('#shop').val(shop_id).change()
                getTableDataReservation('{{route('reservation-table')}}')
            }

            $('#date').change(function () {
                getTableDataReservation('{{route('reservation-table')}}')
            })
            $('#next_week_btn').click(function () {
                $('#first_week_part').hide()
                $('#second_week_part').show()
            })
            $('#prev_week_btn').click(function () {
                $('#first_week_part').show()
                $('#second_week_part').hide()
            })
            $('a.reserveDate').click(function () {
                if($(this).hasClass('maru')){
                    $(this).removeClass('maru')
                    $(this).html('×')
                    $(this).addClass('nai')
                }
                else{
                    $(this).removeClass('nai')
                    $(this).html('◎')
                    $(this).addClass('maru')
                }
            })
            $('#save_time').click(function () {
                let rest_time = []
                $('a.nai').each(function () {
                    let reservation_time = $(this).data('month').replace("年", "-").replace("月", "-") + $(this).data('date').replace("日", "") + " " + $(this).data('time')
                    rest_time.push(reservation_time)
                })
                console.log(rest_time)
                if(rest_time.length){
                    let paramObj = new FormData()
                    paramObj.append('rest_time', rest_time)
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    })
                    $.ajax({
                        url: '{{ route('reservation-rest-time') }}',
                        type: 'post',
                        data: paramObj,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (response.status == true) {
                                toastr.success("成功しました。")
                                $('#editTime').modal('hide')
                            } else {
                                toastr.warning("失敗しました。")
                            }
                        },
                    })
                }

            })
        })
    </script>
</x-app-layout>
