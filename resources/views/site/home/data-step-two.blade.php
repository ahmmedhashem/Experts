@extends('layouts.site')

@section('content')
<div class="app-content content" style="margin-left: 0">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="content-header text-center" style="margin-bottom: 20px">
                <div class="breadcrumbs-top">
                    <div class="breadcrumb-wrapper">
                        <h3 >Experts Pool For Hazardous Material & CBRNe</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form"
                                          action="{{route('store.data.step.two')}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> Experts Education & Area Of Expertise & Experience</h4>
                                            <div class="card">
                                                <div class="card-header" style="background-color: #EEE;padding: 10px 20px;">
                                                    <h3>Education</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> Education Name
                                                                </label>
                                                                <input type="text" id="edu_name"
                                                                       class="form-control"
                                                                       placeholder="Please enter education name"
                                                                       value="{{old('edu_name')}}"
                                                                       name="edu_name">
                                                                @error("edu_name")
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> Country
                                                                </label>
                                                                <select name="country_id" class="select2 form-control">
                                                                    <optgroup label="Choose Country ">
                                                                        <option value="" selected>--Choose--</option>
                                                                        @if($countries && $countries -> count() > 0)
                                                                            @foreach($countries as $country)
                                                                                <option
                                                                                    value="{{$country -> id }}">{{$country -> name}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </optgroup>
                                                                </select>
                                                                @error('country_id')
                                                                <span class="text-danger"> {{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" >
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> Start Date
                                                                </label>

                                                                <input type="date" id="start_date"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       value="{{old('start_date')}}"
                                                                       name="start_date">

                                                                @error('start_date')
                                                                <span class="text-danger"> {{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> End Date
                                                                </label>
                                                                <input type="date" id="end_date"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       value="{{old('end_date')}}"
                                                                       name="end_date">

                                                                @error('end_date')
                                                                <span class="text-danger"> {{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header" style="background-color: #EEE;padding: 10px 20px;">
                                                    <h3>Area Of Experinces</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> Area Of Experince
                                                                </label>
                                                                <select id="choosearea" name="experince_id" class="select2 form-control">
                                                                    <optgroup label="Choose Area ">
                                                                        <option value="" selected>--Choose--</option>
                                                                        @if($categories && $categories -> count() > 0)
                                                                            @foreach($categories as $category)
                                                                                <option
                                                                                    value="{{$category -> id }}">{{$category -> name}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </optgroup>
                                                                </select>
                                                                @error('experince_id')
                                                                <span class="text-danger"> {{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div id="showCategories" class="col-md-6" style="visibility: hidden">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> Categories
                                                                </label>
                                                                <select id="subcategories" name="sub_cats[]" class="select2 form-control" multiple>

                                                                </select>
                                                                @error('sub_cats')
                                                                <span class="text-danger"> {{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>





                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> back
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> next
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function () {
    $('#choosearea').on('change', function () {
        var main_cat = this.value;
        // $("#city-dd").html('');
        $.ajax({
            url: "{{route('get.sub.categories')}}",
            type: "POST",
            data: {
                main_cat: main_cat,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (res) {
                $('#showCategories').css('visibility','visible');
                $('#subcategories').html('<option value="">Select categories</option>');
                $.each(res.categories, function (key, value) {
                    $("#subcategories").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });
});
</script>
@endsection
