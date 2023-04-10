{{ Form::open(['url' => 'branch', 'method' => 'post']) }}
<div class="modal-body model-lg">

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('name', __('Country'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    <select name="country_name" id="country_name" class="form-control">
                        <option value="India">India</option>
                    </select>
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
                {{ Form::label('name', __('State'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    <select name="state_name" id="state_name" required class="form-control">
                        <option value="">Please select State</option>
                        @foreach ($state as $st)
                            <option value="{{ $st->state_id }}">{{ $st->state_title}}</option>
                        @endforeach
                    </select>
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
                {{ Form::label('name', __('District'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    <select name="district_name" id="district_name" required class="form-control">
                        <option value="" >Please select district</option>
                    </select>
                </div>
                @error('name')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        {{-- //district_name  --}}
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('name', __('City'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    <select name="city_name" id="city_name" required class="form-control">
                        <option value="">Please select city</option>
                    </select>
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('name', __('Zip Code *'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    {{ Form::text('zip_code', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter zip code')]) }}
                </div>

            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required','placeholder' => __('Enter Branch Name')]) }}
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                {{ Form::label('name', __('Address'), ['class' => 'form-label']) }}
                <div class="form-icon-user">
                    {{ Form::text('address', null, ['class' => 'form-control', 'required' => 'required','placeholder' => __('Enter Branch Address')]) }}
                </div>
            </div>
        </div>



    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn btn-primary">
</div>


{{ Form::close() }}

<script>



$( document ).ready(function() {

    $("#state_name").change(function () {
        $.ajax({
               type: "get",
               url:"{{ url('getdistict') }}"+'/'+this.value,
               success: function (data)
                {
                    var options =  '<option value="">Please select District</option>';
                    $.each(data, function(index, object) {
                        options += '<option value="' + object.districtid + '">' + object.district_title + '</option>';
                    });
                    $('#district_name').html(options);
                },
                error: function (data) {
                        console.log('Error:', data);
                }
           });
    });
    //get City
    $("#district_name").change(function () {
        $.ajax({
               type: "get",
               url:"{{ url('getcities') }}"+'/'+this.value,
               success: function (data)
                {
                    var options =  '<option value="">Please select City</option>';
                    $.each(data, function(index, object) {
                        console.log(object);
                        options += '<option value="' + object.name + '">' + object.name + '</option>';
                    });
                    $('#city_name').html(options);
                },
                error: function (data) {
                        console.log('Error:', data);
                }
           });
    });

});
</script>
