@extends('admin.layout.index',[
'title' => _i('All Insturctions'),
'activePageName' => _i('All Insturctions'),
'activePageUrl' => '',
'additionalPageUrl' => route('insturctions.index') ,
'additionalPageName' => _i('All'),
] )

@section('content')
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
                @include('admin.layout.swal')
                <form method='post' action="{{ route('insturctions.store') }}" class='form-group' data-parsley-validate enctype="multipart/form-data">
                    @csrf
                   
                    <!-- ---------------------------------------------** Title ** -------------------------------------------------------------- -->
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> {{ _i('Title') }} <span
                                style="color: #F00;">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class='form-control'>
                            @if ($errors->has('title'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>  
                    <!-- ---------------------------------------------** Module ** -------------------------------------------------------------- -->
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> {{ _i('Modules') }} <span
                                style="color: #F00;">*</span></label>
                        <div class="col-sm-10">
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
                    <!-- ---------------------------------------------** Image ** -------------------------------------------------------------- -->
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> {{ _i('Image') }} <span
                                style="color: #F00;">*</span></label>
                        <div class="col-sm-10">
                            <input type="file" name="image" class='form-control'>
                            @if ($errors->has('image'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- ---------------------------------------------** checkbox Status ** -------------------------------------------------------------- -->
                    <!-- <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="checkbox">
                            {{ _i('Status') }}
                        </label>
                        <div class="checkbox-fade fade-in-primary col-sm-6">
                            <label>
                                <input type="checkbox" id="checkbox" name="status" value="1">
                                <span class="cr">
                                    <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                </span>
                            </label>
                        </div>
                    </div> -->
                                  
                    <div class="form-group row">
                        <div class="col-sm-offset-2 col-sm-2">
                            <button type="submit" class="btn btn-primary pull-leftt"> {{ _i('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
