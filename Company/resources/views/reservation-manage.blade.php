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
                                            <label for="date" class="col-sm-3 col-form-label-lg text-end"
                                                   style="padding-top: 10px">{{__('date')}}</label>
                                            <div class="col-sm-9" style="padding-left: 0">
                                                <input type="text" class="form-control flatpickr" id="date" name="date" placeholder="YYYY-MM-DD" required tabindex="1" data-index="1"
                                                       value="{{date('Y-m-d')}}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-1 mb-md-0">
                                    <div class="col-md-3">
                                        <div class="mb-1 row">
                                            <label for="shop" class="col-sm-3 col-form-label-lg text-end"
                                                   style="padding-top: 10px">{{__('shop-name')}}</label>
                                            <div class="col-sm-9" style="padding-left: 0">
                                                <select class="form-select" id="shop" name="shop_id" tabindex="2" data-index="2">
                                                    <option value="" selected>{{__('all')}}</option>
                                                    @foreach($shops as $shop)
                                                        <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
                                                    @endforeach
                                                </select>
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
                                                onclick="event.preventDefault();getTableData('{{route('reservation-table')}}')">{{__('search')}}
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
            getTableData('{{route('reservation-table')}}')
        });
        $(document).ready(function () {
            let queryString = window.location.search
            let urlParams = new URLSearchParams(queryString)
            if(urlParams.has('shop_id')){
                let shop_id = urlParams.get('shop_id')
                console.log(shop_id)
                $('#shop').val(shop_id).change()
                getTableData('{{route('reservation-table')}}')
            }

            $('#date').change(function () {
                getTableData('{{route('reservation-table')}}')
            })
        })
    </script>
</x-app-layout>
