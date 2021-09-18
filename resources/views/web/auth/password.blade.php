
@extends('web.layout.default')
@section('Title','Admin Dashboard')
@section('main')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-12 col-xl-9 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Change password</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form  method="Post" action="{{ route('admin.update.pass') }}" class="forms-sample">
                        @csrf
                        {{-- <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Enter current password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label for="new_password" class="col-sm-3 col-form-label">Enter new password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="new_password" name="password" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="conf_new_password" class="col-sm-3 col-form-label">Confirm new password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="conf_new_password" name="password_confirmation" placeholder="" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="button" class="btn btn-light cancel">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

