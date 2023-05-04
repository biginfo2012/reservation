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
                                            <label for="status" class="col-sm-3 col-form-label-lg"
                                                   style="padding-right: 0; padding-top: 10px">{{__('status')}}</label>
                                            <div class="col-sm-9" style="padding-left: 0">
                                                <select class="form-select" id="status" name="status">
                                                    <option value="">{{__('all')}}</option>
                                                    <option value="1">{{__('enable')}}</option>
                                                    <option value="0">{{__('stop')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-1 row">
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="colFormLabel" name="contact"
                                                       placeholder="{{__('please-input-contact-company')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <button class="btn btn-success mr-2" id="btn_get_table"
                                                onclick="event.preventDefault();">{{__('search')}}
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
        {{--addEventListener('pageshow', (event) => {--}}
        {{--    getTableData('{{route('manager.company-table')}}');--}}
        {{--});--}}
        {{--let change_url = '{{route('manager.company-change-status')}}'--}}
    </script>
</x-app-layout>
