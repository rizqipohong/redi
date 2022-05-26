@extends('layouts.app')
@section('head')
@include('layouts.partials.headersection',['title'=>'Staff'])
@endsection
@section('content')
<div class="row">
  <div class="col-12 mt-2">
    <div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-sm-8">

          </div>

          <div class="col-sm-4 text-right">
            <a href="{{ route('seller.seller.create') }}" class="btn btn-primary">{{ __('Create Staff') }}</a>
          </div>
        </div>

        <div class="float-right">

        </div>

        <form method="post" action="{{ route('seller.seller.destroys') }}" class="basicform_with_reload">
          @csrf
          <div class="float-left mb-1">

            <div class="input-group">
              <select class="form-control selectric" name="method">
                <option value="" >{{ __('Select Action') }}</option>
                <option value="1" >{{ __('Publish') }}</option>
                <option value="2" >{{ __('Suspend') }}</option>
                <option value="3" >{{ __('Move To Pending') }}</option>
                 @if($type !== "trash")
                <option value="trash" >{{ __('Move To Trash') }}</option>
                @endif
                @if($type=="trash")
                <option value="delete" >{{ __('Delete Permanently') }}</option>
                @endif
              </select>
              <div class="input-group-append">
                <button class="btn btn-primary basicbtn" type="submit">{{ __('Submit') }}</button>
              </div>
            </div>

          </div>


          <div class="table-responsive">
            <table class="table table-striped table-hover text-center table-borderless">
              <thead>
                <tr>
                  <th><input type="checkbox" class="checkAll"></th>

                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Email') }}</th>
                  <th>{{ __('Domain') }}</th>
                  <th>{{ __('Storage Used') }}</th>
                  <th>{{ __('Plan') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th>{{ __('Created at') }}</th>

                </tr>
              </thead>
              <tbody>
                @foreach($posts as $row)
                <tr id="row{{ $row->id }}">
                  <td><input type="checkbox" name="ids[]" value="{{ $row->id }}"></td>
                  <td>{{ $row->name }}</td>
                  <td><a href="mailto:{{ $row->email }}">{{ $row->email }}</a></td>
                  <td><a href="{{ $row->user_domain->full_domain ?? '' }}" target="_blank">{{ $row->user_domain->domain ?? '' }}</a></td>
                  <td>{{ folderSize('uploads/'.$row->id) }}MB / {{ $row->user_plan->plan_info->storage ?? 0 }} MB</td>
                  <td>{{ $row->user_plan->plan_info->name ?? '' }}</td>
                  <td>
                    @if($row->status==1) <span class="badge badge-success">{{ __('Active') }}</span>
                    @elseif($row->status==0) <span class="badge badge-danger">{{ __('Trash') }}</span>
                    @elseif($row->status==2) <span class="badge badge-warning">{{ __('Suspended') }}</span>
                    @elseif($row->status==3) <span class="badge badge-warning">{{ __('Pending') }}</span>
                    @endif
                  </td>
                  <td>{{ $row->created_at->format('d-F-Y')  }}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                 <th><input type="checkbox" class="checkAll"></th>

                 <th>{{ __('Name') }}</th>
                 <th>{{ __('Email') }}</th>
                 <th>{{ __('Domain') }}</th>
                 <th>{{ __('Storage Used') }}</th>
                 <th>{{ __('Plan') }}</th>
                 <th>{{ __('Status') }}</th>
                 <th>{{ __('Join at') }}</th>
               </tr>
             </tfoot>
           </table>

         </div>
       </form>
        {{ $posts->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
     </div>
   </div>
 </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush
