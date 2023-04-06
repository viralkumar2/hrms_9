<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Plan')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Plan')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Plan')): ?>
        <?php if(!empty($admin_payment_setting) &&
            (($admin_payment_setting['is_stripe_enabled'] == 'on' &&
                !empty($admin_payment_setting['stripe_key']) &&
                !empty($admin_payment_setting['stripe_secret'])) ||
                ($admin_payment_setting['is_paypal_enabled'] == 'on' &&
                    !empty($admin_payment_setting['paypal_client_id']) &&
                    !empty($admin_payment_setting['paypal_secret_key'])))): ?>
            <a href="#" data-url="<?php echo e(route('plans.create')); ?>" data-size="md" data-ajax-popup="true"
                data-title="<?php echo e(__('Create New Plan')); ?>" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
                data-bs-original-title="<?php echo e(__('Create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-4">
                <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <div class="card-body " style="height: 295px">
                        <span class="price-badge bg-primary"><?php echo e($plan->name); ?></span>

                        <div class="d-flex flex-row-reverse m-0 p-0 ">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Plan')): ?>
                                <div class="action-btn bg-primary ms-2">
                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                        data-ajax-popup="true" data-title="<?php echo e(__('Edit Plan')); ?>"
                                        data-url="<?php echo e(route('plans.edit', $plan->id)); ?>" data-size="lg" data-bs-toggle="tooltip"
                                        data-bs-original-title="<?php echo e(__('Edit')); ?>" data-bs-placement="top"><span
                                            class="text-white"><i class="ti ti-pencil"></i></span></a>
                                </div>
                            <?php endif; ?>

                            <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id): ?>
                                <span class="d-flex align-items-center ms-2">
                                    <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                    <span class="ms-2"><?php echo e(__('Active')); ?></span>
                                </span>
                            <?php endif; ?>
                        </div>


                        <span
                            class="mb-4 f-w-600 p-price"><?php echo e(env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$'); ?><?php echo e(number_format($plan->price)); ?><small
                                class="text-sm">/ <?php echo e($plan->duration); ?></small></span>

                        <p class="mb-0">
                            <?php echo e($plan->description); ?>

                        </p>

                        <ul class="list-unstyled my-4">
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                <?php echo e($plan->max_users == -1 ? __('Unlimited') : $plan->max_users); ?> <?php echo e(__('Users')); ?>

                            </li>
                            <li>
                                <span class="theme-avtar">
                                    <i class="text-primary ti ti-circle-plus"></i></span>
                                <?php echo e($plan->max_employees == -1 ? __('Unlimited') : $plan->max_employees); ?>

                                <?php echo e(__('Employees')); ?>

                            </li>
                        </ul>
                        <div class="row d-flex justify-content-between">
                            <?php if((!empty($admin_payment_setting) &&
                                ($admin_payment_setting['is_stripe_enabled'] == 'on' ||
                                    $admin_payment_setting['is_paypal_enabled'] == 'on' ||
                                    $admin_payment_setting['is_paystack_enabled'] == 'on' ||
                                    $admin_payment_setting['is_flutterwave_enabled'] == 'on' ||
                                    $admin_payment_setting['is_razorpay_enabled'] == 'on' ||
                                    $admin_payment_setting['is_mercado_enabled'] == 'on' ||
                                    $admin_payment_setting['is_paytm_enabled'] == 'on' ||
                                    $admin_payment_setting['is_mollie_enabled'] == 'on' ||
                                    $admin_payment_setting['is_paypal_enabled'] == 'on' ||
                                    $admin_payment_setting['is_skrill_enabled'] == 'on' ||
                                    $admin_payment_setting['is_coingate_enabled'] == 'on')) ||
                                (!empty($admin_payment_setting) && $admin_payment_setting['is_paymentwall_enabled'] == 'on')): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Buy Plan')): ?>
                                    <?php if($plan->id != \Auth::user()->plan && \Auth::user()->type != 'super admin'): ?>
                                        <div class="col-8">
                                            <?php if(!$plan->price == 0): ?>
                                                <div class="d-grid text-center">
                                                    <a href="<?php echo e(route('stripe', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>"
                                                        class="btn btn-primary btn-sm d-flex justify-content-center align-items-center"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="<?php echo e(__('Subscribe')); ?>"
                                                        title="<?php echo e(__('Subscribe')); ?>"><?php echo e(__('Subscribe')); ?>

                                                        <i class="ti ti-arrow-narrow-right ms-1"></i></a>
                                                    <p></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan != $plan->id): ?>
                                <?php if($plan->id != 1): ?>
                                    <div class="col-3">
                                        <?php if(\Auth::user()->requested_plan != $plan->id): ?>
                                            <a href="<?php echo e(route('send.request', [\Illuminate\Support\Facades\Crypt::encrypt($plan->id)])); ?>"
                                                class="btn btn-primary btn-icon btn-sm"
                                                data-title="<?php echo e(__('Send Request')); ?>" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-original-title="<?php echo e(__('Send Request')); ?>"
                                                title="<?php echo e(__('Send Request')); ?>">
                                                <span class="btn-inner--icon"><i class="ti ti-arrow-forward-up"></i></span>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('request.cancel', \Auth::user()->id)); ?>"
                                                class="btn btn-danger btn-icon btn-sm"
                                                data-title="<?php echo e(__('Cancel Request')); ?>" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-original-title="<?php echo e(__('Cancel Request')); ?>"
                                                title="<?php echo e(__('Cancel Request')); ?>">
                                                <span class="btn-inner--icon"><i class="ti ti-shield-x"></i></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php
                                $plan_expire_date = \Auth::user()->plan_expire_date;
                            ?>

                            <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id): ?>
                                <p class="mb-0">
                                    <?php echo e(__('Plan Expired : ')); ?>

                                    <?php echo e(!empty($plan_expire_date) ? \Auth::user()->dateFormat($plan_expire_date) : 'Unlimited'); ?>

                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\hrms_9\resources\views/plan/index.blade.php ENDPATH**/ ?>