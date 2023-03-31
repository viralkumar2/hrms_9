<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Plan Request')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Plan Request')); ?></li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead class="d-none"></thead>

                        <tbody>
                            <?php if($plan_requests->count() > 0): ?>
                                <?php $__currentLoopData = $plan_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="font-style font-weight-bold"><?php echo e($prequest->user->name); ?></div>
                                        </td>
                                        <td>
                                            <div class="font-style font-weight-bold"><?php echo e($prequest->plan->name); ?></div>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold"><?php echo e($prequest->plan->max_employee); ?></div>
                                            <div><?php echo e(__('Employee')); ?></div>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold"><?php echo e($prequest->plan->max_client); ?></div>
                                            <div><?php echo e(__('Client')); ?></div>
                                        </td>
                                        <td>
                                            <div class="font-style font-weight-bold">
                                                <?php echo e($prequest->duration == 'monthly' ? __('One Month') : __('One Year')); ?>

                                            </div>
                                        </td>
                                        <td><?php echo e(\App\Models\Utility::getDateFormated($prequest->created_at, true)); ?>

                                        </td>
                                        <td>
                                            <div>
                                                <a href="<?php echo e(route('response.request', [$prequest->id, 1])); ?>"
                                                    class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-original-title="<?php echo e(__('Approve')); ?>">
                                                    <i class="ti ti-checks"></i>
                                                </a>
                                                <a href="<?php echo e(route('response.request', [$prequest->id, 0])); ?>"
                                                    class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-original-title="<?php echo e(__('Cancel')); ?>">
                                                    <i class="ti ti-shield-x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <th scope="col" colspan="7">
                                        <h6 class="text-center"><?php echo e(__('No Manually Plan Request Found.')); ?></h6>
                                    </th>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\hrms_9\resources\views/plan_request/index.blade.php ENDPATH**/ ?>