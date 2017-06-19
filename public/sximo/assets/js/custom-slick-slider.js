$('.top-nav-cities-filter').slick({
    slide: 'li',
    dots: false,
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    cssEase: 'ease-out',
    variableWidth: false,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
            }
        }
    ]
});
