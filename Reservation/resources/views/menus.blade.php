<div id="menu_part" class="col-12 col-sm-12 col-md-8 col-lg-8 px-xl-0 mx-auto">
    <div class="row">
        <div class="col-12 text-center">
            <div id="step">
                <div class="step-inner">
                    <span class="maruon">1</span>
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
                <h2 class="color-blue" style="font-weight: bold">{{__('select-menu')}}</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div id="content">
                <div class="coment">
                    <p id="menu_alert" class="alert" style="display: none">{{__('no-select-menu')}}</p>
                    <p><span class="">{{__('caution')}}</span></p>
                </div>
                <div id="content-header">
                    <a class="nextButton h-btn">{{__('to-time')}}</a>
                </div>
                <div id="menu" class="row-fluid type1">
                    <table class="tamenu">
                        <tbody>
{{--                        <tr>--}}
{{--                            <th colspan="4">ネイルその他</th>--}}
{{--                        </tr>--}}
                        @foreach($menus as $item)
                            <tr class="">
                                <td class="name" name="{{$item->menu_name}}" colspan="3">
                                    <div class="d-flex is-sp-column">
                                        <div class="menu-name form-check form-check-secondary">
                                            <input type="checkbox" name="menu[]" value="{{$item->menu_code}}" data-id="{{$item->id}}" class="menuCheck interval form-check-input" id="check{{$item->menu_code}}">
                                            <label for="check{{$item->menu_code}}"><span class="bold">{{$item->menu_name}}</span></label>
                                        </div>
                                        <div class="d-flex is-middle price-time">
                                            <div class="price-content d-flex is-middle">
                                                <span class="icon-space"></span>
                                                <span class="price {{$item['ask'] == 1 ? 'standard_going_price' : 'standard_price'}}">{{$item['ask'] == 1 ? __('ask') : ($item['over'] == 1 ? __('symbol-en') . number_format($item['price']) . __('over') : __('symbol-en') . number_format($item['price']))}}</span>
                                            </div>
                                            <div class="time" data-time="{{$item->require_time}}">{{$item->require_time . __('min')}}</div>
                                        </div><!-- price-time -->
                                    </div>
                                    <input type="hidden" class="isGoingPrice" value="{{$item['ask'] == 1 ? 1 : 0 }}">
                                    <p class="description">{{$item->description}}</p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><!-- tamenu -->
                    <div id="menu-footer">
                        <h5 class="color-blue mb-0" style="padding: 10px">{{__('check-menu')}}</h5>

                        <table class="tamenu">
                            <tbody>
                            <tr>
                                <th colspan="3">{{__('selected')}}</th>
                            </tr>
                            <tr id="selectedMenu" style="display:none;">
                                <td class="name selected"></td>
                                <td class="price t-right selected" width="100px">&nbsp;</td>
                                <td class="time t-right selected" width="70px"></td>
                            </tr>
                            <tr class="lightgray">
                                <th class="all">{{__('sum')}}<br><span class="caution">{{__('price-caution')}}</span></th>
                                <th id="totalPrice" class="all t-right" width="100px" price="0" goingprice="0"></th>
                                <th id="totalTime" class="all t-right" width="70px" time="0"></th>
                            </tr>
                            </tbody>
                        </table><!-- tamenu -->
                    </div><!--menu-footer -->
                </div>
                <div id="content-footer">
                    <div class="content-footer-btn">
                        <a class="nextButton f-btn mt-0" id="to_time">{{__('to-time')}}</a>
                        <a id="refresh" class="f-btn1">{{__('back')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        let urlParams = new URLSearchParams(window.location.search);
        let delete_id = urlParams.get('delete_id');
        if(delete_id != null && delete_id != undefined && delete_id != ""){
            $('#delete_id').val(delete_id)
        }
    })
    var inputMenuCheckClick = function(){
        if (this.checked) {
            // 8個以上チェック
            if ($('.selectCountLimitItem').length >= 8) {
                alert('選択できるメニューは８個までです');
                return false;
            }
            var tr = $('#selectedMenu').clone().css('display', 'table-row');
            tr.removeAttr('id');
            tr.attr('id', 'selectedCheck'+$(this).val());
            tr.attr('class', 'selectCountLimitItem');
            //名前
            var name = $(this).closest('td.name').attr('name');
            tr.find('.name').html('<span class="bold">' + name + '</span>');
            //時間
            var time = $(this).closest('td.name').find('.time').html();
            tr.find('.time').html(time);
            //価格
            var price = $(this).closest('div.menu-name').next().find('.price').html();
            tr.find('.price').html(price);

            $('#totalTime').parent().before(tr);
            //時間合計
            var totalTime = parseInt($('#totalTime').attr('time')) + parseInt(time.replace('分', ''));
            $('#totalTime').attr('time', totalTime).html(totalTime + '分');

            //価格合計
            var priceHtml = price.replace(/[^0-9]/g, '');
            var totalPrice = parseInt($('#totalPrice').attr('price')) + parseInt(priceHtml ? priceHtml : '0');
            let isGoingPriceFlg = false;
            $('.selected.price').each(function(index, element) {
                if (/要問合せ$/.test($(element).text().trim())) {
                    isGoingPriceFlg = true;
                    return false;
                }
            })
            if (isGoingPriceFlg) {
                // 要問合せの場合
                $('#totalPrice').attr('goingPrice', 1).html('要問合せ');
            } else {
                let waveDispFlg = false;
                $('.selected.price').each(function(index, element) {
                    if (/～$/.test($(element).text().trim())) {
                        waveDispFlg = true;
                        return false;
                    }
                })
                if(waveDispFlg){
                    totalPrice += '~'
                }
                $('#totalPrice').attr('price', totalPrice).attr('goingPrice', 0).html('￥' + totalPrice.toLocaleString());
            }

        } else {
            var target = $('#selectedCheck'+$(this).val());
            var totalTime = parseInt($('#totalTime').attr('time')) - parseInt(target.find('.time').html().replace('分', ''));
            var priceHtml = target.find('.price').html().replace(/[^0-9]/g, '');
            var totalPrice = parseInt($('#totalPrice').attr('price')) - parseInt(priceHtml ? priceHtml : '0');
            target.remove();

            $('#totalTime').attr('time', totalTime).html(totalTime + '分');

            let isGoingPriceFlg = false;
            $('.selected.price').each(function(index, element) {
                if (/要問合せ$/.test($(element).text().trim())) {
                    isGoingPriceFlg = true;
                    return false;
                }
            })
            if (isGoingPriceFlg) {
                // 要問合せのメニューがremoveされ、かつ要問い合わせメニューが全て未選択の場合
                $('#totalPrice').attr('goingPrice', 1).html('要問合せ');
            } else {
                let waveDispFlg = false;
                $('.selected.price').each(function(index, element) {
                    if (/～$/.test($(element).text().trim())) {
                        waveDispFlg = true;
                        return false;
                    }
                })
                if(waveDispFlg){
                    totalPrice += '~'
                }
                $('#totalPrice').attr('price', totalPrice).attr('goingPrice', 0).html('￥' + totalPrice.toLocaleString());
            }
        }
    }

    $(function(){
        $('input.menuCheck').click(inputMenuCheckClick);
        $('.nextButton').click(function(){
            if ($('input.menuCheck:checked').length === 0) {
                $('#menu_alert').show()
                return false;
            }
            $('#menu_alert').hide()
            $('#menu_part').hide();
            $('#time_part').show()
            $('#selected_price').html($('#totalPrice').html());
            $('#selected_time').html($('#totalTime').html());
            $('#menu_price').html($('#totalPrice').html());
            $('#price_str').val($('#totalPrice').html())
            $('#menu_time').html($('#totalTime').html());
            let menus = ""
            $('.selected.name').each(function(index, element) {
                console.log(index)
                if(index != 0){
                    if(index == $('.selected.name').length - 1){
                        menus += $(element).text().trim()
                    }
                    else{
                        menus += $(element).text().trim() + "、"
                    }
                }
            })
            let menu_ids = ""
            $('input.menuCheck:checked').each(function (index, element) {
                if(index == $('input.menuCheck:checked').length-1){
                    menu_ids += $(this).data('id')
                }
                else{
                    menu_ids += $(this).data('id') + ","
                }
            })
            console.log(menu_ids)
            $('#menu_ids').val(menu_ids)
            $('#menu_names').val(menus)
            $('#selected_menu').html(menus)
            $('#menu_confirm').html(menus)
        });
        $('#refresh').click(function () {
            window.location.reload()
        })
    })
</script>
