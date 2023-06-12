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
                                    <div class="col-md-2">
                                        <div class="mb-1 row">
                                            <label for="status" class="col-sm-4 col-form-label-lg text-end"
                                                   style="padding-top: 10px">{{__('status')}}</label>
                                            <div class="col-sm-8" style="padding-left: 0">
                                                <select class="form-select" id="status" name="status" tabindex="1" data-index="1">
                                                    <option value="" selected>{{__('all')}}</option>
                                                    <option value="2">{{__('published')}}</option>
                                                    <option value="1">{{__('stand')}}</option>
                                                    <option value="0">{{__('draft')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-1 row">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control flatpickr-empty" id="publish_date" name="publish_date"
                                                       placeholder="{{__('please-input-date')}}" tabindex="2" data-index="2"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <button class="btn mr-2 background-dark-blue color-white" id="btn_get_table"
                                                onclick="event.preventDefault(); getTableData('{{route('noti-table')}}')">{{__('search')}}
                                        </button>
                                    </div>
                                    <div class="col-md-5 text-end">
                                        <button id="create_noti" type="button" class="btn background-dark-blue color-white"
                                                data-bs-toggle="modal" data-bs-target="#editNotification"> {{__('new')}}</button>
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
    <!-- Show Notification Info Modal -->
    <div class="modal fade" id="editNotification" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <div class="text-center mt-1">
                        <h3>{{__('noti')}}</h3>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-2 px-3 pt-0">
                    <form class="form" id="save_form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row mb-1">
                            <label for="title" class="col-sm-2 col-form-label-lg"
                                   style="padding-right: 0">{{__('title')}}</label>
                            <div class="col-sm-10" style="padding-left: 0">
                                <input type="text" id="title" class="form-control" name="title"
                                       placeholder="" required/>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-sm-12 d-flex">
                                <div class="form-check me-2" id="now_publish_part">
                                    <input type="radio" id="now-publish" name="status" class="form-check-input" required checked value="2"/>
                                    <label class="form-check-label publish-status" for="now-publish">{{__('now-publish')}}</label>
                                </div>
                                <div class="form-check me-2">
                                    <input type="radio" id="scheduled-publish" name="status" class="form-check-input" required value="1"/>
                                    <label class="form-check-label" for="scheduled-publish">{{__('scheduled-publish')}}</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="save-draft" name="status" class="form-check-input" required value="0"/>
                                    <label class="form-check-label" for="scheduled-publish">{{__('save-draft')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="schedule_part" style="display:none">
                            <label for="publish-time" class="col-sm-2 col-form-label-lg"
                                   style="padding-right: 0">{{__('publish-time')}}</label>
                            <div class="col-sm-4 ps-0">
                                <input type="text" class="form-control flatpickr-noti" id="publish_time" name="publish_time"/>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="content" class="col-sm-12 col-form-label-lg"
                                   style="padding-right: 0">{{__('content')}}</label>
                            <div class="col-sm-12">
                                <div class="summernote-noti"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="button" class="btn waves-effect background-dark-blue color-white me-1 btn_submit"
                                        id="save_noti">{{__('register')}}</button>
                                <label class="btn waves-effect background-dark-blue color-white cursor-pointer me-1"
                                       tabindex="15" data-bs-dismiss="modal" aria-label="Close">{{__('close')}}</label>
                                <button type="reset" class="btn btn-danger waves-effect waves-float waves-light me-1" style="display: none" id="btn_delete"
                                        onclick="event.preventDefault(); deleteDataNoti($('#id').val(), '{{route('noti-delete')}}')">{{__('delete')}}</button>
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
            getTableData('{{route('noti-table')}}')
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
            $('#create_noti').click(function () {
                $('#id').val("")
                $('#title').val("")
                $('input:radio#now-publish').filter('[value="2"]').attr('checked', true)
                $('label.publish-status').text('{{__('now-publish')}}')
                $('#publish_time').val("")
                $('#save_noti').show()
                $('#btn_delete').hide()
                $(".summernote-noti").summernote({
                    height: 300,
                    minHeight: 300,
                    maxHeight: 600,
                    focus: !1,
                    popover: {
                        image: [],
                        link: [],
                        air: []
                    },
                }).summernote('code', "")
            })
            $("input[type=radio][name=status]").change(function () {
                if(this.value == '1'){
                    $('#schedule_part').show()
                }
                else{
                    $('#schedule_part').hide()
                }
            })
            $('#save_noti').click(function (e) {
                e.preventDefault()
                let content = $('.summernote-noti').summernote('code')
                console.log(content)
                if ($('#save_form').valid()) {
                    if(content == "" || content == "<p><br></p>") return
                    if($('input:radio[name="status"]:checked').val() == 1 && $('#publish_time').val() == "") return
                    var paramObj = new FormData($('#save_form')[0])
                    paramObj.append('note', content)
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    })
                    $.ajax({
                        url: '{{route('noti-save')}}',
                        type: 'post',
                        data: paramObj,
                        contentType: false,
                        processData: false,
                        success: function (response) {

                            if (response.status == true) {
                                toastr.success("成功しました。")
                                getTableData('{{route('noti-table')}}')
                                $('#editNotification').modal('hide')
                            } else {
                                toastr.warning("失敗しました。")
                            }
                        },
                    })
                }
            })
            $('#publish_date').change(function () {
                getTableData('{{route('noti-table')}}')
            })
        })
        $(document).on('click', '.delete-noti', function () {
            let id = $(this).data('id')
            deleteDataNoti(id, '{{route('noti-delete')}}')
        })
        $(document).on('click', '.edit-noti', function () {
            $('#id').val($(this).data('id'))
            let status = $(this).data('status')
            console.log(status)
            if(status == 2){
                $('#save_noti').hide()
                $('#btn_delete').hide()
                $('label.publish-status').text('{{__('published')}}')
                $('input:radio#now-publish').attr('checked', true)
            }
            else{
                $('#save_noti').show()
                $('#btn_delete').show()
                $('label.publish-status').text('{{__('now-publish')}}')
                $('input:radio[name="status"]').filter('[value=' + status + ']').attr('checked', true)
            }
            let title = $(this).parent().find('input.title[type=hidden]').val()
            $('#title').val(title)

            let publish_time = $(this).parent().find('input.publish_time[type=hidden]').val()
            $('#publish_time').val(publish_time)
            let content = $(this).parent().find('input.content[type=hidden]').val()
            $('.summernote-noti').summernote({
                height: 300,
                minHeight: 300,
                maxHeight: 600,
                focus: !1,
                popover: {
                    image: [],
                    link: [],
                    air: []
                }
            })
            $('.summernote-noti').summernote('code', content)
            $('#editNotification').modal('toggle')
        })
        function deleteDataNoti(id, url){
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
                                        getTableData('{{route('noti-table')}}')
                                        $('#editNotification').modal('hide')
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
