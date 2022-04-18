@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الصفحه الرئسيه </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.criteria') }}">الانشطه</a>
                            </li>
                            <li class="breadcrumb-item active">تعديل النشاط
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
                                <h4 class="card-title" id="basic-layout-form">تعديل النشاط </h4>
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
                                    <form class="form" action="{{ route('admin.update.activity',$activity -> id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ $activity -> id }}" >

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> البيانات</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الاسم</label>
                                                        <input type="text" value="{{ $activity -> name }}" id="name"
                                                            class="form-control"
                                                            placeholder=""
                                                            name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{ $message }} </span>
                                                            @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> المعيار الرئيسي
                                                        </label>
                                                        <select name="criteria_id" class="select2 form-control">
                                                            <optgroup label="من فضلك اختر المعيار الرئيسي">
                                                                <option value="">--اختر--</option>
                                                                @if(isset($main_criteria) && $main_criteria -> count() > 0)
                                                                    @foreach($main_criteria as $criteria)
                                                                        <option
                                                                            value="{{$criteria -> id }}" @if($criteria -> id == $activity -> criteria_id) selected @endif>{{$criteria -> name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('criteria_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox"  value="1" name="is_active"
                                                            id="switcheryColor4"
                                                            class="switchery" data-color="success"
                                                            @if ($activity -> is_active == 1) checked @endif />
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
                                                <i class="la la-check-square-o"></i>تحديث
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
