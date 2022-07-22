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
                @foreach( $insturcation_modules as $inst)

                    <h1 data-aos="fade-up">{{ $inst->Data ? $inst->Data->first()->title : '' }}</h1>
                @endforeach
                <div data-aos="fade-up" data-aos-delay="600">
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{ asset($inst ? $inst->first()->image : '') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>

