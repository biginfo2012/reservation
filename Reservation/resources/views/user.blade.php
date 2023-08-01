<div id="user_part" class="col-12 col-sm-12 col-md-8 col-lg-8 px-xl-0 mx-auto" style="display: none">
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
                    <span class="maruon">3</span>
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
                <h2 class="color-blue" style="font-weight: bold">{{__('input-user')}}</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="content">
                <div id="message" style="display: none">
                    <p class="red">氏名カナは全角カタカナで入力してください</p>
                </div>
                <div id="date">
                    <p class="info"><span class="must">※</span>{{__('required')}}</p>
                    <form id="userForm" method="POST">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">
                        <input type="hidden" name="menu_names" id="menu_names">
                        <input type="hidden" name="price_str" id="price_str">
                        <input type="hidden" name="shop_id" value="{{$shop->id}}">
                        <input type="hidden" id="menu_ids" name="menu_ids">
                        <input type="hidden" id="reservation_time" name="reservation_time">
                        <table class="taform fomes">
                            <tbody>
                            <tr>
                                <th class="form-head sp-block">{{__('last-name')}}<span class="caution">※</span></th>
                                <td><input id="last_name" type="text" class="w-100" name="last_name" placeholder="{{__('last-name')}}" required></td>
                                <th class="form-subhead sp-block right">{{__('first-name')}}<span class="caution">※</span></th>
                                <td><input id="first_name" type="text" class="w-100" name="first_name" placeholder="{{__('first-name')}}" required></td>
                            </tr>
                            <tr>
                                <th class="form-head sp-block">{{__('sei')}}<span class="caution">※</span></th>
                                <td><input id="sei" type="text" class="w-100" name="sei" placeholder="{{__('sei')}}" required></td>
                                <th class="form-subhead sp-block right">{{__('mei')}}<span class="caution">※</span></th>
                                <td><input id="mei" type="text" class="w-100" name="mei" placeholder="{{__('mei')}}" required></td>
                            </tr>
                            </tbody>
                        </table><!-- fomes -->
                        <table class="taform fomes">
                            <tbody>
                            <tr>
                                <th class="form-head sp-block">{{__('phone-number')}}<span class="caution">※</span><br class="sp-hidden">（{{__('no-hypen')}}）</th>
                                <td><input id="phone" type="number" class="w-100" name="phone" placeholder="例:09000000000" required></td>
                            </tr>
                            <tr>
                                <th class="form-head sp-block">{{__('email')}}<span class="caution">※</span></th>
                                <td><input id="email" type="email" class="w-100" name="email" class="mailCheck" placeholder="例:mail@example.com" required></td>
                            </tr>
                            </tbody>
                        </table><!-- fomes -->

                        <table class="taform fomes">
                            <tbody>
                            <tr>
                                <th class="form-head sp-block">{{__('gender')}}<span class="caution">※</span></th>
                                <td class="d-flex">
                                    <div class="form-check form-check-secondary me-1">
                                        <input type="radio" id="sex1" name="gender" class="form-check-input" value="1" checked>
                                        <label class="form-check-label" for="sex1">{{__('female')}}</label>
                                    </div>
                                    <div class="form-check form-check-secondary me-1">
                                        <input type="radio" id="sex0" name="gender" class="form-check-input" value="0">
                                        <label class="form-check-label" for="sex0">{{__('male')}}</label>
                                    </div>
                                    <div class="form-check form-check-secondary">
                                        <input type="radio" id="sex-null" name="gender" class="form-check-input" value="">
                                        <label class="form-check-label" for="sex-null">{{__('no-select')}}</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="form-head sp-block">{{__('first-visit-sen')}}<span class="caution">※</span></th>
                                <td class="d-flex">
                                    <div class="form-check form-check-secondary me-1">
                                        <input type="radio" id="visit1" name="is_first" class="form-check-input" value="1" checked>
                                        <label class="form-check-label" for="visit1">{{__('yes')}}</label>
                                    </div>
                                    <div class="form-check form-check-secondary">
                                        <input type="radio" id="visit0" name="is_first" class="form-check-input" value="0">
                                        <label class="form-check-label" for="visit0">{{__('no')}}</label>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table><!-- fomes -->
                        <table class="taform fomes">
                            <tbody>
                            <tr>
                                <th class="form-head sp-block">{{__('request')}}</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="note" placeholder="ご要望・ご相談" id="request"></textarea>
                                </td>
                            </tr>
                            </tbody>
                        </table><!-- fomes -->
                    </form>

                </div><!-- date -->

                <div id="content-footer">
                    <a id="to_confirm" href="javascript:void(0);" class="f-btn mt-0">{{__('to-confirm')}}</a>
                    <a id="back_time" class="f-btn1">{{__('back')}}</a>
                </div><!-- content-footer -->
            </div>
        </div>
    </div>
</div>
<script>
    $('#back_time').click(function () {
        $('#user_part').hide()
        $('#time_part').show()
        window.scrollTo(0, 0)
    })
    $('#to_confirm').click(function () {
        if ($('#userForm').valid()) {
            let last_name = $('#last_name').val()
            let first_name = $('#first_name').val()
            let name = last_name + " " + first_name
            $('#confirm_name').html(name)
            let sei = $('#sei').val()
            let mei = $('#mei').val()
            let name_kana = sei + " " + mei
            $('#confirm_name_kana').html(name_kana)
            let phone = $('#phone').val()
            $('#confirm_phone').html(phone)
            let email = $('#email').val()
            $('#confirm_email').html(email)
            let gender = $('input[name=gender]:checked').val()
            let confirm_gender = gender == "1" ? "女性" : (gender == "" ? "選択しない" : "男性")
            $('#confirm_gender').html(confirm_gender)
            let is_first = $('input[name=is_first]:checked').val()
            let confirm_visit = is_first == "1" ? "初来店" : "再来店"
            $('#confirm_visit').html(confirm_visit)
            let request = $('#request').val()
            let confirm_request = request == "" ? "-" : request
            $('#confirm_request').html(confirm_request)
            if (!sei.match(/^[ァ-ンー]*$/) || !mei.match(/^[ァ-ンー]*$/)) {
                $('#message').show()
                return
            }
            $('#user_part').hide()
            $('#confirm_part').show()
            window.scrollTo(0, 0)
        }
    })
</script>
