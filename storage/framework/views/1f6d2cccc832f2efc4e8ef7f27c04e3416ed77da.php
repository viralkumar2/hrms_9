<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php
    // $logo = asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $company_logo = \App\Models\Utility::getValByName('company_logo');
    $company_logo_light = \App\Models\Utility::getValByName('company_logo_light');
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $color = isset($settings['theme_color']) ? $settings['theme_color'] : 'theme-4';

    $settings = App\Models\Utility::settings();

    $currantLang = \App\Models\Utility::languages();
    $SITE_RTL = \App\Models\Utility::getValByName('SITE_RTL');
?>



<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Settings')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/tinymce/tinymce.min.js')); ?>"></script>

    <script>
        if ($(".pc-tinymce-2").length) {
            tinymce.init({
                selector: '.pc-tinymce-2',
                height: "400",
                content_style: 'body { font-family: "Inter", sans-serif; }'
            });
        }
    </script>
    <script>
        if ($(".pc-tinymce-3").length) {
            tinymce.init({
                selector: '.pc-tinymce-3',
                height: "400",
                content_style: 'body { font-family: "Inter", sans-serif; }'
            });
        }
    </script>
    <script>
        if ($(".pc-tinymce-4").length) {
            tinymce.init({
                selector: '.pc-tinymce-4',
                height: "400",
                content_style: 'body { font-family: "Inter", sans-serif; }'
            });
        }
    </script>
    <script>
        if ($(".pc-tinymce-5").length) {
            tinymce.init({
                selector: '.pc-tinymce-5',
                height: "400",
                content_style: 'body { font-family: "Inter", sans-serif; }'
            });
        }
    </script>
    <script>
        $(document).on('change', '.email-template-checkbox', function() {
            var url = $(this).data('url');
            var chbox = $(this);

            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    status: chbox.val()
                },
                success: function(data) {

                },
            });
        });
    </script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })

        $('.themes-color-change').on('click', function() {
            var color_val = $(this).data('value');
            $('.theme-color').prop('checked', false);
            $('.themes-color-change').removeClass('active_color');
            $(this).addClass('active_color');
            $(`input[value=${color_val}]`).prop('checked', true);

        });
    </script>
    <script>
        document.getElementById('company_logo').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }
    </script>
    <script>
        document.getElementById('company_logo_light').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image1').src = src
        }
    </script>
    <script>
        document.getElementById('company_favicon').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image2').src = src
        }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top">
                        <div class="list-group list-group-flush" id="useradd-sidenav">

                            <a href="#business-settings" id="business-setting-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Business Settings')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#system-settings" id="system-setting-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('System Settings')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#company-settings" id="company-setting-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Company Settings')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a id="email-notification-tab" data-toggle="tab" href="#email-notification-settings"
                                role="tab" aria-controls="" aria-selected="false"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Notification Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>

                            <a href="#ip-restriction-settings" id="ip-restrict-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('IP Restriction Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>

                            <?php if(Auth::user()->type == 'company'): ?>
                                <a href="#zoom-meeting-settings" id="zoom-meeting-tab"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Zoom Meeting Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>

                                <a href="#slack-settings" id="slack-tab"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Slack Settings')); ?> <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                                <a href="#telegram-settings" id="telegram-tab"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Telegram Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>

                                <a href="#twilio-settings" id="twilio-tab"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Twilio Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>
                            <a href="#offer-letter-settings" id="offer-letter-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Offer Letter Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>

                            <a href="#joining-letter-settings" id="joining-letter-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Joining Letter Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#increment-letter-settings" id="joining-letter-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Increment Letter Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>

                            <a href="#Relieving-letter-settings" id="joining-letter-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Relieving Lette')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>





                            <a href="#experience-certificate-settings" id="experience-certificate-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Certificate of Experience Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>

                            <a href="#noc-settings" id="noc-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('No Objection Certificate Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>

                            <a href="#google-calender" id="google-calendar-tab"
                                class="list-group-item list-group-item-action border-0"><?php echo e(__('Google Calendar Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        </div>

                    </div>
                </div>

                <div class="col-xl-9">
                    <div class="" id="business-settings">
                        <?php echo e(Form::model($settings, ['route' => 'business.setting', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><?php echo e(__('Business Settings')); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-6 col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><?php echo e(__('Logo dark')); ?></h5>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class=" setting-card">
                                                            <div class="logo-content mt-4 setting-logo">

                                                                <a href="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                                                                    target="_blank">
                                                                    <img id="image" alt="your image"
                                                                        src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                                                                        width="150px" class="big-logo">
                                                                </a>
                                                            </div>
                                                            <div class="choose-files mt-3">

                                                                <label for="company_logo">
                                                                    <div class=" bg-primary "> <i
                                                                            class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                    </div>
                                                                    <input type="file" class="form-control file"
                                                                        name="company_logo" id="company_logo"
                                                                        data-filename="company_logo">
                                                                </label>

                                                            </div>
                                                            <?php $__errorArgs = ['company_logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <div class="row">
                                                                    <span class="invalid-company_logo" role="alert">
                                                                        <strong
                                                                            class="text-danger"><?php echo e($message); ?></strong>
                                                                    </span>
                                                                </div>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6 col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><?php echo e(__('Logo Light')); ?></h5>
                                                    </div>

                                                    <div class="card-body pt-0">
                                                        <div class=" setting-card">
                                                            <div class="logo-content mt-4  setting-logo">
                                                                
                                                                <a href="<?php echo e($logo . (isset($company_logo_light) && !empty($company_logo_light) ? $company_logo_light : 'logo-light.png')); ?>"
                                                                    target="_blank">
                                                                    <img id="image1" alt="your image"
                                                                        src="<?php echo e($logo . (isset($company_logo_light) && !empty($company_logo_light) ? $company_logo_light : 'logo-light.png')); ?>"
                                                                        width="150px"
                                                                        class="big-logo"style="filter: drop-shadow(2px 3px 7px #011c4b);">
                                                                </a>

                                                            </div>
                                                            <div class="choose-files mt-3">
                                                                <label for="company_logo_light">
                                                                    <div class=" bg-primary dark_logo_update"> <i
                                                                            class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                    </div>
                                                                    <input type="file" class="form-control file"
                                                                        name="company_logo_light" id="company_logo_light"
                                                                        data-filename="dark_logo_update">
                                                                </label>
                                                            </div>
                                                            <?php $__errorArgs = ['company_logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <div class="row">
                                                                    <span class="invalid-company_logo_light" role="alert">
                                                                        <strong
                                                                            class="text-danger"><?php echo e($message); ?></strong>
                                                                    </span>
                                                                </div>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6 col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><?php echo e(__('Favicon')); ?></h5>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class=" setting-card">
                                                            <div class="logo-content mt-4 setting-logo ">
                                                                
                                                                <a href="<?php echo e($logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"
                                                                    target="_blank">
                                                                    <img id="image2" alt="your image"
                                                                        src="<?php echo e($logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"
                                                                        width="50px"
                                                                        class="big-logo"style="filter: drop-shadow(2px 3px 7px #011c4b);">
                                                                </a>
                                                            </div>
                                                            <div class="choose-files mt-3">

                                                                <label for="company_favicon">
                                                                    <div class=" bg-primary company_favicon"> <i
                                                                            class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                                    </div>
                                                                    <input type="file" class="form-control file"
                                                                        name="company_favicon" id="company_favicon"
                                                                        data-filename="company_favicon">
                                                                </label>
                                                            </div>
                                                            <?php $__errorArgs = ['company_favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <div class="row">
                                                                    <span class="invalid-logo" role="alert">
                                                                        <strong
                                                                            class="text-danger"><?php echo e($message); ?></strong>
                                                                    </span>
                                                                </div>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">

                                                <?php echo e(Form::label('title_text', __('Title Text'), ['class' => 'col-form-label'])); ?>

                                                <?php echo e(Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Enter Title Text')])); ?>


                                                <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-title_text" role="alert">
                                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>


                                            <div class="form-group col-md-6">

                                                <label for="metakeyword" class="col-form-label"><?php echo e(__('Meta Keywords')); ?>

                                                </label>
                                                <textarea class="form-control" rows="4" cols="8"
                                                    value="<?php echo e(isset($settings['metakeyword']) ? $settings['metakeyword'] : ''); ?>" name="metakeyword"
                                                    id="metakeyword" style="resize: vertical; height: 42px;" placeholder="Enter Meta Keyword"><?php echo e(isset($settings['metakeyword']) ? $settings['metakeyword'] : ''); ?></textarea>

                                            </div>


                                            <div class="form-group col-md-6">

                                                <label for="metadesc"
                                                    class="col-form-label"><?php echo e(__('Meta Description')); ?></label>
                                                <textarea class="form-control" rows="4" cols="8"
                                                    value="<?php echo e(isset($settings['metadesc']) ? $settings['metadesc'] : ''); ?>" name="metadesc" id="metadesc"
                                                    style="resize: vertical; height: 42px;" placeholder="Enter Meta Description"><?php echo e(isset($settings['metadesc']) ? $settings['metadesc'] : ''); ?></textarea>

                                            </div>
                                            <div class="col-3 ">
                                                <div class="col switch-width">
                                                    <div class="form-group ml-2 mr-3">
                                                        <?php echo e(Form::label('SITE_RTL', __('Enable RTL'), ['class' => 'col-form-label'])); ?>

                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" data-toggle="switchbutton"
                                                                data-onstyle="primary" class="" name="SITE_RTL"
                                                                id="SITE_RTL"
                                                                <?php echo e($SITE_RTL == 'on' ? 'checked="checked"' : ''); ?>>
                                                            <label class="custom-control-label mb-1"
                                                                for="SITE_RTL"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 class="mt-3 mb-3"><?php echo e(__('Theme Customizer')); ?></h5>
                                            <div class="col-12">
                                                <div class="pct-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <h6 class="">
                                                                <i data-feather="credit-card"
                                                                    class="me-2"></i><?php echo e(__('Primary color Settings')); ?>

                                                            </h6>
                                                            <hr class="my-2" />
                                                            <div class="theme-color themes-color">
                                                                <a href="#!"
                                                                    class="themes-color-change <?php echo e($color == 'theme-1' ? 'active_color' : ''); ?>"
                                                                    data-value="theme-1"></a>
                                                                <input type="radio" class="theme_color d-none"
                                                                    name="theme_color" value="theme-1"
                                                                    <?php echo e($color == 'theme-1' ? 'checked' : ''); ?>>
                                                                <a href="#!"
                                                                    class="themes-color-change <?php echo e($color == 'theme-2' ? 'active_color' : ''); ?>"
                                                                    data-value="theme-2"></a>
                                                                <input type="radio" class="theme_color d-none"
                                                                    name="theme_color" value="theme-2"
                                                                    <?php echo e($color == 'theme-2' ? 'checked' : ''); ?>>
                                                                <a href="#!"
                                                                    class="themes-color-change <?php echo e($color == 'theme-3' ? 'active_color' : ''); ?>"
                                                                    data-value="theme-3"></a>
                                                                <input type="radio" class="theme_color d-none"
                                                                    name="theme_color" value="theme-3"
                                                                    <?php echo e($color == 'theme-3' ? 'checked' : ''); ?>>
                                                                <a href="#!"
                                                                    class="themes-color-change <?php echo e($color == 'theme-4' ? 'active_color' : ''); ?>"
                                                                    data-value="theme-4"></a>
                                                                <input type="radio" class="theme_color d-none"
                                                                    name="theme_color" value="theme-4"
                                                                    <?php echo e($color == 'theme-4' ? 'checked' : ''); ?>>
                                                            </div>

                                                        </div>
                                                        <div class="col-4">
                                                            <h6 class=" ">
                                                                <i data-feather="layout"
                                                                    class="me-2"></i><?php echo e(__('Sidebar Settings')); ?>

                                                            </h6>
                                                            <hr class="my-2 " />
                                                            <div class="form-check form-switch ">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="cust_theme_bg" name="cust_theme_bg"
                                                                    <?php if($settings['cust_theme_bg'] == 'on'): ?> checked <?php endif; ?> />

                                                                <label class="form-check-label f-w-600 pl-1"
                                                                    for="cust_theme_bg"><?php echo e(__('Transparent layout')); ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <h6 class=" ">
                                                                <i data-feather="sun"
                                                                    class=""></i><?php echo e(__('Layout Settings')); ?>

                                                            </h6>
                                                            
                                                            <hr class=" my-2  " />
                                                            <div class="form-check form-switch mt-2 ">
                                                                <input type="hidden" name="cust_darklayout"
                                                                    value="off">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="cust_darklayout" name="cust_darklayout"
                                                                    <?php if($settings['cust_darklayout'] == 'on'): ?> checked <?php endif; ?> />

                                                                <label class="form-check-label f-w-600 pl-1"
                                                                    for="cust_darklayout"><?php echo e(__('Dark Layout')); ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer ">
                                        <div class="col-sm-12 px-2">
                                            <div class="text-end">
                                                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>

                    <div class="" id="system-settings">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('System Settings')); ?></h5>
                            </div>
                            <?php echo e(Form::model($settings, ['route' => 'system.settings', 'method' => 'post'])); ?>

                            <div class="card-body">
                                <div class="row company-setting">
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('site_currency', __('Currency *'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('site_currency', null, ['class' => 'form-control '])); ?>

                                        <small class="text-xs">
                                            <?php echo e(__('Note: Add currency code as per three-letter ISO code')); ?>.
                                            <a href="https://stripe.com/docs/currencies"
                                                target="_blank"><?php echo e(__('You can find out how to do that here.')); ?></a>
                                        </small>
                                        <?php $__errorArgs = ['site_currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <br>
                                            <span class="text-xs text-danger invalid-site_currency"
                                                role="alert"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('site_currency_symbol', __('Currency Symbol *'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('site_currency_symbol', null, ['class' => 'form-control'])); ?>

                                        <?php $__errorArgs = ['site_currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-xs text-danger invalid-site_currency_symbol"
                                                role="alert"><?php echo e($message); ?></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label"><?php echo e(__('Currency Symbol Position')); ?></label>
                                        <div class="form-check form-check">
                                            <input class="form-check-input" type="radio" id="pre" value="pre"
                                                name="site_currency_symbol_position"
                                                <?php if($settings['site_currency_symbol_position'] == 'pre'): ?> checked <?php endif; ?>>
                                            <label class="form-check-label" for="pre">
                                                <?php echo e(__('Pre')); ?>

                                            </label>
                                        </div>
                                        <div class="form-check form-check">
                                            <input class="form-check-input" type="radio" id="post" value="post"
                                                name="site_currency_symbol_position"
                                                <?php if($settings['site_currency_symbol_position'] == 'post'): ?> checked <?php endif; ?>>
                                            <label class="form-check-label" for="post">
                                                <?php echo e(__('Post')); ?>

                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="site_date_format"
                                            class="col-form-label"><?php echo e(__('Date Format')); ?></label>
                                        <select type="text" name="site_date_format" class="form-control select2"
                                            id="site_date_format">
                                            <option value="M j, Y"
                                                <?php if(@$settings['site_date_format'] == 'M j, Y'): ?> selected="selected" <?php endif; ?>>
                                                Jan 1,2015</option>
                                            <option value="d-m-Y"
                                                <?php if(@$settings['site_date_format'] == 'd-m-Y'): ?> selected="selected" <?php endif; ?>>
                                                d-m-y</option>
                                            <option value="m-d-Y"
                                                <?php if(@$settings['site_date_format'] == 'm-d-Y'): ?> selected="selected" <?php endif; ?>>
                                                m-d-y</option>
                                            <option value="Y-m-d"
                                                <?php if(@$settings['site_date_format'] == 'Y-m-d'): ?> selected="selected" <?php endif; ?>>
                                                y-m-d</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="site_time_format"
                                            class="col-form-label"><?php echo e(__('Time Format')); ?></label>
                                        <select type="text" name="site_time_format" class="form-control select2"
                                            id="site_time_format">
                                            <option value="g:i A"
                                                <?php if(@$settings['site_time_format'] == 'g:i A'): ?> selected="selected" <?php endif; ?>>
                                                10:30 PM</option>
                                            <option value="g:i a"
                                                <?php if(@$settings['site_time_format'] == 'g:i a'): ?> selected="selected" <?php endif; ?>>
                                                10:30 pm</option>
                                            <option value="H:i"
                                                <?php if(@$settings['site_time_format'] == 'H:i'): ?> selected="selected" <?php endif; ?>>
                                                22:30</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        


                                        <?php echo e(Form::label('employee_prefix', __('Employee Prefix'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('employee_prefix', null, ['class' => 'form-control'])); ?>

                                        <?php $__errorArgs = ['employee_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-xs text-danger invalid-employee_prefix" role="alert">
                                                <small class="text-danger"><?php echo e($message); ?></small>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                    </div>

                                </div>
                            </div>

                            <div class="card-footer ">
                                <div class="col-sm-12 px-2">
                                    <div class="text-end">
                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                                    </div>
                                </div>
                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>

                    <div class="" id="company-settings">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Company Settings')); ?></h5>
                            </div>
                            <?php echo e(Form::model($settings, ['route' => 'company.settings', 'method' => 'post'])); ?>

                            <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_name *', __('Company Name *'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_name', null, ['class' => 'form-control ', 'placeholder' => 'Enter Company Name'])); ?>


                                        <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_name" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_address', __('Address'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_address', null, ['class' => 'form-control ', 'placeholder' => 'Enter Address'])); ?>

                                        <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_address" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_city', __('City'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_city', null, ['class' => 'form-control ', 'placeholder' => 'Enter City'])); ?>

                                        <?php $__errorArgs = ['company_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_city" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_state', __('State'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_state', null, ['class' => 'form-control ', 'placeholder' => 'Enter State'])); ?>

                                        <?php $__errorArgs = ['company_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_state" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_zipcode', __('Zip/Post Code'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_zipcode', null, ['class' => 'form-control', 'placeholder' => 'Enter Zip/Post Code'])); ?>

                                        <?php $__errorArgs = ['company_zipcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_zipcode" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_country', __('Country'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_country', null, ['class' => 'form-control', 'placeholder' => 'Enter Country'])); ?>

                                        <?php $__errorArgs = ['company_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_country" role="alert"><strong
                                                    class="text-danger"><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_telephone', __('Telephone'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_telephone', null, ['class' => 'form-control', 'placeholder' => 'Enter Telephone'])); ?>

                                        <?php $__errorArgs = ['company_telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_telephone" role="alert"><strong
                                                    class="text-danger"><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_email', __('System Email *'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_email', null, ['class' => 'form-control', 'placeholder' => 'Enter System Email'])); ?>

                                        <?php $__errorArgs = ['company_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_email" role="alert"><strong
                                                    class="text-danger"><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_email_from_name', __('Email (From Name) *'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_email_from_name', null, ['class' => 'form-control ', 'placeholder' => 'Enter Email'])); ?>

                                        <?php $__errorArgs = ['company_email_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_email_from_name" role="alert"><strong
                                                    class="text-danger"><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_phone_numbar', __('Phone *'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_phone_numbar', null, ['class' => 'form-control ', 'placeholder' => 'Enter Company Phone'])); ?>

                                        <?php $__errorArgs = ['company_phone_numbar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_phone_numbar" role="alert"><strong
                                                    class="text-danger"><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_gstin_numbar', __('GSTIN *'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_gstin_numbar', null, ['class' => 'form-control ',  'placeholder' => 'Enter Company GSTIN'])); ?>

                                        <?php $__errorArgs = ['company_gstin_numbar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_gstin_numbar" role="alert"><strong
                                                    class="text-danger"><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_esic_numbar', __('ESIC*'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_esic_numbar', null, ['class' => 'form-control ',  'placeholder' => 'Enter Company ESIC'])); ?>

                                        <?php $__errorArgs = ['company_esic_numbar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_esic_numbar" role="alert"><strong
                                                    class="text-danger"><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_pf_numbar', __('PF Number *'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_pf_numbar', null, ['class' => 'form-control ',  'placeholder' => 'Enter Company PF Number'])); ?>

                                        <?php $__errorArgs = ['company_pf_numbar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_pf_numbar" role="alert"><strong
                                                    class="text-danger"><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_tan_numbar', __('TAN *'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_tan_numbar', null, ['class' => 'form-control ',  'placeholder' => 'Enter Company TAN'])); ?>

                                        <?php $__errorArgs = ['company_tan_numbar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_tan_numbar" role="alert"><strong
                                                    class="text-danger"><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>


                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('company_pec_numbar', __('PEC *'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('company_pec_numbar', null, ['class' => 'form-control ',  'placeholder' => 'Enter Company PEC'])); ?>

                                        <?php $__errorArgs = ['company_pec_numbar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_pec_numbar" role="alert"><strong
                                                    class="text-danger"><?php echo e($message); ?></strong></span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>








                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('company_start_time', __('Company Start Time *'), ['class' => 'col-form-label'])); ?>


                                                <?php echo e(Form::time('company_start_time', null, ['class' => 'form-control timepicker_format'])); ?>

                                                <?php $__errorArgs = ['company_start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-company_start_time" role="alert">
                                                        <small class="text-danger"><?php echo e($message); ?></small>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php echo e(Form::label('company_end_time', __('Company End Time *'), ['class' => 'col-form-label'])); ?>

                                                <?php echo e(Form::time('company_end_time', null, ['class' => 'form-control timepicker_format'])); ?>

                                                <?php $__errorArgs = ['company_end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-company_end_time" role="alert">
                                                        <small class="text-danger"><?php echo e($message); ?></small>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('timezone', __('Timezone'), ['class' => 'col-form-label'])); ?>

                                        <select type="text" name="timezone" class="form-control select2"
                                            id="timezone">
                                            <option value=""><?php echo e(__('Select Timezone')); ?></option>
                                            <?php if(!empty($timezones)): ?>
                                                <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($k); ?>"
                                                        <?php echo e(env('TIMEZONE') == $k ? 'selected' : ''); ?>>
                                                        <?php echo e($timezone); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php $__errorArgs = ['timezone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-timezone" role="alert">
                                                <small class="text-danger"><?php echo e($message); ?></small>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class=" form-check-input" data-toggle="switchbutton"
                                                data-onstyle="primary" name="ip_restrict" id="ip_restrict"
                                                <?php echo e($settings['ip_restrict'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class=" col-form-label p-0"
                                                for="ip_restrict"><?php echo e(__('Ip Restrict')); ?></label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" id="addSig" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>

                    <div class="" id="email-notification-settings">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Email Notification Settings')); ?></h5>
                            </div>
                            <div class="card-body table-border-style ">
                                <div class="table-responsive">
                                    <table class="table" id="pc-dt-simple">
                                        <thead>
                                            <tr>
                                                <th class="w-75"> <?php echo e(__('Name')); ?></th>
                                                <th class="text-center"> <?php echo e(__('On/Off')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="">
                                                    <td><?php echo e($EmailTemplate->name); ?></td>
                                                    <td class="text-center">

                                                        <div class="form-group col-md-12">
                                                            <label class="form-check form-switch d-inline-block">
                                                                <input type="checkbox"
                                                                    class="email-template-checkbox form-check-input"
                                                                    name="<?php echo e($EmailTemplate->id); ?>"
                                                                    <?php if($EmailTemplate->template->is_active == 1): ?> checked="checked" <?php endif; ?>
                                                                value="<?php echo e($EmailTemplate->template->is_active == 1 ? '1' : '0'); ?>"
                                                                data-url="<?php echo e(route('company.email.setting', $EmailTemplate->id)); ?>">
                                                            <span class="slider1 round"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="" id="ip-restriction-settings">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">

                            <h5><?php echo e(__('IP Restriction Settings')); ?></h5>
                            <a  data-url="<?php echo e(route('create.ip')); ?>" class="btn btn-sm btn-primary"
                                data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Create New IP')); ?>"
                                data-bs-placement="top" data-size="md" data-ajax-popup="true"
                                data-title="<?php echo e(__('Create New IP')); ?>">
                                <i class="ti ti-plus"></i>
                            </a>

                        </div>
                        <div class="card-body table-border-style ">
                            <div class="table-responsive">
                                <table class="table" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th class="w-75"> <?php echo e(__('IP')); ?></th>
                                            <th width="200px"> <?php echo e('Action'); ?></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $__currentLoopData = $ips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="Action">
                                                <td class="sorting_1"><?php echo e($ip->ip); ?></td>
                                                <td class="">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Company Settings')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a  class="mx-3 btn btn-sm  align-items-center"
                                                                data-url="<?php echo e(route('edit.ip', $ip->id)); ?>" data-size="md"
                                                                data-ajax-popup="true" data-title="<?php echo e(__('Edit IP')); ?>"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-original-title="<?php echo e(__('Edit')); ?>"
                                                                data-bs-placement="top" class="edit-icon"
                                                                data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                                    class="ti ti-pencil text-white"></i></a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Company Settings')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['destroy.ip', $ip->id], 'id' => 'delete-form-' . $ip->id]); ?>

                                                            <a href="#!" data-bs-toggle="tooltip"
                                                                data-bs-original-title="<?php echo e(__('Delete')); ?>"
                                                                data-bs-placement="top"
                                                                class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="<?php echo e(__('Delete')); ?>">
                                                                <i class="ti ti-trash text-white"></i></a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
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


                <?php if(Auth::user()->type == 'company'): ?>
                    <div class="" id="zoom-meeting-settings">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Zoom Meeting Settings')); ?></h5>
                            </div>
                            <?php echo e(Form::open(['route' => 'zoom.settings', 'method' => 'post'])); ?>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <?php echo e(Form::label('zoom_apikey', __('Zoom API Key'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('zoom_apikey', isset($settings['zoom_apikey']) ? $settings['zoom_apikey'] : '', ['class' => 'form-control ', 'placeholder' => 'Zoom API Key'])); ?>

                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <?php echo e(Form::label('Zoom Secret Key', __('Zoom Secret Key'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('zoom_secret_key', !empty($settings['zoom_secret_key']) ? $settings['zoom_secret_key'] : '', ['class' => 'form-control', 'placeholder' => 'Zoom Secret Key'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                    <div class="" id="slack-settings">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Slack Settings')); ?></h5>
                                <small
                                    class="text-secondary font-weight-bold"><?php echo e(__('Slack Notification Settings')); ?></small>
                            </div>
                            <?php echo e(Form::open(['route' => 'slack.setting', 'id' => 'slack-setting', 'method' => 'post', 'class' => 'd-contents'])); ?>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <?php echo e(Form::label('Slack Webhook URL', __('Slack Webhook URL'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('slack_webhook', isset($settings['slack_webhook']) ? $settings['slack_webhook'] : '', ['class' => 'form-control w-100', 'placeholder' => __('Enter Slack Webhook URL'), 'required' => 'required'])); ?>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Monthly payslip create', __('New Monthly Payslip'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('monthly_payslip_notification', '1', isset($settings['monthly_payslip_notification']) && $settings['monthly_payslip_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'monthly_payslip_notification'])); ?>

                                                    <label class="col-form-label" for="lead_notificaation"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Award create', __('New Award'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('award_notificaation', '1', isset($settings['award_notificaation']) && $settings['award_notificaation'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'award_notificaation'])); ?>

                                                    <label class="col-form-label" for="award_notificaation"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Ticket create', __('New Ticket'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('ticket_notification', '1', isset($settings['ticket_notification']) && $settings['ticket_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'ticket_notification'])); ?>

                                                    <label class="col-form-label" for="ticket_notification"></label>
                                                </div>
                                            </li>


                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Announcement create', __('New Announcement'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">

                                                    <?php echo e(Form::checkbox('Announcement_notification', '1', isset($settings['Announcement_notification']) && $settings['Announcement_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'Announcement_notification'])); ?>

                                                    <label class="col-form-label" for="Announcement_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Holidays create', __('New Holidays'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('Holiday_notification', '1', isset($settings['Holiday_notification']) && $settings['Holiday_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'Holiday_notification'])); ?>

                                                    <label class="col-form-label" for="Holiday_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Event create', __('New Event'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('event_notification', '1', isset($settings['event_notification']) && $settings['event_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'event_notification'])); ?>

                                                    <label class="col-form-label" for="event_notification"></label>
                                                </div>
                                            </li>


                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Meeting create', __('New Meeting'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('meeting_notification', '1', isset($settings['meeting_notification']) && $settings['meeting_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'meeting_notification'])); ?>

                                                    <label class="col-form-label" for="meeting_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Company policy create', __('New Company Policy'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('company_policy_notification', '1', isset($settings['company_policy_notification']) && $settings['company_policy_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'company_policy_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="company_policy_notification"></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>



                    <div class="" id="telegram-settings">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Telegram Settings')); ?></h5>
                                <small
                                    class="text-secondary font-weight-bold"><?php echo e(__('Telegram Notification Settings')); ?></small>
                            </div>
                            <?php echo e(Form::open(['route' => 'telegram.setting', 'id' => 'telegram-setting', 'method' => 'post', 'class' => 'd-contents'])); ?>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('Telegram Access Token', __('Telegram Access Token'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('telegram_accestoken', isset($settings['telegram_accestoken']) ? $settings['telegram_accestoken'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Telegram AccessToken')])); ?>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('Telegram ChatID', __('Telegram ChatID'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('telegram_chatid', isset($settings['telegram_chatid']) ? $settings['telegram_chatid'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Telegram ChatID')])); ?>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                                        
                                    </div>


                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Monthly payslip create', __('New Monthly Payslip'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_monthly_payslip_notification', '1', isset($settings['telegram_monthly_payslip_notification']) && $settings['telegram_monthly_payslip_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_monthly_payslip_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_monthly_payslip_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Award create', __('New Award'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_award_notification', '1', isset($settings['telegram_award_notification']) && $settings['telegram_award_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_award_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_award_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Ticket create', __('New Ticket '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_ticket_notification', '1', isset($settings['telegram_ticket_notification']) && $settings['telegram_ticket_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_ticket_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_ticket_notification"></label>
                                                </div>
                                            </li>


                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Announcement create', __('New Announcement'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_Announcement_notification', '1', isset($settings['telegram_Announcement_notification']) && $settings['telegram_Announcement_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_Announcement_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_Announcement_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Holidays create', __('New Holidays '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_Holiday_notification', '1', isset($settings['telegram_Holiday_notification']) && $settings['telegram_Holiday_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_Holiday_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_Holiday_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Event create', __('New Event'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_event_notification', '1', isset($settings['telegram_event_notification']) && $settings['telegram_event_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_event_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_event_notification"></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Meeting create', __('New Meeting'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_meeting_notification', '1', isset($settings['telegram_meeting_notification']) && $settings['telegram_meeting_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_meeting_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_meeting_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Company policy create', __('New Company Policy '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('telegram_company_policy_notification', '1', isset($settings['telegram_company_policy_notification']) && $settings['telegram_company_policy_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'telegram_company_policy_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="telegram_company_policy_notification"></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>

                    <div class="" id="twilio-settings">
                        <div class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Twilio Settings')); ?></h5>
                                <small
                                    class="text-secondary font-weight-bold"><?php echo e(__('Twilio Notification Settings')); ?></small>
                            </div>
                            <?php echo e(Form::open(['route' => 'twilio.setting', 'id' => 'twilio-setting', 'method' => 'post', 'class' => 'd-contents'])); ?>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('Twilio SID', __('Twilio SID'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('twilio_sid', isset($settings['twilio_sid']) ? $settings['twilio_sid'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Twilio Sid')])); ?>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('Twilio Token', __('Twilio Token'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('twilio_token', isset($settings['twilio_token']) ? $settings['twilio_token'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Twilio Token')])); ?>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <?php echo e(Form::label('Twilio From', __('Twilio From'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('twilio_from', isset($settings['twilio_from']) ? $settings['twilio_from'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Twilio From')])); ?>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group mb-3">
                                        
                                    </div>


                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Payslip create', __('New Monthly Payslip'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_payslip_notification', '1', isset($settings['twilio_payslip_notification']) && $settings['twilio_payslip_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_payslip_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="twilio_payslip_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Leave Approve/Reject', __('Leave Approve/Reject'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_leave_approve_notification', '1', isset($settings['twilio_leave_approve_notification']) && $settings['twilio_leave_approve_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_leave_approve_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="twilio_leave_approve_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Ticket create', __('New Ticket '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_ticket_notification', '1', isset($settings['twilio_ticket_notification']) && $settings['twilio_ticket_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_ticket_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="twilio_ticket_notification"></label>
                                                </div>
                                            </li>


                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Award create', __('New Award'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_award_notification', '1', isset($settings['twilio_award_notification']) && $settings['twilio_award_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_award_notification'])); ?>

                                                    <label class="col-form-label" for="twilio_award_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Trip create', __('New Trip '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_trip_notification', '1', isset($settings['twilio_trip_notification']) && $settings['twilio_trip_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_trip_notification'])); ?>

                                                    <label class="col-form-label" for="twilio_trip_notification"></label>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Event create', __('New Event'), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_event_notification', '1', isset($settings['twilio_event_notification']) && $settings['twilio_event_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_event_notification'])); ?>

                                                    <label class="col-form-label" for="twilio_event_notification"></label>
                                                </div>
                                            </li>

                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <?php echo e(Form::label('Announcement create', __('New Announcement '), ['class' => 'col-form-label'])); ?>

                                                <div class="form-check form-switch d-inline-block float-right">
                                                    <?php echo e(Form::checkbox('twilio_announcement_notification', '1', isset($settings['twilio_announcement_notification']) && $settings['twilio_announcement_notification'] == '1' ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'twilio_announcement_notification'])); ?>

                                                    <label class="col-form-label"
                                                        for="twilio_announcement_notification"></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div> <?php endif; ?>
                                                                    <div class="" id="offer-letter-settings">
                                                                <div class="card">
                                                                    <div
                                                                        class="card-header d-flex justify-content-between">
                                                                        <h5><?php echo e(__('Offer Letter Settings')); ?></h5>
                                                                        <div
                                                                            class="d-flex justify-content-end drp-languages">
                                                                            <ul class="list-unstyled mb-0 m-2">
                                                                                <li class="dropdown dash-h-item drp-language"
                                                                                    style="margin-top: -19px;">
                                                                                    <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                                                        data-bs-toggle="dropdown"
                                                                                        href="#" role="button"
                                                                                        aria-haspopup="false"
                                                                                        aria-expanded="false"
                                                                                        id="dropdownLanguage">
                                                                                        <span
                                                                                            class="drp-text hide-mob text-primary">
                                                                                            <?php echo e(Str::upper($offerlang)); ?>

                                                                                        </span>
                                                                                        <i
                                                                                            class="ti ti-chevron-down drp-arrow nocolor"></i>
                                                                                    </a>
                                                                                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                                                        aria-labelledby="dropdownLanguage">
                                                                                        <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offerlangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <a href="<?php echo e(route('get.offerlatter.language', ['noclangs' => $noclang, 'explangs' => $explang, 'offerlangs' => $offerlangs, 'joininglangs' => $joininglang])); ?>"
                                                                                                class="dropdown-item ms-1 <?php echo e($offerlangs == $offerlang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($offerlangs)); ?></a>

                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>

                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body ">
                                                                        <h5 class="font-weight-bold pb-3">
                                                                            <?php echo e(__('Placeholders')); ?></h5>

                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                            <div class="card">
                                                                                <div class="card-header card-body">
                                                                                    <div class="row text-xs">
                                                                                        <div class="row">
                                                                                            <p class="col-4">
                                                                                                <?php echo e(__('Applicant Name')); ?>

                                                                                                : <span
                                                                                                    class="pull-end text-primary">{applicant_name}</span>
                                                                                            </p>
                                                                                            <p class="col-4">
                                                                                                <?php echo e(__('Company Name')); ?> :
                                                                                                <span
                                                                                                    class="pull-right text-primary">{app_name}</span>
                                                                                            </p>
                                                                                            <p class="col-4">
                                                                                                <?php echo e(__('Job title')); ?> :
                                                                                                <span
                                                                                                    class="pull-right text-primary">{job_title}</span>
                                                                                            </p>
                                                                                            <p class="col-4">
                                                                                                <?php echo e(__('Job type')); ?> :
                                                                                                <span
                                                                                                    class="pull-right text-primary">{job_type}</span>
                                                                                            </p>
                                                                                            <p class="col-4">
                                                                                                <?php echo e(__('Proposed Start Date')); ?>

                                                                                                : <span
                                                                                                    class="pull-right text-primary">{start_date}</span>
                                                                                            </p>
                                                                                            <p class="col-4">
                                                                                                <?php echo e(__('Working Location')); ?>

                                                                                                : <span
                                                                                                    class="pull-right text-primary">{workplace_location}</span>
                                                                                            </p>
                                                                                            <p class="col-4">
                                                                                                <?php echo e(__('Days Of Week')); ?> :
                                                                                                <span
                                                                                                    class="pull-right text-primary">{days_of_week}</span>
                                                                                            </p>
                                                                                            <p class="col-4">
                                                                                                <?php echo e(__('Salary')); ?> :
                                                                                                <span
                                                                                                    class="pull-right text-primary">{salary}</span>
                                                                                            </p>
                                                                                            <p class="col-4">
                                                                                                <?php echo e(__('Salary Type')); ?> :
                                                                                                <span
                                                                                                    class="pull-right text-primary">{salary_type}</span>
                                                                                            </p>
                                                                                            <p class="col-4">
                                                                                                <?php echo e(__('Salary Duration')); ?>

                                                                                                : <span
                                                                                                    class="pull-end text-primary">{salary_duration}</span>
                                                                                            </p>
                                                                                            <p class="col-4">
                                                                                                <?php echo e(__('Offer Expiration Date')); ?>

                                                                                                : <span
                                                                                                    class="pull-right text-primary">{offer_expiration_date}</span>
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body table-border-style ">

                                                                        <?php echo e(Form::open(['route' => ['offerlatter.update', $offerlang], 'method' => 'post'])); ?>

                                                                        <div class="form-group col-12">
                                                                            <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                                                            <textarea name="content" class="pc-tinymce-2"><?php echo isset($currOfferletterLang->content) ? $currOfferletterLang->content : ''; ?></textarea>
                                                                        </div>
                                                                        <div class="card-footer text-end">

                                                                            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary'])); ?>

                                                                        </div>

                                                                        <?php echo e(Form::close()); ?>

                                                                    </div>
                                                                </div>
                                                        </div>

                                                        <div class="" id="joining-letter-settings">
                                                            <div class="card">
                                                                <div class="card-header d-flex justify-content-between">
                                                                    <h5><?php echo e(__('Joining Letter Settings')); ?></h5>
                                                                    <div class="d-flex justify-content-end drp-languages">
                                                                        <ul class="list-unstyled mb-0 m-2">
                                                                            <li class="dropdown dash-h-item drp-language"
                                                                                style="margin-top: -19px;">
                                                                                <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                                                    data-bs-toggle="dropdown"
                                                                                    href="#" role="button"
                                                                                    aria-haspopup="false"
                                                                                    aria-expanded="false"
                                                                                    id="dropdownLanguage1">
                                                                                    <span
                                                                                        class="drp-text hide-mob text-primary">

                                                                                        <?php echo e(Str::upper($joininglang)); ?>

                                                                                    </span>
                                                                                    <i
                                                                                        class="ti ti-chevron-down drp-arrow nocolor"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                                                    aria-labelledby="dropdownLanguage1">
                                                                                    <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $joininglangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <a href="<?php echo e(route('get.joiningletter.language', ['noclangs' => $noclang, 'explangs' => $explang, 'offerlangs' => $offerlang, 'joininglangs' => $joininglangs])); ?>"
                                                                                            class="dropdown-item <?php echo e($joininglangs == $joininglang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($joininglangs)); ?></a>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </div>
                                                                            </li>

                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                                <div class="card-body ">
                                                                    <h5 class="font-weight-bold pb-3">
                                                                        <?php echo e(__('Placeholders')); ?></h5>

                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="card">
                                                                            <div class="card-header card-body">
                                                                                <div class="row text-xs">
                                                                                    <div class="row">
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Applicant Name')); ?> :
                                                                                            <span
                                                                                                class="pull-end text-primary">{date}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Company Name')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{app_name}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Employee Name')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{employee_name}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Address')); ?> : <span
                                                                                                class="pull-right text-primary">{address}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Designation')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{designation}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Start Date')); ?> : <span
                                                                                                class="pull-right text-primary">{start_date}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Branch')); ?> : <span
                                                                                                class="pull-right text-primary">{branch}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Start Time')); ?> : <span
                                                                                                class="pull-end text-primary">{start_time}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('End Time')); ?> : <span
                                                                                                class="pull-right text-primary">{end_time}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Number of Hours')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{total_hours}</span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body table-border-style ">

                                                                    <?php echo e(Form::open(['route' => ['joiningletter.update', $joininglang], 'method' => 'post'])); ?>

                                                                    <div class="form-group col-12">
                                                                        <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                                                        <textarea name="content" class="pc-tinymce-3"><?php echo isset($currjoiningletterLang->content) ? $currjoiningletterLang->content : ''; ?></textarea>



                                                                    </div>

                                                                    <div class="card-footer text-end">

                                                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary'])); ?>

                                                                    </div>

                                                                    <?php echo e(Form::close()); ?>

                                                                </div>



                                                            </div>
                                                        </div>
                                                        

                                                        <div class="" id="increment-letter-settings">
                                                            <div class="card">
                                                                <div
                                                                    class="card-header d-flex justify-content-between">
                                                                    <h5><?php echo e(__('Increment Letter Settings')); ?></h5>
                                                                    <div
                                                                        class="d-flex justify-content-end drp-languages">
                                                                        <ul class="list-unstyled mb-0 m-2">
                                                                            <li class="dropdown dash-h-item drp-language"
                                                                                style="margin-top: -19px;">
                                                                                <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                                                    data-bs-toggle="dropdown"
                                                                                    href="#" role="button"
                                                                                    aria-haspopup="false"
                                                                                    aria-expanded="false"
                                                                                    id="dropdownLanguage">
                                                                                    <span
                                                                                        class="drp-text hide-mob text-primary">
                                                                                        <?php echo e(Str::upper($offerlang)); ?>

                                                                                    </span>
                                                                                    <i
                                                                                        class="ti ti-chevron-down drp-arrow nocolor"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                                                    aria-labelledby="dropdownLanguage">
                                                                                    <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offerlangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <a href="<?php echo e(route('get.offerlatter.language', ['noclangs' => $noclang, 'explangs' => $explang, 'offerlangs' => $offerlangs, 'joininglangs' => $joininglang])); ?>"
                                                                                            class="dropdown-item ms-1 <?php echo e($offerlangs == $offerlang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($offerlangs)); ?></a>

                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </div>
                                                                            </li>
                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                                <div class="card-body ">
                                                                    <h5 class="font-weight-bold pb-3">
                                                                        <?php echo e(__('Placeholders')); ?></h5>

                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="card">
                                                                            <div class="card-header card-body">
                                                                                <div class="row text-xs">
                                                                                    <div class="row">
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Applicant Name')); ?>

                                                                                            : <span
                                                                                                class="pull-end text-primary">{applicant_name}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Company Name')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{app_name}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Job title')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{job_title}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Job type')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{job_type}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Proposed Start Date')); ?>

                                                                                            : <span
                                                                                                class="pull-right text-primary">{start_date}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Working Location')); ?>

                                                                                            : <span
                                                                                                class="pull-right text-primary">{workplace_location}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Days Of Week')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{days_of_week}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Salary')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{salary}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Salary Type')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{salary_type}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Salary Duration')); ?>

                                                                                            : <span
                                                                                                class="pull-end text-primary">{salary_duration}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Offer Expiration Date')); ?>

                                                                                            : <span
                                                                                                class="pull-right text-primary">{offer_expiration_date}</span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body table-border-style ">

                                                                    <?php echo e(Form::open(['route' => ['incrementlatter.update', $offerlang], 'method' => 'post'])); ?>

                                                                    <div class="form-group col-12">
                                                                        <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                                                        <textarea name="content" class="pc-tinymce-2"><?php echo isset($IncrementLetterLang->content) ? $IncrementLetterLang->content : ''; ?></textarea>
                                                                    </div>
                                                                    <div class="card-footer text-end">

                                                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary'])); ?>

                                                                    </div>

                                                                    <?php echo e(Form::close()); ?>

                                                                </div>
                                                            </div>
                                                    </div>

                                                    
                                                    <div class="" id="Relieving-letter-settings">
                                                        <div class="card">
                                                            <div
                                                                class="card-header d-flex justify-content-between">
                                                                <h5><?php echo e(__('Relieving letter Settings')); ?></h5>
                                                                <div
                                                                    class="d-flex justify-content-end drp-languages">
                                                                    <ul class="list-unstyled mb-0 m-2">
                                                                        <li class="dropdown dash-h-item drp-language"
                                                                            style="margin-top: -19px;">
                                                                            <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                                                data-bs-toggle="dropdown"
                                                                                href="#" role="button"
                                                                                aria-haspopup="false"
                                                                                aria-expanded="false"
                                                                                id="dropdownLanguage">
                                                                                <span
                                                                                    class="drp-text hide-mob text-primary">
                                                                                    <?php echo e(Str::upper($offerlang)); ?>

                                                                                </span>
                                                                                <i
                                                                                    class="ti ti-chevron-down drp-arrow nocolor"></i>
                                                                            </a>
                                                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                                                aria-labelledby="dropdownLanguage">
                                                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offerlangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <a href="<?php echo e(route('get.offerlatter.language', ['noclangs' => $noclang, 'explangs' => $explang, 'offerlangs' => $offerlangs, 'joininglangs' => $joininglang])); ?>"
                                                                                        class="dropdown-item ms-1 <?php echo e($offerlangs == $offerlang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($offerlangs)); ?></a>

                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </div>
                                                                        </li>
                                                                    </ul>

                                                                </div>
                                                            </div>
                                                            <div class="card-body ">
                                                                <h5 class="font-weight-bold pb-3">
                                                                    <?php echo e(__('Placeholders')); ?></h5>

                                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                                    <div class="card">
                                                                        <div class="card-header card-body">
                                                                            <div class="row text-xs">
                                                                                <div class="row">
                                                                                    <p class="col-4">
                                                                                        <?php echo e(__('Applicant Name')); ?>

                                                                                        : <span
                                                                                            class="pull-end text-primary">{applicant_name}</span>
                                                                                    </p>
                                                                                    <p class="col-4">
                                                                                        <?php echo e(__('Company Name')); ?> :
                                                                                        <span
                                                                                            class="pull-right text-primary">{app_name}</span>
                                                                                    </p>
                                                                                    <p class="col-4">
                                                                                        <?php echo e(__('Job title')); ?> :
                                                                                        <span
                                                                                            class="pull-right text-primary">{job_title}</span>
                                                                                    </p>
                                                                                    <p class="col-4">
                                                                                        <?php echo e(__('Job type')); ?> :
                                                                                        <span
                                                                                            class="pull-right text-primary">{job_type}</span>
                                                                                    </p>
                                                                                    <p class="col-4">
                                                                                        <?php echo e(__('Proposed Start Date')); ?>

                                                                                        : <span
                                                                                            class="pull-right text-primary">{start_date}</span>
                                                                                    </p>
                                                                                    <p class="col-4">
                                                                                        <?php echo e(__('Working Location')); ?>

                                                                                        : <span
                                                                                            class="pull-right text-primary">{workplace_location}</span>
                                                                                    </p>
                                                                                    <p class="col-4">
                                                                                        <?php echo e(__('Days Of Week')); ?> :
                                                                                        <span
                                                                                            class="pull-right text-primary">{days_of_week}</span>
                                                                                    </p>
                                                                                    <p class="col-4">
                                                                                        <?php echo e(__('Salary')); ?> :
                                                                                        <span
                                                                                            class="pull-right text-primary">{salary}</span>
                                                                                    </p>
                                                                                    <p class="col-4">
                                                                                        <?php echo e(__('Salary Type')); ?> :
                                                                                        <span
                                                                                            class="pull-right text-primary">{salary_type}</span>
                                                                                    </p>
                                                                                    <p class="col-4">
                                                                                        <?php echo e(__('Salary Duration')); ?>

                                                                                        : <span
                                                                                            class="pull-end text-primary">{salary_duration}</span>
                                                                                    </p>
                                                                                    <p class="col-4">
                                                                                        <?php echo e(__('Offer Expiration Date')); ?>

                                                                                        : <span
                                                                                            class="pull-right text-primary">{offer_expiration_date}</span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body table-border-style ">

                                                                <?php echo e(Form::open(['route' => ['relievingtlatter.update', $offerlang], 'method' => 'post'])); ?>

                                                                <div class="form-group col-12">
                                                                    <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                                                    <textarea name="content" class="pc-tinymce-2"><?php echo isset($RelievingLetterLang->content) ? $RelievingLetterLang->content : ''; ?></textarea>
                                                                </div>
                                                                <div class="card-footer text-end">

                                                                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary'])); ?>

                                                                </div>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                </div>


                                                        <div class="" id="experience-certificate-settings">
                                                            <div class="card">
                                                                <div class="card-header d-flex justify-content-between">
                                                                    <h5><?php echo e(__('Certificate of Experience Settings')); ?>

                                                                    </h5>
                                                                    <div class="d-flex justify-content-end drp-languages">
                                                                        <ul class="list-unstyled mb-0 m-2">
                                                                            <li class="dropdown dash-h-item drp-language"
                                                                                style="margin-top: -19px;">
                                                                                <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                                                    data-bs-toggle="dropdown"
                                                                                    href="#" role="button"
                                                                                    aria-haspopup="false"
                                                                                    aria-expanded="false"
                                                                                    id="dropdownLanguage1">
                                                                                    <span
                                                                                        class="drp-text hide-mob text-primary">

                                                                                        <?php echo e(Str::upper($explang)); ?>

                                                                                    </span>
                                                                                    <i
                                                                                        class="ti ti-chevron-down drp-arrow nocolor"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                                                    aria-labelledby="dropdownLanguage1">
                                                                                    <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $explangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <a href="<?php echo e(route('get.experiencecertificate.language', ['noclangs' => $noclang, 'explangs' => $explangs, 'offerlangs' => $offerlang, 'joininglangs' => $joininglang])); ?>"
                                                                                            class="dropdown-item <?php echo e($explangs == $explang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($explangs)); ?></a>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </div>
                                                                            </li>

                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                                <div class="card-body ">
                                                                    <h5 class="font-weight-bold pb-3">
                                                                        <?php echo e(__('Placeholders')); ?></h5>

                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="card">
                                                                            <div class="card-header card-body">
                                                                                <div class="row text-xs">
                                                                                    <div class="row">
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Company Name')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{app_name}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Employee Name')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{employee_name}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Date of Issuance')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{date}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Designation')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{designation}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Start Date')); ?> : <span
                                                                                                class="pull-right text-primary">{start_date}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Branch')); ?> : <span
                                                                                                class="pull-right text-primary">{branch}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Start Time')); ?> : <span
                                                                                                class="pull-end text-primary">{start_time}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('End Time')); ?> : <span
                                                                                                class="pull-right text-primary">{end_time}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Number of Hours')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{total_hours}</span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body table-border-style ">

                                                                    <?php echo e(Form::open(['route' => ['experiencecertificate.update', $explang], 'method' => 'post'])); ?>

                                                                    <div class="form-group col-12">
                                                                        <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                                                        <textarea name="content" class="pc-tinymce-4"><?php echo isset($curr_exp_cetificate_Lang->content) ? $curr_exp_cetificate_Lang->content : ''; ?></textarea>



                                                                    </div>

                                                                    <div class="card-footer text-end">

                                                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary'])); ?>

                                                                    </div>

                                                                    <?php echo e(Form::close()); ?>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="" id="noc-settings">
                                                            <div class="card">
                                                                <div class="card-header d-flex justify-content-between">
                                                                    <h5><?php echo e(__('No Objection Certificate Settings')); ?></h5>
                                                                    <div class="d-flex justify-content-end drp-languages">
                                                                        <ul class="list-unstyled mb-0 m-2">
                                                                            <li class="dropdown dash-h-item drp-language"
                                                                                style="margin-top: -19px;">
                                                                                <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                                                    data-bs-toggle="dropdown"
                                                                                    href="#" role="button"
                                                                                    aria-haspopup="false"
                                                                                    aria-expanded="false"
                                                                                    id="dropdownLanguage1">
                                                                                    <span
                                                                                        class="drp-text hide-mob text-primary">

                                                                                        <?php echo e(Str::upper($noclang)); ?>

                                                                                    </span>
                                                                                    <i
                                                                                        class="ti ti-chevron-down drp-arrow nocolor"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                                                    aria-labelledby="dropdownLanguage1">
                                                                                    <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noclangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <a href="<?php echo e(route('get.noc.language', ['noclangs' => $noclangs, 'explangs' => $explang, 'offerlangs' => $offerlang, 'joininglangs' => $joininglang])); ?>"
                                                                                            class="dropdown-item <?php echo e($noclangs == $noclang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($noclangs)); ?></a>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </div>
                                                                            </li>

                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                                <div class="card-body ">
                                                                    <h5 class="font-weight-bold pb-3">
                                                                        <?php echo e(__('Placeholders')); ?></h5>

                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="card">
                                                                            <div class="card-header card-body">
                                                                                <div class="row text-xs">
                                                                                    <div class="row">
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Date')); ?> : <span
                                                                                                class="pull-end text-primary">{date}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Company Name')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{app_name}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Employee Name')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{employee_name}</span>
                                                                                        </p>
                                                                                        <p class="col-4">
                                                                                            <?php echo e(__('Designation')); ?> :
                                                                                            <span
                                                                                                class="pull-right text-primary">{designation}</span>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body table-border-style">
                                                                    <?php echo e(Form::open(['route' => ['noc.update', $noclang], 'method' => 'post'])); ?>

                                                                    <div class="form-group col-12">
                                                                        <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                                                        <textarea name="content" class="pc-tinymce-5"><?php echo isset($currnocLang->content) ? $currnocLang->content : ''; ?></textarea>

                                                                    </div>

                                                                    <div class="card-footer text-end">

                                                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary'])); ?>

                                                                    </div>

                                                                    <?php echo e(Form::close()); ?>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                        <div class="card" id="google-calender">
                                                            <div class="col-md-12">
                                                                <?php echo e(Form::open(['url' => route('google.calender.settings'), 'enctype' => 'multipart/form-data'])); ?>

                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                                                            <h5 class="">
                                                                                <?php echo e(__('Google Calendar')); ?>

                                                                            </h5>
                                                                        </div>

                                                                        <div class="col-lg-4 col-md-4 col-sm-4 text-end">
                                                                            <div class="col switch-width">
                                                                                <div class="custom-control custom-switch">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        name="is_enabled"
                                                                                        data-toggle="switchbutton"
                                                                                        data-onstyle="primary"
                                                                                        id="is_enabled"
                                                                                        <?php echo e(isset($settings['is_enabled']) && $settings['is_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                                    <label
                                                                                        class="custom-control-label form-label"
                                                                                        for="is_enabled"></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div
                                                                            class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                                            <?php echo e(Form::label('Google calendar id', __('Google Calendar Id'), ['class' => 'col-form-label'])); ?>

                                                                            <?php echo e(Form::text('google_clender_id', !empty($settings['google_clender_id']) ? $settings['google_clender_id'] : '', ['class' => 'form-control ', 'placeholder' => 'Google Calendar Id'])); ?>

                                                                        </div>
                                                                        <div
                                                                            class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                                            <?php echo e(Form::label('Google calendar json file', __('Google Calendar JSON File'), ['class' => 'col-form-label'])); ?>

                                                                            <input type="file" class="form-control"
                                                                                name="google_calender_json_file"
                                                                                id="file">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer text-end">
                                                                    <button class="btn-submit btn btn-primary"
                                                                        type="submit">
                                                                        <?php echo e(__('Save Changes')); ?>

                                                                    </button>
                                                                </div>
                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\wamp64\www\hrms_9\resources\views/setting/company_settings.blade.php ENDPATH**/ ?>