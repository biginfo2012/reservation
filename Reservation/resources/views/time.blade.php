<div id="time_part" class="col-12 col-sm-12 col-md-8 col-lg-8 px-xl-0 mx-auto" style="display: none">
    <div class="row">
        <div class="col-12 text-center">
            <div id="step">
                <div class="step-inner">
                    <span class="maru">1</span>
                    <span class="stext">{{__('menu-select')}}</span>
                </div><!-- step-inner -->
                <div class="step-inner">
                    <span class="maruon">2</span>
                    <span class="stext">{{__('time-select')}}</span>
                </div><!-- step-inner -->
                <div class="step-inner">
                    <span class="maru">3</span>
                    <span class="stext">{{__('input-info')}}</span>
                </div><!-- step-inner -->
                <div class="step-inner">
                    <span class="maru">4</span>
                    <span class="stext">{{__('confirm-info')}}</span>
                </div><!-- step-inner -->
                <div class="step-inner">
                    <span class="maru">5</span>
                    <span class="stext">{{__('complete-info')}}</span>
                </div><!-- step-inner -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="main-title" class="text-center">
                <h2 class="color-blue" style="font-weight: bold">{{__('select-time')}}</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="content">
                <div class="coment">
                    <p id="time_alert" class="alert" style="display: none">{{__('no-enough-time')}}</p>
                </div>
                <div id="check" class="mb-1">
                    <table class="tacheck">
                        <tbody>
                        <tr>
                            <th>{{__('menu')}}</th>
                            <td id="selected_menu"></td>
                        </tr>
                        <tr>
                            <th>{{__('selected-time')}}</th>
                            <td id="selected_time"></td>
                        </tr>
                        <tr>
                            <th>{{__('selected-price')}}</th>
                            <td><span id="selected_price"></span><br><span
                                    class="caution">{{__('price-caution')}}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table><!-- tacheck -->
                </div><!-- check -->
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
                                                   class="{{$data['first_week_arr'][$i][$j] ? 'reserveDate maru' : 'off'}}">{{$data['first_week_arr'][$i][$j] ? '◎' : '×'}}</a>
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
                                                   class="{{$data['second_week_arr'][$i][$j] ? 'reserveDate maru' : 'off'}}">{{$data['second_week_arr'][$i][$j] ? '◎' : '×'}}</a>
                                            </td>
                                        @endfor
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>
                    </div><!-- component -->
                </div><!-- time -->

                <div id="content-footer">
                    <a id="back_menu" class="f-btn1">{{__('back')}}</a>
                </div><!-- content-footer -->
            </div>
        </div>
    </div>
</div>
<script>
    $('#back_menu').click(function () {
        $('#menu_part').show();
        $('#time_part').hide()
    })
    $('#next_week_btn').click(function () {
        $('#first_week_part').hide();
        $('#second_week_part').show();
    })
    $('#prev_week_btn').click(function () {
        $('#first_week_part').show();
        $('#second_week_part').hide();
    })
    $('a.reserveDate').click(function () {
        let reservation_unit = $('#reservation_unit').val()
        let time = $('#totalTime').attr('time') - reservation_unit
        let week = $(this).data('week')
        $t = $(this).parent().parent()
        let show_alert = false
        while(time > 0){
            let next = $t.next().find('a.reserveDate[data-week=' + week + ']')
            if(next.length){
                time = time - reservation_unit
                $t = $t.next()
            }
            else{
                $('#time_alert').show()
                show_alert = true
                break
            }
        }
        if(!show_alert){
            $('#time_alert').hide()
            $('#user_part').show()
            $('#time_part').hide()
            let selected_date = $(this).data('month') + $(this).data('date') + "(" +  $(this).data('weekday') + ") " + $(this).data('time')
            let reservation_time = $(this).data('month').replace("年", "-").replace("月", "-") + $(this).data('date').replace("日", "") + " " + $(this).data('time')
            console.log(reservation_time)
            $('#reservation_time').val(reservation_time)
            $('#visit_time').html(selected_date)
        }
    })
</script>
