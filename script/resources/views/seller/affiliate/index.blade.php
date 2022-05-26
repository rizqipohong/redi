@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>'Affiliate'])
@endsection
@section('content')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </symbol>
                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </symbol>
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol>
                        </svg>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="alert alert-primary d-flex " role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                         aria-label="Info:">
                                        <use xlink:href="#info-fill"/>
                                    </svg>
                                    <div>
                                        &nbsp;{{ __('Impressions') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="alert alert-primary d-flex " role="alert">
                                    <div>
                                        &nbsp;{{ $impressions }} time
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                         aria-label="Success:">
                                        <use xlink:href="#check-circle-fill"/>
                                    </svg>
                                    <div>
                                        &nbsp;{{ __('Conversion') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    <div>
                                        &nbsp;{{ $conversions }} %
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                         aria-label="Warning:">
                                        <use xlink:href="#exclamation-triangle-fill"/>
                                    </svg>
                                    <div>
                                        &nbsp;{{ __('Affiliate Commision') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="alert alert-warning d-flex align-items-center" role="alert">
                                    @php $total_com =0;
                                      function rupiah($m)
                                        {
                                          $rupiah = "Rp ".number_format($m,0,",",".").",-";
                                          return $rupiah;
                                        }
                                    @endphp
                                    @foreach($data as $row)
                                        @php $total_comision = $total_com += $row->total_commisiion_values; @endphp
                                    @endforeach
                                    <div>{{ $total_comision ?? '' }} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive custom-table">
                            <div class="float-right">
                                <form>
                                    <div class="input-group mb-2">

                                        <input type="text" id="src" class="form-control" placeholder="Search..."
                                               required="" name="src" autocomplete="off" value="{{ $src ?? '' }}">
                                        <select class="form-control selectric" name="type" id="type">
                                            <option value="title">{{ __('Search By Name') }}</option>
                                            <option value="id">{{ __('Search By High Commission') }}</option>

                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="am-select">
                                        #
                                    </th>
                                    <th class="am-title">{{ __('Product Name') }}</th>
                                    <th class="am-title">{{ __('Product Type') }}</th>
                                    <th class="text-center">{{ __('Total Sales') }}</th>
                                    <th class="text-center">{{ __('Product Price') }}</th>
                                    <th class="text-center">{{ __('Commision Value (%)') }}</th>
                                    <th class="text-center">{{ __('Total Commision Value') }}</th>
                                    <th class="text-right">{{ __('Actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $no = 1;
                                @endphp
                                @foreach($data as $row)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->title}}
                                            <br>
                                            <button class="btn btn-primary basicbtn" id="copyBtn"
                                                    data-text="{{ url('/').'/product/'.$row->title.'/'.$row->term_id.'/'.Crypt::encryptString(Auth::id())}}">
                                                Share Affiliate Product
                                            </button>
                                        </td>
                                        <td>{{$row->type}}</td>
                                        <td> -</td>
                                        <td class="text-right"> {{ rupiah($row->price)}} </td>
                                        <td class="text-right"> {{ $row->affiliate}} %</td>
                                        <td class="text-right">{{ rupiah($row->total_commisiion_values)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        const copyBtn = document.querySelector('#copyBtn');
        copyBtn.addEventListener('click', e => {
            const input = document.createElement('input');
            input.value = copyBtn.dataset.text;
            document.body.appendChild(input);
            input.select();
            if (document.execCommand('copy')) {
                alert('Text Copied');
                document.body.removeChild(input);
            }
        });
    </script>
@endpush


