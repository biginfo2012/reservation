<div class="col-12 col-sm-12 col-md-8 col-lg-8 px-xl-0 mx-auto">
    <div class="row">
        <div class="col-12 text-center">
            <div id="step">
                <div class="step-inner">
                    <span class="maruon">1</span>
                    <span class="stext">メニュー選択</span>
                </div><!-- step-inner -->
                <div class="step-inner">
                    <span class="maru">2</span>
                    <span class="stext">日時指名</span>
                </div><!-- step-inner -->
                <div class="step-inner">
                    <span class="maru">3</span>
                    <span class="stext">情報入力</span>
                </div><!-- step-inner -->
                <div class="step-inner">
                    <span class="maru">4</span>
                    <span class="stext">予約確認</span>
                </div><!-- step-inner -->
                <div class="step-inner">
                    <span class="maru">5</span>
                    <span class="stext">予約完了</span>
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
                    <p><span class="caution">{{__('caution')}}</span></p>
                </div>
                <div id="content-header">
                    <a class="nextButton h-btn">この内容で次へ</a>
                </div>
                <div id="menu" class="row-fluid type1">
                    <table class="tamenu">
                        <tbody>
                        <tr>
                            <th colspan="4">ネイルその他</th>
                        </tr>
                        @foreach($menus as $item)
                            <tr class="">
                                <td class="name" name="{{$item->menu_name}}" colspan="3">
                                    <div class="d-flex is-sp-column">
                                        <div class="menu-name">
                                            <input type="checkbox" name="menu[]" value="{{$item->menu_code}}" class="menuCheck interval" id="check{{$item->menu_code}}">
                                            <label for="check{{$item->menu_code}}"><span class="bold">{{$item->menu_name}}</span></label>
                                        </div>
                                        <div class="d-flex is-middle price-time">
                                            <div class="price-content d-flex is-middle">
                                                <span class="icon-space"></span>
                                                <span class="price standard_price">{{$item['ask'] == 1 ? __('ask') : ($item['over'] == 1 ? number_format($item['price']) . __('en-char') . __('over') : number_format($item['price']) . __('en-char'))}}</span>
                                            </div>
                                            <div class="time" data-time="{{$item->require_time}}">{{$item->require_time}}分</div>
                                        </div><!-- price-time -->
                                    </div>
                                    <input type="hidden" class="isGoingPrice" value="0">
                                    <p class="description">{{$item->description}}</p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><!-- tamenu -->
                    <div id="menu-footer">
                        <h5 class="color-blue mb-0" style="padding: 10px">選択済みメニューを確認してください</h5>

                        <table class="tamenu">
                            <tbody>
                            <tr>
                                <th colspan="3">選択済み</th>
                            </tr>
                            <tr id="selectedMenu" style="display:none;">
                                <td class="name selected"></td>
                                <td class="price t-right selected" width="100px">&nbsp;</td>
                                <td class="time t-right selected" width="50px"></td>
                            </tr>
                            <tr style="display: table-row;" id="selectedCheck74035" class="selectCountLimitItem">
                                <td class="name selected"><span class="bold">巻き爪ケア</span></td>
                                <td class="price t-right selected" width="100px">￥5,500～</td>
                                <td class="time t-right selected" width="50px">60分</td>
                            </tr>
                            <tr class="lightgray">
                                <th class="all">合計<br><span class="caution">※実際のお支払い金額と異なる場合があります。</span></th>
                                <th id="totalPrice" class="all t-right" width="100px" price="5500" goingprice="0">￥5,500～</th>
                                <th id="totalTime" class="all t-right" width="50px" time="60">60分</th>
                            </tr>
                            </tbody>
                        </table><!-- tamenu -->
                    </div><!--menu-footer -->
                </div>
                <div id="content-footer">
                    <div class="content-footer-btn">
                        <a class="nextButton f-btn">この内容で次へ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
