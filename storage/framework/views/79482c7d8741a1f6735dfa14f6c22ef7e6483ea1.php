<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Holiday')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Holidays List')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>

    <a href="<?php echo e(route('holidays.export')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
        data-bs-original-title="<?php echo e(__('Export')); ?>">
        <i class="ti ti-file-export"></i>
    </a>

    <a href="#" data-url="<?php echo e(route('holidays.file.import')); ?>" data-ajax-popup="true"
        data-title="<?php echo e(__('Import Holiday CSV file')); ?>" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
        data-bs-original-title="<?php echo e(__('Import')); ?>">
        <i class="ti ti-file-import"></i>
    </a>

    <a href="<?php echo e(route('holiday.calender')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
        data-bs-original-title="<?php echo e(__('Calendar View')); ?>">
        <i class="ti ti-calendar"></i>
    </a>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Holiday')): ?>
        <a href="#" data-url="<?php echo e(route('holiday.create')); ?>" data-ajax-popup="true"
            data-title="<?php echo e(__('Create New Holiday')); ?>" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
            data-bs-original-title="<?php echo e(__('Create')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">

    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12">
        <!-- <div class="multi-collapse mt-2 collapse" id="multiCollapseExample1" style=""> -->
            <div class="card">
                <div class="card-body">
                    <?php echo e(Form::open(['route' => ['holiday.index'], 'method' => 'get', 'id' => 'holiday_filter'])); ?>

                    <div class="d-flex align-items-center justify-content-end">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                            <div class="btn-box">

                                <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::date('start_date', isset($_GET['start_date']) ? $_GET['start_date'] : '', ['class' => 'month-btn form-control current_date', 'autocomplete' => 'off'])); ?>


                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                            <div class="btn-box">

                                <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::date('end_date', isset($_GET['end_date']) ? $_GET['end_date'] : '', ['class' => 'month-btn form-control current_date', 'autocomplete' => 'off'])); ?>


                            </div>
                        </div>

                        <div class="col-auto float-end ms-2 mt-4">
                            <a href="#" class="btn btn-sm btn-primary"
                                onclick="document.getElementById('holiday_filter').submit(); return false;"
                                data-bs-toggle="tooltip" title="" data-bs-original-title="apply">
                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                            </a>
                            <a href="<?php echo e(route('holiday.index')); ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                title="" data-bs-original-title="Reset">
                                <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                            </a>
                        </div>

                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                            <th><?php echo e(__('Occasion')); ?></th>
                                <th><?php echo e(__('Start Date')); ?></th>
                                <th><?php echo e(__('End Date')); ?></th>
                                <?php if(Gate::check('Edit Holiday') || Gate::check('Delete Holiday')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                <td><?php echo e($holiday->occasion); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($holiday->start_date)); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($holiday->end_date)); ?></td>    
                                    <?php if(Gate::check('Edit Holiday') || Gate::check('Delete Holiday')): ?>
                                        <td class="Action">
                                            <span>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Holiday')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                            data-url="<?php echo e(route('holiday.edit', $holiday->id)); ?>"
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                            title="" data-title="<?php echo e(__('Edit Holiday')); ?>"
                                                            data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Holiday')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['holiday.destroy', $holiday->id], 'id' => 'delete-form-' . $holiday->id]); ?>

                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                            aria-label="Delete"><i
                                                                class="ti ti-trash text-white text-white"></i></a>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\hrms_9\resources\views/holiday/index.blade.php ENDPATH**/ ?>