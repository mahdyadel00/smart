@extends('admin.layout.index',[
'title' => _i('Edit Modules'),
'subtitle' => _i('Edit Modules'),
'activePageName' => _i('Edit Modules'),
'activePageUrl' => '',
'additionalPageUrl' => route('modules.index') ,
'additionalPageName' => _i('All'),
] )

@section('content')
    <div class="page-header">
        <div class="page-header-title">
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('modules.index') }}">{{ _i('Modules') }}</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Page-header end -->
    <!-- Page-body start -->
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
                @include('admin.layout.swal')
                <form method='post' action="{{ route('modules.update', $module->id) }}" class='form-group' data-parsley-validate>
                    @csrf
                    @method('POST')
                    <!-- ---------------------------------------------** checkbox Published ** -------------------------------------------------------------- -->

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label" for="checkbox">
                            {{ _i('Published') }}
                        </label>
                        <div class="checkbox-fade fade-in-primary col-sm-6">
                            <label>
                                <input type="checkbox" id="checkbox" name="published" value="1"
                                    {{ $module->published == 1 ? 'checked' : '' }}>
                                <span class="cr">
                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- ---------------------------------------------** Title ** -------------------------------------------------------------- -->

                     <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> {{ _i('Title') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class='form-control' value='{{ $module_data->title }}'>
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                      <!-- ---------------------------------------------** Group Module ** -------------------------------------------------------------- -->

                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> {{ _i('Group Module') }} <span
                                style="color: #F00;">*</span></label>
                        <div class="col-sm-10">
                            <select name="group_module_id" id="group_module_id" class="form-control">
                                <option value="0">{{ _i('Select Group Module') }}</option>
                                @foreach($group_module as $group)
                                <option value="{{ $group->id }}">{{ $group->title }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- ---------------------------------------------** Body ** -------------------------------------------------------------- -->

                     <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> {{ _i('Body') }}</label>
                        <div class="col-sm-10">
                            <textarea name="body" id="" cols="30" rows="10" class="form-control ckeditor">{!! $module_data->body !!}</textarea>
                            @if ($errors->has('body'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-offset-2 col-sm-2">
                            <button type="submit" class="btn btn-primary pull-leftt"> {{ _i('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

