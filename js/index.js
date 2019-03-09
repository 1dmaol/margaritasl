$(function () {

    // Menu Responsive
    $(".menu-responsive").toggle();

    $(".menu-bars").on("click", function () {
        $(".menu-responsive").toggle("slow");
    });


    // Scroll click en el menu
    $(".scroll").on("click", function () {
        $(this).each(function () {
            const sectionTop = $(this.hash).offset().top;
            $("html, body").animate({
                scrollTop: sectionTop
            }, 1500);
        });
    });




});
