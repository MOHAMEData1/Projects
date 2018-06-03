$(document).ready(function() {
    $("body").niceScroll({
        cursorcolor: '#25d366',
        cursorwidth: '6',
        cursorborder: 0,
        zindex: '999999'
    });


    /// fixed navbar if scroll to 400px;
    $(window).scroll(function() {
        var nav = $('.navbar');
        var top = 250;
        if ($(window).scrollTop() >= top) {
            nav.addClass('navbar-fixed-top');
        } else {
            nav.removeClass('navbar-fixed-top');
        }
    });

    /// #accordion .panel-heading
    $('#accordion .panel-heading').click(function () {
       $(this).addClass('activeHead').parent().siblings().find('.panel-heading').removeClass('activeHead');
    });




    $('.navbar-nav li').click(function() {
        $('body,html').animate({
            scrollTop: $('#' + $(this).data('value')).offset().top - 50
        }, 2000);
        $(this).addClass('active').siblings().removeClass('active')
    });
    $('.top .arrow').click(function() {
        $('body,html').animate({
            scrollTop: $('#' + $(this).data('value')).offset().top - 50
        }, 2000)
    });
    $('#quote-carousel').carousel({
        pause: !0,
        interval: 2500,
    })


    $('.navbar-nav li.ho').click(function () {
       $('.hoppy').addClass('backgroundClass');
       $('.objects').removeClass('backgroundClass');
       $('.targets').removeClass('backgroundClass');
       $('.seen').removeClass('backgroundClass');
       $('.messages_us').removeClass('backgroundClass');
       $('.stand_on').removeClass('backgroundClass');
    });

    $('.navbar-nav li.ob').click(function () {
        $('.objects').addClass('backgroundClass');
        $('.hoppy').removeClass('backgroundClass');
        $('.targets').removeClass('backgroundClass');
        $('.seen').removeClass('backgroundClass');
        $('.messages_us').removeClass('backgroundClass');
        $('.stand_on').removeClass('backgroundClass');
    });

    $('.navbar-nav li.ta').click(function () {
        $('.targets').addClass('backgroundClass');
        $('.objects').removeClass('backgroundClass');
        $('.hoppy').removeClass('backgroundClass');
        $('.seen').removeClass('backgroundClass');
        $('.messages_us').removeClass('backgroundClass');
        $('.stand_on').removeClass('backgroundClass');
    });


    $('.navbar-nav li.se').click(function () {
        $('.seen').addClass('backgroundClass');
        $('.objects').removeClass('backgroundClass');
        $('.hoppy').removeClass('backgroundClass');
        $('.targets').removeClass('backgroundClass');
        $('.messages_us').removeClass('backgroundClass');
        $('.stand_on').removeClass('backgroundClass');
    });

    $('.navbar-nav li.me').click(function () {
        $('.messages_us').addClass('backgroundClass');
        $('.objects').removeClass('backgroundClass');
        $('.hoppy').removeClass('backgroundClass');
        $('.targets').removeClass('backgroundClass');
        $('.seen').removeClass('backgroundClass');
        $('.stand_on').removeClass('backgroundClass');
    });

    $('.navbar-nav li.st').click(function () {
        $('.stand_on').addClass('backgroundClass');
        $('.objects').removeClass('backgroundClass');
        $('.hoppy').removeClass('backgroundClass');
        $('.targets').removeClass('backgroundClass');
        $('.seen').removeClass('backgroundClass');
        $('.messages_us').removeClass('backgroundClass');
    });



});


function showDate()
{
    var now = new Date();
    var days = new Array('الاحد','الاثنين','الثلاثاء','الاربعاء','الخميس','الجمعه','السبت');
    var months = new Array('يناير','فبراير','مارس','ابريل','مايو','يونيو','يوليو','اغسطس','سبتمبر','اكتوبر','نوفمبر','ديسمبر');
    var date = ((now.getDate()<10) ? "0" : "")+ now.getDate();
    function fourdigits(number)
    {
        return (number < 1000) ? number + 1900 : number;
    }

    tnow=new Date();
    thour=now.getHours();
    tmin=now.getMinutes();
    tsec=now.getSeconds();

    if (tmin<=9) { tmin="0"+tmin; }
    if (tsec<=9) { tsec="0"+tsec; }
    if (thour<10) { thour="0"+thour; }

    today = days[now.getDay()] + ", " + date + " " + months[now.getMonth()] + ", " + (fourdigits(now.getYear())) + " - " + thour + ":" + tmin +":"+ tsec;
    document.getElementById("dateDiv").innerHTML = today;
}
setInterval("showDate()", 1000);

new WOW().init()


