@extends('admin.layout.index',[
'title' => _i('Edit Content Module'),
'subtitle' => _i('Edit Content Module'),
'activePageName' => _i('Edit Content Module'),
'activePageUrl' => '',
'additionalPageUrl' => route('content_modules.index') ,
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
                <li class="breadcrumb-item"><a href="{{ route('content_modules.index') }}">{{ _i('Content Module') }}</a>
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
                <form method='post' action="{{ route('content_modules.update', $content_module->id) }}" class='form-group' data-parsley-validate enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <!-- ---------------------------------------------** Title ** -------------------------------------------------------------- -->

                     <div class="form-group row">
                        <label for="name" class="col-sm-1 col-form-label"> {{ _i('Goal') }}</label>
                        <div class="col-sm-11">
                            <input type="text" name="title" class='form-control' value='{{ $content_module->title }}'>
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                     <!-- ---------------------------------------------** Module ** -------------------------------------------------------------- -->
                    
                     <div class="form-group row">
                        <label for="name" class="col-sm-1 col-form-label"> {{ _i('Modules') }} <span
                                style="color: #F00;">*</span></label>
                        <div class="col-sm-11">
                            <select name="module_id" id="module_id" class="form-control">
                                <option value="0">{{ _i('Select Module') }}</option>
                                @foreach($modules as $module)
                                <option value="{{ $module->id }}">{{ $module->Data->isNotEmpty() ? $module->Data->first()->title : '' }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('description'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!-- ---------------------------------------------** Video ** -------------------------------------------------------------- -->
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-1 col-form-label"> {{ _i('Video') }} <span
                                style="color: #F00;">*</span></label>
                        <div class="col-sm-11">
                            <input type="file" name="video" class='form-control'>
                            @if ($errors->has('video'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('video') }}</strong>
                                </span>
                            @endif
                            
                        <video width="320" height="240" controls>
                             <source src="{{URL::asset("$content_module->video")}}" type="video/mp4">
                                 Your browser does not support the video tag.
                         </video>
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

