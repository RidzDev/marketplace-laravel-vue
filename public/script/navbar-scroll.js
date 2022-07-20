$(function (){
    var $nav = $(".navbar-fixed-top");
    $(document).scroll(function (){
        $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
    });
});