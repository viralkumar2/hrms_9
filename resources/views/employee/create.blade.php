@extends('layouts.admin')

@section('page-title')
    {{ __('Create Employee') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ url('employee') }}">{{ __('Employee') }}</a></li>
    <li class="breadcrumb-item">{{ __('Create Employee') }}</li>
@endsection


@section('content')
    <div class="row">
        <div class="">
            <div class="">
                <div class="row">

                </div>
                {{ Form::open(['route' => ['employee.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5>{{ __('Personal Detail') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        {!! Form::label('name', __('Name'), ['class' => 'form-label']) !!}<span class="text-danger pl-1">*</span>
                                        {!! Form::text('name', old('name'), [
                                            'class' => 'form-control',
                                            'required' => 'required',
                                            'placeholder' => 'Enter employee name',
                                        ]) !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('phone', __('Phone'), ['class' => 'form-label']) !!}<span class="text-danger pl-1">*</span>
                                        {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Enter employee phone']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('dob', __('Date of Birth'), ['class' => 'form-label']) !!}<span class="text-danger pl-1">*</span>
                                            {{ Form::date('dob', null, ['class' => 'form-control current_date', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Select Date of Birth']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('gender', __('Gender'), ['class' => 'form-label']) !!}<span class="text-danger pl-1">*</span>
                                            <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="g_male" value="Male" name="gender"
                                                        class="form-check-input">
                                                    <label class="form-check-label "
                                                        for="g_male">{{ __('Male') }}</label>
                                                </div>
                                                <div class="custom-control custom-radio ms-1 custom-control-inline">
                                                    <input type="radio" id="g_female" value="Female" name="gender"
                                                        class="form-check-input">
                                                    <label class="form-check-label "
                                                        for="g_female">{{ __('Female') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        {{ Form::label('marital_status', __('Select Marital'), ['class' => 'form-label']) }}
                                        <div class="form-icon-user">
                                            <select name="marital_status" id="marital_status" class="form-control select2">
                                                <option value="">-Select Marital-</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Separated">Separated</option>
                                                <option value="Divorced">Divorced</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        {!! Form::label('email', __('Email'), ['class' => 'form-label']) !!}<span class="text-danger pl-1">*</span>
                                        {!! Form::email('email', old('email'), [
                                            'class' => 'form-control',
                                            'required' => 'required',
                                            'placeholder' => 'Enter employee email',
                                        ]) !!}
                                    </div>

                                    <div class="form-group col-md-6">
                                        {!! Form::label('password', __('Password'), ['class' => 'form-label']) !!}<span class="text-danger pl-1">*</span>
                                        {!! Form::password('password', [
                                            'class' => 'form-control',
                                            'required' => 'required',
                                            'placeholder' => 'Enter employee new password',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('address', __('Address'), ['class' => 'form-label']) !!}<span class="text-danger pl-1"></span>
                                    {!! Form::textarea('address', old('address'), [
                                        'class' => 'form-control',
                                        'rows' => 2,
                                        'placeholder' => 'Enter employee address',
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5>{{ __('Company Detail') }}</h5>
                            </div>
                            <div class="card-body employee-detail-create-body">
                                <div class="row">
                                    @csrf
                                    <div class="form-group ">
                                        {!! Form::label('employee_id', __('Employee ID'), ['class' => 'form-label']) !!}
                                        {!! Form::text('employee_id', $employeesId, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('branch_id', __('Select Branch*'), ['class' => 'form-label']) }}
                                        <div class="form-icon-user">
                                            {{ Form::select('branch_id', $branches, null, ['class' => 'form-control select2', 'required' => 'required', 'placeholder' => 'Select Branch']) }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('department_id', __('Select Department*'), ['class' => 'form-label']) }}
                                        <div class="form-icon-user">
                                            {{ Form::select('department_id', $departments, null, ['class' => 'form-control select2', 'id' => 'department_id', 'required' => 'required', 'placeholder' => 'Select Department']) }}
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        {{ Form::label('designation_id', __('Select Designation'), ['class' => 'form-label']) }}

                                        <div class="form-icon-user">
                                            {{--  <div class="designation_div">
                                            <select class="form-control  designation_id" name="designation_id"
                                                id="choices-multiple" placeholder="Select Designation">
                                            </select>
                                        </div>  --}}
                                            {{ Form::select('designation_id', $designations, null, ['class' => 'form-control select2', 'id' => 'designation_id', 'required' => 'required', 'placeholder' => 'Select Designation']) }}

                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('branch_id', __('Employee Status *'), ['class' => 'form-label']) }}
                                        <div class="form-icon-user">
                                            <select name="employe_status" id="employe_status" class="form-control select2" required>
                                                <option value="">-Select Employee Status-</option>
                                                <option value="Active">Active</option>
                                                <option value="Terminated">Terminated</option>
                                                <option value="Deceased">Deceased</option>
                                                <option value="Resigned">Resigned</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('employe_types', __('Employee Types *'), ['class' => 'form-label']) }}
                                        <div class="form-icon-user">
                                            <select name="employe_types" id="employe_types" class="form-control select2" required>
                                                <option value="">-Select Employee Status-</option>
                                                <option value="Permanent">Permanent</option>
                                                <option value="Temporary">Temporary</option>
                                                <option value="On Contract">On Contract</option>
                                                <option value="Trainee">Trainee</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        {!! Form::label('Experience', __('Experience'), ['class' => 'form-label']) !!}<span class="text-danger pl-1"></span>
                                        {!! Form::text('employee_experience', old('employee_experience'), ['class' => 'form-control', 'placeholder' => 'Enter Experience']) !!}
                                    </div>

                                    <div class="form-group col-md-6">
                                        {!! Form::label('date_of_exit', __('Date on Exit'), ['class' => 'form-label']) !!}<span class="text-danger pl-1"></span>
                                        {!! Form::text('date_of_exit', old('date_of_exit'), ['class' => 'form-control', 'placeholder' => 'Enter Experience']) !!}
                                    </div>


                                    <div class="form-group col-md-12">
                                        {!! Form::label('Job_description', __('Job Description'), ['class' => 'form-label']) !!}<span class="text-danger pl-1"></span>

                                        {!! Form::textarea('Job_description', old('Job_description'), [
                                        'class' => 'form-control',
                                        'rows' => 2,
                                        'placeholder' => 'Enter job description',
                                    ]) !!}
                                    </div>


                                    <div class="form-group">
                                        {!! Form::label('company_doj', __('Company Date Of Joining'), ['class' => '  form-label']) !!}
                                        {{ Form::date('company_doj', null, ['class' => 'form-control current_date', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Select company date of joining']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5>{{ __('Document') }}</h6>
                            </div>
                            <div class="card-body employee-detail-create-body">
                                @foreach ($documents as $key => $document)
                                    <div class="row">
                                        <div class="form-group col-12 d-flex">
                                            <div class="float-left col-4">
                                                <label for="document"
                                                    class="float-left pt-1 form-label">{{ $document->name }} @if ($document->is_required == 1)
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                            </div>
                                            <div class="float-right col-8">
                                                <input type="hidden" name="emp_doc_id[{{ $document->id }}]" id=""
                                                    value="{{ $document->id }}">
                                                <div class="choose-files">
                                                    <label for="document[{{ $document->id }}]">
                                                        <div class=" bg-primary document "> <i
                                                                class="ti ti-upload "></i>{{ __('Choose file here') }}
                                                        </div>
                                                        <input type="file"
                                                            class="form-control file  d-none @error('document') is-invalid @enderror"
                                                            @if ($document->is_required == 1) required @endif
                                                            name="document[{{ $document->id }}]"
                                                            id="document[{{ $document->id }}]"
                                                            data-filename="{{ $document->id . '_filename' }}"
                                                            onchange="document.getElementById('{{ 'blah' . $key }}').src = window.URL.createObjectURL(this.files[0])">
                                                    </label>
                                                    <img id="{{ 'blah' . $key }}" src="" width="50%" />

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- //Work Experience-TABLE --}}
                    <div class="col-md-6 ">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5>{{ __('Work Experience-TABLE') }}</h5>
                            </div>
                            <div class="card-body employee-detail-create-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        {!! Form::label('previous_company_name', __('Previous Company'), ['class' => 'form-label']) !!}
                                        {!! Form::text('previous_company_name', old('previous_company_name'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter previous company',
                                        ]) !!}

                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('previous_job_title', __('Job Title'), ['class' => 'form-label']) !!}
                                        {!! Form::text('previous_job_title', old('previous_job_title'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter job title',
                                        ]) !!}

                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('previous_from_date', __('From Date'), ['class' => 'form-label']) !!}
                                        {{ Form::date('previous_from_date', null, ['class' => 'form-control current_date', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Select Date of Birth']) }}
                                    </div>

                                    <div class="form-group col-md-6">
                                        {!! Form::label('previous_to_date', __('To Date'), ['class' => 'form-label']) !!}
                                        {{ Form::date('previous_to_date', null, ['class' => 'form-control current_date', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Select Date of Birth']) }}
                                    </div>

                                    <div class="form-group col-md-12">
                                        {{ Form::label('previous_company_designation_id', __('Select Designation'), ['class' => 'form-label']) }}
                                        <div class="form-icon-user">
                                            {{ Form::select('previous_company_designation_id', $designations, null, ['class' => 'form-control select2', 'id' => 'previous_company_designation_id','placeholder' => 'Select Designation']) }}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        {!! Form::label('experiance_Job_description', __('Experience Job Description'), ['class' => 'form-label']) !!}<span class="text-danger pl-1"></span>

                                        {!! Form::textarea('experiance_Job_description', old('experiance_Job_description'), [
                                        'class' => 'form-control',
                                        'rows' => 2,
                                        'placeholder' => 'Enter Experience job description',
                                    ]) !!}
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- //Education tables --}}
                    <div class="col-md-6 ">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5>{{ __('Education-TABLE') }}</h5>
                            </div>
                            <div class="card-body employee-detail-create-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        {!! Form::label('institute_name', __('Institute Name'), ['class' => 'form-label']) !!}
                                        {!! Form::text('institute_name', old('institute_name'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter institute name',
                                        ]) !!}

                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('education', __('Education'), ['class' => 'form-label']) !!}
                                        {!! Form::text('education', old('education'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter education',
                                        ]) !!}

                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('specialization', __('Specialization'), ['class' => 'form-label']) !!}
                                        {!! Form::text('specialization', old('specialization'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter specialization',
                                        ]) !!}
                                    </div>

                                    <div class="form-group col-md-6">
                                        {!! Form::label('date_of_completion', __('Date of completion'), ['class' => 'form-label']) !!}
                                        {{ Form::date('date_of_completion', null, ['class' => 'form-control current_date', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Select Date of Birth']) }}
                                    </div>



                                    <div class="form-group col-md-12">
                                        {!! Form::label('notes', __('Notes'), ['class' => 'form-label']) !!}<span class="text-danger pl-1">*</span>

                                        {!! Form::textarea('notes', old('notes'), [
                                        'class' => 'form-control',
                                        'rows' => 2,
                                        'placeholder' => 'Enter notes',
                                    ]) !!}
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                     {{-- //Dependenttables --}}
                     <div class="col-md-6 ">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5>{{ __('Dependent') }}</h5>
                            </div>
                            <div class="card-body employee-detail-create-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        {!! Form::label('dependent_name', __('Name'), ['class' => 'form-label']) !!}
                                        {!! Form::text('dependent_name', old('dependent_name'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter dependent name',
                                        ]) !!}

                                    </div>
                                    <div class="form-group col-md-12">
                                        {{ Form::label('dependent_relation', __('Relation Types'), ['class' => 'form-label']) }}
                                        <div class="form-icon-user">
                                            <select name="dependent_relation" id="dependent_relation" class="form-control select2">
                                                <option value="">-Select Relation</option>
                                                <option value="Father">Father</option>
                                                <option value="Mother">Mother</option>
                                                <option value="Brother">Brother</option>
                                                <option value="Sister">Sister</option>
                                                <option value="Husband">Husband</option>
                                                <option value="Wife">Wife</option>
                                                <option value="Child">Child</option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-12">
                                        {!! Form::label('dependent_dob', __('Date of completion'), ['class' => 'form-label']) !!}
                                        {{ Form::date('dependent_dob', null, ['class' => 'form-control current_date', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Select Date of Birth']) }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- // --}}
                    <div class="col-md-6 ">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5>{{ __('Bank Account Detail') }}</h5>
                            </div>
                            <div class="card-body employee-detail-create-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        {!! Form::label('account_holder_name', __('Account Holder Name'), ['class' => 'form-label']) !!}
                                        {!! Form::text('account_holder_name', old('account_holder_name'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter account holder name',
                                        ]) !!}

                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('account_number', __('Account Number'), ['class' => 'form-label']) !!}
                                        {!! Form::number('account_number', old('account_number'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter account number',
                                        ]) !!}

                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('bank_name', __('Bank Name'), ['class' => 'form-label']) !!}
                                        {!! Form::text('bank_name', old('bank_name'), ['class' => 'form-control', 'placeholder' => 'Enter bank name']) !!}

                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('bank_identifier_code', __('Bank Identifier Code'), ['class' => 'form-label']) !!}
                                        {!! Form::text('bank_identifier_code', old('bank_identifier_code'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter bank identifier code',
                                        ]) !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('branch_location', __('Branch Location'), ['class' => 'form-label']) !!}
                                        {!! Form::text('branch_location', old('branch_location'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter branch location',
                                        ]) !!}
                                    </div>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('tax_payer_id', __('Tax Payer Id'), ['class' => 'form-label']) !!}
                                        {!! Form::text('tax_payer_id', old('tax_payer_id'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter tax payer id',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="float-end">
                <button type="submit" class="btn  btn-primary">{{ 'Create' }}</button>
            </div>
            </form>
        </div>
    </div>
@endsection

@push('script-page')
    <script>
        $('input[type="file"]').change(function(e) {
            var file = e.target.files[0].name;
            var file_name = $(this).attr('data-filename');
            $('.' + file_name).append(file);
        });
    </script>
    <script>
        $(document).ready(function() {
            var d_id = $('.department_id').val();
            getDesignation(d_id);
        });

        $(document).on('change', 'select[name=department_id]', function() {
            var department_id = $(this).val();
            getDesignation(department_id);
        });

        function getDesignation(did) {

            $.ajax({
                url: '{{ route('employee.json') }}',
                type: 'POST',
                data: {
                    "department_id": did,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {

                    $('.designation_id').empty();
                    var emp_selct = ` <select class="form-control  designation_id" name="designation_id" id="choices-multiple"
                                            placeholder="Select Designation" >
                                            </select>`;
                    $('.designation_div').html(emp_selct);

                    $('.designation_id').append('<option value="0"> {{ __('All') }} </option>');
                    $.each(data, function(key, value) {
                        $('.designation_id').append('<option value="' + key + '">' + value +
                            '</option>');
                    });
                    new Choices('#choices-multiple', {
                        removeItemButton: true,
                    });
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            var now = new Date();
            var month = (now.getMonth() + 1);
            var day = now.getDate();
            if (month < 10) month = "0" + month;
            if (day < 10) day = "0" + day;
            var today = now.getFullYear() + '-' + month + '-' + day;
            $('.current_date').val(today);
        });
    </script>
@endpush
