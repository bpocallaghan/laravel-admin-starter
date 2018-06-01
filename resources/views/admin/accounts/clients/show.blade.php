@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-user"></i></span>
                        <span>Account Holder</span>
                    </h3>
                </div>

                <div class="box-body no-padding">
                    <form>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-4">
                                    <section class="form-group">
                                        <label>Fullname</label>
                                        <input type="text" class="form-control" value="{{ $user->fullname }}" readonly>
                                    </section>
                                </div>

                                <div class="col-md-4">
                                    <section class="form-group">
                                        <label>Cellphone</label>
                                        <input type="text" class="form-control" value="{{ $user->cellphone }}" readonly>
                                    </section>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input type="text" class="form-control" value="{{ $user->telephone }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Created At</label>
                                        <input type="text" class="form-control" value="{{ $user->created_at }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Registered At</label>
                                        <input type="text" class="form-control" value="{{ $user->registered_at }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Confirmed At</label>
                                        <input type="text" class="form-control" value="{{ $user->confirmed_at }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.form_footer', ['submit' => false])
@endsection