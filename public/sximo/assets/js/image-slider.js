/**
 * @author SE Manu Mahesh
 * @date 09 Dec 2016
 */

$(document).ready(function () {
    $(".image-slider-previous-btn").click(function ( event ) {
        event.preventDefault();
        
        var index = $(this).parent().parent().find(".image-slider li.active").index();
        if (index == 0) {
            index = +$(this).parent().parent().find(".image-slider li:last-child").index() + 1;
        }

        $(this).parent().parent().find(".image-slider li.active").removeClass("active");
        $(this).parent().parent().find(".image-slider li:nth-child(" + index + ")").addClass("active");
        
        $(this).parent().parent().find(".images-count").html( index + " / " + $(this).parent().parent().find(".image-slider li").length);
        
    });
    
    $(".image-slider-next-btn").click(function ( event ) {
        event.preventDefault();

        var index = $(this).parent().parent().find(".image-slider li.active").index();
        if (index == $(this).parent().parent().find(".image-slider li:last-child").index()) {
            index = -1;
        }

        $(this).parent().parent().find(".image-slider li.active").removeClass("active");
        $(this).parent().parent().find(".image-slider li:nth-child(" + (+index + 2) + ")").addClass("active");
        
        $(this).parent().parent().find(".images-count").html( (+index + 2) + " / " + $(this).parent().parent().find(".image-slider li").length);
        
    });
    
    setInterval(function () {
        var index = $(".auto-slider ul.image-slider > li.active").index();
        if (index == $(".auto-slider ul.image-slider > li:last-child").index()) {
            index = -1;
        }

        $(".auto-slider ul.image-slider > li.active").removeClass("active");
        $(".auto-slider ul.image-slider > li:nth-child(" + (+index + 2) + ")").addClass("active");
        
        $(".auto-slider .images-count").html( (+index + 2) + " / " + $(".auto-slider ul.image-slider > li").length);
        
    }, 40000);
});