{{ Form::open(['url' => 'shift/store', 'method' => 'post']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <label class = 'col-form-label'>Shift Name</label>
            <input type="text" name ="shift_name" class = 'form-control'>
        </div>
        <div class="form-group col-md-6 col-lg-6">
            <label class="col-form-label">Start Time</label>
            <input type="text" name="start_time" class="form-control">
        </div>
        <div class="form-group col-md-6 col-lg-6">
            <label class="col-form-label">End Time</label>
            <input type="text" name="end_time" class="form-control">
        </div>
        
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