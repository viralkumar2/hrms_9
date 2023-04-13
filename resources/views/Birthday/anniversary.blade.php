
@extends('layouts.admin')

@section('page-title')
   {{ __('Anniversary') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Employee Anniversary') }}</li>
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
                                <th>{{ __('Employee ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Date Of Joining') }}</th>
                                <th width="200px">{{ __('Action') }}</th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($total_anniversary as $employee)
                                <tr>
                                    <td><a class="btn btn-outline-primary"
                                        href="#">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a></td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->company_doj }}</td>
                                        <td><a href="{{ route('employee_anniversary_send_email',$employee->id)}}" class="btn btn-primary btn-sm">Send Email</a></td>
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
