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
                                    <div class="col-md-3">
                                        <div class="mb-1 row">
                                            <label for="date" class="col-sm-4 col-form-label-lg text-end"
                                                   style="padding-top: 10px">{{__('visit-date')}}</label>
                                            <div class="col-sm-8" style="padding-left: 0">
                                                <input type="text" class="form-control flatpickr" id="date" name="date" placeholder="YYYY-MM-DD" required tabindex="1"
                                                       data-index="1" value="{{date('Y-m-d')}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1 row">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="keyword" name="keyword" tabindex="3" data-index="3"
                                                       placeholder="{{__('please-input-name-phone-mail')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <button class="btn mr-2 background-dark-blue color-white" id="btn_get_table"
                                                onclick="event.preventDefault();getTableData('{{route('client-table')}}')">{{__('search')}}
                                        </button>
                                    </div>
                                    <div class="col-md-3 text-end">
                                        <button class="btn mr-2 background-dark-blue color-white d-none" id="client_export_csv"
                                                onclick="event.preventDefault();exportFile('{{route('client-export-csv')}}', 'csv', '{{__('client-manage')}}')">
                                            <i data-feather='download'></i> {{__('csv-down')}}
                                        </button>
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
    <!--end::Content-->
    <script>
        addEventListener('pageshow', (event) => {
            getTableData('{{route('client-table')}}');
        });
        $(document).ready(function () {
            $('#date').change(function () {
                getTableData('{{route('client-table')}}');
            })
        })
    </script>
</x-app-layout>
