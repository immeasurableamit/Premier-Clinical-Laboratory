@extends('web.layout.default')
@section('Title','Show ')


@section('main')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold"> History Screening</h3>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="row mt-4">
                <div class="col-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table  table-striped  ">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $sitem)

                                    <tr>
                                        <td>
                                            <p  data-toggle="tooltip" data-placement="top" title="{{  $sitem->Questions->question_text }}" > Question ({{ $sitem->question_id }}) </p>
                                        </td>
                                        <td>{{ $sitem->Answers() }}</td>

                                        <td> {{ date('d/m/Y',strtotime($sitem->created_at)) }} <br>
                                            <small>{{ date('h:m A',strtotime($sitem->created_at)) }}</small> </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection
