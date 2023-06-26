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
                                                       placeholder="{{__('please-input-menu')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <button class="btn mr-2 background-dark-blue color-white" id="btn_get_table"
                                                onclick="event.preventDefault(); getMenuTableData('{{route('menu-table')}}')">{{__('search')}}
                                        </button>
                                    </div>
                                    <div class="col-md-5 text-end">
                                        <button id="create_menu" type="button" class="btn background-dark-blue color-white"
                                                data-bs-toggle="modal" data-bs-target="#editMenu"> {{__('new')}}</button>
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
    <!-- Show Menu Info Modal -->
    <div class="modal fade" id="editMenu" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <div class="text-center mt-1">
                        <h3>{{__('menu')}}</h3>
                    </div>
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
                </div>
                <div class="modal-body pb-2 px-3 pt-0">
                    <form class="form" id="save_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row mb-1">
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="menu-code" class="col-sm-4 col-form-label-lg"
                                           style="padding-right: 0">{{__('menu')}}ID</label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="text" id="menu-code" class="form-control"
                                               placeholder="" required disabled/>
                                        <input type="hidden" id="menu_code" name="menu_code"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <label for="menu-name" class="col-sm-4 col-form-label-lg"
                                           style="padding-right: 0">{{__('menu-name')}}</label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="text" id="menu-name" class="form-control" name="menu_name"
                                               placeholder="" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="description" class="col-sm-2 col-form-label-lg mt-0 mb-auto"
                                   style="padding-right: 0">{{__('description')}} (100{{__('char')}})</label>
                            <div class="col-sm-10 ps-0">
                                <textarea rows="5" id="description" class="form-control" name="description" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6">
                                <div class="row">
                                    <label for="price" class="col-sm-4 col-form-label-lg pe-0 mt-0 mb-auto">
                                        {{__('price')}}</label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="text" id="price" class="form-control" name="price"
                                               placeholder="" required/>
                                        <div class="form-check form-check-inline" style="padding-top: 5px">
                                            <input class="form-check-input" type="checkbox" id="over" name="over" value="checked"/>
                                            <label class="form-check-label" for="over">{{__('show-over')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <label for="require_time" class="col-sm-4 col-form-label-lg pe-0">
                                        {{__('require-time')}}</label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="text" id="require_time" class="form-control" name="require_time"
                                               placeholder="" required/>
                                        <div class="form-check form-check-inline" style="padding-top: 5px">
                                            <input class="form-check-input" type="checkbox" id="ask" name="ask" value="checked"/>
                                            <label class="form-check-label" for="ask">{{__('show-ask')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <label class="col-sm-4 col-form-label-lg pe-0">
                                        {{__('display')}}</label>
                                    <div class="col-sm-8 d-flex" style="padding-left: 0; padding-top: 7px">
                                        <div class="form-check me-2" id="now_publish_part">
                                            <input type="radio" id="display_on" name="display" class="form-check-input" required checked value="1"/>
                                            <label class="form-check-label publish-status" for="display_on">{{__('on')}}</label>
                                        </div>
                                        <div class="form-check me-2">
                                            <input type="radio" id="display_off" name="display" class="form-check-input" required value="0"/>
                                            <label class="form-check-label" for="display_off">{{__('off')}}</label>
                                        </div>
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
                                        id="save_menu">{{__('register')}}</button>
                                <label class="btn waves-effect background-dark-blue color-white cursor-pointer me-1"
                                       tabindex="15" data-bs-dismiss="modal" aria-label="Close">{{__('close')}}</label>
                                <button type="reset" class="btn btn-danger waves-effect waves-float waves-light me-1" id="btn_delete" style="display: none"
                                        onclick="event.preventDefault(); deleteMenu($('#id').val(), '{{route('menu-delete')}}')">{{__('delete')}}</button>
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
            getMenuTableData('{{route('menu-table')}}')
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
            $('#create_menu').click(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                })
                $.ajax({
                    url: '{{route('menu-create-code')}}',
                    type: 'get',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        let menu_code = response.code
                        $('#id').val("")
                        $("#menu-code").val(menu_code)
                        $('#menu_code').val(menu_code)
                        $("#menu-name").val("")
                        $("#description").val("")
                        $("#price").val("")
                        $("#require_time").val("")
                        $('input:radio[name="display"]').filter('[value="1"]').attr('checked', true)
                        $('#note').val('')
                        $('#btn_delete').hide();
                        $('#over').prop('checked', false)
                        $('#ask').prop('checked', false)
                    },
                })
            })
            $('#save_menu').click(function (e) {
                e.preventDefault()
                if ($('#save_form').valid()) {
                    var paramObj = new FormData($('#save_form')[0])
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    })
                    $.ajax({
                        url: '{{route('menu-save')}}',
                        type: 'post',
                        data: paramObj,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (response.status == true) {
                                toastr.success("成功しました。")
                                getMenuTableData('{{route('menu-table')}}')
                                $('#editMenu').modal('hide')
                            } else {
                                toastr.warning("失敗しました。")
                            }
                        },
                    })
                }
            })
        })
        $(document).on('change', 'input.display_table[type=radio]' ,function () {
            console.log(this.value)
            let id = $(this).parent().parent().parent().parent().find('input.id[type=hidden]').val()
            console.log(id)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
            $.ajax({
                url: '{{route('menu-change-display')}}',
                type: 'post',
                data: {
                    id : id,
                    display: this.value
                },
                success: function (response) {
                    if (response.status == true) {
                        toastr.success("成功しました。")
                        getMenuTableData('{{route('menu-table')}}')
                        $('#editMenu').modal('hide')
                    } else {
                        toastr.warning("失敗しました。")
                    }
                },
            })
        })
        $(document).on('click', '.btn_up', function (){
            let id_first = $(this).data('id')
            console.log(id_first)
            let id_second = $(this).parent().parent().prev().find('input.id[type=hidden]').val()
            console.log(id_second)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
            $.ajax({
                url: '{{route('menu-change-order')}}',
                type: 'post',
                data: {
                    id_first : id_first,
                    id_second: id_second
                },
                success: function (response) {
                    if (response.status == true) {
                        toastr.success("成功しました。")
                        getMenuTableData('{{route('menu-table')}}')
                        $('#editMenu').modal('hide')
                    } else {
                        toastr.warning("失敗しました。")
                    }
                },
            })
        })
        $(document).on('click', '.btn_down', function (){
            let id_first = $(this).data('id')
            console.log(id_first)
            let id_second = $(this).parent().parent().next().find('input.id[type=hidden]').val()
            console.log(id_second)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
            $.ajax({
                url: '{{route('menu-change-order')}}',
                type: 'post',
                data: {
                    id_first : id_first,
                    id_second: id_second
                },
                success: function (response) {
                    if (response.status == true) {
                        toastr.success("成功しました。")
                        getMenuTableData('{{route('menu-table')}}')
                        $('#editMenu').modal('hide')
                    } else {
                        toastr.warning("失敗しました。")
                    }
                },
            })
        })
        $(document).on('click', '.delete-menu', function () {
            let id = $(this).data('id')
            deleteMenu(id, '{{route('menu-delete')}}')
        })
        $(document).on('click', '.edit-menu', function () {
            $('#id').val($(this).data('id'))
            $('#menu-code').val($(this).data('code'))
            let display = $(this).data('display')
            $('#menu-name').val($(this).parent().find('input.menu_name[type=hidden]').val())
            $('#description').val($(this).parent().find('input.description[type=hidden]').val())
            $('#price').val($(this).parent().find('input.price[type=hidden]').val())
            $('#require_time').val($(this).parent().find('input.require_time[type=hidden]').val())
            $('input:radio[name="display"]').filter('[value=' + display + ']').attr('checked', true)
            $('#note').val($(this).parent().find('input.note[type=hidden]').val())
            let over = $(this).parent().find('input.over[type=hidden]').val()
            if(over == 1) {
                $('#over').prop('checked', true)
            }
            else{
                $('#over').prop('checked', false)
            }
            let ask = $(this).parent().find('input.ask[type=hidden]').val()
            if(ask == 1) {
                $('#ask').prop('checked', true)
            }
            else{
                $('#ask').prop('checked', false)
            }

            $('#btn_delete').show();
            $('#editMenu').modal('toggle')
        })
        function deleteMenu(id, url){
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
                                        getMenuTableData('{{route('menu-table')}}')
                                        $('#editMenu').modal('hide')
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
    <style>
        .text-hide{
            display: inline-block;
            width: 300px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;
        }
    </style>
</x-app-layout>
