/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    isMobile = false,
    $root = '/erwansene';
$(function() {
    var app = {
        init: function() {
            $(window).resize(function(event) {});
            $(document).ready(function($) {
                $body = $('body');
                $container = $('#container');
                app.sizeSet();
                History.Adapter.bind(window, 'statechange', function() {
                    var State = History.getState();
                    console.log(State);
                    var content = State.data;
                    // if (content.type == 'index') {
                    //     app.loadContent(State.url, $container);
                    // }
                    app.loadContent(State.url, $container);
                });
                app.loadSlider();
                $('body').on('click', '[data-target]', function(e) {
                    $el = $(this);
                    target = $el.data('target');
                    e.preventDefault();
                    if (target == "page") {
                        History.pushState({
                            type: 'page'
                        }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                    } else if (target == "project") {
                        History.pushState({
                            type: 'project'
                        }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                    } else {
                        e.preventDefault();
                        app.goIndex();
                    }
                });
                //esc
                $(document).keyup(function(e) {
                    if (e.keyCode === 27) app.goIndex();
                });
                //left
                $(document).keyup(function(e) {
                    if (e.keyCode === 37 && $slider) app.goPrev($slider);
                });
                //right
                $(document).keyup(function(e) {
                    if (e.keyCode === 39 && $slider) app.goNext($slider);
                });
                $(window).load(function() {
                  if ($('#intro').length > 0 && !isMobile) {
                    $('#intro img').each(function() {
                        var el = $(this);
                        //var w = el.width();
                        var h = el.height();
                        var top = Math.floor(Math.random() * (height - 40 - h)) + 40;
                        var left = Math.floor(Math.random() * (48)) + 10;
                        el.css({
                            top: top,
                            left: left + "%",
                            opacity: 1
                        });
                    });
                    $('#intro').click(function(event) {
                        var el = $(this);
                        el.find('img').fadeOut(200, function() {
                            $body.addClass('loaded');
                            setTimeout(function() {
                                el.remove();
                            }, 1000);
                        });
                    });
                  } else {
                    $body.addClass('loaded');
                  }
                });
            });
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
            if (width <= 770) isMobile = true;
            if (isMobile) {
                if (width >= 770) {
                    isMobile = false;
                }
            }
        },
        loadSlider: function() {
            $slider = $('#slider').flickity({
                cellSelector: '.cell',
                imagesLoaded: true,
                lazyLoad: 2,
                setGallerySize: false,
                accessibility: false,
                wrapAround: true,
                prevNextButtons: false,
                pageDots: false,
                draggable: true
            });
            flkty = $slider.data('flickity');
            $caption = $('#slide-caption');
            $slider.on('select.flickity', function() {
                if (flkty) {
                    var slidecaption = $(flkty.selectedElement).attr('data-caption');
                    if (typeof slidecaption !== typeof undefined && slidecaption !== false) {
                        $caption.html('<p>'+slidecaption+'</p>');
                    }
                }
            });
            $slider.on('staticClick.flickity', function(event, pointer, cellElement, cellIndex) {
                if (!cellElement) {
                    return;
                }
                app.goNext($slider);
            });
            // $slider.click(function(event) {
            //     if (!isMobile) {
            //         event.preventDefault();
            //         if ($body.hasClass('hover-left')) {
            //             app.goPrev($slider);
            //         } else if ($body.hasClass('hover-right')) {
            //             app.goNext($slider);
            //         }
            //     }
            // });
        },
        goNext: function($slider) {
            $slider.flickity('next', false);
        },
        goPrev: function($slider) {
            $slider.flickity('previous', false);
        },
        goIndex: function() {
            History.pushState({
                type: 'index'
            }, $sitetitle, window.location.origin + $root);
        },
        loadContent: function(url, target) {
            $body.addClass('loading');
            setTimeout(function() {
                $body.scrollTop(0);
                $(target).load(url + ' #container .inner', function(response) {
                    setTimeout(function() {
                        if ($('#container .inner').hasClass('project')) {
                            app.loadSlider();
                        }
                        $body.removeClass('loading').addClass('loaded');
                    }, 100);
                });
            }, 1000);
        },
        deferImages: function() {
            var imgDefer = document.getElementsByTagName('img');
            for (var i = 0; i < imgDefer.length; i++) {
                if (imgDefer[i].getAttribute('data-src')) {
                    imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
                }
            }
        }
    };
    app.init();
});