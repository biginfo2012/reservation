<x-app-layout>
    <div class="content-body">
        <!-- Dashboard Ecommerce Starts -->
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Statistics Card -->
                <div class="col-xl-12 col-md-12 col-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <h4 class="card-title">{{__('noti')}}</h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="my-0 col-md-12">
                                    <table class="table table-separate table-head-custom table-checkable" id="noti_table">
                                        <tbody>
                                        @foreach($notifications as $item)
                                            <tr class="{{$item['status'] == 0 ? 'color-red-tmp' : ''}}">
                                                <input type="hidden" value="{{$item['title']}}" class="title">
                                                <input type="hidden" value="{{date('Y/m/d H:i', strtotime($item['publish_time']))}}" class="publish_time">
                                                <input type="hidden" value="{{$item['content']}}" class="content">
                                                <td class="p-0 border text-start align-middle px-1">{{date('Y/m/d H:i', strtotime($item['publish_time']))}}</td>
                                                <td class="p-0 border text-start align-middle px-1">{{$item['title']}}</td>
                                                <td class="p-0 border text-center align-middle px-1">
                                                    <button class="btn btn-outline-dark waves-effect show_noti {{$item['status'] == 0 ? 'color-red-tmp' : ''}}"
                                                           data-id="{{$item['id']}}" style="padding: 8px; margin: 5px;">{{__('detail')}}</button>
                                                </td>
                                            </tr>
                                        @endforeach
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
                        <div class="card-header">
                            <h4 class="card-title">{{__('all-reservation-status')}}</h4>
                        </div>
                        <div class="card-body statistics-body" style="padding-top: 0 !important;">
                            <div class="row">
                                <div class="col-2">

                                </div>
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-2">
                                            <p class="text-start">{{__('prev-week')}}</p>
                                        </div>
                                        <div class="col-2">
                                            <p class="text-start">{{__('this-week')}}</p>
                                        </div>
                                        <div class="col-2">
                                            <p class="text-start">{{__('next-week')}}</p>
                                        </div>
                                        <div class="col-2">
                                            <p class="text-start">{{__('prev-month')}}</p>
                                        </div>
                                        <div class="col-2">
                                            <p class="text-start">{{__('this-month')}}</p>
                                        </div>
                                        <div class="col-2">
                                            <p class="text-start">{{__('next-month')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="d-flex flex-row mb-1">
                                        <div class="avatar bg-light-info me-1">
                                            <div class="avatar-content">
                                                <i data-feather="user" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <p class="text-center mb-0">{{__('people')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="row" style="margin-top: 7px">
                                        <div class="col-2">
                                            <div class="text-start">{{$lastWeekCnt . __('man')}}</div>
                                        </div>
                                        <div class="col-2">
                                            <div class="text-start">{{$thisWeekCnt . __('man')}}</div>
                                        </div>
                                        <div class="col-2">
                                            <div class="text-start">{{$nextWeekCnt . __('man')}}</div>
                                        </div>
                                        <div class="col-2">
                                            <div class="text-start">{{$lastMonthCnt . __('man')}}</div>
                                        </div>
                                        <div class="col-2">
                                            <div class="text-start">{{$thisMonthCnt . __('man')}}</div>
                                        </div>
                                        <div class="col-2">
                                            <div class="text-start">{{$nextMonthCnt . __('man')}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="d-flex flex-row mb-1">
                                        <div class="avatar bg-light-success me-1">
                                            <div class="avatar-content">
                                                <i data-feather="dollar-sign" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <p class="text-center mb-0">{{__('earn')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-2" style="margin-top: 7px">
                                            <div class="text-start">{{__('en') . number_format($lastWeekPrice) }}</div>
                                        </div>
                                        <div class="col-2">
                                            <div class="text-start">{{__('en') . number_format($thisWeekPrice) }}</div>
                                        </div>
                                        <div class="col-2">
                                            <div class="text-start">{{__('en') . number_format($nextWeekPrice) }}</div>
                                        </div>
                                        <div class="col-2">
                                            <div class="text-start">{{__('en') . number_format($lastMonthPrice) }}</div>
                                        </div>
                                        <div class="col-2">
                                            <div class="text-start">{{__('en') . number_format($thisMonthPrice) }}</div>
                                        </div>
                                        <div class="col-2">
                                            <div class="text-start">{{__('en') . number_format($nextMonthPrice) }}</div>
                                        </div>
                                    </div>
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
                        <div class="card-header">
                            <h4 class="card-title">{{__('reservation-by-shop')}}</h4>
                            <div class="d-flex align-items-center">
                                <p class="card-text font-medium-1 me-25 mb-0">{{__('date')}}: {{date('Y年m月d日')}}</p>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="my-0 col-md-12">
                                    <table class="table table-separate table-head-custom table-checkable" id="table">
                                        <thead>
                                        <tr>
                                            <th class="text-center" width="10">{{__('client-name')}}</th>
                                            <th class="text-center" width="10">{{__('reservation-time')}}</th>
                                            <th class="text-center" width="5">{{__('price')}}</th>
                                            <th class="text-center" width="10">{{__('require-time')}}</th>
                                            <th class="text-center" width="10">{{__('phone-number')}}</th>
                                            <th class="text-center" width="5">{{__('diagnosis')}}</th>
                                            <th class="text-center" width="15">{{__('request')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($table_data as $index => $item)
                                            <tr>
                                                <td class="p-0 border text-left align-middle px-1 text-ellipsis" width="10">{{$item['client']['last_name'] . $item['client']['first_name']}}</td>
                                                <td class="p-0 border text-left align-middle px-1 text-ellipsis" width="10">{{date('Y/m/d H:i', $item['created_at'])}}</td>
                                                <td class="p-0 border text-center align-middle" width="5">
                                                    @php
                                                        $price = 0;
                                                        foreach($item['menu'] as $reservation_menu) {
                                                            $price += $reservation_menu['menu']['price'];
                                                        }
                                                        echo number_format($price)
                                                    @endphp
                                                </td>
                                                <td class="p-0 border text-center align-middle" width="10">@php
                                                        $require_time = 0;
                                                        foreach($item['menu'] as $reservation_menu) {
                                                            $require_time += $reservation_menu['menu']['require_time'];
                                                        }
                                                        echo $require_time
                                                    @endphp</td>
                                                <td class="p-0 border text-left align-middle px-1" width="10">{{$item['client']['phone']}}</td>
                                                <td class="p-0 border text-left align-middle px-1" width="5">{{$item['client']['is_first'] == 1 ? __('first') : __('twice')}}</td>
                                                <td class="p-0 border text-left align-middle px-1 whitespace-nowrap overflow-hidden"
                                                    style="overflow:hidden !important; white-space: nowrap; text-overflow: ellipsis" width="15">{{$item['note']}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Statistics Card -->
            </div>
        </section>
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
    </div>
    <script>
        $(document).ready(function (){
            var t = $('#table');
            t.DataTable({
                responsive: !0,
                dom: "<'row'<'col-sm-12 col-md-5 d-flex'<'pat-5'p><'pat-7'i>l>>\n\t\t\t<'row'<'col-sm-12'tr>>",
                lengthMenu: [20, 50, 100],
                pageLength: 20,
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
