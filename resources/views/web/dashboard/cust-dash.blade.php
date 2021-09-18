@extends('web.layout.default')
@section('Title','Customer Dashboard')
@section('main')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    
                    <h3 class="font-weight-bold">Hi, {{ $items->first_name }} </h3>
                
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="">
                <div class="card-people mt-auto">
                    <img src="{{ asset('assets/logos/logo.png') }}" alt="people">

                </div>
            </div>
        </div>
        {{-- <div class="col-md-6 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Customers </p>
                            <p class="fs-30 mb-2">{{ $Data['Employees'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Total tests done</p>
                            <p class="fs-30 mb-2"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <p class="mb-4">Negative cases</p>
                            <p class="fs-30 mb-2"></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <p class="mb-4">Positive cases</p>
                            <p class="fs-30 mb-2"></p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-4">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <p class="mb-4">Pending cases</p>
                            <p class="fs-30 mb-2"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        {{-- <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Customers tested recently</p>
                    <div class="table-responsive">
                        <table class="table table-striped mydata-table  table-borderless">
                            <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>Emp. ID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>


<!-- content-wrapper ends -->
@endsection
