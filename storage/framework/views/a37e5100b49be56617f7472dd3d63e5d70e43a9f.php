<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Account Balances')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Account Balances')); ?></li>
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
                                <th><?php echo e(__('Account Name')); ?></th>
                                <th width="200px"><?php echo e(__('Initial Balance')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totalInitialBalance = 0; ?>
                            <?php $__currentLoopData = $accountLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accountlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $totalInitialBalance = $accountlist->initial_balance + $totalInitialBalance;
                                ?>
                                <tr>
                                    <td><?php echo e($accountlist->account_name); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($accountlist->initial_balance)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-left text-dark"><?php echo e(__('Total')); ?></td>
                                <td><?php echo e(\Auth::user()->priceFormat($totalInitialBalance)); ?></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\hrms_9\resources\views/accountlist/account_balance.blade.php ENDPATH**/ ?>