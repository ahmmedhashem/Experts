@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الصفحه الرئسيه</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.data') }}"> البيانات </a>
                            </li>
                            <li class="breadcrumb-item active">تعديل البيانات
                            </li>
                        </ol>
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
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">تعديل البيانات  </h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" action="{{ route('admin.update.data',$data -> id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ $data -> id }}">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> البيانات</h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> المعيار الرئيسي
                                                        </label>
                                                        <select id="criterychange" name="criteria_id" class="select2 form-control">
                                                            <optgroup label="من فضلك اختر المعيار الرئيسي">
                                                                <option value="" selected>--اختر--</option>
                                                                @if(isset($main_criteria) && $main_criteria -> count() > 0)
                                                                    @foreach($main_criteria as $criteria)
                                                                        <option
                                                                            value="{{$criteria -> id }}" @if($criteria -> id == $data -> activity -> criteria -> id) selected @endif>{{$criteria -> name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('criteria_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div id="activity_row" class="form-group">
                                                        <label for="projectinput1"> النشاط
                                                        </label>
                                                        <select id="activities" name="activity_id" class="select2 form-control">
                                                            <optgroup label="من فضلك اختر النشاط">
                                                                <option value="" selected>--اختر--</option>
                                                                @if(isset($activities) && $activities -> count() > 0)
                                                                    @foreach($activities as $activity)
                                                                        <option
                                                                            value="{{$activity -> id }}" @if($activity -> id == $data -> activity -> id) selected @endif>{{$activity -> name}}</option>
                                                                    @endforeach
                                                                @endif

                                                            </optgroup>
                                                        </select>
                                                        @error('activity_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> القاعده
                                                        </label>
                                                        <select id="rulechange" name="rule_id" class="select2 form-control">
                                                            <optgroup label="من فضلك اختر القاعده">
                                                                <option value="" selected>--اختر--</option>
                                                                @if(isset($rules) && $rules -> count() > 0)
                                                                    @foreach($rules as $rule)
                                                                        <option
                                                                            value="{{$rule -> id }}" @if($rule -> id == $data -> mission -> rule -> id) selected @endif>{{$rule -> name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('rule_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div id="mission_row" class="form-group">
                                                        <label for="projectinput1"> المهمه
                                                        </label>
                                                        <select id="missionss" name="mission_id" class="select2 form-control">
                                                            <optgroup label="من فضلك اختر المهمه">
                                                                <option value="" selected>--اختر--</option>
                                                                @if(isset($missions) && $missions -> count() > 0)
                                                                    @foreach($missions as $mission)
                                                                        <option
                                                                            value="{{$mission -> id }}" @if($mission -> id == $data -> mission -> id) selected @endif>{{$mission -> name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('mission_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الاسم</label>
                                                        <input type="text" value="{{ $data -> name }}" id="name"
                                                            class="form-control"
                                                            placeholder="من فضلك ادخل الاسم "
                                                            name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{ $message }} </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox"  value="1" name="is_active"
                                                            id="switcheryColor4"
                                                            class="switchery" data-color="success"
                                                            @if($data -> is_active == true ) checked @endif/>
                                                        <label for="switcheryColor4"
                                                            class="card-title ml-1">الحاله</label>

                                                            @error("is_active")
                                                            <span class="text-danger">{{ $message }} </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i>حفظ
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
        $('#criterychange').on('change', function () {

            var critery = this.value;
            if(critery != ''){
                $('#activity_row').css('visibility', 'visible');
            }else{
                $('#activity_row').css('visibility', 'hidden');
            }

            $("#activities").html('');
            $.ajax({
                url: "{{route('get.activities.criteria')}}",
                type: "POST",
                data: {
                    criteria_id: critery,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#activities').html('<option value="">اختر النشاط</option>');
                    $.each(res.activities, function (key, value) {
                        $("#activities").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
        //////////////////////////////////
        $('#rulechange').on('change', function () {

            var rule = this.value;
            if(rule != ''){
                $('#mission_row').css('visibility', 'visible');
            }else{
                $('#mission_row').css('visibility', 'hidden');
            }

            $("#missionss").html('');
            $.ajax({
                url: "{{route('get.missions.rule')}}",
                type: "POST",
                data: {
                    rule_id: rule,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#missionss').html('<option value="">اختر المهمه</option>');
                    $.each(res.missions, function (key, value) {
                        $("#missionss").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
</script>
@stop
