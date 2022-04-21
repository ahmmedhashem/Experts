@extends('layouts.site')

@section('content')
<div class="app-content content" style="margin-left: 0" >
    <div class="content-wrapper">
        <div class="content-header text-center" style="margin-bottom: 20px">
            <div class="breadcrumbs-top">
                <div class="breadcrumb-wrapper">
                    <h3 >Experts Pool For Hazardous Material & CBRNe</h3>
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
                                          action="{{route('store.data.step.one')}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> Expert Data  </h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Title
                                                        </label>
                                                        <select name="type" class="select2 form-control">
                                                            <optgroup label="Choose Title">
                                                                <option value="" selected>--Choose--</option>
                                                                <option value="1">Mr</option>
                                                                <option value="2">Ms</option>
                                                            </optgroup>
                                                        </select>
                                                        @error('type')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Gender
                                                        </label>
                                                        <select name="gender" class="select2 form-control">
                                                            <optgroup label="Choose Title">
                                                                <option value="" selected>--Choose--</option>
                                                                <option value="1">Male</option>
                                                                <option value="2">Female</option>
                                                            </optgroup>
                                                        </select>
                                                        @error('gender')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Name
                                                        </label>
                                                        <input type="text" id="name"
                                                               class="form-control"
                                                               placeholder="Please enter your name"
                                                               value="{{old('name')}}"
                                                               name="name">
                                                        @error("name")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Nationality
                                                        </label>
                                                        <select name="nationality_id" class="select2 form-control">
                                                            <optgroup label="Choose Nationality ">
                                                                <option value="" selected>--Choose--</option>
                                                                @if($nationalities && $nationalities -> count() > 0)
                                                                    @foreach($nationalities as $nationality)
                                                                        <option
                                                                            value="{{$nationality -> id }}">{{$nationality -> nationality}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('nationality_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Phone
                                                        </label>
                                                        <input type="text" id="phone"
                                                               class="form-control"
                                                               placeholder="Please enter your phone"
                                                               value="{{old('phone')}}"
                                                               name="phone">
                                                        @error("phone")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Alternative Phone
                                                        </label>
                                                        <input type="text" id="alt_phone"
                                                               class="form-control"
                                                               placeholder="Please enter your phone"
                                                               value="{{old('alt_phone')}}"
                                                               name="alt_phone">
                                                        @error("alt_phone")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Current Position
                                                        </label>
                                                        <input type="text" id="current_location"
                                                               class="form-control"
                                                               placeholder="Please enter your current position"
                                                               value="{{old('current_location')}}"
                                                               name="current_location">
                                                        @error("current_location")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Institution
                                                        </label>
                                                        <input type="text" id="institution"
                                                               class="form-control"
                                                               placeholder="Please enter your phone"
                                                               value="{{old('institution')}}"
                                                               name="institution">
                                                        @error("institution")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Langauges
                                                        </label>
                                                        <select name="langauges[]" class="select2 form-control" multiple>
                                                            <optgroup label="Choose Langauge ">

                                                                @if($langauges && $langauges -> count() > 0)
                                                                    @foreach($langauges as $langauge)
                                                                        <option
                                                                            value="{{$langauge -> id }}">{{$langauge -> name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('langauges')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Are you willing to conduct studies & write report when requested?
                                                        </label>
                                                        <select name="willing_to_study" class="select2 form-control">
                                                            <optgroup label="Choose Title">
                                                                <option value="" selected>--Choose--</option>
                                                                <option value="1">yes</option>
                                                                <option value="2">no</option>
                                                            </optgroup>
                                                        </select>
                                                        @error('willing_to_study')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Are you willing to provide profissional & expert consultancy when requested?
                                                        </label>
                                                        <select name="willing_to_consultancy" class="select2 form-control">
                                                            <optgroup label="Choose Title">
                                                                <option value="" selected>--Choose--</option>
                                                                <option value="1">yes</option>
                                                                <option value="2">no</option>
                                                            </optgroup>
                                                        </select>
                                                        @error('willing_to_consultancy')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Availability to respond to request
                                                        </label>
                                                        <select name="available_to_request" class="select2 form-control">
                                                            <optgroup label="Choose Title">
                                                                <option value="" selected>--Choose--</option>
                                                                <option value="1">yes</option>
                                                                <option value="2">no</option>
                                                            </optgroup>
                                                        </select>
                                                        @error('available_to_request')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i>back
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
