@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

<section id="hero" class="hero d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                @foreach( $activity_modules as $activity)

                    <h1 data-aos="fade-up">{{ $activity->Data ? $activity->Data->title : '' }}</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">{!! $activity->Data ? $activity->Data->description : '' !!}</h2>
                @endforeach
                <div data-aos="fade-up" data-aos-delay="600">
                    
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{ asset($activity ? $activity->first()->image : '') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
    
</section>
<div class="container">
    <div class="row">
        <form action="{{ route('file.upload.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input type="file" name="file" class="form-control">
                    <input type="hidden" name="id" value="{{ $modules->id }}">
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-success">{{ _i('Upload file') }}</button>
                </div>

            </div>
        </form>
    </div>
</div>


