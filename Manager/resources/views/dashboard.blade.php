<x-app-layout>
    <div class="content-body">
        <!-- Dashboard Ecommerce Starts -->
        <section id="dashboard-ecommerce">
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
                                    <div class="row" style="margin-top: 7px">
                                        <div class="col-2">
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
                                            <th class="text-center">{{__('shop-name')}}</th>
                                            <th class="text-center">{{__('people')}}</th>
                                            <th class="text-center">{{__('first-visit')}}</th>
                                            <th class="text-center">{{__('re-visit')}}</th>
                                            <th class="text-center">{{__('price')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($table_data as $item)
                                            <tr>
                                                <td class="p-0 border text-start align-middle px-1"><a href="{{route('reservation-list')}}/?shop_id={{$item['shopId']}}">{{$item['shop_name']}}</a></td>
                                                <td class="p-0 border text-start align-middle px-1">{{$item['client_cnt'] . __('man')}}</td>
                                                <td class="p-0 border text-start align-middle px-1">{{$item['first_cnt'] . __('man')}}</td>
                                                <td class="p-0 border text-start align-middle px-1">{{$item['twice_cnt'] . __('man')}}</td>
                                                <td class="p-0 border text-start align-middle px-1">{{__('en') . number_format($item['price'])}}</td>
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
    </script>
</x-app-layout>
