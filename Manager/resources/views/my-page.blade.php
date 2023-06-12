<x-app-layout>
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
                                    <h4 class="card-title mb-0">{{__('detail')}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-2">
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="client-id" class="col-sm-4 col-form-label-lg text-end">{{__('user-name')}}</label>
                                        <div class="col-sm-8" style="padding-left: 0">
                                            <input type="text" id="client-id" class="form-control" name="client_id"
                                                   placeholder="" value="{{$user->name}}" disabled
                                                   tabindex="3" data-index="3"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <div class="mb-1 row">
                                        <label for="email" class="col-sm-4 col-form-label-lg text-end">{{__('login')}}ID</label>
                                        <div class="col-sm-8" style="padding-left: 0">
                                            <input type="email" id="email" class="form-control" name="email"
                                                   placeholder="" value="{{$user->email}}" disabled
                                                   required tabindex="6" data-index="6"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-8 text-center">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#passwordChangeModal">{{__('password-change')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Show Reservation Info Modal -->
    <div class="modal fade" id="passwordChangeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <div class="text-center mt-1">
                        <h3>{{__('change-password')}}</h3>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-2 px-3 pt-0">
                    <form id="save_form">
                        @csrf
                        <div class="row">
                            <div class="mb-1 col-md-12">
                                <div class="mb-1 row">
                                    <label for="current_password" class="col-sm-4 col-form-label-lg"
                                           style="padding-right: 0"><span class="color-red-tmp" style="margin-right: 2px">*</span>{{__('current-password')}}</label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="password" id="current_password" class="form-control" placeholder="" name="current_password" required
                                               value="" tabindex="1" data-index="1"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1 col-md-12">
                                <div class="mb-1 row">
                                    <label for="new_password" class="col-sm-4 col-form-label-lg"
                                           style="padding-right: 0"><span class="color-red-tmp" style="margin-right: 2px">*</span>{{__('new-password')}}</label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="password" id="new_password" class="form-control" name="new_password"
                                               placeholder="" value="" required minlength="8"
                                               tabindex="2" data-index="2"/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1 col-md-12">
                                <div class="mb-1 row">
                                    <label for="password_confirm" class="col-sm-4 col-form-label-lg"
                                           style="padding-right: 0"><span class="color-red-tmp" style="margin-right: 2px">*</span>{{__('password-confirm')}}</label>
                                    <div class="col-sm-8" style="padding-left: 0">
                                        <input type="password" id="password_confirm" class="form-control" name="password_confirm"
                                               placeholder="" value="" required minlength="8"
                                               tabindex="3" data-index="3"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-danger" onclick="event.preventDefault(); changePW();">{{__('password-change')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Modal -->
    <script>
        $(document).ready(function () {
            $( "#save_form" ).validate({
                rules: {
                    current_password: "required",
                    new_password: "required",
                    password_confirm: {
                        equalTo: "#new_password"
                    }
                }
            });
        })
        function changePW(){
            if($('#save_form').valid()){
                var paramObj = new FormData($('#save_form')[0])
                $.ajax({
                    url: '{{route('change-password')}}',
                    type: 'post',
                    data: paramObj,
                    contentType: false,
                    processData: false,
                    success: function(response){
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
                        if(response.status == true){
                            toastr.success("成功しました。")
                            $('#passwordChangeModal').modal('hide')
                        }
                        else if(response.status = "password_wrong") {
                            toastr.warning("以前のパスワードが間違っています。")
                        }
                        else{
                            toastr.warning("失敗しました。")
                        }
                    },
                })
            }
        }
    </script>
</x-app-layout>
