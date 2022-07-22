{{--  <a class="go-top" href="#"><i class="fa fa-chevron-up"></i></a>
<script src="{{asset('site/js/jquery-3.3.1.min.js')}}"></script>
<script src="https://unpkg.com/counterup2@2.0.2/dist/index.js">	</script>
<!-- Custom js -->
<!-- Select 2 js -->
<script type="text/javascript" src="{{asset('AdminFlatAble/bower_components/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('custom/parsley.min.js') }}"></script>

@include('site.includes.js')

<script src="{{ asset('custom/notify/notify.min.js') }}"></script>
<script src="{{ asset('custom/notify/notify.js') }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('site/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('site/js/jquery.nice-select.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.0/jquery.waypoints.min.js"></script>
<script src="{{asset('site/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('site/js/slick.min.js')}}"></script>
<script src="{{asset('site/js/custom.js')}}"></script>
<script src="{{asset('site/js/backend.js')}}"></script> --}}

{{--@stack('js')--}}

<script src="{{ asset('site') }}/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="{{ asset('site') }}/vendor/purecounter/purecounter.js"></script>
<script src="{{ asset('site') }}/vendor/aos/aos.js"></script>
<script src="{{ asset('site') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('site') }}/vendor/glightbox/js/glightbox.min.js"></script>
<script src="{{ asset('site') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="{{ asset('site') }}/vendor/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('site') }}/vendor/php-email-form/validate.js"></script>
{{--  @include('site.includes.js')  --}}
<!-- Template Main JS File -->
<script src="{{ asset('site') }}/js/main.js"></script>


<script>
    $(document).ready(function(){
        $('.floatingButton').on('click',
            function(e){
                e.preventDefault();
                $(this).toggleClass('open');
                if($(this).children('.fa').hasClass('fa-plus'))
                {
                    $(this).children('.fa').removeClass('fa-plus');
                    $(this).children('.fa').addClass('fa-close');
                }
                else if ($(this).children('.fa').hasClass('fa-close'))
                {
                    $(this).children('.fa').removeClass('fa-close');
                    $(this).children('.fa').addClass('fa-plus');
                }
                $('.floatingMenu').stop().slideToggle();
            }
        );
        $(this).on('click', function(e) {

            var container = $(".floatingButton");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && $('.floatingButtonWrap').has(e.target).length === 0)
            {
                if(container.hasClass('open'))
                {
                    container.removeClass('open');
                }
                if (container.children('.fa').hasClass('fa-close'))
                {
                    container.children('.fa').removeClass('fa-close');
                    container.children('.fa').addClass('fa-plus');
                }
                $('.floatingMenu').hide();
            }

            // if the target of the click isn't the container and a descendant of the menu
            if(!container.is(e.target) && ($('.floatingMenu').has(e.target).length > 0))
            {
                $('.floatingButton').removeClass('open');
                $('.floatingMenu').stop().slideToggle();
            }
        });
    });
</script>
