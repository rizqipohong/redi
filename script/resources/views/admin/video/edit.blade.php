@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h4>{{ __('Edit New Video') }}</h4>
                    <form method="post" action="{{ route('admin.customize.updateVideo', $data->id) }}">
                        @csrf
                        <div class="custom-form pt-20">
                            <div class="form-group">
                                <label for="name">Video Title</label>
                                <input type="text" placeholder="Video Title" name="name" class="form-control" id="name"
                                       required="" value="{{ $data->name ?? '' }}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="excerpt">Link Video / Embed Youtube</label>
                                <textarea name="link" class="form-control content" cols="30" rows="3"
                                          placeholder="Link Video / Embed Youtube" id="link" maxlength=""
                                          required="">{{ $data->link ?? '' }}</textarea>
                            </div>
                        </div>
                </div>
            </div>

        </div>
        <div class="col-lg-3">
            <div class="single-area">
                <div class="card">
                    <div class="card-body">


                        <div class="btn-publish">
                            <button type="submit" class="btn btn-primary col-12"><i
                                    class="fa fa-save"></i> {{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <input type="hidden" name="type" value="1">
        <input type="hidden" name="post_type" value="page">
        </form>

    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/js/form.js?v=1.0') }}"></script>
@endpush
