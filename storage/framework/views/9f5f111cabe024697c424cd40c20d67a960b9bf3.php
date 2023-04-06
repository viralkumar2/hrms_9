<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Create Employee')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(url('employee')); ?>"><?php echo e(__('Employee')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Create Employee')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="">
            <div class="">
                <div class="row">

                </div>
                <?php echo e(Form::open(['route' => ['employee.store'], 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5><?php echo e(__('Personal Detail')); ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('name', __('Name'), ['class' => 'form-label']); ?><span class="text-danger pl-1">*</span>
                                        <?php echo Form::text('name', old('name'), [
                                            'class' => 'form-control',
                                            'required' => 'required',
                                            'placeholder' => 'Enter employee name',
                                        ]); ?>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('phone', __('Phone'), ['class' => 'form-label']); ?><span class="text-danger pl-1">*</span>
                                        <?php echo Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Enter employee phone']); ?>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo Form::label('dob', __('Date of Birth'), ['class' => 'form-label']); ?><span class="text-danger pl-1">*</span>
                                            <?php echo e(Form::date('dob', null, ['class' => 'form-control current_date', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Select Date of Birth'])); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo Form::label('gender', __('Gender'), ['class' => 'form-label']); ?><span class="text-danger pl-1">*</span>
                                            <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="g_male" value="Male" name="gender"
                                                        class="form-check-input">
                                                    <label class="form-check-label "
                                                        for="g_male"><?php echo e(__('Male')); ?></label>
                                                </div>
                                                <div class="custom-control custom-radio ms-1 custom-control-inline">
                                                    <input type="radio" id="g_female" value="Female" name="gender"
                                                        class="form-check-input">
                                                    <label class="form-check-label "
                                                        for="g_female"><?php echo e(__('Female')); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php echo e(Form::label('marital_status', __('Select Marital*'), ['class' => 'form-label'])); ?>

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
                                        <?php echo Form::label('email', __('Email'), ['class' => 'form-label']); ?><span class="text-danger pl-1">*</span>
                                        <?php echo Form::email('email', old('email'), [
                                            'class' => 'form-control',
                                            'required' => 'required',
                                            'placeholder' => 'Enter employee email',
                                        ]); ?>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('password', __('Password'), ['class' => 'form-label']); ?><span class="text-danger pl-1">*</span>
                                        <?php echo Form::password('password', [
                                            'class' => 'form-control',
                                            'required' => 'required',
                                            'placeholder' => 'Enter employee new password',
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php echo Form::label('address', __('Address'), ['class' => 'form-label']); ?><span class="text-danger pl-1">*</span>
                                    <?php echo Form::textarea('address', old('address'), [
                                        'class' => 'form-control',
                                        'rows' => 2,
                                        'placeholder' => 'Enter employee address',
                                    ]); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5><?php echo e(__('Company Detail')); ?></h5>
                            </div>
                            <div class="card-body employee-detail-create-body">
                                <div class="row">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group ">
                                        <?php echo Form::label('employee_id', __('Employee ID'), ['class' => 'form-label']); ?>

                                        <?php echo Form::text('employee_id', $employeesId, ['class' => 'form-control', 'disabled' => 'disabled']); ?>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('branch_id', __('Select Branch*'), ['class' => 'form-label'])); ?>

                                        <div class="form-icon-user">
                                            <?php echo e(Form::select('branch_id', $branches, null, ['class' => 'form-control select2', 'required' => 'required', 'placeholder' => 'Select Branch'])); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('department_id', __('Select Department*'), ['class' => 'form-label'])); ?>

                                        <div class="form-icon-user">
                                            <?php echo e(Form::select('department_id', $departments, null, ['class' => 'form-control select2', 'id' => 'department_id', 'required' => 'required', 'placeholder' => 'Select Department'])); ?>

                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <?php echo e(Form::label('designation_id', __('Select Designation'), ['class' => 'form-label'])); ?>


                                        <div class="form-icon-user">
                                            
                                            <?php echo e(Form::select('designation_id', $designations, null, ['class' => 'form-control select2', 'id' => 'designation_id', 'required' => 'required', 'placeholder' => 'Select Designation'])); ?>


                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('branch_id', __('Employee Status *'), ['class' => 'form-label'])); ?>

                                        <div class="form-icon-user">
                                            <select name="employe_status" id="employe_status" class="form-control select2">
                                                <option value="">-Select Employee Status-</option>
                                                <option value="Active">Active</option>
                                                <option value="Terminated">Terminated</option>
                                                <option value="Deceased">Deceased</option>
                                                <option value="Resigned">Resigned</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('employe_types', __('Employee Types *'), ['class' => 'form-label'])); ?>

                                        <div class="form-icon-user">
                                            <select name="employe_types" id="employe_types" class="form-control select2">
                                                <option value="">-Select Employee Status-</option>
                                                <option value="Permanent">Permanent</option>
                                                <option value="Temporary">Temporary</option>
                                                <option value="On Contract">On Contract</option>
                                                <option value="Trainee">Trainee</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('Experience', __('Experience'), ['class' => 'form-label']); ?><span class="text-danger pl-1">*</span>
                                        <?php echo Form::text('employee_experience', old('employee_experience'), ['class' => 'form-control', 'placeholder' => 'Enter Experience']); ?>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('date_of_exit', __('Date on Exit'), ['class' => 'form-label']); ?><span class="text-danger pl-1">*</span>
                                        <?php echo Form::text('date_of_exit', old('date_of_exit'), ['class' => 'form-control', 'placeholder' => 'Enter Experience']); ?>

                                    </div>


                                    <div class="form-group col-md-12">
                                        <?php echo Form::label('Job_description', __('Job Description'), ['class' => 'form-label']); ?><span class="text-danger pl-1">*</span>

                                        <?php echo Form::textarea('Job_description', old('Job_description'), [
                                        'class' => 'form-control',
                                        'rows' => 2,
                                        'placeholder' => 'Enter job description',
                                    ]); ?>

                                    </div>


                                    <div class="form-group">
                                        <?php echo Form::label('company_doj', __('Company Date Of Joining'), ['class' => '  form-label']); ?>

                                        <?php echo e(Form::date('company_doj', null, ['class' => 'form-control current_date', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Select company date of joining'])); ?>

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
                                <h5><?php echo e(__('Document')); ?></h6>
                            </div>
                            <div class="card-body employee-detail-create-body">
                                <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row">
                                        <div class="form-group col-12 d-flex">
                                            <div class="float-left col-4">
                                                <label for="document"
                                                    class="float-left pt-1 form-label"><?php echo e($document->name); ?> <?php if($document->is_required == 1): ?>
                                                        <span class="text-danger">*</span>
                                                    <?php endif; ?>
                                                </label>
                                            </div>
                                            <div class="float-right col-8">
                                                <input type="hidden" name="emp_doc_id[<?php echo e($document->id); ?>]" id=""
                                                    value="<?php echo e($document->id); ?>">
                                                <div class="choose-files">
                                                    <label for="document[<?php echo e($document->id); ?>]">
                                                        <div class=" bg-primary document "> <i
                                                                class="ti ti-upload "></i><?php echo e(__('Choose file here')); ?>

                                                        </div>
                                                        <input type="file"
                                                            class="form-control file  d-none <?php $__errorArgs = ['document'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            <?php if($document->is_required == 1): ?> required <?php endif; ?>
                                                            name="document[<?php echo e($document->id); ?>]"
                                                            id="document[<?php echo e($document->id); ?>]"
                                                            data-filename="<?php echo e($document->id . '_filename'); ?>"
                                                            onchange="document.getElementById('<?php echo e('blah' . $key); ?>').src = window.URL.createObjectURL(this.files[0])">
                                                    </label>
                                                    <img id="<?php echo e('blah' . $key); ?>" src="" width="50%" />

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 ">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5><?php echo e(__('Work Experience-TABLE')); ?></h5>
                            </div>
                            <div class="card-body employee-detail-create-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('previous_company_name', __('Previous Company'), ['class' => 'form-label']); ?>

                                        <?php echo Form::text('previous_company_name', old('previous_company_name'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter previous company',
                                        ]); ?>


                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('previous_job_title', __('Job Title'), ['class' => 'form-label']); ?>

                                        <?php echo Form::text('previous_job_title', old('previous_job_title'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter job title',
                                        ]); ?>


                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('previous_from_date', __('From Date'), ['class' => 'form-label']); ?>

                                        <?php echo e(Form::date('previous_from_date', null, ['class' => 'form-control current_date', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Select Date of Birth'])); ?>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('previous_to_date', __('To Date'), ['class' => 'form-label']); ?>

                                        <?php echo e(Form::date('previous_to_date', null, ['class' => 'form-control current_date', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Select Date of Birth'])); ?>

                                    </div>

                                    <div class="form-group col-md-12">
                                        <?php echo e(Form::label('previous_company_designation_id', __('Select Designation'), ['class' => 'form-label'])); ?>

                                        <div class="form-icon-user">
                                            <?php echo e(Form::select('previous_company_designation_id', $designations, null, ['class' => 'form-control select2', 'id' => 'previous_company_designation_id', 'required' => 'required', 'placeholder' => 'Select Designation'])); ?>

                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <?php echo Form::label('experiance_Job_description', __('Experience Job Description'), ['class' => 'form-label']); ?><span class="text-danger pl-1">*</span>

                                        <?php echo Form::textarea('experiance_Job_description', old('experiance_Job_description'), [
                                        'class' => 'form-control',
                                        'rows' => 2,
                                        'placeholder' => 'Enter Experience job description',
                                    ]); ?>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6 ">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5><?php echo e(__('Education-TABLE')); ?></h5>
                            </div>
                            <div class="card-body employee-detail-create-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('institute_name', __('Institute Name'), ['class' => 'form-label']); ?>

                                        <?php echo Form::text('institute_name', old('institute_name'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter institute name',
                                        ]); ?>


                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('education', __('Education'), ['class' => 'form-label']); ?>

                                        <?php echo Form::text('education', old('education'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter education',
                                        ]); ?>


                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('specialization', __('Specialization'), ['class' => 'form-label']); ?>

                                        <?php echo Form::text('specialization', old('specialization'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter specialization',
                                        ]); ?>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('date_of_completion', __('Date of completion'), ['class' => 'form-label']); ?>

                                        <?php echo e(Form::date('date_of_completion', null, ['class' => 'form-control current_date', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Select Date of Birth'])); ?>

                                    </div>



                                    <div class="form-group col-md-12">
                                        <?php echo Form::label('notes', __('Notes'), ['class' => 'form-label']); ?><span class="text-danger pl-1">*</span>

                                        <?php echo Form::textarea('notes', old('notes'), [
                                        'class' => 'form-control',
                                        'rows' => 2,
                                        'placeholder' => 'Enter notes',
                                    ]); ?>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                     
                     <div class="col-md-6 ">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5><?php echo e(__('Dependent')); ?></h5>
                            </div>
                            <div class="card-body employee-detail-create-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <?php echo Form::label('dependent_name', __('Name'), ['class' => 'form-label']); ?>

                                        <?php echo Form::text('dependent_name', old('dependent_name'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter dependent name',
                                        ]); ?>


                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php echo e(Form::label('dependent_relation', __('Relation Types *'), ['class' => 'form-label'])); ?>

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
                                        <?php echo Form::label('dependent_dob', __('Date of completion'), ['class' => 'form-label']); ?>

                                        <?php echo e(Form::date('dependent_dob', null, ['class' => 'form-control current_date', 'required' => 'required', 'autocomplete' => 'off', 'placeholder' => 'Select Date of Birth'])); ?>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6 ">
                        <div class="card em-card">
                            <div class="card-header">
                                <h5><?php echo e(__('Bank Account Detail')); ?></h5>
                            </div>
                            <div class="card-body employee-detail-create-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('account_holder_name', __('Account Holder Name'), ['class' => 'form-label']); ?>

                                        <?php echo Form::text('account_holder_name', old('account_holder_name'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter account holder name',
                                        ]); ?>


                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('account_number', __('Account Number'), ['class' => 'form-label']); ?>

                                        <?php echo Form::number('account_number', old('account_number'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter account number',
                                        ]); ?>


                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('bank_name', __('Bank Name'), ['class' => 'form-label']); ?>

                                        <?php echo Form::text('bank_name', old('bank_name'), ['class' => 'form-control', 'placeholder' => 'Enter bank name']); ?>


                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('bank_identifier_code', __('Bank Identifier Code'), ['class' => 'form-label']); ?>

                                        <?php echo Form::text('bank_identifier_code', old('bank_identifier_code'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter bank identifier code',
                                        ]); ?>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('branch_location', __('Branch Location'), ['class' => 'form-label']); ?>

                                        <?php echo Form::text('branch_location', old('branch_location'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter branch location',
                                        ]); ?>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo Form::label('tax_payer_id', __('Tax Payer Id'), ['class' => 'form-label']); ?>

                                        <?php echo Form::text('tax_payer_id', old('tax_payer_id'), [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter tax payer id',
                                        ]); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="float-end">
                <button type="submit" class="btn  btn-primary"><?php echo e('Create'); ?></button>
            </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
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
                url: '<?php echo e(route('employee.json')); ?>',
                type: 'POST',
                data: {
                    "department_id": did,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {

                    $('.designation_id').empty();
                    var emp_selct = ` <select class="form-control  designation_id" name="designation_id" id="choices-multiple"
                                            placeholder="Select Designation" >
                                            </select>`;
                    $('.designation_div').html(emp_selct);

                    $('.designation_id').append('<option value="0"> <?php echo e(__('All')); ?> </option>');
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\hrms_9\resources\views/employee/create.blade.php ENDPATH**/ ?>