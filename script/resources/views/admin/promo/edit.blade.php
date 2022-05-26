@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h4>{{ __('Edit Promo') }}</h4>
                    <form method="post" action="{{ route('admin.customize.updatePromo', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-form pt-20">
                            <div class="form-group">
                                <label for="name">Promo Title</label>
                                <input type="text" placeholder="Promo Title" name="name" class="form-control" id="name"
                                       required="" value="{{ $data->name ?? '' }}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="start_date">Tanggal Mulai</label>
                                <input type="date" placeholder="Tanggal Mulai" name="start_date" class="form-control"
                                       id="start_date"
                                       required="" value="{{ $data->start_date ?? '' }}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="end_date">Tanggal Berakhir</label>
                                <input type="date" placeholder="Tanggal Berakhir" name="end_date" class="form-control"
                                       id="end_date"
                                       required="" value="{{ $data->end_date ?? '' }}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="excerpt">Link Video / Embed Youtube</label><br>
                                @if($data->link)
                                    <img src="{{ asset($data->link) }}" height="100">
                                @endif
                                <input type="file" placeholder="File Image" name="file" class="form-control" id="file"
                                       value="" autocomplete="off">
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
