@extends('frontend.arafa-cart.account.layout.app')
@section('user_content')
    <div class="dash__box dash__box--shadow dash__box--radius dash__box--bg-white u-s-m-b-30">
        <div class="dash__pad-2">
            <h1 class="dash__h1 u-s-m-b-14">{{ __('How To Become Seller') }}</h1>
            <div class="dash__link dash__link--secondary u-s-m-b-30">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="dash-edit-p basicform" id="Website" name="Website">
                            <div class="gl-inline">
                                <div class="u-s-m-b-30">
                                    <label class="gl-label" for="website">{{ __('Create Your Own Website') }} *</label>
                                    <input class="input-text input-text--primary-style" type="text" id="website"
                                           name="website" required="" placeholder="exp: dinokhanstore / playstore">
                                </div>
                                <div id="website-error" class="text-xs text-rose-500"><i></i></div>

                            </div>
                            <button class="btn btn--e-brand-b-2 basicbtn" id="saveWebsite" type="submit">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/form.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#saveWebsite').click(function (e) {
                e.preventDefault();
                $(this).html('Sending...');
                $('#website-error').html("");
                $.ajax({
                    data: $('#Website').serialize(),
                    url: "{{ url('/user/become-seller') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        if (data.errors) {
                            if (data.errors.website) {
                                $('#website-error').html(data.errors.website[0]);
                            }
                            $('#saveWebsite').html('Saved');
                        }
                        if (data.success) {
                            console.log(data)
                            $('#Website').trigger("reset");
                            $('#saveWebsite').html('Saved');
                            setInterval(function () {
                                location.reload()
                            }, 1000);
                        }
                    },
                });
            });
        });
    </script>

@endpush
