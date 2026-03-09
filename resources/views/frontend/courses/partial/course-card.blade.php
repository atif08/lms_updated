

<div class="row">
    <div class="course-box course-design d-flex ">
        <div class="produc p-4 row">
            <div class="col-lg-3 col-md-4">
            <div class="product-img">
                <a href="{{ route('courses.get.details',$course->slug) }}">
                    <img class="img-fluid" alt=""
                         src="{{get_image($course->media)}}">
                </a>
{{--                <div class="price">--}}
{{--                    <h3>$300 <span>$99.00</span></h3>--}}
{{--                </div>--}}
            </div>
        </div>
    {{--            <div class="product-content">--}}
    {{--                <div class="course-group d-flex">--}}
    {{--                    <div class="course-group-img d-flex">--}}
    {{--                        <a href="#"><img src="{{get_image($course->teachers[0]->media??'')}}" alt="" class="img-fluid"></a>--}}
    {{--                        <div class="course-name">--}}
    {{--                            <h4><a href="#">--}}
    {{--                                    {{$course?->teachers[0]?->name ?? ''}}--}}
    {{--                                </a>--}}
    {{--                            </h4>--}}
    {{--                            <p>Instructor</p>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="course-share d-flex align-items-center justify-content-center">--}}
    {{--                                                                        <a href="#rate"><i class="fa-regular fa-heart"></i></a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    <div class="col-lg-9 col-md-8 d-flex align-items-center">
                <h3 class="title">
                    <a href="{{ route('courses.get.details',$course->slug) }}">{{$course->name}}</a>
                </h3>
            </div>
{{--                <div class="course-info d-flex align-items-center">--}}
{{--                    <div class="rating-img d-flex align-items-center">--}}
{{--                        <img src="{{ URL::asset('/frontend/img/icon/icon-01.svg') }}" alt="">--}}
{{--                        <p>{{count($course->topics)}} Topics</p>--}}
{{--                    </div>--}}
{{--                    <div class="course-view d-flex align-items-center">--}}
{{--                        <img src="{{ URL::asset('/frontend/img/icon/icon-02.svg') }}" alt="">--}}
{{--                        <p>9hr 30min</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="rating">--}}
{{--                    <i class="fas fa-star filled"></i>--}}
{{--                    <i class="fas fa-star filled"></i>--}}
{{--                    <i class="fas fa-star filled"></i>--}}
{{--                    <i class="fas fa-star filled"></i>--}}
{{--                    <i class="fas fa-star"></i>--}}
{{--                    <span class="d-inline-block average-rating"><span>4.0</span> (15)</span>--}}
{{--                </div>--}}
                @if(!$hide_enrolled)

                    @if (auth()->user()->enrolled_courses->contains($course->id))
                        <div class="all-btn all-category d-flex align-items-center pt-4">
                        <button type="button" disabled class="btn btn-primary">Enrolled</button>
                        </div>
                    @else
                        <div class="all-btn all-category d-flex align-items-center pt-4">
                            <a href="{{route('courses.user.enroll',['course'=>$course->id,'user'=>auth()->user()->id])}}"
                               class="btn btn-primary">Enroll Now
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
