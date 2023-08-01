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
                                    <h4 class="card-title mb-0">{{__('client') . __('detail')}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-2">
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="client-id" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('client-name')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" id="client-id" class="form-control" name="client_id"
                                                   placeholder="" value="{{$data->last_name . $data->first_name}}" required
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
                                                   placeholder="" value="{{$data->sei . $data->mei}}"
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
                                                   placeholder="" value="{{$data->phone}}"
                                                   tabindex="5" data-index="5"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="email" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('email')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="email" class="form-control" name="email"
                                                   placeholder="" value="{{$data->email}}"
                                                   required tabindex="6" data-index="6"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="gender" class="col-sm-2 col-form-label-lg"
                                               style="padding-right: 0">{{__('gender')}}</label>
                                        <div class="col-sm-10" style="padding-left: 0">
                                            <input type="text" class="form-control" name="gender"
                                                   placeholder="" value="{{$data->gender == 1 ? __('female') : __('male')}}"
                                                   required tabindex="7" data-index="7"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row border-top">
                                <div class="my-1 col-md-12">
                                    <table class="table table-separate table-head-custom table-checkable" id="table">
                                        <thead>
                                        <tr>
                                            <th class="text-center">{{__('visit-time')}}</th>
                                            <th class="text-center">{{__('shop-name')}}</th>
                                            <th class="text-center">{{__('detail')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($reservations as $index => $item)
                                            <tr>
                                                <td class="p-0 border text-left align-middle px-1">{{date('Y/m/d H:i', strtotime($item['reservation_time']))}}</td>
                                                <td class="p-0 border text-left align-middle px-1">{{$item['shop']['shop_name']}}</td>
                                                <td class="p-0 border text-center align-middle">
                                                    <button data-id="{{$item->id}}" class="btn btn-outline-dark waves-effect ex_change show_detail" style="padding: 8px; margin: 5px;">
                                                        {{__('detail')}}</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <label class="btn waves-effect background-dark-blue color-white cursor-pointer"
                                           tabindex="15" id="btn_cancel">{{__('close')}}</label>
{{--                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoReservation">Show</button>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Show Reservation Info Modal -->
    <div class="modal fade" id="infoReservation" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <div class="text-center mt-1">
                        <h3>{{__('reservation') . __('detail')}}</h3>
                    </div>
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
                </div>
                <div class="modal-body pb-2 px-3 pt-0">
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <div class="mb-1 row">
                                <label for="reservation_id" class="col-sm-4 col-form-label-lg"
                                       style="padding-right: 0">{{__('reservation')}}ID</label>
                                <div class="col-sm-8" style="padding-left: 0">
                                    <input type="text" id="reservation_id" class="form-control" tabindex="1" data-index="1"/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 col-md-6">
                            <div class="mb-1 row">
                                <label for="shop_name" class="col-sm-4 col-form-label-lg"
                                       style="padding-right: 0">{{__('shop-name')}}</label>
                                <div class="col-sm-8" style="padding-left: 0">
                                    <input type="text" id="shop_name" class="form-control" tabindex="2" data-index="2"/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 col-md-6">
                            <div class="mb-1 row">
                                <label for="client-id" class="col-sm-4 col-form-label-lg"
                                       style="padding-right: 0">{{__('client-name')}}</label>
                                <div class="col-sm-8" style="padding-left: 0">
                                    <input type="text" id="client_name" class="form-control" tabindex="3" data-index="3"/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 col-md-6">
                            <div class="mb-1 row">
                                <label for="sei-mei" class="col-sm-4 col-form-label-lg"
                                       style="padding-right: 0">{{__('sei-mei')}}</label>
                                <div class="col-sm-8" style="padding-left: 0">
                                    <input type="text" id="sei_mei" class="form-control" tabindex="4" data-index="4"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <div class="mb-1 row">
                                <label for="phone" class="col-sm-4 col-form-label-lg"
                                       style="padding-right: 0">{{__('phone-number')}}</label>
                                <div class="col-sm-8" style="padding-left: 0">
                                    <input type="text" id="phone" class="form-control" tabindex="5" data-index="5"/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 col-md-6">
                            <div class="mb-1 row">
                                <label for="email" class="col-sm-4 col-form-label-lg"
                                       style="padding-right: 0">{{__('email')}}</label>
                                <div class="col-sm-8" style="padding-left: 0">
                                    <input type="email" id="email" class="form-control" tabindex="6" data-index="6"/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 col-md-12">
                            <div class="mb-1 row">
                                <label for="reservation_menu" class="col-sm-2 col-form-label-lg"
                                       style="padding-right: 0">{{__('reservation') . __('menu')}}</label>
                                <div class="col-sm-10" style="padding-left: 0">
                                    <textarea rows="3" id="reservation_menu" class="form-control" tabindex="7" data-index="7"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 col-md-6">
                            <div class="mb-1 row">
                                <label for="price" class="col-sm-4 col-form-label-lg"
                                       style="padding-right: 0">{{__('price')}}</label>
                                <div class="col-sm-8" style="padding-left: 0">
                                    <input type="text" id="price" class="form-control" tabindex="8" data-index="8"/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 col-md-6">
                            <div class="mb-1 row">
                                <label for="require_time" class="col-sm-4 col-form-label-lg"
                                       style="padding-right: 0">{{__('require-time')}}</label>
                                <div class="col-sm-8" style="padding-left: 0">
                                    <input type="text" id="require_time" class="form-control" tabindex="9" data-index="9"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <div class="mb-1 row">
                                <label for="gender" class="col-sm-4 col-form-label-lg"
                                       style="padding-right: 0">{{__('gender')}}</label>
                                <div class="col-sm-8" style="padding-left: 0">
                                    <input type="text" id="gender" class="form-control" tabindex="10" data-index="10"/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 col-md-6">
                            <div class="mb-1 row">
                                <label for="diagnosis" class="col-sm-4 col-form-label-lg"
                                       style="padding-right: 0">{{__('diagnosis')}}</label>
                                <div class="col-sm-8" style="padding-left: 0">
                                    <input type="text" id="diagnosis" class="form-control" tabindex="11" data-index="11"/>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 col-md-12">
                            <div class="mb-1 row">
                                <label for="note" class="col-sm-12 col-form-label-lg"
                                       style="padding-right: 0">{{__('request')}}</label>
                                <div class="col-sm-12">
                                    <textarea rows="5" id="note" class="form-control" tabindex="12" data-index="12"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
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
    <script>
        $(document).ready(function (){
            var t = $('#table');
            t.DataTable({
                responsive: !0,
                dom: "<'row'<'col-sm-12 col-md-5 d-flex'<'pat-5'p><'pat-7'i>l>>\n\t\t\t<'row'<'col-sm-12'tr>>",
                lengthMenu: [20, 50, 100],
                pageLength: 20,
                order: [],
                language: {
                    "decimal": "",
                    "emptyTable": "現在ありません",
                    "info": "_START_~_END_/全_TOTAL_件",
                    "infoEmpty": "0~0/全0件",
                    "infoFiltered": "(filtered from _MAX_ total entries)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": " _MENU_ ",
                    "loadingRecords": "ロード中...",
                    "processing": "処理中...",
                    "search": "検索:",
                    "zeroRecords": "一致する検索資料がありません。",
                    "paginate": {
                        "first": "初めに",
                        "last": "最後",
                        "next": "次へ",
                        "previous": "前へ"
                    },
                },
            });
        })
        $(document).on('click', '.show_detail', function(){
            let id = $(this).data('id')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
            $.ajax({
                url: '{{route('reservation-get')}}',
                type: 'post',
                data: {
                    id : id
                },
                success: function (response) {
                    console.log(response)
                    if(response.status){
                        let data = response.data
                        $('#reservation_id').val(data['reservation_code'])
                        $('#shop_name').val(data['shop']['shop_name'])
                        $('#client_name').val(data['client']['last_name'] + data['client']['first_name'])
                        $('#sei_mei').val(data['client']['sei'] + data['client']['mei'])
                        $('#phone').val(data['client']['phone'])
                        $('#email').val(data['client']['email'])
                        let menus = ''
                        for(let i = 0; i < data['menu'].length; i++){
                            menus = menus + data['menu'][i]['menu']['menu_name'] + '\n'
                        }
                        $('#reservation_menu').val(menus)
                        let price = 0
                        for(let i = 0; i < data['menu'].length; i++){
                            price = price + parseInt(data['menu'][i]['menu']['price'])
                        }
                        $('#price').val(price)
                        let require_time = 0
                        for(let i = 0; i < data['menu'].length; i++){
                            require_time = require_time + parseInt(data['menu'][i]['menu']['require_time'])
                        }
                        $('#require_time').val(require_time)
                        $('#gender').val(data['client']['gender'] ? '{{__('female')}}' : '{{__('male')}}')
                        $('#diagnosis').val(data['client']['is_first'] ? '{{__('first')}}' : '{{__('twice')}}')
                        $('#note').val(data['client']['note'])
                        $('#infoReservation').modal('toggle')
                    }
                },
            })
        })
    </script>
</x-app-layout>
