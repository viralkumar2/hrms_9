
@extends('layouts.admin')

@section('page-title')
   {{ __('Holiday') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Holiday') }}</li>
@endsection



@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                {{-- <h5></h5> --}}
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('Holiday') }}</th>
                                <th>{{ __('Start Date') }}</th>
                                <th>{{ __('End Date') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($total_holidays as $holiday)
                                <tr>

                                    <td>{{ $holiday->occasion }}</td>
                                    <td>{{ \Auth::user()->dateFormat($holiday->start_date) }}</td>
                                    <td>{{ \Auth::user()->dateFormat($holiday->end_date) }}</td>

                                </tr>
                                    @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
