
<div class="modal-body">
    <div class="card mb-2">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table datatable">
                    <tbody>
                        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <h6><?php echo e($plan->name); ?> <?php echo e((!empty(env('CURRENCY_SYMBOL')) ? env('CURRENCY_SYMBOL') : '$') . $plan->price); ?>

                                    <?php echo e(' / ' . $plan->duration); ?></h6>
                            </td>
                            
                            <td><?php echo e(__('Users')); ?> : <?php echo e($plan->max_users); ?></td>
                            <td><?php echo e(__('Employees')); ?> : <?php echo e($plan->max_employees); ?></td>


                            <td class="Action">
                                <span>
                                    <?php if($user->plan == $plan->id): ?>

                                        <div class="badge bg-success p-2 px-3 rounded"><i class="ti ti-checks"></i></div>

                                        <?php else: ?>

                                        <a href="<?php echo e(route('plan.active', [$user->id, $plan->id])); ?>"
                                            class="badge bg-info p-2 px-3 rounded"
                                            title="<?php echo e(__('Click to Upgrade Plan')); ?>"><i class="ti ti-shopping-cart-plus"></i></a>


                                        <?php endif; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\wamp\www\hrms_9\resources\views/user/plan.blade.php ENDPATH**/ ?>