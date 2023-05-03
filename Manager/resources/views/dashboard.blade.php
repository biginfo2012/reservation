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
                                </div>
                                <div class="col-1">
                                </div>
                                <div class="col-1">
                                </div>
                                <div class="col-2">
                                </div>
                                <div class="col-3">
                                </div>
                                <div class="col-2">
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
                                </div>
                                <div class="col-1">
                                </div>
                                <div class="col-1">
                                </div>
                                <div class="col-2">
                                </div>
                                <div class="col-3">
                                </div>
                                <div class="col-2">
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
                        <div class="card-body statistics-body">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Statistics Card -->
            </div>
        </section>
    </div>
</x-app-layout>
