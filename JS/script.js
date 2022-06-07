$(document).ready(function () {
    $('.nav > ul > li').mouseenter(function () {
        $(this).find('ul').slideDown(350);
    });
    $('.nav > ul > li').mouseleave(function () {
        $(this).find('ul').slideUp(250);
    });
    $('.thumbnail').mouseenter(function () {
        $(this).find('.thumbnail-overlay').slideDown(200);
    });
    $('.thumbnail').mouseleave(function () {
        $(this).find('.thumbnail-overlay').slideUp(200);
    });
});