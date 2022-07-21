@extends('admin.layout.index', [
    'title' => _i('Add Help Modules'),
    'subtitle' => _i('Add Help Modules'),
    'activePageName' => _i('Add Help Modules'),
    'activePageUrl' => '',
    'additionalPageUrl' => route('help_module.index'),
    'additionalPageName' => _i('All'),
])

@section('content')
    <div class="page-body">
        <!-- Blog-card start -->
        <div class="card blog-page" id="blog">
            <div class="card-block">
                @include('admin.layout.swal')
                <form method='post' action="{{ route('help_module.store') }}" class='form-group' data-parsley-validate enctype="multipart/form-data">
                    @csrf
                    
                  
                    <!-- ---------------------------------------------** Modules ** -------------------------------------------------------------- -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="checkbox">
                            {{ _i('Modules') }}
                        </label>
                        <div class="checkbox-fade fade-in-primary col-sm-6">
                            <label>
                               <select name="module_id" id="module_id" class="form-control">
                                <option value="0">{{ _i('Select Module') }}</option>
                                   @foreach ($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->Data->isNotEmpty() ? $module->Data->first()->title : '' }}</option>
                                   @endforeach
                               </select>

                            </label>
                        </div>
                    </div>
                    <!-- ---------------------------------------------** Image ** -------------------------------------------------------------- -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="checkbox">
                            {{ _i('Image Module') }}
                        </label>
                        <div class="checkbox-fade fade-in-primary col-sm-6">
                            <label>
                                <input type="file" class="form-control modal-title" name='image'
                                accept="image/jpeg,image/jpg,image/png">
                            </label>
                        </div>
                    </div>
                      <!-- ---------------------------------------------** Video ** -------------------------------------------------------------- -->
                    
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> {{ _i('Video') }} <span
                                style="color: #F00;">*</span></label>
                        <div class="col-sm-10">
                            <input type="file" name="video" class='form-control'>
                            @if ($errors->has('video'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('video') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                      <!-- ---------------------------------------------** File ** -------------------------------------------------------------- -->
                    
                      <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> {{ _i('File') }} <span
                                style="color: #F00;">*</span></label>
                        <div class="col-sm-10">
                            <input type="file" name="file" class='form-control'>
                            @if ($errors->has('file'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


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
                    <!-- ---------------------------------------------** Description ** -------------------------------------------------------------- -->

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"> {{ _i('Description') }} <span
                                style="color: #F00;">*</span></label>
                        <div class="col-sm-10">
                           <textarea name="description" id="description" cols="30" rows="10" class="form-control ckeditor"></textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
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
    @endsection
