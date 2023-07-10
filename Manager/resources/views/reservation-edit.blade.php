<x-app-layout>
    <!--begin::Content-->
    <div class="content-body">
        <!-- Ajax Sourced Server-side -->
        <section>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body border-bottom">
                            <div
                                class="d-flex justify-content-between align-items-center header-actions row mt-75">
                                <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                    <h4 class="card-title mb-0">{{__('reservation') . __('detail')}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-2">
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="reservation-id" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('reservation')}}ID</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="reservation-id" class="form-control" placeholder="" name="reservation_id"
                                                   value="{{$data->reservation_code}}" tabindex="1" data-index="1"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="shop-name" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('shop-name')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="shop-name" class="form-control" name="shop_name"
                                                   placeholder="" value="{{$data->shop->shop_name}}" required
                                                   tabindex="2" data-index="2"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="client-id" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('client-name')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="client-id" class="form-control" name="client_id"
                                                   placeholder="" value="{{$data->client->last_name . $data->client->first_name}}" required
                                                   tabindex="3" data-index="3"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="sei-mei" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('sei-mei')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="sei-mei" class="form-control" name="sei_mei"
                                                   placeholder="" value="{{$data->client->sei . $data->client->mei}}" minlength="8"
                                                   tabindex="4" data-index="4"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="phone-number" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('phone-number')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="phone-number" class="form-control" name="phone_number"
                                                   placeholder="" value="{{$data->client->phone}}"
                                                   tabindex="5" data-index="5"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="email" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('email')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="email" id="email" class="form-control" name="email"
                                                   placeholder="" value="{{$data->client->email}}"
                                                   required tabindex="6" data-index="6"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-1 col-md-12">
                                    <div class="mb-1 row">
                                        <label for="reservation-menu" class="col-sm-1 col-form-label-lg"
                                               style="padding-right: 0">{{__('reservation') . __('menu')}}</label>
                                        <div class="col-sm-11" style="padding-left: 0">
                                            <textarea rows="3" id="reservation-menu" class="form-control" name="reservation_menu"
                                                      placeholder="" tabindex="7"
                                                      data-index="7">@php
                                                    $desc = "";
                                                    foreach($data['menu'] as $reservation_menu) {
                                                        $desc = $desc . $reservation_menu['menu']['menu_name'] . "\n" . $reservation_menu['menu']['description'] . "\n";
                                                    }
                                                    echo $desc
                                                @endphp</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="price" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('price')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="price" class="form-control" name="price"
                                                   placeholder="" value="@php
                                                        $price = 0;
                                                        foreach($data['menu'] as $reservation_menu) {
                                                            $price += $reservation_menu['menu']['price'];
                                                        }
                                                        echo $price
                                                   @endphp"
                                                   required tabindex="8" data-index="8"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="require-time" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('require-time')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="require-time" class="form-control" name="time"
                                                   placeholder="" value="@php
                                                        $time = 0;
                                                        foreach($data['menu'] as $reservation_menu) {
                                                            $time += $reservation_menu['menu']['require_time'];
                                                        }
                                                        echo $time
                                                   @endphp" required
                                                   tabindex="9" data-index="9"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="gender" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('gender')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="gender" class="form-control" name="gender"
                                                   placeholder="" value="{{$data->client->gender == 1 ? __('female') : __('male')}}"
                                                   required tabindex="10" data-index="10"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="diagnosis" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('diagnosis')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="diagnosis" class="form-control" name="diagnosis"
                                                   placeholder="" value="{{$data->client->is_first == 1 ? __('first') : __('twice')}}"
                                                   required tabindex="11" data-index="11"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-1 col-md-12">
                                    <div class="mb-1 row">
                                        <label for="request" class="col-sm-12 col-form-label-lg"
                                               style="padding-right: 0">{{__('request')}}</label>
                                        <div class="col-sm-12">
                                            <textarea rows="5" id="request" class="form-control" name="request"
                                                      placeholder="" tabindex="12"
                                                      data-index="12">{{$data->note}}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <label class="btn waves-effect background-dark-blue color-white cursor-pointer"
                                           tabindex="15" id="btn_cancel">{{__('close')}}</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--end::Content-->
</x-app-layout>
