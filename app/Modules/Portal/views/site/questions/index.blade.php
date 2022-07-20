@extends('site.layout.index')

@section('title', _i('Quiz'))

@section('content')

    @include('site.includes.sessions')

    <?php
    $images = \App\Bll\Site::get_default_images();
    $settings = \App\Bll\Site::getSettings();
    $site_settings = \App\Bll\Site::getSettingsData();

    ?>
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>{{ _i('Befor Quiz') }}</p>
            </header>

            <div class="row gy-4">

                <div class="col-lg-6">

                    <h4>{{ $question_details->title }}</h4>
                    <p>{{ $question_details->description }}</p>
                </div>

                <div class="col-lg-6 quiz">
                    <form action="{{ route('quiz.store') }}" method="post" id="quiz">
                        @csrf
                        <div class="row gy-4">

                            @foreach ($test as $question)
                                <div class="question">
                                    <input type="hidden" name="question_id[]" value="{{ $question->id }}">
                                    <div class="col-md-12">
                                        <input type="text"
                                            value="{{ $question->data->isNotEmpty() ? $question->data->first()->title : '' }}"
                                            class="form-control" disabled>
                                    </div><br>
                                    <div class="col-md-12">
                                        <label for="true">{{ _i('True') }}</label>
                                        <input type="checkbox" style="float:right" name="true[]">
                                        <label for="false" style="float:left">{{ _i('False') }}</label>
                                        <input type="checkbox" style="float:left" name="false[]">
                                    </div>
                                </div>
                            @endforeach

<<<<<<< HEAD
                            <div class="col-md-12 text-center">
                                <button  class="btn btn-primary next" style="float:left">{{ _i('Next') }}</button>
                                <button class="btn btn-primary prev" style="float:right">{{ _i('Previous') }}</button>
                            </div>
=======
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary next" type="submit" style="float:left">{{ _i('Next') }}</button>
                                    <button class="btn btn-primary prev" style="float:right">{{ _i('Previous') }}</button>
                                </div>
>>>>>>> 41c505466b9425c468f07011e43248306bbd6640

                        </div>
                    </form>

                </div>

            </div>

        </div>

    </section><!-- End Contact Section -->



@endsection
@push('js')
   <script>
        $(document).ready(function() {
            $('.question').hide()

            $question_shown = $('.question').first().show();

<<<<<<< HEAD
            $('.next').click(function(e) {
                e.preventDefault()
=======
            $('.next').click(function () {
                // e.preventDefault()
>>>>>>> 41c505466b9425c468f07011e43248306bbd6640
                $('.question').hide()
                $question_shown = $question_shown.next().show();
            });

            $('.prev').click(function(e) {
                e.preventDefault()
                $('.question').hide()
                $question_shown = $question_shown.prev().show();

            });

        });


        $('body').on('submit', '#quiz', function(e) {
            e.preventDefault();
            alert('test')
            let url = $(this).attr('action');
            $.ajax({
                url: url,
                method: "post",
                "_token": "{{ csrf_token() }}",
                data: new FormData(this),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.errors) {
                        $('#masages_model').empty();
                        $.each(response.errors, function(index, value) {
                            $('#masages_model').show();
                            $('#masages_model').append(value + "<br>");
                        });
                    }
                    if (response == 'SUCCESS') {
                        new Noty({
                            type: 'success',
                            layout: 'topRight',
                            text: "{{ _i('Translated Successfully') }}",
                            timeout: 2000,
                            killer: true
                        }).show();
                        $('.modal.modal_create').modal('hide');
                    }
                },
            });
        });
    </script>
@endpush
