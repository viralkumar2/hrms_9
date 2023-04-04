<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Payee')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Payee')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Payee')): ?>
        <a href="#" data-url="<?php echo e(route('payees.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Payee')); ?>"
            data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Create')); ?>">
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
                            <th><?php echo e(__('Payee Name')); ?></th>
                            <th><?php echo e(__('Contact Number')); ?></th>
                            <th width="200px"><?php echo e(__('Action')); ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $payees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($payee->payee_name); ?></td>
                                <td><?php echo e($payee->contact_number); ?></td>
                                <td class="Action">

                                    <span>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Payee')): ?>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                    data-url="<?php echo e(URL::to('payees/' . $payee->id . '/edit')); ?>"
                                                    data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                                                    data-title="<?php echo e(__('Edit Payee')); ?>"
                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Payee')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['payees.destroy', $payee->id], 'id' => 'delete-form-' . $payee->id]); ?>

                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                    data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                    aria-label="Delete"><i
                                                        class="ti ti-trash text-white text-white"></i></a>
                                                </form>
                                            </div>
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
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\hrms_9\resources\views/payees/index.blade.php ENDPATH**/ ?>