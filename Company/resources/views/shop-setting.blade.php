<x-app-layout>
    <div class="content-body">
        <!-- Dashboard Ecommerce Starts -->
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Statistics Card -->
                <div class="col-xl-12 col-md-12 col-12">
                    <div class="card card-statistics">
                        <div class="card-header d-block pb-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">{{__('shop-info')}}</h4>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button id="change_setting" type="button" class="btn background-dark-blue color-white"
                                            data-bs-toggle="modal" data-bs-target="#editShop"> {{__('edit')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="my-0 col-md-12">
                                    <table class="table table-separate table-head-custom table-checkable" id="table">
                                        <tbody>
                                            <tr>
                                                <td class="p-1 border text-start align-middle px-1">{{__('shop')}}ID : {{$shop->shop_code}}</td>
                                                <td class="p-1 border text-start align-middle px-1">{{__('shop-name')}}</td>
                                                <td colspan="3" class="p-1 border text-start align-middle px-1">{{$shop->shop_name}}</td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" class="p-1 border text-start align-middle px-1">〒{{$shop->post_code}}</td>
                                                <td class="p-1 border text-start align-middle px-1">{{__('address')}} 1</td>
                                                <td class="p-1 border text-start align-middle px-1">{{$shop->address_1}}</td>
                                                <td class="p-1 border text-start align-middle px-1">{{__('phone-number')}}</td>
                                                <td class="p-1 border text-start align-middle px-1">{{$shop->phone}}</td>
                                            </tr>
                                            <tr>
                                                <td class="p-1 border text-start align-middle px-1">{{__('address')}} 2</td>
                                                <td class="p-1 border text-start align-middle px-1">{{$shop->address_2}}</td>
                                                <td class="p-1 border text-start align-middle px-1">{{__('email')}}</td>
                                                <td class="p-1 border text-start align-middle px-1">{{$email}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="p-1 border text-start align-middle px-1">{{__('represent')}}</td>
                                                <td class="p-1 border text-start align-middle px-1">{{$shop->represent}}</td>
                                                <td class="p-1 border text-start align-middle px-1">{{__('phone-number')}}</td>
                                                <td class="p-1 border text-start align-middle px-1">{{$shop->represent_phone}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Statistics Card -->
            </div>
            <div class="row match-height">
                <!-- Statistics Card -->
                <div class="col-xl-12 col-md-12 col-12">
                    <div class="card card-statistics">
                        <div class="card-header d-block">
                            <div class="row mb-md-0">
                                <div class="col-md-6">
                                    <h4 class="card-title">{{__('header-image')}}</h4>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button id="change_image" type="button" class="btn background-dark-blue color-white"
                                            data-bs-toggle="modal" data-bs-target="#editImage"> {{__('edit')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-md-12">
                                    @if(!empty($shop_setting))
                                        @if($shop_setting->image_url)
                                            <img src="{{asset('image') . '/' . $shop_setting->image_url}}" style="width: 100%; height: 100px">
                                        @else
                                            <div style="width: 100%; height: 100px; background: #5a9ad3"></div>
                                        @endif
                                    @else
                                        <div style="width: 100%; height: 100px; background: #5a9ad3"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Statistics Card -->
            </div>
            <div class="row match-height">
                <!-- Statistics Card -->
                <div class="col-xl-12 col-md-12 col-12">
                    <div class="card card-statistics">
                        <div class="card-header d-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">{{__('other-setting')}}</h4>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button id="change_setting" type="button" class="btn background-dark-blue color-white"
                                            data-bs-toggle="modal" data-bs-target="#settingShop"> {{__('edit')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-md-2 text-end">
                                    <p>{{__('running-time')}}</p>
                                </div>
                                <div class="col-md-5 text-end">
                                    <p>@if(!empty($shop_setting))
                                           {{(int)($shop_setting->start_time/60) . "時" . $shop_setting->start_time%60 . "分から" . (int)($shop_setting->end_time/60) . "時" . $shop_setting->end_time%60 . "分"}}
                                    @endif</p>
                                </div>
                                <div class="col-md-4 text-end">
                                    <p>{{__('reservation-unit')}}: @if(!empty($shop_setting))
                                                                       {{$shop_setting->reservation_unit . __('min')}}
                                    @endif</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 text-end">
                                    <p>{{__('accept-people')}}</p>
                                </div>
                                <div class="col-md-5 text-end">
                                    <p>@if(!empty($shop_setting)) {{$shop_setting->accept_people . __('man')}} @endif</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 text-end">
                                    <p>{{__('rest-day')}}</p>
                                </div>
                                <div class="col-md-5 text-end">
                                    <p>@if(!empty($shop_setting) && !empty($shop_rest_day))
                                           {{$shop_rest_day}}
                                        @else
                                            なし
                                    @endif</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 text-end">
                                    <p>{{__('temp-rest')}}</p>
                                </div>
                                <div class="col-md-5 text-end">
                                    <p>@if(!empty($shop_temp_this_month))
                                            @foreach($shop_temp_this_month as $item)
                                                {{date('m月d日', strtotime($item->temp_rest))}}
                                            @endforeach
                                        @else
                                            なし
                                        @endif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Statistics Card -->
            </div>
        </section>
        <!-- Show Shop Image Modal -->
        <div class="modal fade" id="editImage" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <div class="text-center mt-1">
                            <h3>{{__('header-image')}}</h3>
                        </div>
                    </div>
                    <div class="modal-body pb-2 px-3 pt-0">
                        <div class="row mb-1">
                            <div class="col-sm-12">
                                <p class="mb-0">登録画像の大きさは、945×10980でお願いします。</p>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-12">
                                @if(!empty($shop_setting))
                                    @if($shop_setting->image_url)
                                        <img src="{{asset('image') . '/' . $shop_setting->image_url}}" style="width: 100%; height: 100px;">
                                    @else
                                        <div style="width: 100%; height: 100px; background: #5a9ad3"></div>
                                    @endif
                                @else
                                    <div style="width: 100%; height: 100px; background: #5a9ad3"></div>
                                @endif
                            </div>
                        </div>
                        <form id="change_url_form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" value="{{$shop->id}}">
                                    <label for="formFile" class="form-label">{{__('file-select')}}</label>
                                    <input class="form-control" type="file" id="formFile" name="image"
                                           accept="image/png, image/gif, image/jpeg" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button"
                                            class="btn waves-effect background-dark-blue color-white me-1 btn_submit"
                                            id="change_url">{{__('register')}}</button>
                                    @if(!empty($shop_setting))
                                        @if($shop_setting->image_url)
                                            <button type="button"
                                                    class="btn btn-danger waves-effect waves-float waves-light me-1"
                                                    id="delete_url">{{__('delete')}}</button>
                                        @endif
                                    @endif
                                    <label class="btn waves-effect background-dark-blue color-white cursor-pointer me-1"
                                           tabindex="15" data-bs-dismiss="modal"
                                           aria-label="Close">{{__('close')}}</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Modal -->
        <!-- Show Shop Info Modal -->
        <div class="modal fade" id="editShop" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <div class="text-center mt-1">
                            <h3>{{__('shop')}}</h3>
                        </div>
                        {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
                    </div>
                    <div class="modal-body pb-2 px-3 pt-0">
                        <form class="form" id="save_form">
                            @csrf
                            <input type="hidden" name="id" value="{{$shop->id}}">
                            <div class="row mb-1">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <label for="shop-code" class="col-sm-4 col-form-label-lg"
                                               style="padding-right: 0">{{__('shop')}}ID</label>
                                        <div class="col-sm-8" style="padding-left: 0">
                                            <input type="text" id="shop-code" class="form-control"
                                                   placeholder="" value="{{$shop->shop_code}}" required disabled/>
                                            <input type="hidden" id="shop_code" name="shop_code" value="{{$shop->shop_code}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <label for="shop-name" class="col-sm-4 col-form-label-lg"
                                               style="padding-right: 0">{{__('shop-name')}}</label>
                                        <div class="col-sm-8" style="padding-left: 0">
                                            <input type="text" id="shop-name" class="form-control" name="shop_name"
                                                   placeholder="" value="{{$shop->shop_name}}" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-6">
                                    <div class="row">
                                        <label for="post-code" class="col-sm-4 col-form-label-lg pt-0 pe-0 pb-0">
                                            {{__('post-code')}}<br><span class="font-small-1">{{__('no-half')}}</span></label>
                                        <div class="col-sm-8" style="padding-left: 0">
                                            <input type="number" id="post-code" class="form-control" name="post_code"
                                                   placeholder="" value="{{$shop->post_code}}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <label for="address-1" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('address')}}1</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="address-1" class="form-control" name="address_1"
                                                   placeholder="" value="{{$shop->address_1}}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <label for="address-2" class="col-sm-2 col-form-label-lg pt-0 pe-0">
                                            {{__('address')}}2<br><span class="font-small-2">{{__('office-number')}}</span></label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="address-2" class="form-control" name="address_2" value="{{$shop->address_2}}"
                                                   placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-6">
                                    <div class="row">
                                        <label for="phone" class="col-sm-4 col-form-label-lg pt-0 pe-0">
                                            {{__('phone')}}<br><span class="font-small-1">{{__('no-half')}}</span></label>
                                        <div class="col-sm-8" style="padding-left: 0">
                                            <input type="number" id="phone" class="form-control" name="phone" value="{{$shop->phone}}"
                                                   placeholder="" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="email" class="col-sm-4 col-form-label-lg"
                                               style="padding-right: 0">{{__('email')}}</label>
                                        <div class="col-sm-8" style="padding-left: 0">
                                            <input type="email" id="email" class="form-control" name="email" value="{{$email}}"
                                                   placeholder="" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="represent" class="col-sm-4 col-form-label-lg"
                                               style="padding-right: 0">{{__('represent')}}</label>
                                        <div class="col-sm-8" style="padding-left: 0">
                                            <input type="text" id="represent" class="form-control" name="represent" value="{{$shop->represent}}"
                                                   placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="represent-phone" class="col-sm-4 col-form-label-lg pt-0 pe-0">
                                            {{__('represent-phone')}}<br><span class="font-small-1">{{__('no-half')}}</span></label>
                                        <div class="col-sm-8" style="padding-left: 0">
                                            <input type="number" id="represent-phone" class="form-control" name="represent_phone" value="{{$shop->represent_phone}}"
                                                   placeholder="" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="login-id" class="col-sm-4 col-form-label-lg"
                                               style="padding-right: 0">{{__('login')}}ID</label>
                                        <div class="col-sm-8" style="padding-left: 0">
                                            <input type="email" id="login-id" class="form-control"
                                                   placeholder="" value="{{$email}}" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="password" class="col-sm-4 col-form-label-lg"
                                               style="padding-right: 0">{{__('password')}}</label>
                                        <div class="col-sm-8" style="padding-left: 0">
                                            <input type="password" id="password" class="form-control" name="password" minlength="8"
                                                   placeholder=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    <div class="row">
                                        <label for="shop-url" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('shop-url')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="shop-url" class="form-control" value="https://www.makidume-yoyaku.com/reservation/{{$shop->shop_code}}"
                                                   placeholder="" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label for="note" class="col-sm-12 col-form-label-lg"
                                       style="padding-right: 0">{{__('note')}} (100{{__('char')}})</label>
                                <div class="col-sm-12">
                                    <textarea rows="5" id="note" class="form-control" name="note" placeholder="">{{$shop->my_note}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn waves-effect background-dark-blue color-white me-1 btn_submit"
                                            id="save_shop">{{__('register')}}</button>
                                    <label class="btn waves-effect background-dark-blue color-white cursor-pointer me-1"
                                           tabindex="15" data-bs-dismiss="modal" aria-label="Close">{{__('close')}}</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Modal -->
        <!-- Show Shop Setting Modal -->
        <div class="modal fade" id="settingShop" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <div class="text-center mt-1">
                            <h3>{{__('other-setting')}}</h3>
                        </div>
                    </div>
                    <div class="modal-body pb-2 px-3 pt-0">
                        <form id="change_setting_form" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$shop->id}}">
                            <div class="row mb-1">
                                <div class="col-md-2 text-start">
                                    <p style="margin-top: 7px">{{__('running-time')}}</p>
                                </div>
                                <div class="col-md-10 d-flex pr-0">
                                    <select class="form-select" name="start_time_hour" id="start_time_hour">
                                        <option value="0" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 0 ? 'selected' : ''}}>00時</option>
                                        <option value="1" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 1 ? 'selected' : ''}}>01時</option>
                                        <option value="2" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 2 ? 'selected' : ''}}>02時</option>
                                        <option value="3" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 3 ? 'selected' : ''}}>03時</option>
                                        <option value="4" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 4 ? 'selected' : ''}}>04時</option>
                                        <option value="5" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 5 ? 'selected' : ''}}>05時</option>
                                        <option value="6" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 6 ? 'selected' : ''}}>06時</option>
                                        <option value="7" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 7 ? 'selected' : ''}}>07時</option>
                                        <option value="8" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 8 ? 'selected' : ''}}>08時</option>
                                        <option value="9" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 9 ? 'selected' : ''}}>09時</option>
                                        <option value="10" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 10 ? 'selected' : ''}} >10時</option>
                                        <option value="11" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 11 ? 'selected' : ''}}>11時</option>
                                        <option value="12" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 12? 'selected' : ''}}>12時</option>
                                        <option value="13" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 13? 'selected' : ''}}>13時</option>
                                        <option value="14" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 14 ? 'selected' : ''}}>14時</option>
                                        <option value="15" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 15 ? 'selected' : ''}}>15時</option>
                                        <option value="16" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 16 ? 'selected' : ''}}>16時</option>
                                        <option value="17" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 17 ? 'selected' : ''}}>17時</option>
                                        <option value="18" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 18 ? 'selected' : ''}}>18時</option>
                                        <option value="19" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 19 ? 'selected' : ''}}>19時</option>
                                        <option value="20" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 20 ? 'selected' : ''}}>20時</option>
                                        <option value="21" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 21 ? 'selected' : ''}}>21時</option>
                                        <option value="22" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 22 ? 'selected' : ''}}>22時</option>
                                        <option value="23" {{!empty($shop_setting) && (int)($shop_setting->start_time/60) == 23 ? 'selected' : ''}}>23時</option>
                                    </select>
                                    <select class="form-select" name="start_time_min" id="start_time_min">
                                        <option value="0" {{!empty($shop_setting) && $shop_setting->start_time%60 == 0 ? 'selected' : ''}}>00分</option>
                                        <option value="30" {{!empty($shop_setting) && $shop_setting->start_time%60 == 30 ? 'selected' : ''}}>30分</option>
                                    </select>
                                    <label class="mx-1" style="margin-top: 7px">~</label>
                                    <select class="form-select" name="end_time_hour" id="end_time_hour">
                                        <option value="0" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 0 ? 'selected' : ''}}>00時</option>
                                        <option value="1" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 1 ? 'selected' : ''}}>01時</option>
                                        <option value="2" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 2 ? 'selected' : ''}}>02時</option>
                                        <option value="3" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 3 ? 'selected' : ''}}>03時</option>
                                        <option value="4" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 4 ? 'selected' : ''}}>04時</option>
                                        <option value="5" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 5 ? 'selected' : ''}}>05時</option>
                                        <option value="6" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 6 ? 'selected' : ''}}>06時</option>
                                        <option value="7" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 7 ? 'selected' : ''}}>07時</option>
                                        <option value="8" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 8 ? 'selected' : ''}}>08時</option>
                                        <option value="9" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 9 ? 'selected' : ''}}>09時</option>
                                        <option value="10" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 10 ? 'selected' : ''}} >10時</option>
                                        <option value="11" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 11 ? 'selected' : ''}}>11時</option>
                                        <option value="12" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 12? 'selected' : ''}}>12時</option>
                                        <option value="13" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 13? 'selected' : ''}}>13時</option>
                                        <option value="14" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 14 ? 'selected' : ''}}>14時</option>
                                        <option value="15" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 15 ? 'selected' : ''}}>15時</option>
                                        <option value="16" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 16 ? 'selected' : ''}}>16時</option>
                                        <option value="17" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 17 ? 'selected' : ''}}>17時</option>
                                        <option value="18" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 18 ? 'selected' : ''}}>18時</option>
                                        <option value="19" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 19 ? 'selected' : ''}}>19時</option>
                                        <option value="20" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 20 ? 'selected' : ''}}>20時</option>
                                        <option value="21" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 21 ? 'selected' : ''}}>21時</option>
                                        <option value="22" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 22 ? 'selected' : ''}}>22時</option>
                                        <option value="23" {{!empty($shop_setting) && (int)($shop_setting->end_time/60) == 23 ? 'selected' : ''}}>23時</option>
                                    </select>
                                    <select class="form-select" name="end_time_min" id="end_time_min">
                                        <option value="0" {{!empty($shop_setting) && $shop_setting->end_time%60 == 0 ? 'selected' : ''}}>00分</option>
                                        <option value="30" {{!empty($shop_setting) && $shop_setting->end_time%60 == 30 ? 'selected' : ''}}>30分</option>
                                    </select>
                                    <label class="mx-1" style="margin-top: 10px; white-space: nowrap">{{__('unit')}}</label>
                                    <select class="form-select" name="reservation_unit">
                                        <option value="30" {{!empty($shop_setting) && $shop_setting->reservation_unit == 30 ? 'selected' : ''}}>30分</option>
                                        <option value="60" {{!empty($shop_setting) && $shop_setting->reservation_unit == 60 ? 'selected' : ''}}>60分</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-2 text-start">
                                    <p class="mb-0">{{__('rest-day')}}</p>
                                </div>
                                <div class="col-md-10 d-flex">
                                    <input type="hidden" id="rest_day" value="{{!empty($shop_setting) ? $shop_setting->rest_day : ''}}">
                                    <input class="form-check-input rest_day" type="checkbox" name="rest_day[]" id="inlineRadio1" value="0" {{!empty($shop_rest_arr) && in_array(0, $shop_rest_arr) ? 'checked' : ''}} />
                                    <label class="form-check-label" for="inlineRadio1" style="margin-right: 5px;">月曜日</label>
                                    <input class="form-check-input rest_day" type="checkbox" name="rest_day[]" id="inlineRadio2" value="1" {{!empty($shop_rest_arr) && in_array(1, $shop_rest_arr) ? 'checked' : ''}} />
                                    <label class="form-check-label" for="inlineRadio2" style="margin-right: 5px;">火曜日</label>
                                    <input class="form-check-input rest_day" type="checkbox" name="rest_day[]" id="inlineRadio3" value="2" {{!empty($shop_rest_arr) && in_array(2, $shop_rest_arr) ? 'checked' : ''}} />
                                    <label class="form-check-label" for="inlineRadio3" style="margin-right: 5px;">水曜日</label>
                                    <input class="form-check-input rest_day" type="checkbox" name="rest_day[]" id="inlineRadio4" value="3" {{!empty($shop_rest_arr) && in_array(3, $shop_rest_arr) ? 'checked' : ''}} />
                                    <label class="form-check-label" for="inlineRadio4" style="margin-right: 5px;">木曜日</label>
                                    <input class="form-check-input rest_day" type="checkbox" name="rest_day[]" id="inlineRadio5" value="4" {{!empty($shop_rest_arr) && in_array(4, $shop_rest_arr) ? 'checked' : ''}} />
                                    <label class="form-check-label" for="inlineRadio5" style="margin-right: 5px;">金曜日</label>
                                    <input class="form-check-input rest_day" type="checkbox" name="rest_day[]" id="inlineRadio6" value="5" {{!empty($shop_rest_arr) && in_array(5, $shop_rest_arr) ? 'checked' : ''}} />
                                    <label class="form-check-label" for="inlineRadio6" style="margin-right: 5px;">土曜日</label>
                                    <input class="form-check-input rest_day" type="checkbox" name="rest_day[]" id="inlineRadio7" value="6" {{!empty($shop_rest_arr) && in_array(6, $shop_rest_arr) ? 'checked' : ''}} />
                                    <label class="form-check-label" for="inlineRadio7" style="margin-right: 5px;">日曜日</label>
                                    <input class="form-check-input" type="checkbox" name="rest_day[]" id="rest_day_no" value="" {{!empty($shop_setting) & empty($shop_setting->rest_day) ? 'checked' : ''}} />
                                    <label class="form-check-label" for="rest_day_no" style="margin-right: 5px;">なし</label>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-2 text-start">
                                    <p style="margin-top: 7px">{{__('accept-people')}}</p>
                                </div>
                                <div class="col-md-2 d-flex">
                                    <select class="form-select" name="accept_people" tabindex="2" data-index="2">
                                        <option value="1"  {{!empty($shop_setting) && $shop_setting->accept_people == 1 ? 'selected' : ''}}>1人</option>
                                        <option value="2" {{!empty($shop_setting) && $shop_setting->accept_people == 2? 'selected' : ''}}>2人</option>
                                        <option value="3" {{!empty($shop_setting) && $shop_setting->accept_people == 3 ? 'selected' : ''}}>3人</option>
                                        <option value="4" {{!empty($shop_setting) && $shop_setting->accept_people == 4 ? 'selected' : ''}}>4人</option>
                                        <option value="5" {{!empty($shop_setting) && $shop_setting->accept_people == 5 ? 'selected' : ''}}>5人</option>
                                        <option value="6" {{!empty($shop_setting) && $shop_setting->accept_people == 6 ? 'selected' : ''}}>6人</option>
                                        <option value="7" {{!empty($shop_setting) && $shop_setting->accept_people == 7 ? 'selected' : ''}}>7人</option>
                                        <option value="8" {{!empty($shop_setting) && $shop_setting->accept_people == 8 ? 'selected' : ''}}>8人</option>
                                        <option value="9" {{!empty($shop_setting) && $shop_setting->accept_people == 9 ? 'selected' : ''}}>9人</option>
                                        <option value="10" {{!empty($shop_setting) && $shop_setting->accept_people == 10 ? 'selected' : ''}}>10人</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-2 text-start">
                                    <p>{{__('temp-rest')}}</p>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p id="p_month">{{date('n')}}月</p>
                                        </div>
                                        <div class="col-md-10" id="this_month">
                                            <div class="mb-1" style="text-align: right">
                                                <label id="next_month_btn" class="btn waves-effect background-dark-blue color-white">{{__('next-month')}}</label>
                                            </div><!-- time-btn -->
                                            <table id="calendar"></table>
                                        </div>
                                        <div class="col-md-10" id="next_month" style="display: none">
                                            <div class="text-left mb-1">
                                                <label id="prev_month_btn" class="btn waves-effect background-dark-blue color-white">{{__('prev-month')}}</label>
                                            </div><!-- time-btn -->
                                            <table id="next_calendar"></table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="button"
                                            class="btn waves-effect background-dark-blue color-white me-1 btn_submit"
                                            id="change_shop_setting">{{__('register')}}</button>
                                    <label class="btn waves-effect background-dark-blue color-white cursor-pointer me-1"
                                           tabindex="15" data-bs-dismiss="modal" aria-label="Close">{{__('close')}}</label>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--/ Modal -->
    </div>
    <script>
        let temp_days = '{!! json_encode($shop_temp_this_month->toArray()) !!}'
        temp_days = JSON.parse(temp_days)
        $(document).ready(function (){
            $('#start-time').flatpickr({
                enableTime: true,
                noCalendar: true
            })
            $('#end-time').flatpickr({
                enableTime: true,
                noCalendar: true
            })
            $('#next_month_btn').click(function () {
                $('#this_month').hide()
                let date = new Date()
                let month = date.getMonth() + 2
                $('#p_month').html(month + "月")
                $('#next_month').show()
            })
            $('#prev_month_btn').click(function () {
                $('#this_month').show()
                let date = new Date()
                let month = date.getMonth() + 1
                $('#p_month').html(month + "月")
                $('#next_month').hide()
            })
            createCalendar()
            createNextCalendar()
            $('#save_shop').click(function (e) {
                e.preventDefault()
                if ($('#save_form').valid()) {
                    var paramObj = new FormData($('#save_form')[0])
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    })
                    $.ajax({
                        url: '{{route('shop-save')}}',
                        type: 'post',
                        data: paramObj,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (response.status == true) {
                                toastr.success("成功しました。")
                                window.location.reload()
                                $('#editShop').modal('hide')
                            } else {
                                toastr.warning("失敗しました。")
                            }
                        },
                    })
                }
            })
            $('#change_url').click(function (e) {
                e.preventDefault()
                if ($('#change_url_form').valid()) {
                    var paramObj = new FormData($('#change_url_form')[0])
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    })
                    $.ajax({
                        url: '{{ route('shop-image') }}',
                        type: 'post',
                        data: paramObj,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (response.status == true) {
                                toastr.success("成功しました。")
                                window.location.reload()
                                $('#editImage').modal('hide')
                            } else {
                                toastr.warning("失敗しました。")
                            }
                        },
                    })
                }
            })
            $('#delete_url').click(function (e) {
                e.preventDefault()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                })
                $.ajax({
                    url: '{{route('shop-image-delete')}}',
                    type: 'get',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == true) {
                            toastr.success("成功しました。")
                            window.location.reload()
                            $('#editImage').modal('hide')
                        } else {
                            toastr.warning("失敗しました。")
                        }
                    },
                })
            })
            $('#change_shop_setting').click(function (e) {
                e.preventDefault()
                if ($('#change_setting_form').valid()) {
                    let formDataArray = $('#change_setting_form').serializeArray();
                    console.log(formDataArray);
                    let isSet = formDataArray.some(item => item.name == "rest_day[]")
                    if(!isSet){
                        Swal.fire({
                            title: '定休日',
                            text: "定休日を設定してください。",
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'はい',
                            customClass: {
                                confirmButton: 'btn background-dark-blue color-white',
                            },
                            buttonsStyling: false
                        })
                        return;
                    }
                    var paramObj = new FormData($('#change_setting_form')[0])
                    let start_time_hour = parseInt($('#start_time_hour').find(':selected').val())
                    let end_time_hour = parseInt($('#end_time_hour').find(':selected').val())
                    if(end_time_hour < start_time_hour){
                        Swal.fire({
                            title: '運営時間',
                            text: "店舗運営時間の設定に問題があります。 運用開始時間と終了時間が正確ではありません。",
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'はい',
                            customClass: {
                                confirmButton: 'btn background-dark-blue color-white',
                            },
                            buttonsStyling: false
                        })
                        return
                    }
                    else{
                        if(end_time_hour == start_time_hour){
                            let start_time_min = parseInt($('#start_time_min').find(':selected').val())
                            let end_time_min = parseInt($('#end_time_min').find(':selected').val())
                            if(end_time_min <= start_time_min){
                                Swal.fire({
                                    title: '運営時間',
                                    text: "店舗運営時間の設定に問題があります。 運用開始時間と終了時間が正確ではありません。",
                                    icon: 'warning',
                                    showCancelButton: false,
                                    confirmButtonText: 'はい',
                                    customClass: {
                                        confirmButton: 'btn background-dark-blue color-white',
                                    },
                                    buttonsStyling: false
                                })
                                return
                            }
                        }
                    }

                    let rest_day = $('#rest_day').val()
                    if(rest_day != ""){
                        rest_day = rest_day.split(',')
                        rest_day = rest_day.map(Number)
                    }
                    let temp_rest_day = []
                    $('.temp_select').each(function (){
                        let select = $(this).find(':selected').val()
                        if(select == 0){
                            if(rest_day != ''){
                                if(!rest_day.includes($(this).data('week'))){
                                    temp_rest_day.push($(this).data('id'))
                                }
                            }
                            else{
                                temp_rest_day.push($(this).data('id'))
                            }
                        }
                    })
                    if(temp_rest_day.length){
                        Swal.fire({
                            title: '臨時休業日',
                            text: "臨時休業日を設定してください。",
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'はい',
                            customClass: {
                                confirmButton: 'btn background-dark-blue color-white',
                            },
                            buttonsStyling: false
                        })
                        return;
                    }
                    paramObj.append('temp_rest_day', temp_rest_day)
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    })
                    $.ajax({
                        url: '{{ route('change-setting') }}',
                        type: 'post',
                        data: paramObj,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (response.status == true) {
                                toastr.success("成功しました。")
                                window.location.reload()
                                $('#editImage').modal('hide')
                            } else {
                                toastr.warning("失敗しました。")
                            }
                        },
                    })
                }
            })
            $('#rest_day_no').click(function () {
                $t = $(this)
                if ($t.prop('checked')) {
                    $('.rest_day').each(function () {
                        let d_week = $(this).val()
                        if($(this).prop('checked')){
                            $('.temp_select').each(function (){
                                let week = $(this).data('week')
                                if(week == d_week){
                                    $(this).removeClass('color-red-tmp')
                                    $(this).prop('disabled', false)
                                    $(this).val(1)
                                }
                            })
                        }
                        $(this).prop('checked', false)
                        $(this).prop('disabled', true)
                    })
                }
                else{
                    $('.rest_day').each(function () {
                        $(this).prop('disabled', false)
                    })
                }
            })
            $('.rest_day').click(function () {
                let value = $(this).val()
                if ($(this).prop('checked')){
                    $('.temp_select').each(function (){
                        let week = $(this).data('week')
                        if(week == value){
                            if(!$(this).hasClass('before')){
                                $(this).addClass('color-red-tmp')
                                $(this).prop('disabled', true)
                                $(this).val(0)
                            }
                        }
                    })
                }
                else{
                    $('.temp_select').each(function (){
                        let week = $(this).data('week')
                        if(week == value){
                            if(!$(this).hasClass('before')){
                                $(this).removeClass('color-red-tmp')
                                $(this).prop('disabled', false)
                                $(this).val(1)
                            }
                        }
                    })
                }
            })
            $('.temp_select').click(function () {
                let select = $(this).find(':selected').val()
                if(select == 0){
                    $(this).addClass('color-red-tmp')
                }
                else{
                    $(this).removeClass('color-red-tmp')
                }
            })
        })
        function createCalendar() {
            let date = new Date()
            let month = date.getMonth()
            console.log(month)
            let year = date.getFullYear()
            let today = date.getDate()
            let firstDay = (new Date(year, month)).getDay()
            let rest_day = $('#rest_day').val()
            if(rest_day != ""){
                rest_day = rest_day.split(',')
            }

            firstDay = (firstDay === 0) ? 6 : firstDay - 1 // Adjusting the first day to be Monday
            let daysInMonth = 32 - new Date(year, month, 32).getDate()
            let tbl = document.getElementById("calendar")

            tbl.innerHTML = ""

            let dateNumber = 1
            let row = document.createElement("tr")
            let weekdays = ['月', '火', '水', '木', '金', '土', '日']
            for (let j = 0; j < 7; j++) {
                let cell = document.createElement("td")
                let cellText = document.createTextNode(weekdays[j])
                if(j == 5){
                    cell.classList.add('sat')
                }
                if(j == 6){
                    cell.classList.add('sun')
                }
                cell.appendChild(cellText)
                row.appendChild(cell)
            }
            tbl.appendChild(row)
            for (let i = 0; i < 6; i++) {
                let row = document.createElement("tr")
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        let cell = document.createElement("td")
                        if(j == 5){
                            cell.classList.add('sat')
                        }
                        if(j == 6){
                            cell.classList.add('sun')
                        }
                        let cellText = document.createTextNode("")
                        cell.appendChild(cellText)
                        row.appendChild(cell)
                    }
                    else if (dateNumber > daysInMonth) {
                       break
                    }
                    else {
                        let cell = document.createElement("td")
                        if(j == 5){
                            cell.classList.add('sat')
                        }
                        if(j == 6){
                            cell.classList.add('sun')
                        }
                        let cellText = document.createTextNode(dateNumber)
                        let selectOption = document.createElement('select')
                        selectOption.classList.add('temp_select')
                        let r_month = month + 1
                        selectOption.dataset.id = r_month + "-" + dateNumber
                        selectOption.dataset.week = j
                        let options = [
                            { value: 0, label: "休業" },
                            { value: 1, label: "営業" }
                        ]
                        for(let k = 0; k < options.length; k++){
                            let option = document.createElement('option')
                            option.text = options[k].label
                            option.value = options[k].value
                            selectOption.add(option)
                        }
                        selectOption.selectedIndex = 1
                        if(rest_day != ""){
                            for(let k = 0; k < rest_day.length; k++){
                                if(rest_day[k] == j){
                                    selectOption.selectedIndex = 0
                                    selectOption.classList.add('color-red-tmp')
                                    selectOption.disabled = true
                                }
                            }
                        }
                        if(temp_days.length > 0){
                            for(let i = 0; i < temp_days.length; i++){
                                let temp_rest = temp_days[i]['temp_rest']
                                let tmp_arr = temp_rest.split('-')
                                let day = parseInt(tmp_arr[2])
                                if(day == dateNumber) {
                                    selectOption.selectedIndex = 0
                                    selectOption.classList.add('color-red-tmp')
                                }
                            }
                        }
                        if(dateNumber <= today){
                            selectOption.disabled = true
                            selectOption.classList.add('before')
                        }
                        cell.appendChild(cellText)
                        cell.appendChild(selectOption)
                        row.appendChild(cell)
                        dateNumber++
                    }
                }
                tbl.appendChild(row)
            }
        }
        function createNextCalendar() {
            let date = new Date()
            let month = date.getMonth() + 1
            console.log(month)
            let year = date.getFullYear()
            let firstDay = (new Date(year, month)).getDay()
            let rest_day = $('#rest_day').val()
            if(rest_day != ""){
                rest_day = rest_day.split(',')
            }

            firstDay = (firstDay === 0) ? 6 : firstDay - 1 // Adjusting the first day to be Monday
            let daysInMonth = 32 - new Date(year, month, 32).getDate()
            let tbl = document.getElementById("next_calendar")

            tbl.innerHTML = ""

            let dateNumber = 1
            let row = document.createElement("tr")
            let weekdays = ['月', '火', '水', '木', '金', '土', '日']
            for (let j = 0; j < 7; j++) {
                let cell = document.createElement("td")
                let cellText = document.createTextNode(weekdays[j])
                if(j == 5){
                    cell.classList.add('sat')
                }
                if(j == 6){
                    cell.classList.add('sun')
                }
                cell.appendChild(cellText)
                row.appendChild(cell)
            }
            tbl.appendChild(row)
            for (let i = 0; i < 6; i++) {
                let row = document.createElement("tr")
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        let cell = document.createElement("td")
                        if(j == 5){
                            cell.classList.add('sat')
                        }
                        if(j == 6){
                            cell.classList.add('sun')
                        }
                        let cellText = document.createTextNode("")
                        cell.appendChild(cellText)
                        row.appendChild(cell)
                    }
                    else if (dateNumber > daysInMonth) {
                        break
                    }
                    else {
                        let cell = document.createElement("td")
                        if(j == 5){
                            cell.classList.add('sat')
                        }
                        if(j == 6){
                            cell.classList.add('sun')
                        }
                        let cellText = document.createTextNode(dateNumber)
                        let selectOption = document.createElement('select')
                        selectOption.classList.add('temp_select')
                        let r_month = month + 1
                        selectOption.dataset.id = r_month + "-" + dateNumber
                        selectOption.dataset.week = j
                        let options = [
                            { value: 0, label: "休業" },
                            { value: 1, label: "営業" }
                        ]
                        for(let k = 0; k < options.length; k++){
                            let option = document.createElement('option')
                            option.text = options[k].label
                            option.value = options[k].value
                            selectOption.add(option)
                        }
                        selectOption.selectedIndex = 1
                        if(rest_day != ""){
                            for(let k = 0; k < rest_day.length; k++){
                                if(rest_day[k] == j){
                                    selectOption.selectedIndex = 0
                                    selectOption.classList.add('color-red-tmp')
                                    selectOption.disabled = true
                                }
                            }
                        }
                        if(temp_days.length > 0){
                            for(let i = 0; i < temp_days.length; i++){
                                let temp_rest = temp_days[i]['temp_rest']
                                let tmp_arr = temp_rest.split('-')
                                let day = parseInt(tmp_arr[2])
                                if(day == dateNumber) {
                                    selectOption.selectedIndex = 0
                                    selectOption.classList.add('color-red-tmp')
                                }
                            }
                        }
                        cell.appendChild(cellText)
                        cell.appendChild(selectOption)
                        row.appendChild(cell)
                        dateNumber++
                    }
                }
                tbl.appendChild(row)
            }
        }
    </script>
    <style>
        #calendar{
            width: 100%;
            border: 1px solid;
        }
        #calendar>tr{
            border-top: 1px solid;
        }
        #calendar>tr>td{
            border-left: 1px solid;
            border-right: 1px solid;
            text-align: center;
            padding: 2px;
        }
        #calendar>tr>td>select{
            margin: 2px 5px;
        }
        #next_calendar{
            width: 100%;
            border: 1px solid;
        }
        #next_calendar>tr{
            border-top: 1px solid;
        }
        #next_calendar>tr>td{
            border-left: 1px solid;
            border-right: 1px solid;
            text-align: center;
            padding: 2px;
        }
        #next_calendar>tr>td>select{
            margin: 2px 5px;
        }
        .sat{
            background-color: #e8f3ff;
            color: #4285ef;
        }
        .sun{
            background-color: #ffeeee;
            color: #d94535;
        }
    </style>
</x-app-layout>
