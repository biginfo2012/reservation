<x-app-layout>
    <!--begin::Content-->
    <div class="content-body">
        <!-- Ajax Sourced Server-side -->
        <section id="datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('noti')}}</h4>
                        </div>
                        <form class="form" id="search_form">
                            @csrf
                        </form>
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
                </div>
                <div class="modal-body pb-2 px-3 pt-0">
                    <div class="row mb-1">
                        <h4 class="col-sm-12 text-center" id="title"></h4>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p id="publish_time" class="text-end"></p>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-12 text-start">
                            <div id="content"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <label class="btn waves-effect background-dark-blue color-white cursor-pointer me-1"
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
        addEventListener('pageshow', (event) => {
            getTableData('{{route('noti-table')}}')
            $('td.content_part').each(function () {
                let content = $(this).prev().prev().val()
                console.log(content)
                $(this).next().next().html(content);
            })
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
        })
        $(document).on('click', '.show_noti', function () {
            let id = $(this).data('id')
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
            $.ajax({
                url: '{{route('noti-read')}}',
                type:'post',
                data: {
                    id : id
                },
                success: function (response) {
                    if(response.status == true){
                        console.log("success")
                        getTableData('{{route('noti-table')}}')
                    }
                    else {
                        toastr.warning("失敗しました。")
                    }
                },
                error: function () {

                }
            })
            let title = $(this).parent().parent().find('input.title[type=hidden]').val()
            $('#title').text(title)
            let publish_time = $(this).parent().parent().find('input.publish_time[type=hidden]').val()
            $('#publish_time').text(publish_time)
            let content = $(this).parent().parent().find('input.content[type=hidden]').val()
            $('#content').html(content);
            $('#editNotification').modal('toggle')
        })
    </script>
</x-app-layout>
