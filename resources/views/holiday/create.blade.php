@php
    $setting = App\Models\Utility::settings();
@endphp
{{ Form::open(['url' => 'holiday', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">

        <div class="form-group col-md-12">
            {{ Form::label('Branch', __('Branch'), ['class' => 'col-form-label']) }}
            <select name="branch_name" id="branch_name" class="form-control" required>
                <option value="">Select a branch</option>
                @foreach($branches as $row)
                    <option value="{{ $row->id }}">{{ $row->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('occasion', __('Occasion'), ['class' => 'col-form-label']) }}
            {{ Form::text('occasion', null, ['class' => 'form-control', 'placeholder' => 'Enter Occasion']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('start_date', __('Start Date'), ['class' => 'col-form-label']) }}
            {{ Form::date('start_date', null, ['class' => 'form-control current_date', 'autocomplete' => 'off']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('end_date', __('End Date'), ['class' => 'col-form-label']) }}
            {{ Form::date('end_date', null, ['class' => 'form-control current_date', 'autocomplete' => 'off']) }}
        </div>
        @if(isset($setting['is_enabled']) && $setting['is_enabled'] =='on')
        <div class="form-group col-md-6">
            {{ Form::label('synchronize_type', __('Synchroniz in Google Calendar ?'), ['class' => 'form-label']) }}
            <div class=" form-switch">
                <input type="checkbox" class="form-check-input mt-2" name="synchronize_type" id="switch-shadow"
                    value="google_calender">
                <label class="form-check-label" for="switch-shadow"></label>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn btn-primary">
</div>

{{ Form::close() }}

<script>
    $(document).ready(function() {
        var now = new Date();
        var month = (now.getMonth() + 1);
        var day = now.getDate();
        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;
        var today = now.getFullYear() + '-' + month + '-' + day;
        $('.current_date').val(today);
    });
</script>
