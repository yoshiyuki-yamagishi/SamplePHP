//画面遷移のスクリプト

$(window).on('load',function(){
    $("#splash-logo").delay(1200).fadeOut('slow');


    $("#splash").delay(1500).fadeOut('slow',function(){

        $('body').addClass('appear');

    });

    $('.splashbg').on('animationend', function() {
    });

});

$(document).ready(function() {
    $("#slide").animate({ marginLeft: "3000px" }, 10000);
})


