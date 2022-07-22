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
                @foreach( $modules->interModule as $inter)

                    <h1 data-aos="fade-up">{{ $inter->Data->isNotEmpty() ? $modules->Data->first()->title : '' }}</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">{!! $inter->Data->isNotEmpty() ? $modules->Data->first()->body : '' !!}</h2>
                @endforeach
                <div data-aos="fade-up" data-aos-delay="600">
                    {{--  <div class="text-center text-lg-start">
                      <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                        <span>Get Started</span>
                        <i class="bi bi-arrow-right"></i>
                      </a>
                    </div>  --}}
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{ asset($inter ? $inter->first()->image : '') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>


