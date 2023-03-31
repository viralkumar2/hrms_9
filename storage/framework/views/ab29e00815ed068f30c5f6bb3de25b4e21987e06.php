<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Promotion')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Promotion')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Promotion')): ?>
        <a href="#" data-url="<?php echo e(route('promotion.create')); ?>" data-ajax-popup="true"
            data-title="<?php echo e(__('Create New Promotion')); ?>" data-size="lg" data-bs-toggle="tooltip" title=""
            class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Create')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'company')): ?>
                                    <th><?php echo e(__('Employee Name')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Designation')); ?></th>
                                <th><?php echo e(__('Promotion Title')); ?></th>
                                <th><?php echo e(__('Promotion Date')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <?php if(Gate::check('Edit Promotion') || Gate::check('Delete Promotion')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            


                            <?php $__currentLoopData = $promotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promotion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'company')): ?>
                                        <td><?php echo e(!empty($promotion->employee()) ? $promotion->employee()->name : ''); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(!empty($promotion->designation()) ? $promotion->designation()->name : ''); ?>

                                    </td>
                                    <td><?php echo e($promotion->promotion_title); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($promotion->promotion_date)); ?></td>
                                    <td><?php echo e($promotion->description); ?></td>
                                    <td class="Action">
                                        <?php if(Gate::check('Edit Promotion') || Gate::check('Delete Promotion')): ?>
                                            <span>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Promotion')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-size="lg"
                                                            data-url="<?php echo e(URL::to('promotion/' . $promotion->id . '/edit')); ?>"
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                            title="" data-title="<?php echo e(__('Edit Promotion')); ?>"
                                                            data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Promotion')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['promotion.destroy', $promotion->id], 'id' => 'delete-form-' . $promotion->id]); ?>

                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                            aria-label="Delete"><i
                                                                class="ti ti-trash text-white text-white"></i></a>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\hrms_9\resources\views/promotion/index.blade.php ENDPATH**/ ?>