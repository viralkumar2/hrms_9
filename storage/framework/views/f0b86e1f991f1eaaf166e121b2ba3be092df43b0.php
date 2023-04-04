<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Register')); ?>

<?php $__env->stopSection(); ?>
<?php
    // $logo=asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    
?>

<?php $__env->startPush('custom-scripts'); ?>
    <?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
        <?php echo NoCaptcha::renderJs(); ?>

    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('language-bar'); ?>
    <li class="nav-item">
        <select name="language" id="language" class="lang-dropdown btn btn-primary my-1 me-2"
            onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e(route('login', $language)); ?>">
                    <?php echo e(Str::upper($language)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="row align-items-center text-start">
            <div class="col-xl-6">
                <?php echo e(Form::open(['route' => 'register', 'method' => 'post', 'id' => 'loginForm'])); ?>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="mb-4 font-medium text-lg text-green-600 text-danger">
                            <?php echo e(__('Email SMTP settings does not configured so please contact to your site admin.')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="">
                        <h2 class="mb-3 f-w-600"><?php echo e(__('Register')); ?></h2>

                    </div>
                    <div class="">
                        <div class="form-group mb-3">
                            <label class="form-label"><?php echo e(__('Full Name')); ?></label>
                            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Username')])); ?>

                        </div>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error invalid-name text-danger" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-group mb-3">
                            <label class="form-label"><?php echo e(__('Email')); ?></label>
                            <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Email address')])); ?>

                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error invalid-email text-danger" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-group mb-3">
                            <label class="form-label"><?php echo e(__('Password')); ?></label>
                            <?php echo e(Form::password('password', ['class' => 'form-control', 'id' => 'input-password', 'placeholder' => __('Password')])); ?>

                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error invalid-password text-danger" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-group">
                            <label class="form-label"><?php echo e(__('Confirm password')); ?></label>
                            <?php echo e(Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'confirm-input-password', 'placeholder' => __('Confirm Password')])); ?>

                            
                            <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error invalid-password_confirmation text-danger" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <?php if(env('RECAPTCHA_MODULE') == 'yes'): ?>
                            <div class="form-group col-lg-12 col-md-12 mt-3">
                                <?php echo NoCaptcha::display(); ?>

                                <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error small text-danger" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        <?php endif; ?>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-block mt-2"><?php echo e(__('Register')); ?></button>
                        </div>

                    </div>
                    <p class="mb-2 my-4 text-center"><?php echo e(__('Already have an account?')); ?> <a href="<?php echo e(route('login')); ?>"
                            class="f-w-400 text-primary"><?php echo e(__('Login')); ?></a></p>
                </div>
            </div>
            <div class="col-xl-6 img-card-side">
                <div class="auth-img-content">
                    <img src="<?php echo e(asset('assets/images/auth/img-auth-3.svg')); ?>" alt="" class="img-fluid">
                    <h3 class="text-white mb-4 mt-5"><?php echo e(__('“Attention is the new currency”')); ?></h3>
                    <p class="text-white">
                        <?php echo e(__('The more effortless the writing looks, the more effort the writer
                                                actually put into the process.')); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\hrms_9\resources\views/auth/register.blade.php ENDPATH**/ ?>