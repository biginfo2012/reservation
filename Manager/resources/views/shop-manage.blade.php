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
                                    <div class="col-md-4">
                                        <div class="mb-1 row">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="keyword" name="keyword" tabindex="3" data-index="3"
                                                       placeholder="{{__('please-input-name-phone-mail')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <button class="btn mr-2 background-dark-blue color-white" id="btn_get_table"
                                                onclick="event.preventDefault(); getTableData('{{route('shop-table')}}')">{{__('search')}}
                                        </button>
                                    </div>
                                    <div class="col-md-5 text-end">
                                        <button id="create_shop" type="button" class="btn background-dark-blue color-white"
                                                data-bs-toggle="modal" data-bs-target="#editShop"> {{__('new')}}</button>
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
    <!-- Show Shop Info Modal -->
    <div class="modal fade" id="editShop" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <div class="text-center mt-1">
                        <h3>{{__('shop')}}</h3>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-2 px-3 pt-0">
                    <form class="form" id="save_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row mb-1">
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="shop-code" class="col-sm-4 col-form-label-lg"
                                           style="padding-right: 0">{{__('shop')}}ID</label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="text" id="shop-code" class="form-control"
                                               placeholder="" required disabled/>
                                        <input type="hidden" id="shop_code" name="shop_code"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="shop-name" class="col-sm-4 col-form-label-lg"
                                           style="padding-right: 0">{{__('shop-name')}}</label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="text" id="shop-name" class="form-control" name="shop_name"
                                               placeholder="" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6">
                                <div class="row">
                                    <label for="post-code" class="col-sm-4 col-form-label-lg pt-0 pe-0 pb-0">
                                        {{__('post-code')}}<br><span class="font-small-2">{{__('no-half')}}</span></label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="text" id="post-code" class="form-control" name="post_code"
                                               placeholder="" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <label for="address-1" class="col-sm-2 col-form-label-lg"
                                           style="padding-right: 0">{{__('address')}}1</label>
                                    <div class="col-sm-10" style="padding-left: 0">
                                        <input type="text" id="address-1" class="form-control" name="address_1"
                                               placeholder="" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <label for="address-2" class="col-sm-2 col-form-label-lg pt-0 pe-0">
                                        {{__('address')}}2<br><span class="font-small-2">{{__('office-number')}}</span></label>
                                    <div class="col-sm-10" style="padding-left: 0">
                                        <input type="text" id="address-2" class="form-control" name="address_2"
                                               placeholder=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6">
                                <div class="row">
                                    <label for="phone" class="col-sm-4 col-form-label-lg pt-0 pe-0">
                                        {{__('phone')}}<br><span class="font-small-2">{{__('no-half')}}</span></label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="text" id="phone" class="form-control" name="phone"
                                               placeholder="" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <label for="email" class="col-sm-4 col-form-label-lg"
                                           style="padding-right: 0">{{__('email')}}</label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="email" id="email" class="form-control" name="email"
                                               placeholder="" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <label for="represent" class="col-sm-4 col-form-label-lg"
                                           style="padding-right: 0">{{__('represent')}}</label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="text" id="represent" class="form-control" name="represent"
                                               placeholder=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <label for="represent-phone" class="col-sm-4 col-form-label-lg pt-0 pe-0">
                                        {{__('phone')}}<br><span class="font-small-2">{{__('no-half')}}</span></label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="text" id="represent-phone" class="form-control" name="represent_phone"
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
                                               placeholder="" disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <label for="password" class="col-sm-4 col-form-label-lg"
                                           style="padding-right: 0">{{__('password')}}</label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="password" id="password" class="form-control" name="password" minlength="8"
                                               placeholder="" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-1">
                                <div class="row">
                                    <label for="shop-url" class="col-sm-2 col-form-label-lg"
                                           style="padding-right: 0">{{__('shop-url')}}</label>
                                    <div class="col-sm-10" style="padding-left: 0">
                                        <input type="text" id="shop-url" class="form-control"
                                               placeholder="" disabled/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="note" class="col-sm-12 col-form-label-lg"
                                   style="padding-right: 0">{{__('note')}} (100{{__('char')}})</label>
                            <div class="col-sm-12">
                                <textarea rows="5" id="note" class="form-control" name="note" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="button" class="btn waves-effect background-dark-blue color-white me-1 btn_submit"
                                        id="save_shop">{{__('register')}}</button>
                                <label class="btn waves-effect background-dark-blue color-white cursor-pointer me-1"
                                       tabindex="15" data-bs-dismiss="modal" aria-label="Close">{{__('close')}}</label>
                                <button type="reset" class="btn btn-danger waves-effect waves-float waves-light me-1" style="display: none"
                                        onclick="event.preventDefault(); deleteData($('#id').val(), '{{route('shop-delete')}}')">{{__('delete')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Modal -->
    <!--end::Content-->
    <script>
        addEventListener('pageshow', (event) => {
            getTableData('{{route('shop-table')}}')
        })
        $(document).ready(function () {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            $('#create_shop').click(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                })
                $.ajax({
                    url: '{{route('shop-create-code')}}',
                    type: 'get',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        let shop_code = response.code
                        $('#id').val("")
                        $("#shop-code").val(shop_code)
                        $('#shop_code').val(shop_code)
                        $("#shop-name").val("")
                        $("#post-code").val("")
                        $("#address-1").val("")
                        $("#address-2").val("")
                        $("#phone").val("")
                        $('#email').val('')
                        $('#represent').val('')
                        $('#represent-phone').val('')
                        $('#password').val('')
                        $('#password').attr('required', true)
                        $('#shop-url').val('base_shop_reservation_url' + shop_code)
                        $('#note').val('')
                    },
                })
            })
            $("#email[type=email]").change(function () {
                $('#login-id').val($(this).val())
            })
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
                                getTableData('{{route('shop-table')}}')
                                $('#editShop').modal('hide')
                            } else {
                                toastr.warning("失敗しました。")
                            }
                        },
                    })
                }
            })
        })
        $(document).on('click', '.delete-shop', function () {
            let id = $(this).data('id')
            deleteShop(id, '{{route('shop-delete')}}')
        })
        $(document).on('click', '.edit-shop', function () {
            $('#id').val($(this).data('id'))
            $('#shop-code').val($(this).data('code'))
            $('#shop-name').val($(this).parent().find('input.shop_name[type=hidden]').val())
            $('#post-code').val($(this).parent().find('input.post_code[type=hidden]').val())
            $('#address-1').val($(this).parent().find('input.address_1[type=hidden]').val())
            $('#address-2').val($(this).parent().find('input.address_2[type=hidden]').val())
            $('#phone').val($(this).parent().find('input.phone[type=hidden]').val())
            $('#email').val($(this).parent().find('input.email[type=hidden]').val())
            $('#represent').val($(this).parent().find('input.represent[type=hidden]').val())
            $('#represent-phone').val($(this).parent().find('input.represent_phone[type=hidden]').val())
            $('#login-id').val($(this).parent().find('input.email[type=hidden]').val())
            $('#password').val('')
            $('#password').removeAttr('required')
            $('#shop-url').val('base_shop_reservation_url' + $(this).data('code'))
            $('#note').val($(this).parent().find('input.note[type=hidden]').val())
            $('#editShop').modal('toggle')
        })
        function deleteShop(id, url){
            Swal.fire({
                title: '本当に削除しますか？',
                text: "これを戻すことができません！",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'はい',
                cancelButtonText: 'キャンセル',
                customClass: {
                    confirmButton: 'btn background-dark-blue color-white',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    })
                    $.ajax({
                        url: url,
                        type:'post',
                        data: {
                            id : id
                        },
                        success: function (response) {
                            if(response.status == true){
                                Swal.fire({
                                    icon: 'success',
                                    title: '削除しました！',
                                    // text: '削除しました！',
                                    customClass: {
                                        confirmButton: 'btn btn-dark-blue color-white'
                                    }
                                }).then(function (result) {
                                    if (result.value) {
                                        getTableData('{{route('shop-table')}}')
                                    }})
                                //toastr.success("成功しました。")
                            }
                            else {
                                toastr.warning("失敗しました。")
                            }
                        },
                        error: function () {

                        }
                    })
                }
            })
        }
    </script>
</x-app-layout>
