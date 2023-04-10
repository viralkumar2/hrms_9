{{ Form::model($holiday, ['route' => ['holiday.update', $holiday->id], 'method' => 'PUT']) }}
<div class="modal-body">
    <div class="row">

        <div class="form-group col-md-12">
            {{ Form::label('Branch', __('Branch'), ['class' => 'col-form-label']) }}
            <select name="branch_name" id="branch_name" class="form-control" required>
                <option value="">Select a branch</option>
                @foreach($branches as $row)
                    <option @if($holiday->branch_name == $row->id ) selected @else @endif value="{{ $row->id }}">{{ $row->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('occasion', __('Occasion'), ['class' => 'col-form-label']) }}
            {{ Form::text('occasion', null, ['class' => 'form-control','placeholder'=>'Enter Occasion']) }}
        </div>
        <div class="row col-md-12">
        <div class="form-group col-md-6">
            {{ Form::label('start_date', __('Start Date'), ['class' => 'col-form-label']) }}
            {{ Form::date('start_date', null, ['class' => 'form-control ']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('end_date', __('End Date'), ['class' => 'col-form-label']) }}
            {{ Form::date('end_date', null, ['class' => 'form-control ']) }}
        </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
     <input type="submit" value="{{ __('Update') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}

