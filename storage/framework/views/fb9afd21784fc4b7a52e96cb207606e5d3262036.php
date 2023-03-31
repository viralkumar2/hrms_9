<?php echo e(Form::model($holiday, ['route' => ['holiday.update', $holiday->id], 'method' => 'PUT'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('occasion', __('Occasion'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::text('occasion', null, ['class' => 'form-control','placeholder'=>'Enter Occasion'])); ?>

        </div>
        <div class="row col-md-12">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::date('start_date', null, ['class' => 'form-control '])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::date('end_date', null, ['class' => 'form-control '])); ?>

        </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
     <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH E:\wamp64\www\hrms_9\resources\views/holiday/edit.blade.php ENDPATH**/ ?>