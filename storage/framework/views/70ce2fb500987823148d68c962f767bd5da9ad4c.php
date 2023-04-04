<?php if(Auth::user()->type == 'company'): ?>
    <?php echo e(Form::model($event, ['route' => ['event.update', $event->id], 'method' => 'PUT'])); ?>

    <div class="modal-body">
        <div class="row">
            <div class="form-group">
                <?php echo e(Form::label('title', __('Event Title'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Event Title')])); ?>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('start_date', __('Event start Date'), ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::text('start_date', null, ['class' => 'form-control d_week', 'autocomplete' => 'off'])); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('end_date', __('Event End Date'), ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::text('end_date', null, ['class' => 'form-control d_week', 'autocomplete' => 'off'])); ?>

                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('color', __('Event Select Color'), ['class' => 'col-form-label d-block mb-3'])); ?>

                <div class=" btn-group-toggle btn-group-colors event-tag" data-toggle="buttons">
                    <label
                        class="btn bg-info p-3 <?php echo e($event->color == 'event-info'
                            ? 'custom_color_radio_button
                                                                                                                        '
                            : ''); ?> "><input
                            type="radio" name="color" class="d-none" value="event-info"
                            <?php echo e($event->color == 'event-info' ? 'checked' : ''); ?>></label>

                    <label
                        class="btn bg-warning p-3 <?php echo e($event->color == 'event-warning' ? 'custom_color_radio_button' : ''); ?>"><input
                            type="radio" class="d-none" name="color" value="event-warning"
                            <?php echo e($event->color == 'event-warning' ? 'checked' : ''); ?>></label>

                    <label
                        class="btn bg-danger p-3 <?php echo e($event->color == 'event-danger' ? 'custom_color_radio_button' : ''); ?>"><input
                            type="radio" name="color" class="d-none" value="event-danger"
                            <?php echo e($event->color == 'event-danger' ? 'checked' : ''); ?>></label>


                    <label
                        class="btn bg-success p-3 <?php echo e($event->color == 'event-success' ? 'custom_color_radio_button' : ''); ?>"><input
                            type="radio" class="d-none" name="color" value="event-success"
                            <?php echo e($event->color == 'event-success' ? 'checked' : ''); ?>></label>

                    <label class="btn p-3 <?php echo e($event->color == 'event-primary' ? 'custom_color_radio_button' : ''); ?>"
                        style="background-color: #51459d !important"><input type="radio" class="d-none"
                            name="color" value="event-primary"
                            <?php echo e($event->color == 'event-primary' ? 'checked' : ''); ?>></label>
                </div>
            </div>
            <div class="form-group">
                <?php echo e(Form::label('description', __('Event Description'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => __('Enter Event Description')])); ?>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">

    </div>
    <?php echo e(Form::close()); ?>

<?php endif; ?>

<?php if(Auth::user()->type == 'employee'): ?>
    <div class="model-body">
        <div class="card">

            <div class="tab-content tab-bordered">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="">
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-4"><span
                                                class="h6 text-sm mb-0"><?php echo e(__('Title')); ?></span>
                                        </dt>
                                        <dd class="col-sm-8"><span
                                                class="text-sm"><?php echo e($event->title); ?></span></dd>

                                        <dt class="col-sm-4"><span
                                                class="h6 text-sm mb-0"><?php echo e(__('Start Date')); ?></span>
                                        </dt>
                                        <dd class="col-sm-8"><span
                                                class="text-sm"><?php echo e(\Auth::user()->dateFormat($event->start_date)); ?></span>
                                        </dd>
                                        <dt class="col-sm-4"><span
                                                class="h6 text-sm mb-0"><?php echo e(__('End Date')); ?></span>
                                        </dt>
                                        <dd class="col-sm-8"><span
                                                class="text-sm"><?php echo e(\Auth::user()->dateFormat($event->end_date)); ?></span>
                                        </dd>
                                        <dt class="col-sm-4"><span
                                                class="h6 text-sm mb-0"><?php echo e(__('Description')); ?></span></dt>
                                        <dd class="col-sm-8"><span
                                                class="text-sm"><?php echo e($event->description); ?></span></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(Auth::user()->type == 'hr'): ?>
    <?php echo e(Form::model($event, ['route' => ['event.update', $event->id], 'method' => 'PUT'])); ?>

    <div class="modal-body">
        <div class="col-form-label">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo e(Form::label('title', __('Event Title'), ['class' => 'col-form-label'])); ?>

                        <?php echo e(Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Event Title')])); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('start_date', __('Event start Date'), ['class' => 'col-form-label'])); ?>

                        <?php echo e(Form::text('start_date', null, ['class' => 'form-control d_week', 'autocomplete' => 'off'])); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('end_date', __('Event End Date'), ['class' => 'col-form-label'])); ?>

                        <?php echo e(Form::text('end_date', null, ['class' => 'form-control d_week', 'autocomplete' => 'off'])); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <?php echo e(Form::label('color', __('Event Select Color'), ['class' => 'col-form-label d-block mb-3'])); ?>

                       
                        <div class=" btn-group-toggle btn-group-colors event-tag" data-toggle="buttons">
                            <label
                                class="btn bg-info p-3 <?php echo e($event->color == 'event-info'
                                    ? 'custom_color_radio_button
                                                        '
                                    : ''); ?> "><input
                                    type="radio" name="color" class="d-none" value="event-info"
                                    <?php echo e($event->color == 'event-info' ? 'checked' : ''); ?>></label>
        
                            <label
                                class="btn bg-warning p-3 <?php echo e($event->color == 'event-warning' ? 'custom_color_radio_button' : ''); ?>"><input
                                    type="radio" class="d-none" name="color" value="event-warning"
                                    <?php echo e($event->color == 'event-warning' ? 'checked' : ''); ?>></label>
        
                            <label
                                class="btn bg-danger p-3 <?php echo e($event->color == 'event-danger' ? 'custom_color_radio_button' : ''); ?>"><input
                                    type="radio" name="color" class="d-none" value="event-danger"
                                    <?php echo e($event->color == 'event-danger' ? 'checked' : ''); ?>></label>
        
        
                            <label
                                class="btn bg-success p-3 <?php echo e($event->color == 'event-success' ? 'custom_color_radio_button' : ''); ?>"><input
                                    type="radio" class="d-none" name="color" value="event-success"
                                    <?php echo e($event->color == 'event-success' ? 'checked' : ''); ?>></label>
        
                            <label class="btn p-3 <?php echo e($event->color == 'event-primary' ? 'custom_color_radio_button' : ''); ?>"
                                style="background-color: #51459d !important"><input type="radio" class="d-none"
                                    name="color" value="event-primary"
                                    <?php echo e($event->color == 'event-primary' ? 'checked' : ''); ?>></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo e(Form::label('description', __('Event Description'), ['class' => 'col-form-label'])); ?>

                        <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Event Description')])); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">

    </div>
    <?php echo e(Form::close()); ?>

<?php endif; ?>
<?php /**PATH E:\wamp64\www\hrms_9\resources\views/event/edit.blade.php ENDPATH**/ ?>