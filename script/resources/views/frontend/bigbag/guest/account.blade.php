@extends('frontend.bigbag.guest.layout.app')
@section('user_content')
<div class="col-lg-9">
	<form  method="post" class="basicform" action="{{ url('/user/settings/update') }}">
		@csrf
		<p class="bigbag-form-row bigbag-form-row--last form-row form-row-wide">
			<label for="account_last_name">{{ __('Name') }} &nbsp;<span class="required">*</span></label>
			<input type="text" class="bigbag-Input" name="name" id="account_last_name"  required="" readonly value="{{ $user->name }}">
		</p>
		<p class="bigbag-form-row bigbag-form-row--last form-row form-row-wide">
			<label for="email">{{ __('Email') }} &nbsp;<span class="required">*</span></label>
			<input type="email" class="bigbag-Input" name="email" id="email"  required="" readonly value="{{ $user->email }}">
		</p>
		<div class="clear"></div>

	</form>
</div>
@endsection
@push('js')
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/form.js') }}"></script>
@endpush
