@extends('admin.layout.index',[
'title' => _i('Edit QuizModule'),
'subtitle' => _i('Edit QuizModule'),
'activePageName' => _i('Edit QuizModule'),
'activePageUrl' => '',
'additionalPageUrl' => route('activity_modules.index') ,
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
                <li class="breadcrumb-item"><a href="{{ route('activity_modules.index') }}">{{ _i('ActivityModule') }}</a>
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
                <form method='post' action="{{ route('activity_modules.update', $avtivity_module->id) }}" class='form-group' data-parsley-validate>
                    @csrf
                    @method('POST')

                    <!-- ---------------------------------------------** Title ** -------------------------------------------------------------- -->

                     <div class="form-group row">
                        <label for="name" class="col-sm-1 col-form-label"> {{ _i('Title') }}</label>
                        <div class="col-sm-11">
                            <input type="text" name="title" class='form-control' value='{{ $avtivity_module_data->title }}'>
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                    <!-- ---------------------------------------------** Description ** -------------------------------------------------------------- -->

                     <div class="form-group row">
                        <label for="name" class="col-sm-1 col-form-label"> {{ _i('Description') }}</label>
                        <div class="col-sm-11">
                            <textarea type="text" name="description" class='form-control'>{{ $avtivity_module_data->description }}</textarea>
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                    <!-- ---------------------------------------------** checkbox Published ** -------------------------------------------------------------- -->

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label" for="checkbox">
                            {{ _i('Published') }}
                        </label>
                        <div class="checkbox-fade fade-in-primary col-sm-6">
                            <label>
                                <input type="checkbox" id="checkbox" name="published" value="1"
                                    {{ $avtivity_module->published == 1 ? 'checked' : '' }}>
                                <span class="cr">
                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
                            </label>
                        </div>
                    </div>
                     <!-- ---------------------------------------------** checkbox Answer ** -------------------------------------------------------------- -->
                     <div class="form-group row">
                        <label class="col-sm-1 col-form-label" for="checkbox">
                            {{ _i('Answer') }}
                        </label>
                        <div class="checkbox-fade fade-in-primary col-sm-6">
                            <label>
                                <input type="checkbox" id="checkbox" name="answer" value="1"
                                    {{ $avtivity_module_data->answer == 1 ? 'checked' : '' }}>
                                <span class="cr">
                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
                            </label>
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

