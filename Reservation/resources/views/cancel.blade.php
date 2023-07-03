<div id="cancel_part" class="col-12 col-sm-12 col-md-8 col-lg-8 px-xl-0 mx-auto">
    <div class="row">
        <div class="col-12">
            <div id="main-title" class="text-center">
                <h2 class="color-blue" style="font-weight: bold">{{__('cancel-reservation')}}</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="content">
                <div id="check">
                    <p class="mb-0">{{__('reservation-content')}}</p>
                    <table class="tacheck">
                        <tbody>
                        <tr>
                            <th width="30%">{{__('reservation-number')}}</th>
                            <td id="">{{$reservation['reservation_code']}}</td>
                        </tr>
                        <tr>
                            <th width="30%">{{__('menu')}}</th>
                            <td id="menu_confirm">{{$data['menus']}}</td>
                        </tr>
                        <tr>
                            <th>{{__('selected-time')}}</th>
                            <td id="menu_time">{{$data['time']}}{{__('min')}}</td>
                        </tr>
                        <tr>
                            <th>{{__('selected-price')}}</th>
                            <td><span id="menu_price">{{$data['price']}}</span><br><span class="caution">{{__('price-caution')}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{__('visit-time')}}</th>
                            <td id="visit_time">{{$data['visit']}}</td>
                        </tr>
                        </tbody>
                    </table><!-- tacheck -->
                    <p class="mb-0 mt-1">{{__('client-info')}}</p>
                    <table class="tacheck">
                        <tbody>
                        <tr>
                            <th width="30%">{{__('name')}}</th>
                            <td id="confirm_name">{{$client->last_name . $client->first_name}}</td>
                        </tr>
                        <tr>
                            <th>{{__('name-kana')}}</th>
                            <td id="confirm_name_kana">{{$client->sei . $client->mei}}</td>
                        </tr>
                        <!-- 質問 start -->
                        <!-- 質問 end -->
                        <tr>
                            <th>{{__('request')}}</th>
                            <td id="confirm_request">{{$reservation->note}}</td>
                        </tr>
                        </tbody>
                    </table><!-- tacheck -->
                </div><!-- check -->
                <input type="hidden" id="formReferer" name="referer" value="4">
                <div id="content-footer">
                    <form id="cancelForm" method="POST">
                        @csrf
                        <input type="hidden" name="reservation_id" value="{{$reservation->id}}">
                    </form>
                    <a id="cancelReservation" href="javascript:void(0);"
                       class="f-btn disp-indicator">{{__('reservation-cancel')}}</a>
                    <a id="changeReservation" class="f-btn" style="float:left;">{{__('change-reservation')}}</a>
                </div><!-- content-footer -->
                <div id="spinner_border" class="spinner-border" role="status" style="width: 3rem; height: 3rem; position: absolute; left: calc(50% - 1.5rem); top: 60%; display: none">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#cancelReservation').click(function () {
        let paramObj = new FormData($('#cancelForm')[0])
        $('#spinner_border').show()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        })
        $.ajax({
            url: '{{ route('cancel-reservation-mail') }}',
            type: 'post',
            data: paramObj,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#spinner_border').hide()
                if (response.status == true) {
                    toastr.success("成功しました。")
                    $('#cancel_part').hide()
                    $('#complete_part').show()
                } else {
                    toastr.warning("失敗しました。")
                }
            },
        })
    })
    $('#changeReservation').click(function () {
        let paramObj = new FormData($('#cancelForm')[0])
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        })
        $.ajax({
            url: '{{ route('cancel-reservation') }}',
            type: 'post',
            data: paramObj,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == true) {
                    window.location.href = '{{route('reservation', $shop->shop_code)}}?delete_id={{$reservation->id}}'
                } else {
                    toastr.warning("失敗しました。")
                }
            },
        })
    })
</script>

