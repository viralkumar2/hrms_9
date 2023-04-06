
<?php echo e(Form::open(array('url' => 'contract'))); ?>

<div class="modal-body">
    <div class="row">
        
        <div class="col-md-6 form-group">
            <?php echo e(Form::label('employee_name', __('Employee Name'),['class'=>'col-form-label'])); ?>

            <?php echo e(Form::select('employee_name', $employee,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="col-md-6 form-group">
            <?php echo e(Form::label('subject', __('Subject'),['class'=>'col-form-label'])); ?>

            <?php echo e(Form::text('subject', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-md-6 form-group">
            <?php echo e(Form::label('value', __('Value'),['class'=>'col-form-label'])); ?>

            <?php echo e(Form::number('value', '', array('class' => 'form-control','required'=>'required','min' => '1'))); ?>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('type', __('Type'),['class'=>'col-form-label'])); ?>

                <?php echo e(Form::select('type', $contractType,null, array('class' => 'form-control select2','required'=>'required'))); ?>

                <?php if(count($contractType) <= 0): ?>
                    <div class="text-muted text-xs">
                        <?php echo e(__('Please create new contract type')); ?> <a href="<?php echo e(route('contract_type.index')); ?>"><?php echo e(__('here')); ?></a>.
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'col-form-label'])); ?>

            <?php echo e(Form::date('start_date', null, array('class' => 'form-control current_date','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('end_date', __('Due Date'),['class'=>'col-form-label'])); ?>

            <?php echo e(Form::date('end_date', null, array('class' => 'form-control current_date','required'=>'required'))); ?>

        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('description', __('Description'),['class'=>'col-form-label'])); ?>

                <?php echo e(Form::textarea('description', '', array('class' => 'form-control'))); ?>

            </div>
        </div>
    </div>
</div>


<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <button type="submit" class="btn  btn-primary"><?php echo e(__('Create')); ?></button>
   
</div>
<?php echo e(Form::close()); ?>


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
</script><?php /**PATH E:\wamp64\www\hrms_9\resources\views/contracts/create.blade.php ENDPATH**/ ?>