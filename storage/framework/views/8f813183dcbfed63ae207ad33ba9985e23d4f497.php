<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Trip')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Trip')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
   

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Travel')): ?>
        <a href="#" data-url="<?php echo e(route('travel.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Trip')); ?>" data-size="lg"
            data-size="lg" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
            data-bs-original-title="<?php echo e(__('Create')); ?>">
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
                                <th><?php echo e(__('Start Date')); ?></th>
                                <th><?php echo e(__('End Date')); ?></th>
                                <th><?php echo e(__('Purpose of Trip')); ?></th>
                                <th><?php echo e(__('Country')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <?php if(Gate::check('Edit Travel') || Gate::check('Delete Travel')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php $__currentLoopData = $travels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $travel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'company')): ?>
                                        <td><?php echo e(!empty($travel->employee()) ? $travel->employee()->name : ''); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(\Auth::user()->dateFormat($travel->start_date)); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($travel->end_date)); ?></td>
                                    <td><?php echo e($travel->purpose_of_visit); ?></td>
                                    <td><?php echo e($travel->place_of_visit); ?></td>
                                    <td><?php echo e($travel->description); ?></td>
                                    <td class="Action">
                                        <?php if(Gate::check('Edit Travel') || Gate::check('Delete Travel')): ?>
                                            <span>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Travel')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-size="lg"
                                                            data-url="<?php echo e(URL::to('travel/' . $travel->id . '/edit')); ?>"
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                            title="" data-title="<?php echo e(__('Edit Trip')); ?>"
                                                            data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Travel')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['travel.destroy', $travel->id], 'id' => 'delete-form-' . $travel->id]); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\hrms_9\resources\views/travel/index.blade.php ENDPATH**/ ?>