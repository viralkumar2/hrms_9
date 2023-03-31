@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Plan Request') }}
@endsection


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Plan Request') }}</li>
@endsection



@section('content')
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                {{-- <h5></h5> --}}
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead class="d-none"></thead>

                        <tbody>
                            @if ($plan_requests->count() > 0)
                                @foreach ($plan_requests as $prequest)
                                    <tr>
                                        <td>
                                            <div class="font-style font-weight-bold">{{ $prequest->user->name }}</div>
                                        </td>
                                        <td>
                                            <div class="font-style font-weight-bold">{{ $prequest->plan->name }}</div>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">{{ $prequest->plan->max_employee }}</div>
                                            <div>{{ __('Employee') }}</div>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">{{ $prequest->plan->max_client }}</div>
                                            <div>{{ __('Client') }}</div>
                                        </td>
                                        <td>
                                            <div class="font-style font-weight-bold">
                                                {{ $prequest->duration == 'monthly' ? __('One Month') : __('One Year') }}
                                            </div>
                                        </td>
                                        <td>{{ \App\Models\Utility::getDateFormated($prequest->created_at, true) }}
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{ route('response.request', [$prequest->id, 1]) }}"
                                                    class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{ __('Approve') }}">
                                                    <i class="ti ti-checks"></i>
                                                </a>
                                                <a href="{{ route('response.request', [$prequest->id, 0]) }}"
                                                    class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-original-title="{{ __('Cancel') }}">
                                                    <i class="ti ti-shield-x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th scope="col" colspan="7">
                                        <h6 class="text-center">{{ __('No Manually Plan Request Found.') }}</h6>
                                    </th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
