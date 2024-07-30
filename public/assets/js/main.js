// project Filter
if ($('.filter-button-group button').length) {
    var projectfiler = $('.filter-button-group button');
    if (projectfiler.length) {
        $('.filter-button-group button').on('click', function (event) {
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
            event.preventDefault();
        });
    }
}

let defaults = {
    spaceBetween: 5,
    slidesPerView: 1
};

initSwipers(defaults);

function initSwipers(defaults = {}, selector = ".swiper") {
    let swipers = document.querySelectorAll(selector);
    swipers.forEach((swiper) => {
        // get options
        let optionsData = swiper.dataset.swiper
            ? JSON.parse(swiper.dataset.swiper)
            : {};

        let options = {
            ...defaults,
            ...optionsData
        };

        // init
        new Swiper(swiper, options);
    });
}