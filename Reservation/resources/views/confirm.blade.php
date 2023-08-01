<div id="confirm_part" class="col-12 col-sm-12 col-md-8 col-lg-8 px-xl-0 mx-auto" style="display: none">
    <div class="row">
        <div class="col-12 text-center">
            <div id="step">
                <div class="step-inner">
                    <span class="maru">1</span>
                    <span class="stext">{{__('menu-select')}}</span>
                </div><!-- step-inner -->
                <div class="step-inner">
                    <span class="maru">2</span>
                    <span class="stext">{{__('time-select')}}</span>
                </div><!-- step-inner -->
                <div class="step-inner">
                    <span class="maru">3</span>
                    <span class="stext">{{__('input-info')}}</span>
                </div><!-- step-inner -->
                <div class="step-inner">
                    <span class="maruon">4</span>
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
                <h2 class="color-blue" style="font-weight: bold">{{__('confirm')}}</h2>
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
                            <th width="30%">{{__('menu')}}</th>
                            <td id="menu_confirm"></td>
                        </tr>
                        <tr>
                            <th>{{__('selected-time')}}</th>
                            <td id="menu_time"></td>
                        </tr>
                        <tr>
                            <th>{{__('selected-price')}}</th>
                            <td><span id="menu_price"></span><br><span class="caution">{{__('price-caution')}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{__('visit-time')}}</th>
                            <td id="visit_time"></td>
                        </tr>
                        </tbody>
                    </table><!-- tacheck -->
                    <p class="mb-0 mt-1">{{__('client-info')}}</p>
                    <table class="tacheck">
                        <tbody>
                        <tr>
                            <th width="30%">{{__('name')}}</th>
                            <td id="confirm_name"></td>
                        </tr>
                        <tr>
                            <th>{{__('name-kana')}}</th>
                            <td id="confirm_name_kana"></td>
                        </tr>
                        <tr>
                            <th>{{__('phone')}}</th>
                            <td id="confirm_phone"></td>
                        </tr>
                        <tr>
                            <th>{{__('email')}}</th>
                            <td id="confirm_email"></td>
                        </tr>
                        <tr>
                            <th>{{__('gender')}}</th>
                            <td id="confirm_gender"></td>
                        </tr>
                        <tr>
                            <th>{{__('visit-history')}}</th>
                            <td id="confirm_visit"></td>
                        </tr>
                        <!-- 質問 start -->
                        <!-- 質問 end -->
                        <tr>
                            <th>{{__('request')}}</th>
                            <td id="confirm_request"></td>
                        </tr>
                        </tbody>
                    </table><!-- tacheck -->


                    <div id="contract">
                        <span class="caution">{{__('mail-caution')}}</span><br><br>
                        <a href="#" target="_blank">{{__('policy')}}</a>と<a href="#"
                                                                            target="_blank">{{__('privacy')}}</a>に同意した上で、予約を確定してください。
                    </div><!-- contract -->
                </div><!-- check -->
                <input type="hidden" id="formReferer" name="referer" value="4">
                <div id="content-footer">
                    <a id="reserveSubmit" href="javascript:void(0);"
                       class="f-btn disp-indicator mt-0">{{__('confirm-reservation')}}</a>
                    <a id="back_user" class="f-btn1">{{__('back')}}</a>
                </div><!-- content-footer -->
                <div id="spinner_border" class="spinner-border" role="status" style="width: 3rem; height: 3rem; position: absolute; left: calc(50% - 1.5rem); top: 60%; display: none">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#reserveSubmit').click(function () {
        let paramObj = new FormData($('#userForm')[0])
        $('#spinner_border').show()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        })
        $.ajax({
            url: '{{ route('reservation-add') }}',
            type: 'post',
            data: paramObj,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#spinner_border').hide()
                if (response.status == true) {
                    toastr.success("成功しました。")
                    $('#reservation_code').html(response.reservation_code)
                    $('#confirm_part').hide()
                    $('#complete_part').show()
                    window.scrollTo(0, 0)
                } else {
                    toastr.warning("失敗しました。")
                }
            },
        })
    })
    $('#back_user').click(function () {
        $('#confirm_part').hide()
        $('#user_part').show()
        window.scrollTo(0, 0)
    })
</script>

