@extends('layouts.admin')
@section('page-title')
    {{ __('Settings') }}
@endsection

@section('action-button')
@endsection

@push('script-page')
    <script>
        $(document).ready(function() {
            if ($('.gdpr_fulltime').is(':checked')) {

                $('.fulltime').show();
            } else {

                $('.fulltime').hide();
            }

            $('#gdpr_cookie').on('change', function() {
                if ($('.gdpr_fulltime').is(':checked')) {

                    $('.fulltime').show();
                } else {

                    $('.fulltime').hide();
                }
            });
        });

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
        document.getElementById('logo').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }
    </script>
    <script>
        document.getElementById('logo_light').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image1').src = src
        }
    </script>
    <script>
        document.getElementById('favicon_update').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image2').src = src
        }
    </script>
    <script>
        $(document).on("click", '.send_email', function(e) {
            e.preventDefault();
            var title = $(this).attr('data-title');

            var size = 'md';
            var url = $(this).attr('data-url');
            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $("#commonModal").modal('show');
                $.post(url, {
                    _token: '{{ csrf_token() }}',
                    mail_driver: $("#mail_driver").val(),
                    mail_host: $("#mail_host").val(),
                    mail_port: $("#mail_port").val(),
                    mail_username: $("#mail_username").val(),
                    mail_password: $("#mail_password").val(),
                    mail_encryption: $("#mail_encryption").val(),
                    mail_from_address: $("#mail_from_address").val(),
                    mail_from_name: $("#mail_from_name").val(),
                }, function(data) {
                    $('#commonModal .body').html(data);
                });
            }
        });


        $(document).on('submit', '#test_email', function(e) {
            e.preventDefault();
            $("#email_sending").show();
            var post = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: post,
                cache: false,
                beforeSend: function() {
                    $('#test_email .btn-create').attr('disabled', 'disabled');
                },
                success: function(data) {
                    if (data.is_success) {
                        show_toastr('Success', data.message, 'success');
                    } else {
                        show_toastr('Error', data.message, 'error');
                    }
                    $("#email_sending").hide();
                    $('#commonModal').modal('hide');
                },
                complete: function() {
                    $('#test_email .btn-create').removeAttr('disabled');
                },
            });
        });
    </script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        $(".list-group-item").click(function() {
            $('.list-group-item').filter(function() {
                return this.href == id;
            }).parent().removeClass('text-primary');
        });

        function check_theme(color_val) {
            $('#theme_color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }

        $(document).on('change', '[name=storage_setting]', function() {
            if ($(this).val() == 's3') {
                $('.s3-setting').removeClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').addClass('d-none');
            } else if ($(this).val() == 'wasabi') {
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').removeClass('d-none');
                $('.local-setting').addClass('d-none');
            } else {
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').removeClass('d-none');
            }
        });
    </script>
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Settings') }}</li>
@endsection



@php
    // $logo = asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $lang = \App\Models\Utility::getValByName('default_language');
    $color = isset($settings['theme_color']) ? $settings['theme_color'] : 'theme-4';
    // $is_sidebar_transperent = isset($settings['is_sidebar_transperent']) ? $settings['is_sidebar_transperent'] : '';
    // $dark_mode = isset($settings['dark_mode']) ? $settings['dark_mode'] : '';
    $setting = \App\Models\Utility::settings();
    
    $SITE_RTL = $settings['SITE_RTL'];
    if ($SITE_RTL == '') {
        $SITE_RTL == 'off';
    }
    $file_type = config('files_types');
    $setting = \App\Models\Utility::settings();
    
    $local_storage_validation = $setting['local_storage_validation'];
    $local_storage_validations = explode(',', $local_storage_validation);
    
    $s3_storage_validation = $setting['s3_storage_validation'];
    $s3_storage_validations = explode(',', $s3_storage_validation);
    
    $wasabi_storage_validation = $setting['wasabi_storage_validation'];
    $wasabi_storage_validations = explode(',', $wasabi_storage_validation);
@endphp
@if ($color == 'theme-1')
    <style>
        .btn-check:checked+.btn-outline-success,
        .btn-check:active+.btn-outline-success,
        .btn-outline-success:active,
        .btn-outline-success.active,
        .btn-outline-success.dropdown-toggle.show {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
            border-color: #51459d !important;
        }


        .btn-outline-success:hover {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
            border-color: #41377e !important;
        }

        .btn.btn-outline-success {
            color: #41377e;
            border-color: #41377e !important;
        }
    </style>
@endif
@if ($color == 'theme-2')
    <style>
        .btn-check:checked+.btn-outline-success,
        .btn-check:active+.btn-outline-success,
        .btn-outline-success:active,
        .btn-outline-success.active,
        .btn-outline-success.dropdown-toggle.show {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #4ebbd3 99.86%)#1f3996 !important;
            border-color: #1f3996 !important;
        }


        .btn-outline-success:hover {
            color: #ffffff;
            background: linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #4ebbd3 99.86%)#1f3996 !important;
            border-color: #1f3996 !important;
        }

        .btn.btn-outline-success {
            color: #1f3996;
            border-color: #1f3996 !important;
        }
    </style>
@endif
@if ($color == 'theme-4')
    <style>
        .btn-check:checked+.btn-outline-success,
        .btn-check:active+.btn-outline-success,
        .btn-outline-success:active,
        .btn-outline-success.active,
        .btn-outline-success.dropdown-toggle.show {
            color: #ffffff;
            background-color: #584ed2 !important;
            border-color: #584ed2 !important;
        }


        .btn-outline-success:hover {
            color: #ffffff;
            background-color: #584ed2 !important;
            border-color: #584ed2 !important;
        }

        .btn.btn-outline-success {
            color: #584ed2;
            border-color: #584ed2 !important;
        }
    </style>
@endif


@section('content')
    <div class="row">

        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top">
                        <div class="list-group list-group-flush" id="useradd-sidenav">

                            <a href="#brand-settings" id="site-setting-tab"
                                class="list-group-item list-group-item-action border-0">{{ __('Brand Settings') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#email-settings" id="email-setting-tab"
                                class="list-group-item list-group-item-action border-0">{{ __('Email Settings') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#payment-settings" id="payment-setting-tab"
                                class="list-group-item list-group-item-action border-0">{{ __('Payment Settings') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#pusher-settings" id="pusher-setting-tab"
                                class="list-group-item list-group-item-action border-0">{{ __('Pusher Settings') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#recaptcha-print-settings" id="recaptcha-print-tab"
                                class="list-group-item list-group-item-action border-0">{{ __('ReCaptcha Settings') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>

                            <a href="#storage-settings" id="storage-print-tab"
                                class="list-group-item list-group-item-action border-0">{{ __('Storage Settings') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="" id="brand-settings">
                        {{ Form::model($settings, ['route' => 'settings.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>{{ __('Brand Settings') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-6 col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>{{ __('Logo dark') }}</h5>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class=" setting-card">
                                                            <div class="logo-content mt-4 setting-logo">
                                                                <a href="{{ $logo . 'logo-dark.png' }}" target="_blank">
                                                                    <img id="image" alt="your image"
                                                                        src="{{ $logo . 'logo-dark.png' }}" width="150px"
                                                                        class="big-logo">
                                                                </a>

                                                            </div>
                                                            <div class="choose-files mt-5">
                                                                <label for="logo">
                                                                    <div class=" bg-primary logo_update"> <i
                                                                            class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                                    </div>
                                                                    <input type="file" class="form-control file"
                                                                        name="logo" id="logo"
                                                                        data-filename="logo_update" accept=".jpeg,.jpg,.png"
                                                                        accept=".jpeg,.jpg,.png">
                                                                </label>
                                                            </div>


                                                            @error('logo')
                                                                <div class="row">
                                                                    <span class="invalid-logo" role="alert">
                                                                        <strong
                                                                            class="text-danger">{{ $message }}</strong>
                                                                    </span>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6 col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>{{ __('Logo Light') }}</h5>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class=" setting-card">
                                                            <div class="logo-content mt-4  setting-logo">
                                                                <a href="{{ $logo . 'logo-light.png' }}" target="_blank">
                                                                    <img id="image1" alt="your image"
                                                                        src="{{ $logo . 'logo-light.png' }}" width="150px"
                                                                        class="big-logo"
                                                                        style="filter: drop-shadow(2px 3px 7px #011c4b);">
                                                                </a>
                                                            </div>

                                                            <div class="choose-files mt-5">
                                                                <label for="logo_light">
                                                                    <div class=" bg-primary logo_light_update"> <i
                                                                            class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                                    </div>
                                                                    <input type="file" class="form-control file"
                                                                        name="logo_light" id="logo_light"
                                                                        data-filename="logo_light_update">
                                                                </label>
                                                            </div>
                                                            @error('logo_light')
                                                                <div class="row">
                                                                    <span class="invalid-logo_light" role="alert">
                                                                        <strong
                                                                            class="text-danger">{{ $message }}</strong>
                                                                    </span>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6 col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>{{ __('Favicon') }}</h5>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <div class=" setting-card">
                                                            <div class="logo-content mt-4 setting-logo ">
                                                                {{-- <img src="{{ asset(Storage::url('uploads/logo/favicon.png')) }}"
                                                                width="50px" class="logo logo-sm img_setting">
                                                                <a href="{{$logo.'logo-light.png'}}" target="_blank">
                                                                    <img id="image2" alt="your image" src="{{$logo.'logo-light.png'}}" width="150px" class="big-logo" style="filter: drop-shadow(2px 3px 7px #011c4b);">
                                                                </a> --}}
                                                                <a href="{{ $logo . (isset($favicon) && !empty($favicon) ? $favicon : 'favicon.png') }}"
                                                                    target="_blank">
                                                                    <img id="image2" alt="your image"
                                                                        src="{{ $logo . (isset($favicon) && !empty($favicon) ? $favicon : 'favicon.png') }}"
                                                                        width="50px" class="big-logo img_setting">
                                                                </a>
                                                                {{-- <a href="{{$logo.'favicon.png'}}" target="_blank">
                                                                    <img id="image2" alt="your image" src="{{$logo.'favicon.png'}}" width="150px" class="big-logo" style="filter: drop-shadow(2px 3px 7px #011c4b);">
                                                                </a> --}}
                                                            </div>
                                                            <div class="choose-files mt-5">
                                                                <label for="favicon_update">
                                                                    <div class=" bg-primary favicon_update"> <i
                                                                            class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                                    </div>
                                                                    <input type="file" class="form-control file"
                                                                        name="favicon" id="favicon_update"
                                                                        data-filename="favicon_update">
                                                                </label>
                                                            </div>
                                                            @error('favicon')
                                                                <div class="row">
                                                                    <span class="invalid-favicon" role="alert">
                                                                        <strong
                                                                            class="text-danger">{{ $message }}</strong>
                                                                    </span>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                {{ Form::label('title_text', __('Title Text'), ['class' => 'col-form-label']) }}
                                                {{ Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Title Text')]) }}
                                                @error('title_text')
                                                    <span class="invalid-title_text" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror



                                            </div>
                                            <div class="form-group col-md-4">
                                                {{ Form::label('footer_text', __('Footer Text'), ['class' => 'col-form-label']) }}
                                                {{ Form::text('footer_text', null, ['class' => 'form-control', 'placeholder' => __('Footer Text')]) }}
                                                @error('footer_text')
                                                    <span class="invalid-footer_text" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror


                                            </div>
                                            {{-- {{ dd($lang) }} --}}
                                            <div class="form-group col-md-4">
                                                {{ Form::label('default_language', __('Default Language'), ['class' => 'col-form-label']) }}
                                                <select name="default_language" id="default_language"
                                                    class="form-control select2">
                                                    @foreach (\App\Models\Utility::languages() as $language)
                                                        <option @if ($lang == $language) selected @endif
                                                            value="{{ $language }}">{{ Str::upper($language) }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="row">
                                                <div class="col-3 ">
                                                    <div class="col switch-width">
                                                        <div class="form-group ml-2 mr-3">

                                                            {{ Form::label('display_landing_page', __('Enable Landing Page'), ['class' => 'col-form-label']) }}

                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" data-toggle="switchbutton"
                                                                    data-onstyle="primary" class=""
                                                                    name="display_landing_page" id="display_landing_page"
                                                                    {{ $settings['display_landing_page'] == 'on' ? 'checked="checked"' : '' }}>
                                                                <label class="custom-control-label mb-1"
                                                                    for="display_landing_page"></label>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 ">
                                                    <div class="col switch-width">
                                                        <div class="form-group ml-2 mr-3">
                                                            {{ Form::label('SITE_RTL', __('Enable RTL'), ['class' => 'col-form-label']) }}
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" data-toggle="switchbutton"
                                                                    data-onstyle="primary" class="" name="SITE_RTL"
                                                                    id="SITE_RTL"
                                                                    {{ \App\Models\Utility::getValByName('SITE_RTL') == 'on' ? 'checked="checked"' : '' }}>
                                                                <label class="custom-control-label mb-1"
                                                                    for="SITE_RTL"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3 ">
                                                    <div class="col switch-width">
                                                        <div class="form-group ml-2 mr-3">
                                                            {{ Form::label('disable_signup_button', __('Enable Sign-Up Page'), ['class' => 'col-form-label']) }}
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" data-toggle="switchbutton"
                                                                    data-onstyle="primary" class=""
                                                                    name="disable_signup_button"
                                                                    id="disable_signup_button"
                                                                    {{ $settings['disable_signup_button'] == 'on' ? 'checked="checked"' : '' }}>
                                                                <label class="custom-control-label mb-1"
                                                                    for="disable_signup_button"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="col switch-width">
                                                        <div class="form-group ml-2 mr-3 ">
                                                            {{ Form::label('email_verification', __('Email Verification'), ['class' => 'col-form-label']) }}
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" data-toggle="switchbutton"
                                                                    data-onstyle="primary" class=""
                                                                    name="email_verification" id="email_verification"
                                                                    {{ $settings['email_verification'] == 'on' ? 'checked="checked"' : '' }}>
                                                                <label class="custom-control-label mb-1"
                                                                    for="email_verification"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="custom-control custom-switch p-0">
                                                        <div class="form-group ml-2 mr-3">
                                                            <label class="col-form-label"
                                                                for="gdpr_cookie">{{ __('GDPR Cookie') }}</label><br>
                                                            <input type="checkbox"
                                                                class="form-check-input gdpr_fulltime gdpr_type"
                                                                data-toggle="switchbutton" data-onstyle="primary"
                                                                name="gdpr_cookie" id="gdpr_cookie"
                                                                {{ isset($settings['gdpr_cookie']) && $settings['gdpr_cookie'] == 'on' ? 'checked="checked"' : '' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                {{ Form::label('cookie_text', __('GDPR Cookie Text'), ['class' => 'fulltime form-label']) }}
                                                {!! Form::textarea(
                                                    'cookie_text',
                                                    isset($settings['cookie_text']) && $settings['cookie_text'] ? $settings['cookie_text'] : '',
                                                    ['class' => 'form-control fulltime', 'style' => 'display: hidden;resize: none;', 'rows' => '2'],
                                                ) !!}
                                            </div>

                                            <h5 class="mt-3 mb-3">{{ __('Theme Customizer') }}</h5>
                                            <div class="col-12">
                                                <div class="pct-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <h6 class="">
                                                                <i data-feather="credit-card"
                                                                    class="me-2"></i>{{ __('Primary color Settings') }}
                                                            </h6>
                                                            <hr class="my-2" />

                                                            <div class="theme-color themes-color">
                                                                <a href="#!"
                                                                    class="themes-color-change {{ $color == 'theme-1' ? 'active_color' : '' }}"
                                                                    data-value="theme-1"></a>
                                                                <input type="radio" class="theme_color d-none"
                                                                    name="theme_color" value="theme-1"
                                                                    {{ $color == 'theme-1' ? 'checked' : '' }}>
                                                                <a href="#!"
                                                                    class="themes-color-change {{ $color == 'theme-2' ? 'active_color' : '' }}"
                                                                    data-value="theme-2"></a>
                                                                <input type="radio" class="theme_color d-none"
                                                                    name="theme_color" value="theme-2"
                                                                    {{ $color == 'theme-2' ? 'checked' : '' }}>
                                                                <a href="#!"
                                                                    class="themes-color-change {{ $color == 'theme-3' ? 'active_color' : '' }}"
                                                                    data-value="theme-3"></a>
                                                                <input type="radio" class="theme_color d-none"
                                                                    name="theme_color" value="theme-3"
                                                                    {{ $color == 'theme-3' ? 'checked' : '' }}>
                                                                <a href="#!"
                                                                    class="themes-color-change {{ $color == 'theme-4' ? 'active_color' : '' }}"
                                                                    data-value="theme-4"></a>
                                                                <input type="radio" class="theme_color d-none"
                                                                    name="theme_color" value="theme-4"
                                                                    {{ $color == 'theme-4' ? 'checked' : '' }}>
                                                            </div>

                                                        </div>
                                                        <div class="col-4">
                                                            <h6 class=" ">
                                                                <i data-feather="layout"
                                                                    class="me-2"></i>{{ __('Sidebar Settings') }}
                                                            </h6>
                                                            <hr class="my-2 " />
                                                            <div class="form-check form-switch ">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="cust_theme_bg" name="cust_theme_bg"
                                                                    @if ($settings['cust_theme_bg'] == 'on') checked @endif />

                                                                <label class="form-check-label f-w-600 pl-1"
                                                                    for="cust_theme_bg">{{ __('Transparent layout') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <h6 class=" ">
                                                                <i data-feather="sun"
                                                                    class=""></i>{{ __('Layout Settings') }}
                                                            </h6>
                                                            <hr class=" my-2  " />
                                                            <div class="form-check form-switch mt-2 ">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="cust_darklayout" name="cust_darklayout"
                                                                    @if ($settings['cust_darklayout'] == 'on') checked @endif />

                                                                <label class="form-check-label f-w-600 pl-1"
                                                                    for="cust_darklayout">{{ __('Dark Layout') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">

                                        {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary']) }}

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>

                    <div class="" id="email-settings">
                        {{ Form::open(['route' => 'email.settings', 'method' => 'post']) }}
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>{{ __('Email Settings') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                {{ Form::label('mail_driver', __('Mail Driver'), ['class' => 'col-form-label mail_driver']) }}
                                                {{ Form::text('mail_driver', env('MAIL_DRIVER'), ['class' => 'form-control ', 'placeholder' => __('Enter Mail Driver')]) }}
                                                @error('mail_driver')
                                                    <span class="text-xs text-danger invalid-mail_driver"
                                                        role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                {{ Form::label('mail_host', __('Mail Host'), ['class' => 'col-form-label']) }}
                                                {{ Form::text('mail_host', env('MAIL_HOST'), ['class' => 'form-control ', 'placeholder' => __('Enter Mail Driver')]) }}
                                                @error('mail_host')
                                                    <span class="text-xs text-danger invalid-mail_driver"
                                                        role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                {{ Form::label('mail_port', __('Mail Port'), ['class' => 'col-form-label']) }}
                                                {{ Form::text('mail_port', env('MAIL_PORT'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Port')]) }}
                                                @error('mail_port')
                                                    <span class="text-xs text-danger invalid-mail_port"
                                                        role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                {{ Form::label('mail_username', __('Mail Username'), ['class' => 'col-form-label']) }}
                                                {{ Form::text('mail_username', env('MAIL_USERNAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Username')]) }}
                                                @error('mail_username')
                                                    <span class="text-xs text-danger invalid-mail_username"
                                                        role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                {{ Form::label('mail_password', __('Mail Password'), ['class' => 'col-form-label']) }}
                                                {{ Form::text('mail_password', env('MAIL_PASSWORD'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Password')]) }}
                                                @error('mail_password')
                                                    <span class="text-xs text-danger invalid-mail_password"
                                                        role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                {{ Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'col-form-label']) }}
                                                {{ Form::text('mail_encryption', env('MAIL_ENCRYPTION'), ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')]) }}
                                                @error('mail_encryption')
                                                    <span class="text-xs text-danger invalid-mail_encryption"
                                                        role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                {{ Form::label('mail_from_address', __('Mail From Address'), ['class' => 'col-form-label']) }}
                                                {{ Form::text('mail_from_address', env('MAIL_FROM_ADDRESS'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')]) }}
                                                @error('mail_from_address')
                                                    <span class="text-xs text-danger invalid-mail_from_address"
                                                        role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                                {{ Form::label('mail_from_name', __('Mail From Name'), ['class' => 'col-form-label']) }}
                                                {{ Form::text('mail_from_name', env('MAIL_FROM_NAME'), ['class' => 'form-control', 'placeholder' => __('Enter Mail From Name')]) }}
                                                @error('mail_from_name')
                                                    <span class="text-xs text-danger invalid-mail_from_name"
                                                        role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-6">
                                                {{-- <a href="#" class="btn btn-xs btn-primary send_email"  data-ajax-popup="true"
                                                data-title="{{ __('Send Test Mail') }}"
                                                data-url="{{ route('test.mail') }}">
                                                {{ __('Send Test Mail') }}
                                            </a> --}}
                                                <a href="#"
                                                    class="btn btn-print-invoice  btn-primary m-r-10 send_email"
                                                    data-ajax-popup="true" data-title="{{ __('Send Test Mail') }}"
                                                    data-url="{{ route('test.mail') }}">
                                                    {{ __('Send Test Mail') }}
                                                </a>

                                            </div>
                                            <div class="text-end col-md-6">
                                                {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="card" id="payment-settings">
                        <div class="card-header">
                            <h5>{{ 'Payment Settings' }}</h5>
                            <small
                                class="text-secondary font-weight-bold">{{ __('These details will be used to collect subscription plan payments.Each subscription plan will have a payment button based on the below configuration.') }}</small>
                        </div>
                        {{ Form::open(['route' => 'payment.settings', 'method' => 'post']) }}
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label class="col-form-label">{{ __('Currency') }} *</label>

                                            {{ Form::text('currency', env('CURRENCY'), ['class' => 'form-control font-style', 'required', 'placeholder' => __('Enter Currency')]) }}
                                            <small class="text-xs">
                                                {{ __('Note: Add currency code as per three-letter ISO code') }}.
                                                <a href="https://stripe.com/docs/currencies"
                                                    target="_blank">{{ __('You can find out how to do that here.') }}</a>
                                            </small>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="currency_symbol"
                                                class="col-form-label">{{ __('Currency Symbol') }}</label>
                                            {{ Form::text('currency_symbol', env('CURRENCY_SYMBOL'), ['class' => 'form-control', 'required', 'placeholder' => __('Enter Currency Symbol')]) }}
                                        </div>
                                    </div>
                                    <div class="faq justify-content-center">
                                        <div class="row">


                                            <div class="col-sm-12 col-md-12 col-xxl-12">
                                                <div class="accordion accordion-flush" id="accordionExample">


                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-2">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse0"
                                                                aria-expanded="true" aria-controls="collapse0">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i>
                                                                    {{ __('Stripe') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse0" class="accordion-collapse collapse"
                                                            aria-labelledby="heading-2-2"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">

                                                                    <div class="col-12 text-end">
                                                                        <div
                                                                            class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_stripe_enabled"
                                                                                value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input mx-2"
                                                                                name="is_stripe_enabled"
                                                                                id="is_stripe_enabled"
                                                                                {{ isset($admin_payment_setting['is_stripe_enabled']) && $admin_payment_setting['is_stripe_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="is_stripe_enabled">{{ __('Enable') }}</label>
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">

                                                                            {{ Form::label('stripe_key', __('Stripe Key'), ['class' => 'col-form-label']) }}
                                                                            {{ Form::text('stripe_key', isset($admin_payment_setting['stripe_key']) ? $admin_payment_setting['stripe_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Stripe Key')]) }}
                                                                            @if ($errors->has('stripe_key'))
                                                                                <span class="invalid-feedback d-block">
                                                                                    {{ $errors->first('stripe_key') }}
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">

                                                                            {{ Form::label('stripe_secret', __('Stripe Secret'), ['class' => 'col-form-label']) }}
                                                                            {{ Form::text('stripe_secret', isset($admin_payment_setting['stripe_secret']) ? $admin_payment_setting['stripe_secret'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Stripe Secret')]) }}
                                                                            @if ($errors->has('stripe_secret'))
                                                                                <span class="invalid-feedback d-block">
                                                                                    {{ $errors->first('stripe_secret') }}
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="accordion accordion-flush" id="accordionExample"> --}}
                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-2">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse1"
                                                                aria-expanded="true" aria-controls="collapse1">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i>
                                                                    {{ __('Paypal') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse1" class="accordion-collapse collapse"
                                                            aria-labelledby="heading-2-2"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">

                                                                    <div class="col-12 text-end">
                                                                        <div
                                                                            class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_paypal_enabled"
                                                                                value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input mx-2"
                                                                                name="is_paypal_enabled"
                                                                                id="is_paypal_enabled"
                                                                                {{ isset($admin_payment_setting['is_paypal_enabled']) && $admin_payment_setting['is_paypal_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="is_paypal_enabled">{{ __('Enable') }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-labe text-dark">
                                                                                        <input type="radio"
                                                                                            name="paypal_mode"
                                                                                            value="sandbox"
                                                                                            class="form-check-input"
                                                                                            {{ (isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == '') || (isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == 'sandbox') ? 'checked="checked"' : '' }}>
                                                                                        {{ __('Sandbox') }}
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2">
                                                                            <div class="border card p-3">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-labe text-dark">
                                                                                        <input type="radio"
                                                                                            name="paypal_mode"
                                                                                            value="live"
                                                                                            class="form-check-input"
                                                                                            {{ isset($admin_payment_setting['paypal_mode']) && $admin_payment_setting['paypal_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                                        {{ __('Live') }}
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="col-form-label"
                                                                                for="paypal_client_id">{{ __('Client ID') }}</label>
                                                                            <input type="text" name="paypal_client_id"
                                                                                id="paypal_client_id" class="form-control"
                                                                                value="{{ !isset($admin_payment_setting['paypal_client_id']) || is_null($admin_payment_setting['paypal_client_id']) ? '' : $admin_payment_setting['paypal_client_id'] }}"
                                                                                placeholder="{{ __('Client ID') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="col-form-label"
                                                                                for="paypal_secret_key">{{ __('Secret Key') }}</label>
                                                                            <input type="text" name="paypal_secret_key"
                                                                                id="paypal_secret_key"
                                                                                class="form-control"
                                                                                value="{{ isset($admin_payment_setting['paypal_secret_key']) ? $admin_payment_setting['paypal_secret_key'] : '' }}"
                                                                                placeholder="{{ __('Secret Key') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}
                                                    {{-- <div class="accordion accordion-flush" id="accordionExample"> --}}
                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-2">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse2"
                                                                aria-expanded="true" aria-controls="collapse2">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i>
                                                                    {{ __('Paystack') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse2" class="accordion-collapse collapse"
                                                            aria-labelledby="heading-2-2"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">

                                                                    <div class="col-12 text-end">
                                                                        <div
                                                                            class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden"
                                                                                name="is_paystack_enabled" value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input mx-2"
                                                                                name="is_paystack_enabled"
                                                                                id="is_paystack_enabled"
                                                                                {{ isset($admin_payment_setting['is_paystack_enabled']) && $admin_payment_setting['is_paystack_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="is_paystack_enabled">{{ __('Enable') }}</label>

                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paypal_client_id"
                                                                                class="col-form-label">{{ __('Public Key') }}</label>
                                                                            <input type="text"
                                                                                name="paystack_public_key"
                                                                                id="paystack_public_key"
                                                                                class="form-control"
                                                                                value="{{ isset($admin_payment_setting['paystack_public_key']) ? $admin_payment_setting['paystack_public_key'] : '' }}"
                                                                                placeholder="{{ __('Public Key') }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paystack_secret_key"
                                                                                class="col-form-label">{{ __('Secret Key') }}</label>
                                                                            <input type="text"
                                                                                name="paystack_secret_key"
                                                                                id="paystack_secret_key"
                                                                                class="form-control"
                                                                                value="{{ isset($admin_payment_setting['paystack_secret_key']) ? $admin_payment_setting['paystack_secret_key'] : '' }}"
                                                                                placeholder="{{ __('Secret Key') }}" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}
                                                    <!-- FLUTTERWAVE -->
                                                    {{-- <div class="accordion accordion-flush" id="accordionExample"> --}}
                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-5">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse3"
                                                                aria-expanded="true" aria-controls="collapse3">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i>
                                                                    {{ __('Flutterwave') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse3" class="accordion-collapse collapse"
                                                            aria-labelledby="heading-2-5"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">

                                                                    <div class="col-12 text-end">
                                                                        <div
                                                                            class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden"
                                                                                name="is_flutterwave_enabled"
                                                                                value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input mx-2"
                                                                                name="is_flutterwave_enabled"
                                                                                id="is_flutterwave_enabled"
                                                                                {{ isset($admin_payment_setting['is_flutterwave_enabled']) && $admin_payment_setting['is_flutterwave_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="is_flutterwave_enabled">{{ __('Enable') }}</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paypal_client_id"
                                                                                class="col-form-label">{{ __('Public Key') }}</label>
                                                                            <input type="text"
                                                                                name="flutterwave_public_key"
                                                                                id="flutterwave_public_key"
                                                                                class="form-control"
                                                                                value="{{ isset($admin_payment_setting['flutterwave_public_key']) ? $admin_payment_setting['flutterwave_public_key'] : '' }}"
                                                                                placeholder="Public Key">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paystack_secret_key"
                                                                                class="col-form-label">{{ __('Secret Key') }}</label>
                                                                            <input type="text"
                                                                                name="flutterwave_secret_key"
                                                                                id="flutterwave_secret_key"
                                                                                class="form-control"
                                                                                value="{{ isset($admin_payment_setting['flutterwave_secret_key']) ? $admin_payment_setting['flutterwave_secret_key'] : '' }}"
                                                                                placeholder="Secret Key">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}

                                                    {{-- <div class="accordion accordion-flush" id="accordionExample"> --}}

                                                    <!-- Razorpay -->
                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-6">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse4"
                                                                aria-expanded="true" aria-controls="collapse4">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i>
                                                                    {{ __('Razorpay') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse4" class="accordion-collapse collapse"
                                                            aria-labelledby="heading-2-6"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">

                                                                    <div class="col-12 text-end">
                                                                        <div
                                                                            class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden"
                                                                                name="is_razorpay_enabled" value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input mx-2"
                                                                                name="is_razorpay_enabled"
                                                                                id="is_razorpay_enabled"
                                                                                {{ isset($admin_payment_setting['is_razorpay_enabled']) && $admin_payment_setting['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="is_razorpay_enabled">{{ __('Enable') }}</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paypal_client_id"
                                                                                class="col-form-label">{{ __('Public Key') }}</label>

                                                                            <input type="text"
                                                                                name="razorpay_public_key"
                                                                                id="razorpay_public_key"
                                                                                class="form-control"
                                                                                value="{{ !isset($admin_payment_setting['razorpay_public_key']) || is_null($admin_payment_setting['razorpay_public_key']) ? '' : $admin_payment_setting['razorpay_public_key'] }}"
                                                                                placeholder="Public Key">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paystack_secret_key"
                                                                                class="col-form-label">
                                                                                {{ __('Secret Key') }}</label>
                                                                            <input type="text"
                                                                                name="razorpay_secret_key"
                                                                                id="razorpay_secret_key"
                                                                                class="form-control"
                                                                                value="{{ !isset($admin_payment_setting['razorpay_secret_key']) || is_null($admin_payment_setting['razorpay_secret_key']) ? '' : $admin_payment_setting['razorpay_secret_key'] }}"
                                                                                placeholder="Secret Key">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}
                                                    {{-- <div class="accordion accordion-flush" id="accordionExample"> --}}
                                                    <!-- Paytm -->
                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-7">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse5"
                                                                aria-expanded="true" aria-controls="collapse5">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i>
                                                                    {{ __('Paytm') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse5" class="accordion-collapse collapse"
                                                            aria-labelledby="heading-2-7"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">

                                                                    <div class="col-12 text-end">
                                                                        <div
                                                                            class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_paytm_enabled"
                                                                                value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input mx-2"
                                                                                name="is_paytm_enabled"
                                                                                id="is_paytm_enabled"
                                                                                {{ isset($admin_payment_setting['is_paytm_enabled']) && $admin_payment_setting['is_paytm_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="is_paytm_enabled">{{ __('Enable') }}</label>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 pb-4">
                                                                        <label class="paypal-label col-form-label"
                                                                            for="paypal_mode">{{ __('Paytm Environment') }}</label>
                                                                        <br>
                                                                        <div class="d-flex">
                                                                            <div class="mr-2"
                                                                                style="margin-right: 15px;">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                name="paytm_mode"
                                                                                                value="local"
                                                                                                class="form-check-input"
                                                                                                {{ !isset($admin_payment_setting['paytm_mode']) || $admin_payment_setting['paytm_mode'] == '' || $admin_payment_setting['paytm_mode'] == 'local' ? 'checked="checked"' : '' }}>
                                                                                            {{ __('Local') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                name="paytm_mode"
                                                                                                value="production"
                                                                                                class="form-check-input"
                                                                                                {{ isset($admin_payment_setting['paytm_mode']) && $admin_payment_setting['paytm_mode'] == 'production' ? 'checked="checked"' : '' }}>
                                                                                            {{ __('Production') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="paytm_public_key"
                                                                                class="col-form-label">{{ __('Merchant ID') }}</label>
                                                                            <input type="text" name="paytm_merchant_id"
                                                                                id="paytm_merchant_id"
                                                                                class="form-control"
                                                                                value="{{ isset($admin_payment_setting['paytm_merchant_id']) ? $admin_payment_setting['paytm_merchant_id'] : '' }}"
                                                                                placeholder="{{ __('Merchant ID') }}" />
                                                                            @if ($errors->has('paytm_merchant_id'))
                                                                                <span class="invalid-feedback d-block">
                                                                                    {{ $errors->first('paytm_merchant_id') }}
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="paytm_secret_key"
                                                                                class="col-form-label">{{ __('Merchant Key') }}</label>
                                                                            <input type="text"
                                                                                name="paytm_merchant_key"
                                                                                id="paytm_merchant_key"
                                                                                class="form-control"
                                                                                value="{{ isset($admin_payment_setting['paytm_merchant_key']) ? $admin_payment_setting['paytm_merchant_key'] : '' }}"
                                                                                placeholder="{{ __('Merchant Key') }}" />
                                                                            @if ($errors->has('paytm_merchant_key'))
                                                                                <span class="invalid-feedback d-block">
                                                                                    {{ $errors->first('paytm_merchant_key') }}
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="paytm_industry_type"
                                                                                class="col-form-label">{{ __('Industry Type') }}</label>
                                                                            <input type="text"
                                                                                name="paytm_industry_type"
                                                                                id="paytm_industry_type"
                                                                                class="form-control"
                                                                                value="{{ isset($admin_payment_setting['paytm_industry_type']) ? $admin_payment_setting['paytm_industry_type'] : '' }}"
                                                                                placeholder="{{ __('Industry Type') }}" />
                                                                            @if ($errors->has('paytm_industry_type'))
                                                                                <span class="invalid-feedback d-block">
                                                                                    {{ $errors->first('paytm_industry_type') }}
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}

                                                    {{-- <div class="accordion accordion-flush" id="accordionExample"> --}}
                                                    <!-- Mercado Pago-->
                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-8">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse6"
                                                                aria-expanded="true" aria-controls="collapse6">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i>
                                                                    {{ __('Mercado Pago') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse6" class="accordion-collapse collapse"
                                                            aria-labelledby="heading-2-8"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">

                                                                    <div class="col-12 text-end">
                                                                        <div
                                                                            class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden"
                                                                                name="is_mercado_enabled" value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input mx-2"
                                                                                name="is_mercado_enabled"
                                                                                id="is_mercado_enabled"
                                                                                {{ isset($admin_payment_setting['is_mercado_enabled']) && $admin_payment_setting['is_mercado_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="is_mercado_enabled">{{ __('Enable') }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 pb-4">
                                                                        <label class="coingate-label col-form-label"
                                                                            for="mercado_mode">{{ __('Mercado Mode') }}</label>
                                                                        <br>
                                                                        <div class="d-flex">
                                                                            <div class="mr-2"
                                                                                style="margin-right: 15px;">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                name="mercado_mode"
                                                                                                value="sandbox"
                                                                                                class="form-check-input"
                                                                                                {{ (isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == '') || (isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == 'sandbox') ? 'checked="checked"' : '' }}>
                                                                                            {{ __('Sandbox') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                name="mercado_mode"
                                                                                                value="live"
                                                                                                class="form-check-input"
                                                                                                {{ isset($admin_payment_setting['mercado_mode']) && $admin_payment_setting['mercado_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                                            {{ __('Live') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="mercado_access_token"
                                                                                class="col-form-label">{{ __('Access Token') }}</label>
                                                                            <input type="text"
                                                                                name="mercado_access_token"
                                                                                id="mercado_access_token"
                                                                                class="form-control"
                                                                                value="{{ isset($admin_payment_setting['mercado_access_token']) ? $admin_payment_setting['mercado_access_token'] : '' }}"
                                                                                placeholder="{{ __('Access Token') }}" />
                                                                            @if ($errors->has('mercado_secret_key'))
                                                                                <span class="invalid-feedback d-block">
                                                                                    {{ $errors->first('mercado_access_token') }}
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}

                                                    {{-- <div class="accordion accordion-flush" id="accordionExample"> --}}
                                                    <!-- Mollie -->
                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-9">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse8"
                                                                aria-expanded="true" aria-controls="collapse8">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i>
                                                                    {{ __('Mollie') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse8" class="accordion-collapse collapse"
                                                            aria-labelledby="heading-2-9"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">

                                                                    <div class="col-12 text-end">
                                                                        <div
                                                                            class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_mollie_enabled"
                                                                                value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input mx-2"
                                                                                name="is_mollie_enabled"
                                                                                id="is_mollie_enabled"
                                                                                {{ isset($admin_payment_setting['is_mollie_enabled']) && $admin_payment_setting['is_mollie_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="is_mollie_enabled">{{ __('Enable') }}</label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="mollie_api_key"
                                                                                class="col-form-label">{{ __('Mollie Api Key') }}</label>
                                                                            <input type="text" name="mollie_api_key"
                                                                                id="mollie_api_key" class="form-control"
                                                                                value="{{ !isset($admin_payment_setting['mollie_api_key']) || is_null($admin_payment_setting['mollie_api_key']) ? '' : $admin_payment_setting['mollie_api_key'] }}"
                                                                                placeholder="Mollie Api Key">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="mollie_profile_id"
                                                                                class="col-form-label">{{ __('Mollie Profile Id') }}</label>
                                                                            <input type="text" name="mollie_profile_id"
                                                                                id="mollie_profile_id"
                                                                                class="form-control"
                                                                                value="{{ !isset($admin_payment_setting['mollie_profile_id']) || is_null($admin_payment_setting['mollie_profile_id']) ? '' : $admin_payment_setting['mollie_profile_id'] }}"
                                                                                placeholder="Mollie Profile Id">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="mollie_partner_id"
                                                                                class="col-form-label">{{ __('Mollie Partner Id') }}</label>
                                                                            <input type="text" name="mollie_partner_id"
                                                                                id="mollie_partner_id"
                                                                                class="form-control"
                                                                                value="{{ !isset($admin_payment_setting['mollie_partner_id']) || is_null($admin_payment_setting['mollie_partner_id']) ? '' : $admin_payment_setting['mollie_partner_id'] }}"
                                                                                placeholder="Mollie Partner Id">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}

                                                    {{-- <div class="accordion accordion-flush" id="accordionExample"> --}}
                                                    <!-- Skrill -->
                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-10">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse9"
                                                                aria-expanded="true" aria-controls="collapse9">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i>
                                                                    {{ __('Skrill') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse9" class="accordion-collapse collapse"
                                                            aria-labelledby="heading-2-10"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-12 text-end">
                                                                        <div
                                                                            class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden" name="is_skrill_enabled"
                                                                                value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input mx-2"
                                                                                name="is_skrill_enabled"
                                                                                id="is_skrill_enabled"
                                                                                {{ isset($admin_payment_setting['is_skrill_enabled']) && $admin_payment_setting['is_skrill_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="is_skrill_enabled">{{ __('Enable') }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="mollie_api_key"
                                                                                class="col-form-label">{{ __('Skrill Email') }}</label>
                                                                            <input type="email" name="skrill_email"
                                                                                id="skrill_email" class="form-control"
                                                                                value="{{ isset($admin_payment_setting['skrill_email']) ? $admin_payment_setting['skrill_email'] : '' }}"
                                                                                placeholder="{{ __('Mollie Api Key') }}" />
                                                                            @if ($errors->has('skrill_email'))
                                                                                <span class="invalid-feedback d-block">
                                                                                    {{ $errors->first('skrill_email') }}
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}

                                                    {{-- <div class="accordion accordion-flush" id="accordionExample"> --}}
                                                    <!-- CoinGate -->
                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-11">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse10"
                                                                aria-expanded="true" aria-controls="collapse10">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i>
                                                                    {{ __('CoinGate') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse10" class="accordion-collapse collapse"
                                                            aria-labelledby="heading-2-11"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">

                                                                    <div class="col-12 text-end">
                                                                        <div
                                                                            class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden"
                                                                                name="is_coingate_enabled" value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input mx-2"
                                                                                name="is_coingate_enabled"
                                                                                id="is_coingate_enabled"
                                                                                {{ isset($admin_payment_setting['is_coingate_enabled']) && $admin_payment_setting['is_coingate_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="is_coingate_enabled">{{ __('Enable') }}</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 pb-4">
                                                                        <label class="col-form-label"
                                                                            for="coingate_mode">{{ __('CoinGate Mode') }}</label>
                                                                        <br>
                                                                        <div class="d-flex">
                                                                            <div class="mr-2"
                                                                                style="margin-right: 15px;">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                name="coingate_mode"
                                                                                                value="sandbox"
                                                                                                class="form-check-input"
                                                                                                {{ !isset($admin_payment_setting['coingate_mode']) || $admin_payment_setting['coingate_mode'] == '' || $admin_payment_setting['coingate_mode'] == 'sandbox' ? 'checked="checked"' : '' }}>
                                                                                            {{ __('Sandbox') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mr-2">
                                                                                <div class="border card p-3">
                                                                                    <div class="form-check">
                                                                                        <label
                                                                                            class="form-check-labe text-dark">
                                                                                            <input type="radio"
                                                                                                name="coingate_mode"
                                                                                                value="live"
                                                                                                class="form-check-input"
                                                                                                {{ isset($admin_payment_setting['coingate_mode']) && $admin_payment_setting['coingate_mode'] == 'live' ? 'checked="checked"' : '' }}>
                                                                                            {{ __('Live') }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="coingate_auth_token"
                                                                                class="col-form-label">{{ __('CoinGate Auth Token') }}</label>
                                                                            <input type="text"
                                                                                name="coingate_auth_token"
                                                                                id="coingate_auth_token"
                                                                                class="form-control"
                                                                                value="{{ !isset($admin_payment_setting['coingate_auth_token']) || is_null($admin_payment_setting['coingate_auth_token']) ? '' : $admin_payment_setting['coingate_auth_token'] }}"
                                                                                placeholder="CoinGate Auth Token">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}

                                                    {{-- <div class="accordion accordion-flush" id="accordionExample"> --}}
                                                    <!-- PaymentWall -->
                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header" id="heading-2-12">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapse11"
                                                                aria-expanded="true" aria-controls="collapse11">
                                                                <span class="d-flex align-items-center">
                                                                    <i class="ti ti-credit-card text-primary"></i>
                                                                    {{ __('PaymentWall') }}
                                                                </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse11" class="accordion-collapse collapse"
                                                            aria-labelledby="heading-2-12"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row">

                                                                    <div class="col-12 text-end">
                                                                        <div
                                                                            class="form-check form-switch form-switch-right mb-2">
                                                                            <input type="hidden"
                                                                                name="is_paymentwall_enabled"
                                                                                value="off">
                                                                            <input type="checkbox"
                                                                                class="form-check-input mx-2"
                                                                                name="is_paymentwall_enabled"
                                                                                id="is_paymentwall_enabled"
                                                                                {{ isset($admin_payment_setting['is_paymentwall_enabled']) && $admin_payment_setting['is_paymentwall_enabled'] == 'on' ? 'checked="checked"' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="is_paymentwall_enabled">{{ __('Enable') }}
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paymentwall_public_key"
                                                                                class="col-form-label">{{ __('Public Key') }}</label>
                                                                            <input type="text"
                                                                                name="paymentwall_public_key"
                                                                                id="paymentwall_public_key"
                                                                                class="form-control"
                                                                                value="{{ !isset($admin_payment_setting['paymentwall_public_key']) || is_null($admin_payment_setting['paymentwall_public_key']) ? '' : $admin_payment_setting['paymentwall_public_key'] }}"
                                                                                placeholder="{{ __('Public Key') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="paymentwall_secret_key"
                                                                                class="col-form-label">{{ __('Private Key') }}</label>
                                                                            <input type="text"
                                                                                name="paymentwall_secret_key"
                                                                                id="paymentwall_secret_key"
                                                                                class="form-control"
                                                                                value="{{ !isset($admin_payment_setting['paymentwall_secret_key']) || is_null($admin_payment_setting['paymentwall_secret_key']) ? '' : $admin_payment_setting['paymentwall_secret_key'] }}"
                                                                                placeholder="{{ __('Private Key') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn-submit btn btn-primary" type="submit">
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                        </form>
                    </div>
                    <div class="" id="pusher-settings">
                        {{ Form::open(['route' => 'pusher.settings', 'method' => 'post']) }}
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <h5>{{ __('Pusher Settings') }}</h5><small
                                                    class="text-secondary font-weight-bold"></small>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                <label for="pusher_app_id"
                                                    class="col-form-label">{{ __('Pusher App Id') }}</label>
                                                <input class="form-control" placeholder="Enter Pusher App Id"
                                                    name="pusher_app_id" type="text"
                                                    value="{{ env('PUSHER_APP_ID') }}" id="pusher_app_id">

                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                <label for="pusher_app_key"
                                                    class="col-form-label">{{ __('Pusher App Key') }}</label>
                                                <input class="form-control " placeholder="Enter Pusher App Key"
                                                    name="pusher_app_key" type="text"
                                                    value="{{ env('PUSHER_APP_KEY') }}" id="pusher_app_key">

                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                <label for="pusher_app_secret"
                                                    class="col-form-label">{{ __('Pusher App Secret') }}</label>
                                                <input class="form-control " placeholder="Enter Pusher App Secret"
                                                    name="pusher_app_secret" type="text"
                                                    value="{{ env('PUSHER_APP_SECRET') }}" id="pusher_app_secret">

                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                                <label for="pusher_app_cluster"
                                                    class="col-form-label">{{ __('Pusher App Cluster') }}</label>
                                                <input class="form-control " placeholder="Enter Pusher App Cluster"
                                                    name="pusher_app_cluster" type="text"
                                                    value="{{ env('PUSHER_APP_CLUSTER') }}" id="pusher_app_cluster">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">

                                        {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary']) }}

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div id="recaptcha-print-settings" class="card">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('recaptcha.settings.store') }}"
                                accept-charset="UTF-8">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                                target="_blank" class="text-blue">
                                                <h5 class="">{{ __('ReCaptcha settings') }}</h5><small
                                                    class="text-secondary font-weight-bold">({{ __('How to Get Google reCaptcha Site and Secret key') }})</small>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-end">
                                            <div class="col switch-width">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switchbutton"
                                                        data-onstyle="primary" class="" name="recaptcha_module"
                                                        id="recaptcha_module" value="yes"
                                                        {{ env('RECAPTCHA_MODULE') == 'yes' ? 'checked="checked"' : '' }}>
                                                    <label class="custom-control-label form-control-label px-2"
                                                        for="recaptcha_module "></label><br>
                                                    <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                                        target="_blank" class="text-blue">

                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">

                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="google_recaptcha_key"
                                                class="form-label">{{ __('Google Recaptcha Key') }}</label>
                                            <input class="form-control"
                                                placeholder="{{ __('Enter Google Recaptcha Key') }}"
                                                name="google_recaptcha_key" type="text"
                                                value="{{ env('NOCAPTCHA_SITEKEY') }}" id="google_recaptcha_key">

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                            <label for="google_recaptcha_secret"
                                                class="form-label">{{ __('Google Recaptcha Secret') }}</label>
                                            <input class="form-control "
                                                placeholder="{{ __('Enter Google Recaptcha Secret') }}"
                                                name="google_recaptcha_secret" type="text"
                                                value="{{ env('NOCAPTCHA_SECRET') }}" id="google_recaptcha_secret">

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">

                                    {{ Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary']) }}

                                </div>
                            </form>
                        </div>
                    </div>

                    <!--storage Setting-->
                    <div id="storage-settings" class="card">
                        {{ Form::open(['route' => 'storage.setting.store', 'enctype' => 'multipart/form-data']) }}
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <h5 class="">{{ __('Storage Settings') }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="pe-2">
                                    <input type="radio" class="btn-check" name="storage_setting"
                                        id="local-outlined" autocomplete="off"
                                        {{ $setting['storage_setting'] == 'local' ? 'checked' : '' }} value="local"
                                        checked>
                                    <label class="btn btn-outline-success"
                                        for="local-outlined">{{ __('Local') }}</label>
                                </div>
                                <div class="pe-2">
                                    <input type="radio" class="btn-check" name="storage_setting" id="s3-outlined"
                                        autocomplete="off" {{ $setting['storage_setting'] == 's3' ? 'checked' : '' }}
                                        value="s3">
                                    <label class="btn btn-outline-success" for="s3-outlined">
                                        {{ __('AWS S3') }}</label>
                                </div>

                                <div class="pe-2">
                                    <input type="radio" class="btn-check" name="storage_setting"
                                        id="wasabi-outlined" autocomplete="off"
                                        {{ $setting['storage_setting'] == 'wasabi' ? 'checked' : '' }} value="wasabi">
                                    <label class="btn btn-outline-success"
                                        for="wasabi-outlined">{{ __('Wasabi') }}</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div
                                    class="local-setting row mb-4 {{ $setting['storage_setting'] == 'local' ? ' ' : 'd-none' }}">
                                    {{-- <h4 class="small-title">{{ __('Local Settings') }}</h4> --}}
                                    <div class="form-group col-8 switch-width">
                                        {{ Form::label('local_storage_validation', __('Only Upload Files'), ['class' => ' form-label']) }}
                                        <select name="local_storage_validation[]" class="select2"
                                            id="local_storage_validation" multiple>
                                            @foreach ($file_type as $f)
                                                <option @if (in_array($f, $local_storage_validations)) selected @endif>
                                                    {{ $f }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label"
                                                for="local_storage_max_upload_size">{{ __('Max upload size ( In KB)') }}</label>
                                            <input type="number" name="local_storage_max_upload_size"
                                                class="form-control"
                                                value="{{ !isset($setting['local_storage_max_upload_size']) || is_null($setting['local_storage_max_upload_size']) ? '' : $setting['local_storage_max_upload_size'] }}"
                                                placeholder="{{ __('Max upload size') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="s3-setting row {{ $setting['storage_setting'] == 's3' ? ' ' : 'd-none' }}">

                                    <div class=" row ">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_key">{{ __('S3 Key') }}</label>
                                                <input type="text" name="s3_key" class="form-control"
                                                    value="{{ !isset($setting['s3_key']) || is_null($setting['s3_key']) ? '' : $setting['s3_key'] }}"
                                                    placeholder="{{ __('S3 Key') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_secret">{{ __('S3 Secret') }}</label>
                                                <input type="text" name="s3_secret" class="form-control"
                                                    value="{{ !isset($setting['s3_secret']) || is_null($setting['s3_secret']) ? '' : $setting['s3_secret'] }}"
                                                    placeholder="{{ __('S3 Secret') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_region">{{ __('S3 Region') }}</label>
                                                <input type="text" name="s3_region" class="form-control"
                                                    value="{{ !isset($setting['s3_region']) || is_null($setting['s3_region']) ? '' : $setting['s3_region'] }}"
                                                    placeholder="{{ __('S3 Region') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_bucket">{{ __('S3 Bucket') }}</label>
                                                <input type="text" name="s3_bucket" class="form-control"
                                                    value="{{ !isset($setting['s3_bucket']) || is_null($setting['s3_bucket']) ? '' : $setting['s3_bucket'] }}"
                                                    placeholder="{{ __('S3 Bucket') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_url">{{ __('S3 URL') }}</label>
                                                <input type="text" name="s3_url" class="form-control"
                                                    value="{{ !isset($setting['s3_url']) || is_null($setting['s3_url']) ? '' : $setting['s3_url'] }}"
                                                    placeholder="{{ __('S3 URL') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_endpoint">{{ __('S3 Endpoint') }}</label>
                                                <input type="text" name="s3_endpoint" class="form-control"
                                                    value="{{ !isset($setting['s3_endpoint']) || is_null($setting['s3_endpoint']) ? '' : $setting['s3_endpoint'] }}"
                                                    placeholder="{{ __('S3 Bucket') }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-8 switch-width">
                                            {{ Form::label('s3_storage_validation', __('Only Upload Files'), ['class' => ' form-label']) }}
                                            <select name="s3_storage_validation[]" class="select2"
                                                id="s3_storage_validation" multiple>
                                                @foreach ($file_type as $f)
                                                    <option @if (in_array($f, $s3_storage_validations)) selected @endif>
                                                        {{ $f }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_max_upload_size">{{ __('Max upload size ( In MB)') }}</label>
                                                <input type="number" name="s3_max_upload_size" class="form-control"
                                                    value="{{ !isset($setting['s3_max_upload_size']) || is_null($setting['s3_max_upload_size']) ? '' : $setting['s3_max_upload_size'] }}"
                                                    placeholder="{{ __('Max upload size') }}">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div
                                    class="wasabi-setting row {{ $setting['storage_setting'] == 'wasabi' ? ' ' : 'd-none' }}">
                                    <div class=" row ">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_key">{{ __('Wasabi Key') }}</label>
                                                <input type="text" name="wasabi_key" class="form-control"
                                                    value="{{ !isset($setting['wasabi_key']) || is_null($setting['wasabi_key']) ? '' : $setting['wasabi_key'] }}"
                                                    placeholder="{{ __('Wasabi Key') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_secret">{{ __('Wasabi Secret') }}</label>
                                                <input type="text" name="wasabi_secret" class="form-control"
                                                    value="{{ !isset($setting['wasabi_secret']) || is_null($setting['wasabi_secret']) ? '' : $setting['wasabi_secret'] }}"
                                                    placeholder="{{ __('Wasabi Secret') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_region">{{ __('Wasabi Region') }}</label>
                                                <input type="text" name="wasabi_region" class="form-control"
                                                    value="{{ !isset($setting['wasabi_region']) || is_null($setting['wasabi_region']) ? '' : $setting['wasabi_region'] }}"
                                                    placeholder="{{ __('Wasabi Region') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="wasabi_bucket">{{ __('Wasabi Bucket') }}</label>
                                                <input type="text" name="wasabi_bucket" class="form-control"
                                                    value="{{ !isset($setting['wasabi_bucket']) || is_null($setting['wasabi_bucket']) ? '' : $setting['wasabi_bucket'] }}"
                                                    placeholder="{{ __('Wasabi Bucket') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="wasabi_url">{{ __('Wasabi URL') }}</label>
                                                <input type="text" name="wasabi_url" class="form-control"
                                                    value="{{ !isset($setting['wasabi_url']) || is_null($setting['wasabi_url']) ? '' : $setting['wasabi_url'] }}"
                                                    placeholder="{{ __('Wasabi URL') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="wasabi_root">{{ __('Wasabi Root') }}</label>
                                                <input type="text" name="wasabi_root" class="form-control"
                                                    value="{{ !isset($setting['wasabi_root']) || is_null($setting['wasabi_root']) ? '' : $setting['wasabi_root'] }}"
                                                    placeholder="{{ __('Wasabi Bucket') }}">
                                            </div>
                                        </div>
                                        <div class="form-group col-8 switch-width">
                                            {{ Form::label('wasabi_storage_validation', __('Only Upload Files'), ['class' => 'form-label']) }}

                                            <select name="wasabi_storage_validation[]" class="select2"
                                                id="wasabi_storage_validation" multiple>
                                                @foreach ($file_type as $f)
                                                    <option @if (in_array($f, $wasabi_storage_validations)) selected @endif>
                                                        {{ $f }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="wasabi_root">{{ __('Max upload size ( In MB)') }}</label>
                                                <input type="number" name="wasabi_max_upload_size"
                                                    class="form-control"
                                                    value="{{ !isset($setting['wasabi_max_upload_size']) || is_null($setting['wasabi_max_upload_size']) ? '' : $setting['wasabi_max_upload_size'] }}"
                                                    placeholder="{{ __('Max upload size') }}">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit"
                                        value="{{ __('Save Changes') }}">
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
