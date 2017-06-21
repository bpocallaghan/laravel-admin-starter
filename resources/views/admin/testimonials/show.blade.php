@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-eye"></i></span>
                        <span>Testimonials - {{ $item->title }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form>
                        <fieldset>
                            <div class="row">
                                <section class="col col-6">
                                    <section class="form-group">
                                        <label>Customer</label>
                                        <input type="text" class="form-control" value="{{ $item->customer }}" readonly>
                                    </section>
                                </section>

                                <section class="col col-6">
                                    <section class="form-group">
                                        <label>Link</label>
                                        <input type="text" class="form-control" value="{{ $item->link }}" readonly>
                                    </section>
                                </section>
                            </div>

                            <section class="form-group">
                                <label>Description</label>
                                <div class="well well-light well-form-description">
                                    {!! $item->description !!}
                                </div>
                            </section>
                        </fieldset>

                        @include('admin.partials.form_footer', ['submit' => false])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection