@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>'Tutorial Website'])
@endsection
@section('content')
    <div class="row">
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <br>
                    <div class="card-action-filter">
                        <form method="post" class="basicform_with_reload" action="{{ route('admin.pages.destroys') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex">
                                        <div class="single-filter">
                                            <div class="form-group">
                                                <select class="form-control selectric" name="status">
                                                    <option disabled="" selected="">Select Action</option>
                                                    <option value="delete">{{ __('Delete Permanently') }}</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="single-filter">
                                            <button type="submit" disabled
                                                    class="btn btn-primary btn-lg ml-2">{{ __('Apply') }}</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="add-new-btn">
                                        <a href="{{ route('admin.customize.createTutorial') }}"
                                           class="btn btn-primary float-right">{{ __('Add New Tutorial') }}</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover text-left table-borderless">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="checkAll"></th>
                                <th>{{ __('Name') }}</th>
                                <th width="40%">{{ __('Link Tutorial') }}</th>
                                <th>{{ __('Created By') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            @foreach($data as $row)
                                <tr>
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ids[]" class="custom-control-input"
                                                   id="customCheck{{ $row->id }}" value="{{ $row->id }}">
                                            <label class="custom-control-label" for="customCheck{{ $row->id }}"></label>
                                        </div>
                                    </th>
                                    <td>{{ $row->name ?? '' }}</td>
                                    <td>{{ $row->link ?? '' }}</td>
                                    <td>{{ $row->user->name ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('admin.customize.editTutorial',$row->id) }}"
                                           class="btn btn-primary btn-sm text-center"><i class="far fa-edit"></i></a>
                                        <a href="{{ route('admin.customize.deleteTutorial',$row->id) }}"
                                           class="btn btn-danger  btn-sm cancel"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tfoot>
                            <tr>
                                <th><input type="checkbox" class="checkAll"></th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Link Video Tutorial') }}</th>
                                <th>{{ __('Created By') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/js/form.js') }}"></script>
@endpush
