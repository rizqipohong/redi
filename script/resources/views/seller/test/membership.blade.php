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
                                    <th width="5%" class="am-select">
                                        #
                                    </th>
                                    <th class="am-title">{{ __('User Reff') }}</th>
                                    <th class="am-title">{{ __('New User') }}</th>
                                    <th class="am-title">{{ __('Bisnis Plan') }}</th>
                                    <th class="am-title">{{ __('Created At') }}</th>
                                    <th class="text-right">{{ __('Actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $no = 1;
                                @endphp
                                @foreach($data as $row)
                                    <tr>
                                        <td>{{ $no++  }}</td>
                                        <td>{{ $row->userReff->name ?? ''  }}</td>
                                        <td>{{ $row->member->email ?? ''  }}</td>
                                        <td>{{ $row->plan->name ?? ''  }}</td>
                                        <td>{{ $row->created_at ?? ''  }}</td>
                                        <td>

                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton2" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    {{ __('Action') }}
                                                </button>
                                                <div class="dropdown-menu">
                                                    @can('customer.edit')
                                                        <a class="dropdown-item has-icon"
                                                           href="{{ route('admin.customer.edit',$row->member_id) }}"><i
                                                                class="fas fa-user-edit"></i> {{ __('Edit') }}</a>

                                                        <a class="dropdown-item has-icon"
                                                           href="{{ route('admin.customer.planedit',$row->member_id) }}"><i
                                                                class="far fa-edit"></i> {{ __('Edit Plan Info') }}</a>
                                                    @endcan
                                                    @can('customer.view')
                                                        <a class="dropdown-item has-icon"
                                                           href="{{ route('admin.customer.show',$row->member_id) }}"><i
                                                                class="far fa-eye"></i>{{ __('View') }}</a>
                                                    @endcan

                                                    <a class="dropdown-item has-icon"
                                                       href="{{ route('admin.order.create','email='.$row->email) }}"><i
                                                            class="fas fa-cart-arrow-down"></i>{{ __('Make Order') }}
                                                    </a>

                                                    <a class="dropdown-item has-icon"
                                                       href="{{ route('admin.customer.show',$row->member_id) }}"><i
                                                            class="far fa-envelope"></i>{{ __('Send Email') }}</a>
                                                </div>

                                        </td>
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


