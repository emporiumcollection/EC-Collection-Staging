/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var ww = $(window).width();
var hh = $(window).height();

$(window).scroll(function () {
    var scrolled = $(window).scrollTop();
    if ($(".home").length && scrolled > 120) {
        TweenLite.to($("#svg"), .5, {opacity: "0", ease: Linear.easeOut});
    } else if (scrolled <= 120) {
        TweenLite.to($("#svg"), .5, {opacity: "1", ease: Linear.easeOut});
    }
    if ($(".brand").length && scrolled > 0) {

        var ll = $("#show_br").find('.line');
        var hbar = (hh / 100) * 30 - (scrolled / 2);
        ;
        TweenLite.to($("#show_br").find('.line'), 0, {height: hbar, ease: Linear.easeOut});
        TweenLite.to($("#show_br").find('.rotate90'), 0, {width: hbar, ease: Linear.easeOut});
    }
    if ($(".brand").length && scrolled > hh) {
        var hline = scrolled - hh;
        TweenLite.to($("#show_de").find('.line'), 0, {height: hline, ease: Linear.easeNone});
        TweenLite.to($("#show_de").find('.rotate90'), 0, {top: hline + 100, ease: Linear.easeNone});
    }
});

$(window).on('load', function () {
    $('body').imagesLoaded(function () {
        setTimeout(function () {
            $(".item").fadeOut('slow');
            var rosa = $(".rosa, .pink");
            var nero = $(".nero, .black");
            var testata = $("#foto_testata");
            var foto = $("#foto_testata .foto");
            var linea = $("#show_c .line");
            var lettera = $("#show_c .rotate90 div");
            var discover1 = $("#dis_col");
            var discover2 = $("#dis_col h3");
            if (ww > 1200) {
                TweenLite.to(rosa, 1, {width: "100%", opacity: 1, ease: Expo.easeInOut});
                TweenLite.to(nero, .5, {delay: 1, width: "100%", ease: Expo.easeOut});

                TweenLite.to(testata, 1, {delay: 1.5, width: "100%", opacity: 1, ease: Expo.easeInOut});
                TweenLite.to(foto, 1, {delay: 2, width: "100%", ease: Expo.easeInOut});


                TweenLite.to(discover1, 1, {delay: 2.5, width: "20vw", opacity: 1, ease: Expo.easeInOut});
                TweenMax.staggerFromTo(discover2.find("span"), 1, {delay: 3, autoAlpha: 0, top: "30px", ease: Expo.easeInOut}, {delay: 3, autoAlpha: 1, top: "0px", ease: Expo.easeInOut}, 0.5);

                //TweenMax.staggerFromTo( lettera.find("span"), .5, {autoAlpha:0, scale:7}, {autoAlpha:1, scale:1}, 0.2 );
                var tl = new TimelineMax();
                tl.add(TweenMax.staggerFromTo($("#social hr"), 0.5, {autoAlpha: 0, width: "0"}, {autoAlpha: 1, width: "25%"}, 0.2), '+=1.5');
                tl.add(TweenMax.staggerTo($("#social a"), 0.5, {autoAlpha: 1, top: "0px", ease: Expo.easeInOut}, 0.2), '-=.5');
                tl.add(TweenLite.fromTo($("#freccetta"), 1, {autoAlpha: 0, top: "-30px", ease: Expo.easeIn}, {autoAlpha: 1, top: "0px", ease: Expo.easeIn}), '-=1');
                tl.add(TweenLite.fromTo($("#cerchio"), 1, {autoAlpha: 0, rotation: "-180", ease: Expo.easeIn}, {autoAlpha: 1, rotation: "+=180", ease: Expo.easeIn}), '-=.5');

                TweenLite.to(linea, .3, {delay: 2, height: "200px", opacity: 1, ease: Linear.easeOut});
                TweenLite.to(lettera.find("span"), .3, {delay: 2.4, top: "0px", ease: Linear.easeOut});

                TweenLite.to($("#show_ho .line"), .3, {delay: 1.3, height: "10vh", opacity: 1, ease: Linear.easeOut});
                TweenLite.to($("#show_ho .rotate90 div").find("span"), .3, {delay: 1.6, top: "0px", ease: Linear.easeOut});
            } else {

                TweenLite.to(rosa, 1, {width: "100%", opacity: 1, ease: Expo.easeInOut});
                TweenLite.to(nero, .5, {delay: .5, width: "100%", ease: Expo.easeOut});

                TweenLite.to(testata, 1, {delay: .5, width: "100%", opacity: 1, ease: Expo.easeInOut});
                TweenLite.to(foto, 1, {delay: 1, width: "100%", ease: Expo.easeInOut});

                if (ww > 532)
                    TweenLite.to(discover1, 1, {delay: 1.5, width: "50vw", opacity: 1, ease: Expo.easeInOut});
                else
                    TweenLite.to(discover1, 1, {delay: 1.5, width: "90vw", opacity: 1, ease: Expo.easeInOut});
                TweenMax.staggerFromTo(discover2.find("span"), 1, {delay: 2, autoAlpha: 0, top: "30px", ease: Expo.easeInOut}, {delay: 2, autoAlpha: 1, top: "0px", ease: Expo.easeInOut}, 0.5);

                //TweenMax.staggerFromTo( lettera.find("span"), .5, {autoAlpha:0, scale:7}, {autoAlpha:1, scale:1}, 0.2 );
                var tl = new TimelineMax();
                tl.add(TweenMax.staggerFromTo($("#social hr"), 0.5, {autoAlpha: 0, width: "0"}, {autoAlpha: 1, width: "25%"}, 0.2), '+=1.5');
                tl.add(TweenMax.staggerTo($("#social a"), 0.5, {autoAlpha: 1, top: "0px", ease: Expo.easeInOut}, 0.2), '-=.5');
                tl.add(TweenLite.fromTo($("#freccetta"), 1, {autoAlpha: 0, top: "-30px", ease: Expo.easeIn}, {autoAlpha: 1, top: "0px", ease: Expo.easeIn}), '-=1');
                tl.add(TweenLite.fromTo($("#cerchio"), 1, {autoAlpha: 0, rotation: "-180", ease: Expo.easeIn}, {autoAlpha: 1, rotation: "+=180", ease: Expo.easeIn}), '-=.5');

                TweenLite.to(linea, .3, {delay: 2, height: "200px", opacity: 1, ease: Linear.easeOut});
                TweenLite.to(lettera.find("span"), .3, {delay: 2.4, top: "0px", ease: Linear.easeOut});

                TweenLite.to($("#show_ho .line"), .3, {delay: 1.3, height: "10vh", opacity: 1, ease: Linear.easeOut});
                TweenLite.to($("#show_ho .rotate90 div").find("span"), .3, {delay: 1.6, top: "0px", ease: Linear.easeOut});
            }
            if ($(".contact").length) {
                TweenMax.staggerTo($(".pink .scritta span"), .4, {delay: .7, top: "0", ease: Linear.easeIn}, 0.3);

                TweenLite.to($("#foto_contatti"), 1, {delay: .5, width: "100%", opacity: 1, ease: Expo.easeInOut});
                TweenLite.to($("#foto_contatti .foto"), 1, {delay: 1, width: "100%", ease: Expo.easeInOut});

                if (ww > 1200)
                    TweenLite.to($("#email"), 1, {delay: 1, width: "30vw", opacity: 1, ease: Expo.easeInOut});
                else if (ww <= 1200)
                    TweenLite.to($("#email"), 1, {delay: 1, width: "90vw", opacity: 1, ease: Expo.easeInOut});
                else
                    TweenLite.to($("#email"), 1, {delay: 1, width: "50%", opacity: 1, ease: Expo.easeInOut});
                TweenMax.staggerFromTo($("#email").find("span"), 1, {delay: 1.5, autoAlpha: 0, top: "30px", ease: Expo.easeInOut}, {delay: 1.5, autoAlpha: 1, top: "0px", ease: Expo.easeInOut}, 0.5);

                TweenLite.to($("#show_co .line"), .3, {delay: 1.3, height: "30vh", opacity: 1, ease: Linear.easeOut});
                TweenLite.to($("#show_co .rotate90 div").find("span"), .3, {delay: 1.6, top: "0px", ease: Linear.easeOut});

                TweenMax.staggerTo($(".info h4 span"), .4, {delay: 1.1, top: "0", opacity: "1", ease: Linear.easeIn}, 0.3);
                TweenMax.staggerTo($(".via span"), .4, {delay: 1.5, top: "0", opacity: "1", ease: Linear.easeIn}, 0.3);
                TweenMax.staggerTo($(".showroom span"), .4, {delay: 2, top: "0", opacity: "1", ease: Linear.easeIn}, 0.3);
            }
            if ($(".social").length) {

                TweenMax.staggerTo($(".pink .scritta span"), .4, {delay: .7, top: "0", ease: Linear.easeIn}, 0.3);

                $(".insta").bind('inview', function (event, visible) {
                    if (visible) {
                        TweenLite.to($(this).find(".social_foto"), 1, {width: "100%", opacity: 1, ease: Expo.easeInOut});
                        TweenLite.to($(this).find(".social_foto .foto"), 1, {width: "100%", ease: Expo.easeInOut});

                        TweenLite.to($(this).find(".rosa .info p"), 1, {delay: .5, top: "0", opacity: 1, ease: Expo.easeInOut});

                        TweenMax.staggerTo($(this).find(".d_ce"), .4, {delay: 1, opacity: "1", ease: Linear.easeIn}, 0.3);
                        TweenMax.staggerTo($(this).find(".d_fr"), .4, {delay: 1.2, right: "0", opacity: "1", ease: Expo.easeInOut}, 0.3);
                    }
                });

            }

            if ($(".press").length) {
                TweenMax.staggerTo($(".pink .scritta span"), .4, {delay: .7, top: "0", ease: Linear.easeIn}, 0.3);

                TweenMax.staggerTo($(".giornale.schermata1 .bianco"), .4, {delay: 1, width: "100%", ease: Expo.easeInOut}, 0.3);
                TweenMax.staggerTo($(".giornale.schermata1 .logo_g img"), .4, {delay: 1.4, top: "0", ease: Expo.easeInOut}, 0.3);
                TweenMax.staggerTo($(".giornale.schermata1 .rosa h2 span"), .4, {delay: 1.6, top: "0", ease: Expo.easeInOut}, 0.3);
                TweenMax.staggerTo($(".giornale.schermata1 .rosa h3 span"), .4, {delay: 1.8, top: "0", ease: Expo.easeInOut}, 0.3);

                TweenMax.staggerTo($(".giornale.schermata1 .d_ce"), .4, {delay: 1.4, opacity: "1", ease: Linear.easeIn}, 0.3);
                TweenMax.staggerTo($(".giornale.schermata1 .d_fr"), .4, {delay: 1.6, top: "0", opacity: "1", ease: Expo.easeInOut}, 0.3);
            }
            if ($(".pagina").length) {
                TweenMax.staggerTo($(".pink .scritta span"), .4, {delay: .7, top: "0", ease: Linear.easeIn}, 0.3);

                TweenLite.to($(".pagina #brand1"), 1, {delay: .5, width: "100%", opacity: 1, ease: Expo.easeInOut});
                TweenLite.to($(".pagina #brand1 .foto"), 1, {delay: 1, width: "100%", ease: Expo.easeInOut});
                TweenMax.staggerTo($(".info1 h2 span"), .3, {delay: 1.3, top: "0", ease: Linear.easeIn}, 0.2);
                TweenLite.to($(".info1 .appendice"), 1, {delay: 1.6, top: "0", opacity: 1, ease: Expo.easeOut});

                if (ww > 1200)
                    TweenLite.to($(".pagina #brand2"), 1, {delay: 1.3, width: "50vw", opacity: 1, ease: Expo.easeInOut});
                else
                    TweenLite.to($(".pagina #brand2"), 1, {delay: 1.3, width: "100%", opacity: 1, ease: Expo.easeInOut});
                TweenLite.to($(".pagina #brand2 .foto"), 1, {delay: 1.6, width: "100%", ease: Expo.easeInOut});

                TweenLite.to($("#show_br .line"), .3, {delay: 1.3, height: "30vh", opacity: 1, ease: Linear.easeOut});
                TweenLite.to($("#show_br .rotate90 div").find("span"), .3, {delay: 1.6, top: "0px", ease: Linear.easeOut});

                $("#show_de").bind('inview', function (event, visible) {
                    if (visible) {
                        //TweenLite.to($(this).find(".line"), 1, {delay:1.3,height:"100%", opacity:1, ease:Linear.easeOut});
                        TweenLite.to($(this).find("span"), .3, {delay: 3.3, top: "0px", ease: Linear.easeOut});
                    }
                });

                $(".pagina .bianco").bind('inview', function (event, visible) {
                    if (visible) {
                        TweenLite.to($(this).find(".brand"), 1, {delay: .5, width: "100%", opacity: 1, ease: Expo.easeInOut});
                        TweenLite.to($(this).find(".foto"), 1, {delay: 1, width: "100%", ease: Expo.easeInOut});

                    }
                });
                $(".pagina .bianco h2").bind('inview', function (event, visible) {
                    if (visible) {
                        TweenMax.staggerTo($(this).find("span"), .3, {delay: .5, top: "0", ease: Linear.easeIn}, 0.2);
                    }
                });

                $(".pagina .rosa .brand").bind('inview', function (event, visible) {
                    if (visible) {
                        TweenLite.to($(this), 1, {delay: .5, width: "100%", opacity: 1, ease: Expo.easeInOut});
                        TweenLite.to($(this).find(".foto"), 1, {delay: 1, width: "100%", ease: Expo.easeInOut});
                    }
                });
                $(".pagina .rosa").bind('inview', function (event, visible) {
                    if (visible) {
                        TweenLite.to($(this).find(".annie"), 1, {delay: .5, width: "100%", opacity: 1, ease: Expo.easeInOut});
                        TweenLite.to($(this).find(".annie .foto"), 1, {delay: 1, width: "100%", ease: Expo.easeInOut});
                    }
                });



                $(".pagina .info2 .appendice p").bind('inview', function (event, visible) {
                    if (visible) {
                        TweenLite.to($(this), 1, {delay: .3, top: "0", opacity: 1, ease: Expo.easeOut});
                    }
                });
                $(".pagina .rosa .info .appendice").bind('inview', function (event, visible) {
                    if (visible) {
                        TweenLite.to($(this), 1, {delay: .3, top: "50%", opacity: 1, ease: Expo.easeOut});
                    }
                });
                $(".pagina .bianco .info .appendice p").bind('inview', function (event, visible) {
                    if (visible) {
                        TweenLite.to($(this), 1, {delay: .3, top: "0", opacity: 1, ease: Expo.easeOut});
                    }
                });
            }
            if ($("#interna").length) {
                TweenMax.staggerTo($("#interna .scritta span"), .4, {delay: .7, top: "0", ease: Linear.easeIn}, 0.3);

                TweenLite.to($(".principale1"), 1, {delay: .5, width: "100%", opacity: 1, ease: Expo.easeInOut});
                TweenLite.to($(".principale1 .foto1"), 1, {delay: 1, width: "100%", ease: Expo.easeInOut});
                TweenLite.to($(".secondaria1"), .6, {delay: 1, width: "100%", opacity: 1, ease: Expo.easeInOut});
                TweenLite.to($(".secondaria1 .foto1"), .6, {delay: 1.2, width: "100%", ease: Expo.easeInOut});
                TweenLite.to($(".info1 h2 span"), .6, {delay: 1.2, top: "0px", ease: Expo.easeOut});
                TweenLite.to($(".info1 p span"), .6, {delay: 1.6, top: "0px", ease: Expo.easeOut});
                TweenLite.to($(".info1 .freccetta_left"), 1, {delay: 1, autoAlpha: 1, right: "0px", ease: Expo.easeIn});
                TweenLite.to($(".info1 .cerchio_left"), 1, {delay: 1, autoAlpha: 1, right: "0px", rotation: "0", ease: Expo.easeIn});
                TweenLite.to($(".info1 .freccetta_right"), 1, {delay: 1, autoAlpha: 1, left: "0px", ease: Expo.easeIn});
                TweenLite.to($(".info1 .cerchio_right"), 1, {delay: 1, autoAlpha: 1, left: "0px", rotation: "0", ease: Expo.easeIn});
                TweenLite.to($(".info1 .viewmore h3 span"), .6, {delay: 1.2, top: "0px", ease: Expo.easeOut});

                TweenLite.to($(".principale2"), 1, {delay: 1.3, width: "100%", opacity: 1, ease: Expo.easeInOut});
                TweenLite.to($(".principale2 .foto1"), 1, {delay: 1.8, width: "100%", ease: Expo.easeInOut});
                TweenLite.to($(".secondaria2"), .6, {delay: 1.8, width: "100%", opacity: 1, ease: Expo.easeInOut});
                TweenLite.to($(".secondaria2 .foto1"), .6, {delay: 2, width: "100%", ease: Expo.easeInOut});
                TweenLite.to($(".info2 h2 span"), .6, {delay: 2, top: "0px", ease: Expo.easeOut});
                TweenLite.to($(".info2 p span"), .6, {delay: 2.4, top: "0px", ease: Expo.easeOut});
                TweenLite.to($(".info2 .freccetta_left"), 1, {delay: 1, autoAlpha: 1, right: "0px", ease: Expo.easeIn});
                TweenLite.to($(".info2 .cerchio_left"), 1, {delay: 1, autoAlpha: 1, right: "0px", rotation: "0", ease: Expo.easeIn});
                TweenLite.to($(".info2 .freccetta_right"), 1, {delay: 1, autoAlpha: 1, left: "0px", ease: Expo.easeIn});
                TweenLite.to($(".info2 .cerchio_right"), 1, {delay: 1, autoAlpha: 1, left: "0px", rotation: "0", ease: Expo.easeIn});
                TweenLite.to($(".info2 .viewmore h3 span"), .6, {delay: 2, top: "0px", ease: Expo.easeOut});

                $(".gallery").bind('inview', function (event, visible) {
                    if (visible) {
                        TweenLite.to($(this).find(".principale"), 1, {width: "100%", opacity: 1, ease: Expo.easeInOut});
                        TweenLite.to($(this).find(".principale .foto1"), 1, {delay: .5, width: "100%", ease: Expo.easeInOut});
                        TweenLite.to($(this).find(".secondaria"), 1, {delay: .5, width: "100%", opacity: 1, ease: Expo.easeInOut});
                        TweenLite.to($(this).find(".secondaria .foto1"), 1, {delay: .7, width: "100%", ease: Expo.easeInOut});

                        TweenLite.to($(this).find(".info h2 span"), .6, {delay: 1, top: "0px", ease: Expo.easeOut});
                        TweenLite.to($(this).find(".info p span"), .6, {delay: 1.4, top: "0px", ease: Expo.easeOut});

                        TweenLite.to($(this).find(".info .freccetta_left"), 1, {delay: 1, autoAlpha: 1, right: "0px", ease: Expo.easeIn});
                        TweenLite.to($(this).find(".info .cerchio_left"), 1, {delay: 1, autoAlpha: 1, right: "0px", rotation: "0", ease: Expo.easeIn});
                        TweenLite.to($(this).find(".info .freccetta_right"), 1, {delay: 1, autoAlpha: 1, left: "0px", ease: Expo.easeIn});
                        TweenLite.to($(this).find(".info .cerchio_right"), 1, {delay: 1, autoAlpha: 1, left: "0px", rotation: "0", ease: Expo.easeIn});
                        TweenLite.to($(this).find(".info .viewmore h3 span"), .6, {delay: 1.2, top: "0px", ease: Expo.easeOut});

                    }
                });
            }
        }, 600);
    });
});

$(document).ready(function () {
    //ridimensiona();





    if ($("#interna").length) {




        $(document).on('click', '.sec', function () {
            var attuale = $(this);
            var principale = attuale.closest(".gallery").find(".prc");

            next(attuale, principale);

        });

        $(document).on('click', '.viewmore .right', function () {

            var attuale = $(this).closest('.gallery').find(".sec");
            var principale = attuale.closest(".gallery").find(".prc");

            next(attuale, principale);

        });

        $(document).on('click', '.prc', function () {
            var attuale = $(this);
            var secondaria = attuale.closest(".gallery").find(".sec");

            prev(attuale, secondaria);

        });

        $(document).on('click', '.viewmore .left', function () {

            var attuale = $(this).closest('.gallery').find(".prc");
            var principale = attuale.closest(".gallery").find(".sec");

            prev(attuale, principale);

        });


    }

    $(document).on('click', '.hamburger', function () {
        $(this).toggleClass('is-active');
        if ($('.is-active').length) {
            openmenu();
        } else {
            closemenu();
        }
    });

    $("#brand .col-md-6").bind('inview', function (event, visible) {
        if (visible) {
            TweenLite.to($("#brand_home"), 1, {width: "100%", opacity: 1, ease: Expo.easeInOut});
            TweenLite.to($("#brand_home .foto"), 1, {delay: .5, width: "100%", ease: Expo.easeInOut});
        }
    });
    $("#brand .scritta-md").bind('inview', function (event, visible) {
        if (visible) {
            TweenMax.staggerTo($(this).find("span"), .4, {delay: .6, top: "0px", ease: Linear.easeIn}, 0.3);
        }
    });
    $("#brand .discover").bind('inview', function (event, visible) {
        if (visible) {
            if (ww > 1200)
                TweenLite.to($(this), 1, {width: "20vw", opacity: 1, ease: Expo.easeInOut});
            else
                TweenLite.to($(this), 1, {width: "50vw", opacity: 1, ease: Expo.easeInOut});
            TweenMax.staggerTo($(this).find("h3 span"), 1, {delay: .6, autoAlpha: 1, top: "0px", ease: Expo.easeInOut}, 0.5);
        }
    });
    $("#press .discover").bind('inview', function (event, visible) {
        if (visible) {
            if (ww > 1200)
                TweenLite.to($(this), 1, {width: "20vw", opacity: 1, ease: Expo.easeInOut});
            else
                TweenLite.to($(this), 1, {width: "50vw", opacity: 1, ease: Expo.easeInOut});
            TweenMax.staggerTo($(this).find("h3 span"), 1, {delay: .6, autoAlpha: 1, top: "0px", ease: Expo.easeInOut}, 0.5);
        }
    });
    $("#show_b").bind('inview', function (event, visible) {
        if (visible) {
            if (ww > 532)
                TweenLite.to($(this).find(".line"), .3, {height: "200px", opacity: 1, ease: Linear.easeOut});
            else
                TweenLite.to($(this).find(".line"), .3, {height: "100px", opacity: 1, ease: Linear.easeOut});
            TweenLite.to($(this).find(".rotate90 div span"), .3, {delay: .4, top: "0px", ease: Linear.easeOut});
        }
    });
    $(".testo .scritta-ld").bind('inview', function (event, visible) {
        if (visible) {
            TweenMax.staggerTo($(this).find("span"), .4, {delay: .4, top: "0", ease: Linear.easeIn}, 0.3);
        }
    });
    $("#press .col-md-4").bind('inview', function (event, visible) {
        if (visible) {
            TweenLite.to($("#press_home"), 1, {delay: .5, width: "100%", opacity: 1, ease: Expo.easeInOut});
            TweenLite.to($("#press_home .foto"), 1, {delay: 1, width: "100%", ease: Expo.easeInOut});
        }
    });
    $("#show_d").bind('inview', function (event, visible) {
        if (visible) {
            if (ww > 1200)
                TweenLite.to($(this).find(".line"), .5, {width: "30vw", opacity: 1, ease: Linear.easeOut});
            else if (ww < 533)
                TweenLite.to($(this).find(".line"), .5, {width: "20vw", opacity: 1, ease: Linear.easeOut});
            else
                TweenLite.to($(this).find(".line"), .5, {width: "60vw", opacity: 1, ease: Linear.easeOut});
            TweenLite.to($(this).find(".rotate0 div span"), .3, {delay: .6, top: "0px", ease: Linear.easeOut});
        }
    });
    $("#foot .scritta").bind('inview', function (event, visible) {
        if (visible) {
            TweenMax.staggerTo($(this).find("span"), .3, {delay: .4, top: "0", ease: Linear.easeIn}, 0.2);
        }
    });

    ridimensiona();

    $(document).on('click', '#menu a', function (e) {
        e.preventDefault();
        var href = $(this).attr("href");
        aprimenu(href);
    });

    $(document).on('click', '.animate-link', function (e) {
        e.preventDefault();
        var href = $(this).attr("href");

        chiusura();

        setTimeout(function () {
            window.location.href = href;
        }, 1000);

    });

});

$(window).resize(function () {
    ridimensiona();
});


function ridimensiona() {
    ww = $(window).width();
    hh = $(window).height();

    var md6 = $("#hotel .col-md-6").width();
    var md4 = $("#hotel .col-md-4").width();
    var h_principale = (720 * md6) / 1280;
    var h_brand = (960 * md6) / 1280;
    var h_annie = (1280 * md4) / 854;
    var h_annie_m = (1280 * ww) / 854;
    $(".principale1, .principale2, .principale, .secondaria1, .secondaria2, .secondaria, .pagina .brand").height(h_principale);
    $(".principale1 .foto1, .principale1 .foto2, .principale2 .foto1, .principale2 .foto2, .principale .foto1, .principale .foto2, .secondaria1 .foto1, .secondaria1 .foto2, .secondaria2 .foto1, .secondaria2 .foto2, .secondaria .foto1, .secondaria .foto2").height(h_principale);
    $(".principale1 .foto1 img, .principale1 .foto2 img, .principale2 .foto1 img, .principale2 .foto2 img, .principale .foto1 img, .principale .foto2 img").height(h_principale);
    $(".principale1 .foto1 img, .principale1 .foto2 img, .principale2 .foto1 img, .principale2 .foto2 img, .principale .foto1 img, .principale .foto2 img, .pagina .foto img").width($("#hotel .col-md-6").width());
    $(".pagina .foto img, .pagina .foto, #brand1, #brand2, .pagina .info1, .pagina .info, .pagina .brand").height(h_brand);
    if (ww > 1200)
        $(".pagina .brand.annie img").width(md4);
    else
        $(".pagina .brand.annie img").width(ww);
    if (ww > 1200)
        $(".pagina.sopra1 .rosa .info, .pagina.sopra1 .nero .info, .pagina.sopra1 .bianco").height(h_brand - ((hh / 100) * 20));
    $(".pagina .brand.annie, .pagina .brand.annie .foto, .pagina .brand.annie img, .pagina.sopra2 .nero .info, .pagina.sopra2 .bianco .info").height(h_annie);
    if (ww <= 1200)
        $(".pagina .brand.annie, .pagina .brand.annie .foto, .pagina .brand.annie img").height(h_annie_m);
    $(".secondaria1 .foto1 img, .secondaria1 .foto2 img, .secondaria2 .foto1 img, .secondaria2 .foto2 img, .secondaria .foto1 img, .secondaria .foto2 img").height(h_principale);

    $(".gallery .rosa, .gallery .nero, .gallery .pink, .gallery .black").height(h_principale);

}
function openmenu() {

    TweenMax.fromTo($("#menu"), 1, {width: "0%", autoAlpha: 0, ease: Expo.easeInOut}, {autoAlpha: 1, width: "100%", ease: Expo.easeInOut});
    TweenMax.staggerTo($("#menu ul li a"), 1, {delay: .5, autoAlpha: 1, top: "0px", ease: Expo.easeInOut}, 0.1);

}
function closemenu() {

    TweenMax.fromTo($("#menu"), 1, {delay: .6, width: "100%", autoAlpha: 1, ease: Expo.easeInOut}, {delay: .6, autoAlpha: 0, width: "0%", ease: Expo.easeOut});
    TweenMax.staggerTo($("#menu ul li a"), .5, {autoAlpha: 1, top: "5vh", ease: Expo.easeInOut}, 0.1);

}

function aprimenu(href) {
    TweenMax.fromTo($("#menu"), 1, {delay: .6, width: "100%", autoAlpha: 1, ease: Expo.easeInOut}, {delay: .6, autoAlpha: 0, width: "0%", ease: Expo.easeInOut});
    TweenLite.to($("#contenitore-menu ul"), 1, {width: "0%", ease: Expo.easeInOut});

    TweenMax.staggerTo($("#menu ul li a"), .5, {autoAlpha: 1, top: "5vh", ease: Expo.easeInOut}, 0.1);
    TweenLite.to($(".nero, .black"), .5, {delay: .7, width: "0%", ease: Expo.easeIn});
    chiusura();
    setTimeout(function () {
        window.location.href = href;
    }, 1800);
}

function chiusura() {
    TweenLite.to($(".rosa, .pink, .nero, .black"), .5, {width: "0%", ease: Expo.easeIn});

    TweenLite.to($("#foto_testata, #brand_home, .prc, .sec, #brand1, #brand2, .giornale .bianco, .brand"), .5, {delay: .3, width: "0%", ease: Expo.easeIn});
    TweenLite.to($(".foto, .foto1, .foto2, #foto_contatti"), .5, {delay: .3, width: "0%", ease: Expo.easeIn});
    TweenMax.staggerTo($(".giornale.schermata1 .logo_g img"), .4, {delay: .3, top: "4vh", ease: Expo.easeInOut}, 0.3);
    TweenLite.to($("#dis_col h3,#email h3, .discover h3, .pagina .info2, .pagina .info1, .pagina .info").find("span"), .5, {delay: .3, opacity: 0, ease: Expo.easeIn});
    TweenLite.to($(".appendice, #foot .scritta, .insta .info"), .5, {delay: .3, opacity: 0, ease: Expo.easeIn});
    TweenLite.to($("#dis_col, #email, .discover"), .5, {delay: .3, width: "0vw", opacity: 1, ease: Expo.easeIn});
    TweenLite.to($(".line"), .5, {delay: .3, height: "0px", opacity: 1, ease: Linear.easeIn});
    TweenLite.to($(".rotate90 div span, .rotate0 div span"), .5, {delay: .3, top: "16px", ease: Linear.easeIn});
    TweenMax.staggerTo($(".scritta-ld span"), .4, {delay: .3, top: "3.5vw", ease: Linear.easeIn}, 0.3);
    TweenLite.to($("#freccetta, #cerchio, .cerchio_right, .cerchio_left, .freccetta_right, .freccetta_left"), .5, {delay: .3, autoAlpha: 0, top: "0px", ease: Expo.easeIn});
}

function next(attuale, principale) {

    var next = parseInt(attuale.find(".foto1 img").attr("rel")) + 1;
    if (next == 5)
        next = 1;

    var succ = next + 1;
    if (succ == 5)
        succ = 1;
    
    var classe = attuale.find(".foto2").attr("rel");
    var next_classe = attuale.find("."+classe + next).data("image");
    var succ_classe = attuale.find("."+classe + succ).data("image");

//    alert("."+classe + next + ": " + next_classe + "\n\n\n" + "."+classe + succ + ": " + succ_classe);

    attuale.find(".foto2 img").attr("src", next_classe);
    attuale.find(".foto2 img").attr("rel", next);
    principale.find(".foto2 img").attr("src", succ_classe);
    principale.find(".foto2 img").attr("rel", succ);

    attuale.find(".foto1").css({"right": "0px", "left": "auto"});
    attuale.find(".foto2").css({"left": "0px", "right": "auto"});
    principale.find(".foto1").css({"right": "0px", "left": "auto"});
    principale.find(".foto2").css({"right": "auto", "left": "0px"});
    TweenLite.to(principale.find(".foto1"), .6, {width: "0%", ease: Expo.easeInOut});
    TweenLite.to(principale.find(".foto2"), .6, {width: "100%", ease: Expo.easeInOut});
    TweenLite.to(attuale.find(".foto1"), .6, {width: "0%", ease: Expo.easeInOut});
    TweenLite.to(attuale.find(".foto2"), .6, {width: "100%", ease: Expo.easeInOut});



    setTimeout(function () {
        attuale.find(".foto2").removeClass('foto2').addClass('foto3');
        attuale.find(".foto1").removeClass('foto1').addClass('foto2');
        attuale.find(".foto3").removeClass('foto3').addClass('foto1');
        principale.find(".foto2").removeClass('foto2').addClass('foto3');
        principale.find(".foto1").removeClass('foto1').addClass('foto2');
        principale.find(".foto3").removeClass('foto3').addClass('foto1');
        attuale.find(".foto1").css({"right": "auto", "left": "0px"});
        attuale.find(".foto2").css({"left": "auto", "right": "0px"});
        principale.find(".foto1").css({"right": "auto", "left": "0px"});
        principale.find(".foto2").css({"left": "auto", "right": "0px"});


    }, 600);
}

function prev(attuale, principale) {


    var next = parseInt(attuale.find(".foto1 img").attr("rel")) - 1;
    if (next == 0)
        next = 4;

    var succ = next - 1;
    if (succ == 0)
        succ = 4;
    var classe = attuale.find(".foto2").attr("rel");
    var next_classe = attuale.find("."+classe + next).data("image");
    var succ_classe = attuale.find("."+classe + succ).data("image");

//    alert("."+classe + next + ": " + next_classe + "\n\n\n" + "."+classe + succ + ": " + succ_classe);

    attuale.find(".foto2 img").attr("src", next_classe);
    attuale.find(".foto2 img").attr("rel", next);
    principale.find(".foto2 img").attr("src", succ_classe);
    principale.find(".foto2 img").attr("rel", succ);

    attuale.find(".foto1").css({"left": "0px", "right": "auto"});
    attuale.find(".foto2").css({"right": "0px", "left": "auto"});
    principale.find(".foto1").css({"left": "0px", "right": "auto"});
    principale.find(".foto2").css({"left": "auto", "right": "0px"});
    TweenLite.to(principale.find(".foto1"), .6, {width: "0%", ease: Expo.easeInOut});
    TweenLite.to(principale.find(".foto2"), .6, {width: "100%", ease: Expo.easeInOut});
    TweenLite.to(attuale.find(".foto1"), .6, {width: "0%", ease: Expo.easeInOut});
    TweenLite.to(attuale.find(".foto2"), .6, {width: "100%", ease: Expo.easeInOut});

    setTimeout(function () {
        attuale.find(".foto2").removeClass('foto2').addClass('foto3');
        attuale.find(".foto1").removeClass('foto1').addClass('foto2');
        attuale.find(".foto3").removeClass('foto3').addClass('foto1');
        principale.find(".foto2").removeClass('foto2').addClass('foto3');
        principale.find(".foto1").removeClass('foto1').addClass('foto2');
        principale.find(".foto3").removeClass('foto3').addClass('foto1');
        attuale.find(".foto1").css({"right": "auto", "left": "0px"});
        attuale.find(".foto2").css({"left": "auto", "right": "0px"});
        principale.find(".foto1").css({"right": "auto", "left": "0px"});
        principale.find(".foto2").css({"left": "auto", "right": "0px"});


    }, 600);



}