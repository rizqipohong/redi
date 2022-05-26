@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>'Become Genius Seller'])
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            @php
                $data = App\Models\Tutorial::with('user')->get();
            @endphp
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($data as $row)
                        <div class="carousel-item {{ $row->name=='Instalasi' ? 'active' : '' }}">
                            <iframe width="100%" height="450"
                                    src="{{ $row->link ?? '' }}">
                            </iframe>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <hr>

@endsection
@push('js')
    <script src="{{ asset('assets/js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/seller/dashboard.js') }}"></script>
    <script type="text/javascript">
        $(window).on('load', function () {
            $('#myTutorial').modal('show');
        });
        $("#myTutorial").on('hidden.bs.modal', function (e) {
            $("#myTutorial iframe").attr("src", $("#myTutorial iframe").attr("src"));
        });
    </script>
@endpush
