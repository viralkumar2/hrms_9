<?php echo e(Form::open(['url' => 'coupons', 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('discount', __('Discount'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('discount', null, ['class' => 'form-control', 'required' => 'required', 'step' => '0.01'])); ?>

            <span class="small"><?php echo e(__('Note: Discount in Percentage')); ?></span>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('limit', __('Limit'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('limit', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>

        <div class="form-group col-md-12" id="auto">
            <?php echo e(Form::label('limit', __('Code'), ['class' => 'col-form-label'])); ?>

            <div class="input-group">
                <?php echo e(Form::text('autoCode', null, ['class' => 'form-control', 'id' => 'auto-code', 'required' => 'required'])); ?>

                <button class="btn btn-outline-primary" type="button" id="code-generate"><i
                        class="fa fa-history pr-1"></i><?php echo e(__(' Generate')); ?></button>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH E:\wamp64\www\hrms_9\resources\views/coupon/create.blade.php ENDPATH**/ ?>