@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Shift') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('shift') }}</li>
@endsection

@section('action-button')
    @can('Create Warning')
        <a href="#" data-url="{{ route('shift.create') }}"   data-ajax-popup="true"
            data-title="{{ __('Create New shift') }}" data-size="lg" data-bs-toggle="tooltip" title=""
            class="btn btn-sm btn-primary" data-bs-original-title="{{ __('Create') }}">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
@endsection

@section('content')
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                {{-- <h5> </h5> --}}
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('Shift Name') }}</th>
                                <th>{{ __('Start Time') }}</th>
                                <th>{{ __('End Time') }}</th>
                                <th>{{ __('Status') }}</th>
                                @if (Gate::check('Edit Warning') || Gate::check('Delete Warning'))
                                    <th width="200px">{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($shift as $key => $s)
                                <tr>
                                    <td>{{$key +1}}</td>
                                    <td>{{$s->shift_name}}</td>
                                    <td>{{$s->start_time}}</td>
                                    <td>{{$s->end_time}}</td>
                                    <td>1</td>
                                 
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
