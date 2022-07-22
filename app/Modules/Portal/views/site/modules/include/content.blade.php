
<style>
    .nav-pills-custom .nav-vertical {
        color: #aaa;
        background: #fff;
        position: relative;
    }

    .nav-pills-custom .nav-vertical:active {
        color: #4154f1!important;
        background: #fff;
    }


    /* Add indicator arrow for the active tab */
    @media (min-width: 992px) {
        .nav-pills-custom .nav-link::before {
            content: '';
            display: block;
            border-top: 8px solid transparent;
            border-left: 10px solid #fff;
            border-bottom: 8px solid transparent;
            position: absolute;
            top: 50%;
            right: -10px;
            transform: translateY(-50%);
            opacity: 0;
        }
    }

    .nav-pills-custom .nav-link.active::before {
        opacity: 1;
    }

    .fade:not(.show) {
         opacity: 1 !important;
    }


    .floatingButtonWrap {
        display: block;
        position: fixed;
        bottom: 45px;
        left: 45px;
        z-index: 999999999;
    }

    .floatingButtonInner {
        position: relative;
    }

    .floatingButton {
        display: block;
        width: 60px;
        height: 60px;
        text-align: center;
        background: -webkit-linear-gradient(45deg, #8769a9, #507cb3);
        background: -o-linear-gradient(45deg, #8769a9, #507cb3);
        background: linear-gradient(45deg, #8769a9, #507cb3);
        color: #fff;
        line-height: 50px;
        position: absolute;
        border-radius: 50% 50%;
        bottom: 0px;
        left: 0px;
        border: 5px solid #b2bedc;
        /* opacity: 0.3; */
        opacity: 1;
        transition: all 0.4s;
    }

    .floatingButton .fa {
        font-size: 15px !important;
    }

    .floatingButton.open,
    .floatingButton:hover,
    .floatingButton:focus,
    .floatingButton:active {
        opacity: 1;
        color: #fff;
    }


    .floatingButton .fa {
        transform: rotate(0deg);
        transition: all 0.4s;
    }

    .floatingButton.open .fa {
        transform: rotate(270deg);
    }

    .floatingMenu {
        position: absolute;
        bottom: 46px;
        left: 0px;
        /* width: 200px; */
        display: none;
    }

    .floatingMenu li {
        width: 100%;
        float: right;
        list-style: none;
        text-align: right;
        margin-bottom: 0px;
    }

    .floatingMenu li a {
        padding: 4px 15px;
        display: inline-block;
        background: #ccd7f5;
        color: #6077b0;
        border-radius: 5px;
        overflow: hidden;
        white-space: nowrap;
        transition: all 0.4s;
        /* -webkit-box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.22);
        box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.22); */
        -webkit-box-shadow: 1px 3px 5px rgba(211, 224, 255, 0.5);
        box-shadow: 1px 3px 5px rgba(211, 224, 255, 0.5);
    }

    .floatingMenu li a:hover {
        margin-right: 10px;
        text-decoration: none;
    }


</style>


    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach($contents as $content)
                    <a class="nav-link nav-vertical mb-3 p-3 shadow" id="#{{$content->id}}" data-toggle="pill" href="#{{$content->id}}" >
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">{{$content->title}}</span></a>
                        @endforeach
                </div>
            </div>


            <div class="col-md-9">
                <!-- Tabs content -->
                <div class="tab-content tab-content-vertical" id="v-pills-tabContent">
                    @foreach($contents as $content)
                    <div class="tab-pane fade shadow rounded bg-white show p-3" id="{{$content->id}}">
                        {{--<iframe width="600" height="400" src="{{ $content->video }}" frameborder="0" allowfullscreen>--}}
                        {{--</iframe>--}}

                        <video id="my-video" class="video-js" controls preload="auto" width="200" height="100" data-setup="{}">
                            <source src="{{ $content->video }}" type='video/mp4'>
                        </video>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>


    </div>


<div class="floatingButtonWrap">
    <div class="floatingButtonInner">
        <a href="#" class="floatingButton">
           {{_i('help')}}
        </a>
        <ul class="floatingMenu">
            <li>
                <a href="#">{{_i('Video')}}</a>
            </li>
            <li>
                <a href="#">{{_i('Images')}}</a>
            </li>
            <li>
                <a href="#">{{_i('Teaching')}}</a>
            </li>


        </ul>
    </div>
</div>

