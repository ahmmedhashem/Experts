@extends('layouts.admin')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Main </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}"> Categories </a>
                            </li>
                            <li class="breadcrumb-item active">Add new category
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
                                <h4 class="card-title" id="basic-layout-form">Add new category </h4>
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
                                    <form class="form" action="{{ route('admin.store.category') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> Category Data</h4>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Name</label>
                                                        <input type="text" value="" id="name"
                                                            class="form-control"
                                                            placeholder="Please enter category name"
                                                            name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{ $message }} </span>
                                                            @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group mt-1">
                                                        <input type="radio"
                                                               name="type"
                                                               value="1"
                                                               checked
                                                               class="switchery"
                                                               data-color="success"/>
                                                        <label
                                                            class="card-title ml-1">
                                                            Main Category
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mt-1">
                                                        <input type="radio"
                                                               name="type"
                                                               value="2"
                                                               class="switchery" data-color="success"/>
                                                        <label
                                                            class="card-title ml-1">
                                                            Sub Category
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row hidden" id="mainCat">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput2">Choose Category</label>
                                                        <select name="parent_id" class="select2 form-control">
                                                            <optgroup label="Please choose parent category">
                                                                <option value="" selected>--choose--</option>
                                                                @if($categories && $categories -> count() > 0)
                                                                    @foreach($categories as $category)
                                                                        <option value="{{$category -> id }}">{{$category -> name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('parent_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox"  value="1" name="is_active"
                                                            id="switcheryColor4"
                                                            class="switchery" data-color="success"
                                                            checked/>
                                                        <label for="switcheryColor4"
                                                            class="card-title ml-1">Status</label>

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
                                                <i class="ft-x"></i> back
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i>save
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
        $('input:radio[name="type"]').change(
            function(){
                if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
                    $('#mainCat').removeClass('hidden');
                }else{
                    $('#mainCat').addClass('hidden');
                }
            });
    </script>
@stop
