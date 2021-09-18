@extends('web.layout.default')
@section('Title','Admin Dashboard')
@section('main')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome Super-admin </h3>
                    {{-- <h4>()</h4> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="">
                <div class="card-people mt-auto">
                    <img src="{{ asset('assets/logos/logo.png') }}" alt="people">
                    {{-- <div class="weather-info">
                        <div class="d-flex">
                            <div>
                                <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>{{ date('d/m/y') }}<sup>{{  date('H:m A') }}</sup></h2>
                            </div>
                            <div class="ml-2">
                                <h4 class="location font-weight-normal"></h4>
                                <h6 class="font-weight-normal"></h6>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <a class="text-light" href="">
                        <div class="card-body">
                            <p class="mb-4">Employees </p>
                            <p class="fs-30 mb-2">{{ $Data['Employees'] }}</p>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <a class="text-light" href="">
                        <div class="card-body">
                            <p class="mb-4">Total tests done</p>
                            <p class="fs-30 mb-2">{{ $Data['NotPending'] }}</p>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card bg-success text-white">
                        <a class="text-light" href="">

                        <div class="card-body">
                            <p class="mb-4">Negative cases</p>
                            <p class="fs-30 mb-2">{{ $Data['Negative'] }}</p>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                    <div class="card bg-danger text-white">
                        <a class="text-light" href="">
                        <div class="card-body">
                            <p class="mb-4">Positive cases</p>
                            <p class="fs-30 mb-2">{{ $Data['Positive'] }}</p>
                        </div>
                        </a>
                    </div>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card bg-warning text-white">
                        <a class="text-light" href="">
                        <div class="card-body">
                            <p class="mb-4">Pending cases</p>
                            <p class="fs-30 mb-2">{{ $Data['Pending'] }}</p>
                        </div>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection
