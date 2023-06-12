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
                                <div class="col-1">
                                    <p class="text-center">{{__('prev-week')}}</p>
                                </div>
                                <div class="col-1">
                                    <p class="text-center">{{__('this-week')}}</p>
                                </div>
                                <div class="col-1">
                                    <p class="text-center">{{__('next-week')}}</p>
                                </div>
                                <div class="col-2">
                                    <p class="text-center">{{__('prev-month')}}</p>
                                </div>
                                <div class="col-3">
                                    <p class="text-center">{{__('this-month')}}</p>
                                </div>
                                <div class="col-2">
                                    <p class="text-center">{{__('next-month')}}</p>
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
                                <div class="col-1">
                                    <div class="text-center">{{$lastWeekCnt . __('man')}}</div>
                                </div>
                                <div class="col-1">
                                    <div class="text-center">{{$thisWeekCnt . __('man')}}</div>
                                </div>
                                <div class="col-1">
                                    <div class="text-center">{{$nextWeekCnt . __('man')}}</div>
                                </div>
                                <div class="col-2">
                                    <div class="text-center">{{$lastMonthCnt . __('man')}}</div>
                                </div>
                                <div class="col-3">
                                    <div class="text-center">{{$thisMonthCnt . __('man')}}</div>
                                </div>
                                <div class="col-2">
                                    <div class="text-center">{{$nextMonthCnt . __('man')}}</div>
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
                                <div class="col-1">
                                    <div class="text-center">{{$lastWeekPrice . __('en')}}</div>
                                </div>
                                <div class="col-1">
                                    <div class="text-center">{{$thisWeekPrice . __('en')}}</div>
                                </div>
                                <div class="col-1">
                                    <div class="text-center">{{$nextWeekPrice . __('en')}}</div>
                                </div>
                                <div class="col-2">
                                    <div class="text-center">{{$lastMonthPrice . __('en')}}</div>
                                </div>
                                <div class="col-3">
                                    <div class="text-center">{{$thisMonthPrice . __('en')}}</div>
                                </div>
                                <div class="col-2">
                                    <div class="text-center">{{$nextMonthPrice . __('en')}}</div>
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
                                <p class="card-text font-medium-1 me-25 mb-0">{{__('date')}}: {{date('d/m/Y')}}</p>
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
                                                <td class="p-0 border text-center align-middle"><a href="{{route('reservation-list')}}/?shop_id={{$item['shopId']}}">{{$item['shop_name']}}</a></td>
                                                <td class="p-0 border text-end align-middle px-1">{{$item['client_cnt'] . __('man')}}</td>
                                                <td class="p-0 border text-end align-middle px-1">{{$item['first_cnt'] . __('man')}}</td>
                                                <td class="p-0 border text-end align-middle px-1">{{$item['twice_cnt'] . __('man')}}</td>
                                                <td class="p-0 border text-end align-middle px-1">{{$item['price'] . __('en')}}</td>
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
                dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                lengthMenu: [20, 50, 100],
                pageLength: 20,
                language: {
                    "decimal": "",
                    "emptyTable": "現在ありません",
                    "info": "_TOTAL_中_START_から_END_を表示",
                    "infoEmpty": "0~0の0を表示。",
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
