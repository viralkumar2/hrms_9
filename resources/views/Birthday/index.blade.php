
@extends('layouts.admin')

@section('page-title')
   {{ __('Birthday') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Employee Birthday') }}</li>
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
                                <th>{{ __('Date Of Birth') }}</th>



                                @if (Gate::check('Edit Employee') || Gate::check('Delete Employee'))
                                    <th width="200px">{{ __('Action') }}</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($total_birthday as $employee)
                                <tr>
                                    <td><a class="btn btn-outline-primary"
                                        href="#">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a></td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->dob }}</td>
                                        <td><a href="{{ route('send_employee_email',$employee->id)}}" class="btn btn-primary btn-sm">Send Email</a></td>
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
