@if ($model->images->count() > 0)
    <div class="carousel-container">
        <div @class([
            'carousel',
            'carousel-swiper' => $model->images->count() > 1,
            'swiper-container',
        ])>
            <div class="swiper-wrapper">
                @foreach ($model->images as $image)
                    <img class="carousel-image swiper-slide" src="{!! $image->present()->image(2880, 1920) !!}" width="1440" height="960" alt="" />
                @endforeach
            </div>
            @if ($model->images->count() > 1)
                <div class="carousel-button carousel-button-prev swiper-button-prev swiper-button-white"></div>
                <div class="carousel-button carousel-button-next swiper-button-next swiper-button-white"></div>
            @endif
        </div>
        @if ($model->images->count() > 1)
            <div class="carousel-pagination swiper-pagination"></div>
        @endif
    </div>
@endif

@push('js')
    <script type="module">
        new Swiper('.carousel-swiper', {
            loop: true,
            grabCursor: true,
            speed: 800,
            autoplay: {
                delay: 6000,
            },
            navigation: {
                prevEl: '.carousel-button-prev',
                nextEl: '.carousel-button-next',
            },
            pagination: {
                el: '.carousel-pagination',
                type: 'bullets',
                clickable: true,
            },
            // slidesPerView: 1,
            // allowTouchMove: true,
            // watchOverflow: true,
            // spaceBetween: 50,
            // breakpoints: {
            //   1100: {
            //     slidesPerView: 2,
            //   },
            // },
        });
    </script>
@endpush
