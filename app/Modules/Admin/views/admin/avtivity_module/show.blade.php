@extends('admin.layout.index',[
'title' => _i('View QuizModule'),
'subtitle' => _i('View QuizModule'),
'activePageName' => _i('View QuizModule'),
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
                <form method='post' action="#" class='form-group' data-parsley-validate >
                  

                    <!-- ---------------------------------------------** Title ** -------------------------------------------------------------- -->

                     <div class="form-group row">
                        <label for="name" class="col-sm-1 col-form-label"> {{ _i('Title') }}</label>
                        <div class="col-sm-11">
                        @if($avtivity_module_upload)

                            <div class="download-catalog mt-3">
                            <a href="{{asset($avtivity_module_upload->link)}}" class="d-flex justify-content-between align-items-center btn btn-primary" download="">
                            <p>
                            <img src="{{$avtivity_module_upload->link}}" alt="" class="img-fluid " loading="lazy">
                            {{_i('Download File')}}
                            </p>
                            <i class="fas fa-download"></i>
                            </a>
                            </div>
                        @endif
                        </div>
                    </div> 
                </form>
            </div>
        </div>
    </div>
@endsection

