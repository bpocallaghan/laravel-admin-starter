@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-eye"></i></span>
                        <span>FAQ - {{ $item->question }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Question</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $item->question }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-question"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col col-md-6">
                                    <section class="form-group">
                                        <label>Category</label>
                                        <input type="text" class="form-control" value="{{ $item->category->name }}" readonly>
                                    </section>
                                </div>
                            </div>

                            <section class="form-group">
                                <label>Answer</label>
                                <div class="well well-sm well-light well-form-description">
                                    {!! $item->answer !!}
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