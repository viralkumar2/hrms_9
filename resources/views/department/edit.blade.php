
{{ Form::model($department, ['route' => ['department.update', $department->id], 'method' => 'PUT']) }}
<div class="modal-body">

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('branch_id', __('Branch'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    {{ Form::select('branch_id', $branch, null, ['class' => 'form-control select2 ','placeholder' => __('Select Branch')]) }}
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Department Name')]) }}
                </div>
                @error('name')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('status', __('status'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    <select name="status" id="status" class="form-control">
                        <option @if($department->status == 'Active') selected @else @endif value="Active">Active</option>
                        <option @if($department->status == 'In-Active') selected @else @endif value="In-Active">In-Active</option>
                    </select>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update') }}" class="btn btn-primary">
</div>
{{ Form::close() }}
