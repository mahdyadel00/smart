@extends('site.layout.index')

@section('content')

    <section class="page-head" style="background-image: url('{{ asset('site/images/contact-head-img.jpg') }}');">
        <div class="container">
            <h3 class="page-title">{{ _i('Profile') }}</h3>
        </div>
    </section>

    @include('site.includes.sessions')
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>{{ _i('Profile') }}</p>
            </header>

            <div class="row gy-4">



                <div class="col-lg-12">
                    <form action="{{ route('profile.edit' , auth()->user()->id) }}" method="post">
                        @csrf
                        <div class="row gy-4">

                            <div class="col-md-10">
                                <label for="email">{{ _i('Name') }}</label>
                                <input type="text" class="form-control" name="name" placeholder="{{ _i('Name') }}" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="col-md-10">
                                <label for="email">{{ _i('LastName') }}</label>
                                <input type="text" class="form-control" name="lastname" placeholder="{{ _i('LasteName') }}" value="{{ auth()->user()->lastname }}">
                            </div>
                            <div class="col-md-10">
                                <label for="email">{{ _i('Email') }}</label>
                                <input type="email" class="form-control" name="email" placeholder="{{ _i('Email') }}" value="{{ auth()->user()->email }}">
                            </div>
                            <div class="col-md-10">
                                <label for="phone">{{ _i('MyPhone') }}</label>
                                <input type="number" class="form-control" name="phone" placeholder="{{ _i('MyPhone') }}" value="{{ auth()->user()->phone }}">
                            </div>

                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" type="submit">{{ _i('Save') }}</button>
                            </div>

                        </div>
                    </form>

                </div>

            </div>

        </div>

    </section><!-- End Contact Section -->
@endsection
