@extends('web.layout.default')
@section('Title','Test list')


@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Booking Confirmed</h3>
                    <h4> {{ Session::get('site_name') }} </h4>
                </div>
            </div>
        </div>
        <div class="col-lg-9   grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <h4>Your covid test booking is confirmed, please visit the address given below to give your sample.</h4>
                                   
                        <table id="datatable" class="table  table-striped mydata-table ">
                           
                            <tbody>

                                <tr>
                                    <td>Lab Name</td>
                                    <td >{{$site_details->name}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td >{{$site_details->address}}</td>
                                </tr>
                                

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

