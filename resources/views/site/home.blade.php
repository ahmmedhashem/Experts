@extends('layouts.site')

@section('content')
<div class="app-content content" style="margin-right: 0">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-2">
                <h3 class="content-header-title text-center"> تحليل أدوار ومسؤوليات اصحاب العلاقة بالمواد الخطره</h3>

            </div>
        </div>
        <div class="content-body">

            <form id="form_data" class="form" action="{{ route('search.data') }}" method="GET"
            enctype="multipart/form-data">
            @csrf
                <div class="form-body">
                    <h4 class="form-section"><i class="ft-home"></i> البيانات</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="projectinput1"> المعيار الرئيسي
                                </label>
                                <select id="criterychange" name="criteria_id" class="select2 form-control">
                                    <optgroup label="من فضلك اختر المعيار الرئيسي">
                                        <option value="" selected>--اختر--</option>
                                        @if(isset($main_criteria) && $main_criteria -> count() > 0)
                                            @foreach($main_criteria as $criteria)
                                                <option
                                                    value="{{$criteria -> id }}">{{$criteria -> name}}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                </select>
                                @error('criteria_id')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div id="activity_row" class="col-md-3" >
                            <div  class="form-group" >
                                <label for="projectinput1"> النشاط
                                </label>
                                <select id="activities" name="activity_id" class="select2 form-control">
                                    <optgroup label="من فضلك اختر النشاط">
                                        <option value="" selected>--اختر--</option>
                                        @if(isset($activities) && $activities -> count() > 0)
                                            @foreach($activities as $activity)
                                                <option
                                                    value="{{$activity -> id }}">{{$activity -> name}}</option>
                                            @endforeach
                                        @endif

                                    </optgroup>
                                </select>
                                @error('activity_id')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="projectinput1"> القاعده
                                </label>
                                <select id="rulechange" name="rule_id" class="select2 form-control">
                                    <optgroup label="من فضلك اختر القاعده">
                                        <option value="" selected>--اختر--</option>
                                        @if(isset($rules) && $rules -> count() > 0)
                                            @foreach($rules as $rule)
                                                <option
                                                    value="{{$rule -> id }}">{{$rule -> name}}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                </select>
                                @error('rule_id')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button id="search_data" type="submit" class="btn btn-primary searchbutton">
                                    <i class="la la-check-square-o"></i>بحث
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>



            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">جميع البيانات</h4>
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
                                <div class="card-body card-dashboard">
                                    {{-- scroll-horizontal class to make table scroll --}}
                                    <table
                                        class="table display nowrap table-striped table-bordered user-table ">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>المعيار الرئيسي</th>
                                            <th> النشاط</th>
                                            <th> القاعده</th>
                                            <th> المهمه</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @isset($datas)
                                                @foreach ($datas as $data)
                                                    <tr>
                                                        <td>{{ $data -> id }} </td>
                                                        <td>{{ $data -> name }} </td>
                                                        <td>{{ $data -> activity -> criteria -> name }} </td>
                                                        <td>{{ $data -> activity -> name }} </td>
                                                        <td>{{ $data -> mission -> rule -> name }} </td>
                                                        <td>{{ $data -> mission -> name }} </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">
                                        {!! $datas -> links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('table').DataTable()
    </script>
   <script>
    $(document).ready(function () {
        $('#criterychange').on('change', function () {

            var critery = this.value;
            // if(critery != ''){
            //     $('#activity_row').show();
            // }else{
            //     $('#activity_row').css('display', 'none');
            // }

            $("#activities").html('');
            $.ajax({
                url: "{{route('user.get.activities.criteria')}}",
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

    });
</script>
@endsection

