/*
 *  jQuery OwlCarousel v1.3.3
 *
 *  Copyright (c) 2013 Bartosz Wojciechowski
 *  http://www.owlgraphic.com/owlcarousel/
 *
 *  Licensed under MIT
 *
 */

/*JS Lint helpers: */
/*global dragMove: false, dragEnd: false, $, jQuery, alert, window, document */
/*jslint nomen: true, continue:true */


if (typeof Object.create !== "function") {
    Object.create = function (obj) {
        function F() {}
        F.prototype = obj;
        return new F();
    };
}
(function ($, window, document) {

    var Carousel = {
        init : function (options, el) {
            var base = this;

            base.$elem = $(el);
            base.options = $.extend({}, $.fn.owlCarousel.options, base.$elem.data(), options);

            base.userOptions = options;
            base.loadContent();
        },

        loadContent : function () {
            var base = this, url;

            function getData(data) {
                var i, content = "";
                if (typeof base.options.jsonSuccess === "function") {
                    base.options.jsonSuccess.apply(this, [data]);
                } else {
                    for (i in data.owl) {
                        if (data.owl.hasOwnProperty(i)) {
                            content += data.owl[i].item;
                        }
                    }
                    base.$elem.html(content);
                }
                base.logIn();
            }

            if (typeof base.options.beforeInit === "function") {
                base.options.beforeInit.apply(this, [base.$elem]);
            }

            if (typeof base.options.jsonPath === "string") {
                url = base.options.jsonPath;
                $.getJSON(url, getData);
            } else {
                base.logIn();
            }
        },

        logIn : function () {
            var base = this;

            base.$elem.data("owl-originalStyles", base.$elem.attr("style"));
            base.$elem.data("owl-originalClasses", base.$elem.attr("class"));

            base.$elem.css({opacity: 0});
            base.orignalItems = base.options.items;
            base.checkBrowser();
            base.wrapperWidth = 0;
            base.checkVisible = null;
            base.setVars();
        },

        setVars : function () {
            var base = this;
            if (base.$elem.children().length === 0) {return false; }
            base.baseClass();
            base.eventTypes();
            base.$userItems = base.$elem.children();
            base.itemsAmount = base.$userItems.length;
            base.wrapItems();
            base.$owlItems = base.$elem.find(".owl-item");
            base.$owlWrapper = base.$elem.find(".owl-wrapper");
            base.playDirection = "next";
            base.prevItem = 0;
            base.prevArr = [0];
            base.currentItem = 0;
            base.customEvents();
            base.onStartup();
        },

        onStartup : function () {
            var base = this;
            base.updateItems();
            base.calculateAll();
            base.buildControls();
            base.updateControls();
            base.response();
            base.moveEvents();
            base.stopOnHover();
            base.owlStatus();

            if (base.options.transitionStyle !== false) {
                base.transitionTypes(base.options.transitionStyle);
            }
            if (base.options.autoPlay === true) {
                base.options.autoPlay = 5000;
            }
            base.play();

            base.$elem.find(".owl-wrapper").css("display", "block");

            if (!base.$elem.is(":visible")) {
                base.watchVisibility();
            } else {
                base.$elem.css("opacity", 1);
            }
            base.onstartup = false;
            base.eachMoveUpdate();
            if (typeof base.options.afterInit === "function") {
                base.options.afterInit.apply(this, [base.$elem]);
            }
        },

        eachMoveUpdate : function () {
            var base = this;

            if (base.options.lazyLoad === true) {
                base.lazyLoad();
            }
            if (base.options.autoHeight === true) {
                base.autoHeight();
            }
            base.onVisibleItems();

            if (typeof base.options.afterAction === "function") {
                base.options.afterAction.apply(this, [base.$elem]);
            }
        },

        updateVars : function () {
            var base = this;
            if (typeof base.options.beforeUpdate === "function") {
                base.options.beforeUpdate.apply(this, [base.$elem]);
            }
            base.watchVisibility();
            base.updateItems();
            base.calculateAll();
            base.updatePosition();
            base.updateControls();
            base.eachMoveUpdate();
            if (typeof base.options.afterUpdate === "function") {
                base.options.afterUpdate.apply(this, [base.$elem]);
            }
        },

        reload : function () {
            var base = this;
            window.setTimeout(function () {
                base.updateVars();
            }, 0);
        },

        watchVisibility : function () {
            var base = this;

            if (base.$elem.is(":visible") === false) {
                base.$elem.css({opacity: 0});
                window.clearInterval(base.autoPlayInterval);
                window.clearInterval(base.checkVisible);
            } else {
                return false;
            }
            base.checkVisible = window.setInterval(function () {
                if (base.$elem.is(":visible")) {
                    base.reload();
                    base.$elem.animate({opacity: 1}, 200);
                    window.clearInterval(base.checkVisible);
                }
            }, 500);
        },

        wrapItems : function () {
            var base = this;
            base.$userItems.wrapAll("<div class=\"owl-wrapper\">").wrap("<div class=\"owl-item\"></div>");
            base.$elem.find(".owl-wrapper").wrap("<div class=\"owl-wrapper-outer\">");
            base.wrapperOuter = base.$elem.find(".owl-wrapper-outer");
            base.$elem.css("display", "block");
        },

        baseClass : function () {
            var base = this,
                hasBaseClass = base.$elem.hasClass(base.options.baseClass),
                hasThemeClass = base.$elem.hasClass(base.options.theme);

            if (!hasBaseClass) {
                base.$elem.addClass(base.options.baseClass);
            }

            if (!hasThemeClass) {
                base.$elem.addClass(base.options.theme);
            }
        },

        updateItems : function () {
            var base = this, width, i;

            if (base.options.responsive === false) {
                return false;
            }
            if (base.options.singleItem === true) {
                base.options.items = base.orignalItems = 1;
                base.options.itemsCustom = false;
                base.options.itemsDesktop = false;
                base.options.itemsDesktopSmall = false;
                base.options.itemsTablet = false;
                base.options.itemsTabletSmall = false;
                base.options.itemsMobile = false;
                return false;
            }

            width = $(base.options.responsiveBaseWidth).width();

            if (width > (base.options.itemsDesktop[0] || base.orignalItems)) {
                base.options.items = base.orignalItems;
            }
            if (base.options.itemsCustom !== false) {
                //Reorder array by screen size
                base.options.itemsCustom.sort(function (a, b) {return a[0] - b[0]; });

                for (i = 0; i < base.options.itemsCustom.length; i += 1) {
                    if (base.options.itemsCustom[i][0] <= width) {
                        base.options.items = base.options.itemsCustom[i][1];
                    }
                }

            } else {

                if (width <= base.options.itemsDesktop[0] && base.options.itemsDesktop !== false) {
                    base.options.items = base.options.itemsDesktop[1];
                }

                if (width <= base.options.itemsDesktopSmall[0] && base.options.itemsDesktopSmall !== false) {
                    base.options.items = base.options.itemsDesktopSmall[1];
                }

                if (width <= base.options.itemsTablet[0] && base.options.itemsTablet !== false) {
                    base.options.items = base.options.itemsTablet[1];
                }

                if (width <= base.options.itemsTabletSmall[0] && base.options.itemsTabletSmall !== false) {
                    base.options.items = base.options.itemsTabletSmall[1];
                }

                if (width <= base.options.itemsMobile[0] && base.options.itemsMobile !== false) {
                    base.options.items = base.options.itemsMobile[1];
                }
            }

            //if number of items is less than declared
            if (base.options.items > base.itemsAmount && base.options.itemsScaleUp === true) {
                base.options.items = base.itemsAmount;
            }
        },

        response : function () {
            var base = this,
                smallDelay,
                lastWindowWidth;

            if (base.options.responsive !== true) {
                return false;
            }
            lastWindowWidth = $(window).width();

            base.resizer = function () {
                if ($(window).width() !== lastWindowWidth) {
                    if (base.options.autoPlay !== false) {
                        window.clearInterval(base.autoPlayInterval);
                    }
                    window.clearTimeout(smallDelay);
                    smallDelay = window.setTimeout(function () {
                        lastWindowWidth = $(window).width();
                        base.updateVars();
                    }, base.options.responsiveRefreshRate);
                }
            };
            $(window).resize(base.resizer);
        },

        updatePosition : function () {
            var base = this;
            base.jumpTo(base.currentItem);
            if (base.options.autoPlay !== false) {
                base.checkAp();
            }
        },

        appendItemsSizes : function () {
            var base = this,
                roundPages = 0,
                lastItem = base.itemsAmount - base.options.items;

            base.$owlItems.each(function (index) {
                var $this = $(this);
                $this
                    .css({"width": base.itemWidth})
                    .data("owl-item", Number(index));

                if (index % base.options.items === 0 || index === lastItem) {
                    if (!(index > lastItem)) {
                        roundPages += 1;
                    }
                }
                $this.data("owl-roundPages", roundPages);
            });
        },

        appendWrapperSizes : function () {
            var base = this,
                width = base.$owlItems.length * base.itemWidth;

            base.$owlWrapper.css({
                "width": width * 2,
                "left": 0
            });
            base.appendItemsSizes();
        },

        calculateAll : function () {
            var base = this;
            base.calculateWidth();
            base.appendWrapperSizes();
            base.loops();
            base.max();
        },

        calculateWidth : function () {
            var base = this;
            base.itemWidth = Math.round(base.$elem.width() / base.options.items);
        },

        max : function () {
            var base = this,
                maximum = ((base.itemsAmount * base.itemWidth) - base.options.items * base.itemWidth) * -1;
            if (base.options.items > base.itemsAmount) {
                base.maximumItem = 0;
                maximum = 0;
                base.maximumPixels = 0;
            } else {
                base.maximumItem = base.itemsAmount - base.options.items;
                base.maximumPixels = maximum;
            }
            return maximum;
        },

        min : function () {
            return 0;
        },

        loops : function () {
            var base = this,
                prev = 0,
                elWidth = 0,
                i,
                item,
                roundPageNum;

            base.positionsInArray = [0];
            base.pagesInArray = [];

            for (i = 0; i < base.itemsAmount; i += 1) {
                elWidth += base.itemWidth;
                base.positionsInArray.push(-elWidth);

                if (base.options.scrollPerPage === true) {
                    item = $(base.$owlItems[i]);
                    roundPageNum = item.data("owl-roundPages");
                    if (roundPageNum !== prev) {
                        base.pagesInArray[prev] = base.positionsInArray[i];
                        prev = roundPageNum;
                    }
                }
            }
        },

        buildControls : function () {
            var base = this;
            if (base.options.navigation === true || base.options.pagination === true) {
                base.owlControls = $("<div class=\"owl-controls\"/>").toggleClass("clickable", !base.browser.isTouch).appendTo(base.$elem);
            }
            if (base.options.pagination === true) {
                base.buildPagination();
            }
            if (base.options.navigation === true) {
                base.buildButtons();
            }
        },

        buildButtons : function () {
            var base = this,
                buttonsWrapper = $("<div class=\"owl-buttons\"/>");
            base.owlControls.append(buttonsWrapper);

            base.buttonPrev = $("<div/>", {
                "class" : "owl-prev",
                "html" : base.options.navigationText[0] || ""
            });

            base.buttonNext = $("<div/>", {
                "class" : "owl-next",
                "html" : base.options.navigationText[1] || ""
            });

            buttonsWrapper
                .append(base.buttonPrev)
                .append(base.buttonNext);

            buttonsWrapper.on("touchstart.owlControls mousedown.owlControls", "div[class^=\"owl\"]", function (event) {
                event.preventDefault();
            });

            buttonsWrapper.on("touchend.owlControls mouseup.owlControls", "div[class^=\"owl\"]", function (event) {
                event.preventDefault();
                if ($(this).hasClass("owl-next")) {
                    base.next();
                } else {
                    base.prev();
                }
            });
        },

        buildPagination : function () {
            var base = this;

            base.paginationWrapper = $("<div class=\"owl-pagination\"/>");
            base.owlControls.append(base.paginationWrapper);

            base.paginationWrapper.on("touchend.owlControls mouseup.owlControls", ".owl-page", function (event) {
                event.preventDefault();
                if (Number($(this).data("owl-page")) !== base.currentItem) {
                    base.goTo(Number($(this).data("owl-page")), true);
                }
            });
        },

        updatePagination : function () {
            var base = this,
                counter,
                lastPage,
                lastItem,
                i,
                paginationButton,
                paginationButtonInner;

            if (base.options.pagination === false) {
                return false;
            }

            base.paginationWrapper.html("");

            counter = 0;
            lastPage = base.itemsAmount - base.itemsAmount % base.options.items;

            for (i = 0; i < base.itemsAmount; i += 1) {
                if (i % base.options.items === 0) {
                    counter += 1;
                    if (lastPage === i) {
                        lastItem = base.itemsAmount - base.options.items;
                    }
                    paginationButton = $("<div/>", {
                        "class" : "owl-page"
                    });
                    paginationButtonInner = $("<span></span>", {
                        "text": base.options.paginationNumbers === true ? counter : "",
                        "class": base.options.paginationNumbers === true ? "owl-numbers" : ""
                    });
                    paginationButton.append(paginationButtonInner);

                    paginationButton.data("owl-page", lastPage === i ? lastItem : i);
                    paginationButton.data("owl-roundPages", counter);

                    base.paginationWrapper.append(paginationButton);
                }
            }
            base.checkPagination();
        },
        checkPagination : function () {
            var base = this;
            if (base.options.pagination === false) {
                return false;
            }
            base.paginationWrapper.find(".owl-page").each(function () {
                if ($(this).data("owl-roundPages") === $(base.$owlItems[base.currentItem]).data("owl-roundPages")) {
                    base.paginationWrapper
                        .find(".owl-page")
                        .removeClass("active");
                    $(this).addClass("active");
                }
            });
        },

        checkNavigation : function () {
            var base = this;

            if (base.options.navigation === false) {
                return false;
            }
            if (base.options.rewindNav === false) {
                if (base.currentItem === 0 && base.maximumItem === 0) {
                    base.buttonPrev.addClass("disabled");
                    base.buttonNext.addClass("disabled");
                } else if (base.currentItem === 0 && base.maximumItem !== 0) {
                    base.buttonPrev.addClass("disabled");
                    base.buttonNext.removeClass("disabled");
                } else if (base.currentItem === base.maximumItem) {
                    base.buttonPrev.removeClass("disabled");
                    base.buttonNext.addClass("disabled");
                } else if (base.currentItem !== 0 && base.currentItem !== base.maximumItem) {
                    base.buttonPrev.removeClass("disabled");
                    base.buttonNext.removeClass("disabled");
                }
            }
        },

        updateControls : function () {
            var base = this;
            base.updatePagination();
            base.checkNavigation();
            if (base.owlControls) {
                if (base.options.items >= base.itemsAmount) {
                    base.owlControls.hide();
                } else {
                    base.owlControls.show();
                }
            }
        },

        destroyControls : function () {
            var base = this;
            if (base.owlControls) {
                base.owlControls.remove();
            }
        },

        next : function (speed) {
            var base = this;

            if (base.isTransition) {
                return false;
            }

            base.currentItem += base.options.scrollPerPage === true ? base.options.items : 1;
            if (base.currentItem > base.maximumItem + (base.options.scrollPerPage === true ? (base.options.items - 1) : 0)) {
                if (base.options.rewindNav === true) {
                    base.currentItem = 0;
                    speed = "rewind";
                } else {
                    base.currentItem = base.maximumItem;
                    return false;
                }
            }
            base.goTo(base.currentItem, speed);
        },

        prev : function (speed) {
            var base = this;

            if (base.isTransition) {
                return false;
            }

            if (base.options.scrollPerPage === true && base.currentItem > 0 && base.currentItem < base.options.items) {
                base.currentItem = 0;
            } else {
                base.currentItem -= base.options.scrollPerPage === true ? base.options.items : 1;
            }
            if (base.currentItem < 0) {
                if (base.options.rewindNav === true) {
                    base.currentItem = base.maximumItem;
                    speed = "rewind";
                } else {
                    base.currentItem = 0;
                    return false;
                }
            }
            base.goTo(base.currentItem, speed);
        },

        goTo : function (position, speed, drag) {
            var base = this,
                goToPixel;

            if (base.isTransition) {
                return false;
            }
            if (typeof base.options.beforeMove === "function") {
                base.options.beforeMove.apply(this, [base.$elem]);
            }
            if (position >= base.maximumItem) {
                position = base.maximumItem;
            } else if (position <= 0) {
                position = 0;
            }

            base.currentItem = base.owl.currentItem = position;
            if (base.options.transitionStyle !== false && drag !== "drag" && base.options.items === 1 && base.browser.support3d === true) {
                base.swapSpeed(0);
                if (base.browser.support3d === true) {
                    base.transition3d(base.positionsInArray[position]);
                } else {
                    base.css2slide(base.positionsInArray[position], 1);
                }
                base.afterGo();
                base.singleItemTransition();
                return false;
            }
            goToPixel = base.positionsInArray[position];

            if (base.browser.support3d === true) {
                base.isCss3Finish = false;

                if (speed === true) {
                    base.swapSpeed("paginationSpeed");
                    window.setTimeout(function () {
                        base.isCss3Finish = true;
                    }, base.options.paginationSpeed);

                } else if (speed === "rewind") {
                    base.swapSpeed(base.options.rewindSpeed);
                    window.setTimeout(function () {
                        base.isCss3Finish = true;
                    }, base.options.rewindSpeed);

                } else {
                    base.swapSpeed("slideSpeed");
                    window.setTimeout(function () {
                        base.isCss3Finish = true;
                    }, base.options.slideSpeed);
                }
                base.transition3d(goToPixel);
            } else {
                if (speed === true) {
                    base.css2slide(goToPixel, base.options.paginationSpeed);
                } else if (speed === "rewind") {
                    base.css2slide(goToPixel, base.options.rewindSpeed);
                } else {
                    base.css2slide(goToPixel, base.options.slideSpeed);
                }
            }
            base.afterGo();
        },

        jumpTo : function (position) {
            var base = this;
            if (typeof base.options.beforeMove === "function") {
                base.options.beforeMove.apply(this, [base.$elem]);
            }
            if (position >= base.maximumItem || position === -1) {
                position = base.maximumItem;
            } else if (position <= 0) {
                position = 0;
            }
            base.swapSpeed(0);
            if (base.browser.support3d === true) {
                base.transition3d(base.positionsInArray[position]);
            } else {
                base.css2slide(base.positionsInArray[position], 1);
            }
            base.currentItem = base.owl.currentItem = position;
            base.afterGo();
        },

        afterGo : function () {
            var base = this;

            base.prevArr.push(base.currentItem);
            base.prevItem = base.owl.prevItem = base.prevArr[base.prevArr.length - 2];
            base.prevArr.shift(0);

            if (base.prevItem !== base.currentItem) {
                base.checkPagination();
                base.checkNavigation();
                base.eachMoveUpdate();

                if (base.options.autoPlay !== false) {
                    base.checkAp();
                }
            }
            if (typeof base.options.afterMove === "function" && base.prevItem !== base.currentItem) {
                base.options.afterMove.apply(this, [base.$elem]);
            }
        },

        stop : function () {
            var base = this;
            base.apStatus = "stop";
            window.clearInterval(base.autoPlayInterval);
        },

        checkAp : function () {
            var base = this;
            if (base.apStatus !== "stop") {
                base.play();
            }
        },

        play : function () {
            var base = this;
            base.apStatus = "play";
            if (base.options.autoPlay === false) {
                return false;
            }
            window.clearInterval(base.autoPlayInterval);
            base.autoPlayInterval = window.setInterval(function () {
                base.next(true);
            }, base.options.autoPlay);
        },

        swapSpeed : function (action) {
            var base = this;
            if (action === "slideSpeed") {
                base.$owlWrapper.css(base.addCssSpeed(base.options.slideSpeed));
            } else if (action === "paginationSpeed") {
                base.$owlWrapper.css(base.addCssSpeed(base.options.paginationSpeed));
            } else if (typeof action !== "string") {
                base.$owlWrapper.css(base.addCssSpeed(action));
            }
        },

        addCssSpeed : function (speed) {
            return {
                "-webkit-transition": "all " + speed + "ms ease",
                "-moz-transition": "all " + speed + "ms ease",
                "-o-transition": "all " + speed + "ms ease",
                "transition": "all " + speed + "ms ease"
            };
        },

        removeTransition : function () {
            return {
                "-webkit-transition": "",
                "-moz-transition": "",
                "-o-transition": "",
                "transition": ""
            };
        },

        doTranslate : function (pixels) {
            return {
                "-webkit-transform": "translate3d(" + pixels + "px, 0px, 0px)",
                "-moz-transform": "translate3d(" + pixels + "px, 0px, 0px)",
                "-o-transform": "translate3d(" + pixels + "px, 0px, 0px)",
                "-ms-transform": "translate3d(" + pixels + "px, 0px, 0px)",
                "transform": "translate3d(" + pixels + "px, 0px,0px)"
            };
        },

        transition3d : function (value) {
            var base = this;
            base.$owlWrapper.css(base.doTranslate(value));
        },

        css2move : function (value) {
            var base = this;
            base.$owlWrapper.css({"left" : value});
        },

        css2slide : function (value, speed) {
            var base = this;

            base.isCssFinish = false;
            base.$owlWrapper.stop(true, true).animate({
                "left" : value
            }, {
                duration : speed || base.options.slideSpeed,
                complete : function () {
                    base.isCssFinish = true;
                }
            });
        },

        checkBrowser : function () {
            var base = this,
                translate3D = "translate3d(0px, 0px, 0px)",
                tempElem = document.createElement("div"),
                regex,
                asSupport,
                support3d,
                isTouch;

            tempElem.style.cssText = "  -moz-transform:" + translate3D +
                                  "; -ms-transform:"     + translate3D +
                                  "; -o-transform:"      + translate3D +
                                  "; -webkit-transform:" + translate3D +
                                  "; transform:"         + translate3D;
            regex = /translate3d\(0px, 0px, 0px\)/g;
            asSupport = tempElem.style.cssText.match(regex);
            support3d = (asSupport !== null && asSupport.length === 1);

            isTouch = "ontouchstart" in window || window.navigator.msMaxTouchPoints;

            base.browser = {
                "support3d" : support3d,
                "isTouch" : isTouch
            };
        },

        moveEvents : function () {
            var base = this;
            if (base.options.mouseDrag !== false || base.options.touchDrag !== false) {
                base.gestures();
                base.disabledEvents();
            }
        },

        eventTypes : function () {
            var base = this,
                types = ["s", "e", "x"];

            base.ev_types = {};

            if (base.options.mouseDrag === true && base.options.touchDrag === true) {
                types = [
                    "touchstart.owl mousedown.owl",
                    "touchmove.owl mousemove.owl",
                    "touchend.owl touchcancel.owl mouseup.owl"
                ];
            } else if (base.options.mouseDrag === false && base.options.touchDrag === true) {
                types = [
                    "touchstart.owl",
                    "touchmove.owl",
                    "touchend.owl touchcancel.owl"
                ];
            } else if (base.options.mouseDrag === true && base.options.touchDrag === false) {
                types = [
                    "mousedown.owl",
                    "mousemove.owl",
                    "mouseup.owl"
                ];
            }

            base.ev_types.start = types[0];
            base.ev_types.move = types[1];
            base.ev_types.end = types[2];
        },

        disabledEvents :  function () {
            var base = this;
            base.$elem.on("dragstart.owl", function (event) { event.preventDefault(); });
            base.$elem.on("mousedown.disableTextSelect", function (e) {
                return $(e.target).is('input, textarea, select, option');
            });
        },

        gestures : function () {
            /*jslint unparam: true*/
            var base = this,
                locals = {
                    offsetX : 0,
                    offsetY : 0,
                    baseElWidth : 0,
                    relativePos : 0,
                    position: null,
                    minSwipe : null,
                    maxSwipe: null,
                    sliding : null,
                    dargging: null,
                    targetElement : null
                };

            base.isCssFinish = true;

            function getTouches(event) {
                if (event.touches !== undefined) {
                    return {
                        x : event.touches[0].pageX,
                        y : event.touches[0].pageY
                    };
                }

                if (event.touches === undefined) {
                    if (event.pageX !== undefined) {
                        return {
                            x : event.pageX,
                            y : event.pageY
                        };
                    }
                    if (event.pageX === undefined) {
                        return {
                            x : event.clientX,
                            y : event.clientY
                        };
                    }
                }
            }

            function swapEvents(type) {
                if (type === "on") {
                    $(document).on(base.ev_types.move, dragMove);
                    $(document).on(base.ev_types.end, dragEnd);
                } else if (type === "off") {
                    $(document).off(base.ev_types.move);
                    $(document).off(base.ev_types.end);
                }
            }

            function dragStart(event) {
                var ev = event.originalEvent || event || window.event,
                    position;

                if (ev.which === 3) {
                    return false;
                }
                if (base.itemsAmount <= base.options.items) {
                    return;
                }
                if (base.isCssFinish === false && !base.options.dragBeforeAnimFinish) {
                    return false;
                }
                if (base.isCss3Finish === false && !base.options.dragBeforeAnimFinish) {
                    return false;
                }

                if (base.options.autoPlay !== false) {
                    window.clearInterval(base.autoPlayInterval);
                }

                if (base.browser.isTouch !== true && !base.$owlWrapper.hasClass("grabbing")) {
                    base.$owlWrapper.addClass("grabbing");
                }

                base.newPosX = 0;
                base.newRelativeX = 0;

                $(this).css(base.removeTransition());

                position = $(this).position();
                locals.relativePos = position.left;

                locals.offsetX = getTouches(ev).x - position.left;
                locals.offsetY = getTouches(ev).y - position.top;

                swapEvents("on");

                locals.sliding = false;
                locals.targetElement = ev.target || ev.srcElement;
            }

            function dragMove(event) {
                var ev = event.originalEvent || event || window.event,
                    minSwipe,
                    maxSwipe;

                base.newPosX = getTouches(ev).x - locals.offsetX;
                base.newPosY = getTouches(ev).y - locals.offsetY;
                base.newRelativeX = base.newPosX - locals.relativePos;

                if (typeof base.options.startDragging === "function" && locals.dragging !== true && base.newRelativeX !== 0) {
                    locals.dragging = true;
                    base.options.startDragging.apply(base, [base.$elem]);
                }

                if ((base.newRelativeX > 8 || base.newRelativeX < -8) && (base.browser.isTouch === true)) {
                    if (ev.preventDefault !== undefined) {
                        ev.preventDefault();
                    } else {
                        ev.returnValue = false;
                    }
                    locals.sliding = true;
                }

                if ((base.newPosY > 10 || base.newPosY < -10) && locals.sliding === false) {
                    $(document).off("touchmove.owl");
                }

                minSwipe = function () {
                    return base.newRelativeX / 5;
                };

                maxSwipe = function () {
                    return base.maximumPixels + base.newRelativeX / 5;
                };

                base.newPosX = Math.max(Math.min(base.newPosX, minSwipe()), maxSwipe());
                if (base.browser.support3d === true) {
                    base.transition3d(base.newPosX);
                } else {
                    base.css2move(base.newPosX);
                }
            }

            function dragEnd(event) {
                var ev = event.originalEvent || event || window.event,
                    newPosition,
                    handlers,
                    owlStopEvent;

                ev.target = ev.target || ev.srcElement;

                locals.dragging = false;

                if (base.browser.isTouch !== true) {
                    base.$owlWrapper.removeClass("grabbing");
                }

                if (base.newRelativeX < 0) {
                    base.dragDirection = base.owl.dragDirection = "left";
                } else {
                    base.dragDirection = base.owl.dragDirection = "right";
                }

                if (base.newRelativeX !== 0) {
                    newPosition = base.getNewPosition();
                    base.goTo(newPosition, false, "drag");
                    if (locals.targetElement === ev.target && base.browser.isTouch !== true) {
                        $(ev.target).on("click.disable", function (ev) {
                            ev.stopImmediatePropagation();
                            ev.stopPropagation();
                            ev.preventDefault();
                            $(ev.target).off("click.disable");
                        });
                        handlers = $._data(ev.target, "events").click;
                        owlStopEvent = handlers.pop();
                        handlers.splice(0, 0, owlStopEvent);
                    }
                }
                swapEvents("off");
            }
            base.$elem.on(base.ev_types.start, ".owl-wrapper", dragStart);
        },

        getNewPosition : function () {
            var base = this,
                newPosition = base.closestItem();

            if (newPosition > base.maximumItem) {
                base.currentItem = base.maximumItem;
                newPosition  = base.maximumItem;
            } else if (base.newPosX >= 0) {
                newPosition = 0;
                base.currentItem = 0;
            }
            return newPosition;
        },
        closestItem : function () {
            var base = this,
                array = base.options.scrollPerPage === true ? base.pagesInArray : base.positionsInArray,
                goal = base.newPosX,
                closest = null;

            $.each(array, function (i, v) {
                if (goal - (base.itemWidth / 20) > array[i + 1] && goal - (base.itemWidth / 20) < v && base.moveDirection() === "left") {
                    closest = v;
                    if (base.options.scrollPerPage === true) {
                        base.currentItem = $.inArray(closest, base.positionsInArray);
                    } else {
                        base.currentItem = i;
                    }
                } else if (goal + (base.itemWidth / 20) < v && goal + (base.itemWidth / 20) > (array[i + 1] || array[i] - base.itemWidth) && base.moveDirection() === "right") {
                    if (base.options.scrollPerPage === true) {
                        closest = array[i + 1] || array[array.length - 1];
                        base.currentItem = $.inArray(closest, base.positionsInArray);
                    } else {
                        closest = array[i + 1];
                        base.currentItem = i + 1;
                    }
                }
            });
            return base.currentItem;
        },

        moveDirection : function () {
            var base = this,
                direction;
            if (base.newRelativeX < 0) {
                direction = "right";
                base.playDirection = "next";
            } else {
                direction = "left";
                base.playDirection = "prev";
            }
            return direction;
        },

        customEvents : function () {
            /*jslint unparam: true*/
            var base = this;
            base.$elem.on("owl.next", function () {
                base.next();
            });
            base.$elem.on("owl.prev", function () {
                base.prev();
            });
            base.$elem.on("owl.play", function (event, speed) {
                base.options.autoPlay = speed;
                base.play();
                base.hoverStatus = "play";
            });
            base.$elem.on("owl.stop", function () {
                base.stop();
                base.hoverStatus = "stop";
            });
            base.$elem.on("owl.goTo", function (event, item) {
                base.goTo(item);
            });
            base.$elem.on("owl.jumpTo", function (event, item) {
                base.jumpTo(item);
            });
        },

        stopOnHover : function () {
            var base = this;
            if (base.options.stopOnHover === true && base.browser.isTouch !== true && base.options.autoPlay !== false) {
                base.$elem.on("mouseover", function () {
                    base.stop();
                });
                base.$elem.on("mouseout", function () {
                    if (base.hoverStatus !== "stop") {
                        base.play();
                    }
                });
            }
        },

        lazyLoad : function () {
            var base = this,
                i,
                $item,
                itemNumber,
                $lazyImg,
                follow;

            if (base.options.lazyLoad === false) {
                return false;
            }
            for (i = 0; i < base.itemsAmount; i += 1) {
                $item = $(base.$owlItems[i]);

                if ($item.data("owl-loaded") === "loaded") {
                    continue;
                }

                itemNumber = $item.data("owl-item");
                $lazyImg = $item.find(".lazyOwl");

                if (typeof $lazyImg.data("src") !== "string") {
                    $item.data("owl-loaded", "loaded");
                    continue;
                }
                if ($item.data("owl-loaded") === undefined) {
                    $lazyImg.hide();
                    $item.addClass("loading").data("owl-loaded", "checked");
                }
                if (base.options.lazyFollow === true) {
                    follow = itemNumber >= base.currentItem;
                } else {
                    follow = true;
                }
                if (follow && itemNumber < base.currentItem + base.options.items && $lazyImg.length) {
                    base.lazyPreload($item, $lazyImg);
                }
            }
        },

        lazyPreload : function ($item, $lazyImg) {
            var base = this,
                iterations = 0,
                isBackgroundImg;

            if ($lazyImg.prop("tagName") === "DIV") {
                $lazyImg.css("background-image", "url(" + $lazyImg.data("src") + ")");
                isBackgroundImg = true;
            } else {
                $lazyImg[0].src = $lazyImg.data("src");
            }

            function showImage() {
                $item.data("owl-loaded", "loaded").removeClass("loading");
                $lazyImg.removeAttr("data-src");
                if (base.options.lazyEffect === "fade") {
                    $lazyImg.fadeIn(400);
                } else {
                    $lazyImg.show();
                }
                if (typeof base.options.afterLazyLoad === "function") {
                    base.options.afterLazyLoad.apply(this, [base.$elem]);
                }
            }

            function checkLazyImage() {
                iterations += 1;
                if (base.completeImg($lazyImg.get(0)) || isBackgroundImg === true) {
                    showImage();
                } else if (iterations <= 100) {//if image loads in less than 10 seconds 
                    window.setTimeout(checkLazyImage, 100);
                } else {
                    showImage();
                }
            }

            checkLazyImage();
        },

        autoHeight : function () {
            var base = this,
                $currentimg = $(base.$owlItems[base.currentItem]).find("img"),
                iterations;

            function addHeight() {
                var $currentItem = $(base.$owlItems[base.currentItem]).height();
                base.wrapperOuter.css("height", $currentItem + "px");
                if (!base.wrapperOuter.hasClass("autoHeight")) {
                    window.setTimeout(function () {
                        base.wrapperOuter.addClass("autoHeight");
                    }, 0);
                }
            }

            function checkImage() {
                iterations += 1;
                if (base.completeImg($currentimg.get(0))) {
                    addHeight();
                } else if (iterations <= 100) { //if image loads in less than 10 seconds 
                    window.setTimeout(checkImage, 100);
                } else {
                    base.wrapperOuter.css("height", ""); //Else remove height attribute
                }
            }

            if ($currentimg.get(0) !== undefined) {
                iterations = 0;
                checkImage();
            } else {
                addHeight();
            }
        },

        completeImg : function (img) {
            var naturalWidthType;

            if (!img.complete) {
                return false;
            }
            naturalWidthType = typeof img.naturalWidth;
            if (naturalWidthType !== "undefined" && img.naturalWidth === 0) {
                return false;
            }
            return true;
        },

        onVisibleItems : function () {
            var base = this,
                i;

            if (base.options.addClassActive === true) {
                base.$owlItems.removeClass("active");
            }
            base.visibleItems = [];
            for (i = base.currentItem; i < base.currentItem + base.options.items; i += 1) {
                base.visibleItems.push(i);

                if (base.options.addClassActive === true) {
                    $(base.$owlItems[i]).addClass("active");
                }
            }
            base.owl.visibleItems = base.visibleItems;
        },

        transitionTypes : function (className) {
            var base = this;
            //Currently available: "fade", "backSlide", "goDown", "fadeUp"
            base.outClass = "owl-" + className + "-out";
            base.inClass = "owl-" + className + "-in";
        },

        singleItemTransition : function () {
            var base = this,
                outClass = base.outClass,
                inClass = base.inClass,
                $currentItem = base.$owlItems.eq(base.currentItem),
                $prevItem = base.$owlItems.eq(base.prevItem),
                prevPos = Math.abs(base.positionsInArray[base.currentItem]) + base.positionsInArray[base.prevItem],
                origin = Math.abs(base.positionsInArray[base.currentItem]) + base.itemWidth / 2,
                animEnd = 'webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend';

            base.isTransition = true;

            base.$owlWrapper
                .addClass('owl-origin')
                .css({
                    "-webkit-transform-origin" : origin + "px",
                    "-moz-perspective-origin" : origin + "px",
                    "perspective-origin" : origin + "px"
                });
            function transStyles(prevPos) {
                return {
                    "position" : "relative",
                    "left" : prevPos + "px"
                };
            }

            $prevItem
                .css(transStyles(prevPos, 10))
                .addClass(outClass)
                .on(animEnd, function () {
                    base.endPrev = true;
                    $prevItem.off(animEnd);
                    base.clearTransStyle($prevItem, outClass);
                });

            $currentItem
                .addClass(inClass)
                .on(animEnd, function () {
                    base.endCurrent = true;
                    $currentItem.off(animEnd);
                    base.clearTransStyle($currentItem, inClass);
                });
        },

        clearTransStyle : function (item, classToRemove) {
            var base = this;
            item.css({
                "position" : "",
                "left" : ""
            }).removeClass(classToRemove);

            if (base.endPrev && base.endCurrent) {
                base.$owlWrapper.removeClass('owl-origin');
                base.endPrev = false;
                base.endCurrent = false;
                base.isTransition = false;
            }
        },

        owlStatus : function () {
            var base = this;
            base.owl = {
                "userOptions"   : base.userOptions,
                "baseElement"   : base.$elem,
                "userItems"     : base.$userItems,
                "owlItems"      : base.$owlItems,
                "currentItem"   : base.currentItem,
                "prevItem"      : base.prevItem,
                "visibleItems"  : base.visibleItems,
                "isTouch"       : base.browser.isTouch,
                "browser"       : base.browser,
                "dragDirection" : base.dragDirection
            };
        },

        clearEvents : function () {
            var base = this;
            base.$elem.off(".owl owl mousedown.disableTextSelect");
            $(document).off(".owl owl");
            $(window).off("resize", base.resizer);
        },

        unWrap : function () {
            var base = this;
            if (base.$elem.children().length !== 0) {
                base.$owlWrapper.unwrap();
                base.$userItems.unwrap().unwrap();
                if (base.owlControls) {
                    base.owlControls.remove();
                }
            }
            base.clearEvents();
            base.$elem
                .attr("style", base.$elem.data("owl-originalStyles") || "")
                .attr("class", base.$elem.data("owl-originalClasses"));
        },

        destroy : function () {
            var base = this;
            base.stop();
            window.clearInterval(base.checkVisible);
            base.unWrap();
            base.$elem.removeData();
        },

        reinit : function (newOptions) {
            var base = this,
                options = $.extend({}, base.userOptions, newOptions);
            base.unWrap();
            base.init(options, base.$elem);
        },

        addItem : function (htmlString, targetPosition) {
            var base = this,
                position;

            if (!htmlString) {return false; }

            if (base.$elem.children().length === 0) {
                base.$elem.append(htmlString);
                base.setVars();
                return false;
            }
            base.unWrap();
            if (targetPosition === undefined || targetPosition === -1) {
                position = -1;
            } else {
                position = targetPosition;
            }
            if (position >= base.$userItems.length || position === -1) {
                base.$userItems.eq(-1).after(htmlString);
            } else {
                base.$userItems.eq(position).before(htmlString);
            }

            base.setVars();
        },

        removeItem : function (targetPosition) {
            var base = this,
                position;

            if (base.$elem.children().length === 0) {
                return false;
            }
            if (targetPosition === undefined || targetPosition === -1) {
                position = -1;
            } else {
                position = targetPosition;
            }

            base.unWrap();
            base.$userItems.eq(position).remove();
            base.setVars();
        }

    };

    $.fn.owlCarousel = function (options) {
        return this.each(function () {
            if ($(this).data("owl-init") === true) {
                return false;
            }
            $(this).data("owl-init", true);
            var carousel = Object.create(Carousel);
            carousel.init(options, this);
            $.data(this, "owlCarousel", carousel);
        });
    };

    $.fn.owlCarousel.options = {

        items : 5,
        itemsCustom : false,
        itemsDesktop : [1199, 4],
        itemsDesktopSmall : [979, 3],
        itemsTablet : [768, 2],
        itemsTabletSmall : false,
        itemsMobile : [479, 1],
        singleItem : false,
        itemsScaleUp : false,

        slideSpeed : 200,
        paginationSpeed : 800,
        rewindSpeed : 1000,

        autoPlay : false,
        stopOnHover : false,

        navigation : false,
        navigationText : ["prev", "next"],
        rewindNav : true,
        scrollPerPage : false,

        pagination : true,
        paginationNumbers : false,

        responsive : true,
        responsiveRefreshRate : 200,
        responsiveBaseWidth : window,

        baseClass : "owl-carousel",
        theme : "owl-theme",

        lazyLoad : false,
        lazyFollow : true,
        lazyEffect : "fade",

        autoHeight : false,

        jsonPath : false,
        jsonSuccess : false,

        dragBeforeAnimFinish : true,
        mouseDrag : true,
        touchDrag : true,

        addClassActive : false,
        transitionStyle : false,

        beforeUpdate : false,
        afterUpdate : false,
        beforeInit : false,
        afterInit : false,
        beforeMove : false,
        afterMove : false,
        afterAction : false,
        startDragging : false,
        afterLazyLoad: false
    };
}(jQuery, window, document));
/* 
 * Picker v3.1.2 - 2014-11-25 
 * A jQuery plugin for replacing default checkboxes and radios. Part of the formstone library. 
 * http://formstone.it/picker/ 
 * 
 * Copyright 2014 Ben Plum; MIT Licensed 
 */


;(function ($, window) {
	"use strict";

	var isIE8 = (document.all && document.querySelector && !document.addEventListener);

	/**
	 * @options
	 * @param customClass [string] <''> "Class applied to instance"
	 * @param toggle [boolean] <false> "Render 'toggle' styles"
	 * @param labels.on [string] <'ON'> "Label for 'On' position; 'toggle' only"
	 * @param labels.off [string] <'OFF'> "Label for 'Off' position; 'toggle' only"
	 */
	var options = {
		customClass: "",
		toggle: false,
		labels: {
			on: "ON",
			off: "OFF"
		}
	};

	var pub = {

		/**
		 * @method
		 * @name defaults
		 * @description Sets default plugin options
		 * @param opts [object] <{}> "Options object"
		 * @example $.picker("defaults", opts);
		 */
		defaults: function(opts) {
			options = $.extend(options, opts || {});
			return (typeof this === 'object') ? $(this) : true;
		},

		/**
		 * @method
		 * @name destroy
		 * @description Removes instance of plugin
		 * @example $(".target").picker("destroy");
		 */
		destroy: function() {
			return $(this).each(function(i, input) {
				var data = $(input).data("picker");

				if (data) {
					data.$picker.off(".picker");
					data.$handle.remove();
					data.$labels.remove();
					data.$input.off(".picker")
							   .removeClass("picker-element")
							   .data("picker", null);
					data.$label.removeClass("picker-label")
							   .unwrap();
				}
			});
		},

		/**
		 * @method
		 * @name disable
		 * @description Disables target instance
		 * @example $(".target").picker("disable");
		 */
		disable: function() {
			return $(this).each(function(i, input) {
				var data = $(input).data("picker");

				if (data) {
					data.$input.prop("disabled", true);
					data.$picker.addClass("disabled");
				}
			});
		},

		/**
		 * @method
		 * @name enable
		 * @description Enables target instance
		 * @example $(".target").picker("enable");
		 */
		enable: function() {
			return $(this).each(function(i, input) {
				var data = $(input).data("picker");

				if (data) {
					data.$input.prop("disabled", false);
					data.$picker.removeClass("disabled");
				}
			});
		},

		/**
		 * @method
		 * @name update
		 * @description Updates instance of plugin
		 * @example $(".target").picker("update");
		 */
		update: function() {
			return $(this).each(function(i, input) {
				var data = $(input).data("picker");

				if (data && !data.$input.is(":disabled")) {
					if (data.$input.is(":checked")) {
						_onSelect({ data: data }, true);
					} else {
						_onDeselect({ data: data }, true);
					}
				}
			});
		}
	};

	/**
	 * @method private
	 * @name _init
	 * @description Initializes plugin
	 * @param opts [object] "Initialization options"
	 */
	function _init(opts) {
		// Settings
		opts = $.extend({}, options, opts);

		// Apply to each element
		var $items = $(this);
		for (var i = 0, count = $items.length; i < count; i++) {
			_build($items.eq(i), opts);
		}
		return $items;
	}

	/**
	 * @method private
	 * @name _build
	 * @description Builds each instance
	 * @param $input [jQuery object] "Target jQuery object"
	 * @param opts [object] <{}> "Options object"
	 */
	function _build($input, opts) {
		if (!$input.data("picker")) {
			// EXTEND OPTIONS
			opts = $.extend({}, opts, $input.data("picker-options"));

			var $parent = $input.closest("label"),
				$label = $parent.length ? $parent.eq(0) : $("label[for=" + $input.attr("id") + "]"),
				type = $input.attr("type"),
				typeClass = "picker-" + (type === "radio" ? "radio" : "checkbox"),
				group = $input.attr("name"),
				html = '<div class="picker-handle"><div class="picker-flag" /></div>';

			if (opts.toggle) {
				typeClass += " picker-toggle";
				html = '<span class="picker-toggle-label on">' + opts.labels.on + '</span><span class="picker-toggle-label off">' + opts.labels.off + '</span>' + html;
			}

			// Modify DOM
			$input.addClass("picker-element");

			if ($label.length) {
				$label.wrap('<div class="picker ' + typeClass + ' ' + opts.customClass + '" />')
					  .before(html)
					  .addClass("picker-label");
			} else {
				$input.before('<div class="picker ' + typeClass + ' ' + opts.customClass + '">' + html + '</div>');
			}

			// Store plugin data
			var $picker = ($label.length) ? $label.parents(".picker") : $input.prev(".picker"),
				$handle = $picker.find(".picker-handle"),
				$labels = $picker.find(".picker-toggle-label");

			// Check checked
			if ($input.is(":checked")) {
				$picker.addClass("checked");
			}

			// Check disabled
			if ($input.is(":disabled")) {
				$picker.addClass("disabled");
			}

			var data = $.extend({}, opts, {
				$picker: $picker,
				$input: $input,
				$handle: $handle,
				$label: $label,
				$labels: $labels,
				group: group,
				isRadio: (type === "radio"),
				isCheckbox: (type === "checkbox")
			});

			// Bind click events
			data.$input.on("focus.picker", data, _onFocus)
					   .on("blur.picker", data, _onBlur)
					   .on("change.picker", data, _onChange)
					   .on("click.picker", data, _onClick)
					   .on("deselect.picker", data, _onDeselect)
					   .data("picker", data);

			data.$picker.on("click.picker", data, _onClick);
		}
	}

	/**
	 * @method private
	 * @name _onClick
	 * @description Handles instance clicks
	 * @param e [object] "Event data"
	 */
	function _onClick(e) {
		e.stopPropagation();

		var data = e.data;

		if (!$(e.target).is(data.$input)) {
			e.preventDefault();

			data.$input.trigger("click");
		}
	}

	/**
	 * @method private
	 * @name _onChange
	 * @description Handles external changes
	 * @param e [object] "Event data"
	 */
	function _onChange(e) {
		var data = e.data;

		if (!data.$input.is(":disabled")) {
			// Checkbox change events fire after state has changed
			var checked = data.$input.is(":checked");
			if (data.isCheckbox) {
				if (checked) {
					_onSelect(e, true);
				} else {
					_onDeselect(e, true);
				}
			} else {
				// radio
				if (checked || (isIE8 && !checked)) {
					_onSelect(e);
				}
			}
		}
	}

	/**
	 * @method private
	 * @name _onSelect
	 * @description Changes input to "checked"
	 * @param e [object] "Event data"
	 * @param internal [boolean] "Internal update flag"
	 */
	function _onSelect(e, internal) {
		var data = e.data;

		if (typeof data.group !== "undefined" && data.isRadio) {
			$('input[name="' + data.group + '"]').not(data.$input).trigger("deselect");
		}

		data.$picker.addClass("checked");
	}

	/**
	 * @method private
	 * @name _onDeselect
	 * @description Changes input from "checked"
	 * @param e [object] "Event data"
	 * @param internal [boolean] "Internal update flag"
	 */
	function _onDeselect(e, internal) {
		var data = e.data;

		data.$picker.removeClass("checked");
	}

	/**
	 * @method private
	 * @name _onFocus
	 * @description Handles instance focus
	 * @param e [object] "Event data"
	 */
	function _onFocus(e) {
		e.data.$picker.addClass("focus");
	}

	/**
	 * @method private
	 * @name _onBlur
	 * @description Handles instance blur
	 * @param e [object] "Event data"
	 */
	function _onBlur(e) {
		e.data.$picker.removeClass("focus");
	}

	$.fn.picker = function(method) {
		if (pub[method]) {
			return pub[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return _init.apply(this, arguments);
		}
		return this;
	};

	$.picker = function(method) {
		if (method === "defaults") {
			pub.defaults.apply(this, Array.prototype.slice.call(arguments, 1));
		}
	};
})(jQuery);
/* 
 * Selecter v3.2.4 - 2015-01-07 
 * A jQuery plugin for replacing default select elements. Part of the Formstone Library. 
 * http://formstone.it/selecter/ 
 * 
 * Copyright 2015 Ben Plum; MIT Licensed 
 */


;(function ($, window) {
	"use strict";

	var guid = 0,
		userAgent = (window.navigator.userAgent||window.navigator.vendor||window.opera),
		isFirefox = /Firefox/i.test(userAgent),
		isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(userAgent),
		isFirefoxMobile = (isFirefox && isMobile),
		$body = null;

	/**
	 * @options
	 * @param callback [function] <$.noop> "Select item callback"
	 * @param cover [boolean] <false> "Cover handle with option set"
	 * @param customClass [string] <''> "Class applied to instance"
	 * @param label [string] <''> "Label displayed before selection"
	 * @param external [boolean] <false> "Open options as links in new window"
	 * @param links [boolean] <false> "Open options as links in same window"
	 * @param mobile [boolean] <false> "Force desktop interaction on mobile"
	 * @param trim [int] <0> "Trim options to specified length; 0 to disable”
	 */
	var options = {
		callback: $.noop,
		cover: false,
		customClass: "",
		label: "",
		external: false,
		links: false,
		mobile: false,
		trim: 0
	};

	var pub = {

		/**
		 * @method
		 * @name defaults
		 * @description Sets default plugin options
		 * @param opts [object] <{}> "Options object"
		 * @example $.selecter("defaults", opts);
		 */
		defaults: function(opts) {
			options = $.extend(options, opts || {});
			return (typeof this === 'object') ? $(this) : true;
		},

		/**
		 * @method
		 * @name disable
		 * @description Disables target instance or option
		 * @param option [string] <null> "Target option value"
		 * @example $(".target").selecter("disable", "1");
		 */
		disable: function(option) {
			return $(this).each(function(i, input) {
				var data = $(input).parent(".selecter").data("selecter");

				if (data) {
					if (typeof option !== "undefined") {
						var index = data.$items.index( data.$items.filter("[data-value=" + option + "]") );

						data.$items.eq(index).addClass("disabled");
						data.$options.eq(index).prop("disabled", true);
					} else {
						if (data.$selecter.hasClass("open")) {
							data.$selecter.find(".selecter-selected").trigger("click.selecter");
						}

						data.$selecter.addClass("disabled");
						data.$select.prop("disabled", true);
					}
				}
			});
		},

		/**
		 * @method
		 * @name destroy
		 * @description Removes instance of plugin
		 * @example $(".target").selecter("destroy");
		 */
		destroy: function() {
			return $(this).each(function(i, input) {
				var data = $(input).parent(".selecter").data("selecter");

				if (data) {
					if (data.$selecter.hasClass("open")) {
						data.$selecter.find(".selecter-selected").trigger("click.selecter");
					}

					// Scroller support
					if ($.fn.scroller !== undefined) {
						data.$selecter.find(".selecter-options").scroller("destroy");
					}

					data.$select[0].tabIndex = data.tabIndex;

					data.$select.find(".selecter-placeholder").remove();
					data.$selected.remove();
					data.$itemsWrapper.remove();

					data.$selecter.off(".selecter");

					data.$select.off(".selecter")
								.removeClass("selecter-element")
								.show()
								.unwrap();
				}
			});
		},

		/**
		 * @method
		 * @name enable
		 * @description Enables target instance or option
		 * @param option [string] <null> "Target option value"
		 * @example $(".target").selecter("enable", "1");
		 */
		enable: function(option) {
			return $(this).each(function(i, input) {
				var data = $(input).parent(".selecter").data("selecter");

				if (data) {
					if (typeof option !== "undefined") {
						var index = data.$items.index( data.$items.filter("[data-value=" + option + "]") );
						data.$items.eq(index).removeClass("disabled");
						data.$options.eq(index).prop("disabled", false);
					} else {
						data.$selecter.removeClass("disabled");
						data.$select.prop("disabled", false);
					}
				}
			});
		},


		/**
		* @method private
		* @name refresh
		* @description DEPRECATED - Updates instance base on target options
		* @example $(".target").selecter("refresh");
		*/
		refresh: function() {
			return pub.update.apply($(this));
		},

		/**
		* @method
		* @name update
		* @description Updates instance base on target options
		* @example $(".target").selecter("update");
		*/
		update: function() {
			return $(this).each(function(i, input) {
				var data = $(input).parent(".selecter").data("selecter");

				if (data) {
					var index = data.index;

					data.$allOptions = data.$select.find("option, optgroup");
					data.$options = data.$allOptions.filter("option");
					data.index = -1;

					index = data.$options.index(data.$options.filter(":selected"));

					_buildOptions(data);

					if (!data.multiple) {
						_update(index, data);
					}
				}
			});
		}
	};

	/**
	 * @method private
	 * @name _init
	 * @description Initializes plugin
	 * @param opts [object] "Initialization options"
	 */
	function _init(opts) {
		// Local options
		opts = $.extend({}, options, opts || {});

		// Check for Body
		if ($body === null) {
			$body = $("body");
		}

		// Apply to each element
		var $items = $(this);
		for (var i = 0, count = $items.length; i < count; i++) {
			_build($items.eq(i), opts);
		}
		return $items;
	}

	/**
	 * @method private
	 * @name _build
	 * @description Builds each instance
	 * @param $select [jQuery object] "Target jQuery object"
	 * @param opts [object] <{}> "Options object"
	 */
	function _build($select, opts) {
		if (!$select.hasClass("selecter-element")) {
			// EXTEND OPTIONS
			opts = $.extend({}, opts, $select.data("selecter-options"));

			opts.multiple = $select.prop("multiple");
			opts.disabled = $select.is(":disabled");

			if (opts.external) {
				opts.links = true;
			}

			// Grab true original index, only if selected attribute exits
			var $originalOption = $select.find("[selected]").not(":disabled"),
				originalOptionIndex = $select.find("option").index($originalOption);

			if (!opts.multiple && opts.label !== "") {
				$select.prepend('<option value="" class="selecter-placeholder" selected>' + opts.label + '</option>');
				if (originalOptionIndex > -1) {
					originalOptionIndex++;
				}
			} else {
				opts.label = "";
			}

			// Build options array
			var $allOptions = $select.find("option, optgroup"),
				$options = $allOptions.filter("option");

			// If we didn't actually have a selected elemtn
			if (!$originalOption.length) {
				$originalOption = $options.eq(0);
			}

			// Determine original item
			var originalIndex = (originalOptionIndex > -1) ? originalOptionIndex : 0,
				originalLabel = (opts.label !== "") ? opts.label : $originalOption.text(),
				wrapperTag = "div";

			// Swap tab index, no more interacting with the actual select!
			opts.tabIndex = $select[0].tabIndex;
			$select[0].tabIndex = -1;

			// Build HTML
			var inner = "",
				wrapper = "";

			// Build wrapper
			wrapper += '<' + wrapperTag + ' class="selecter ' + opts.customClass;
			// Special case classes
			if (isMobile) {
				wrapper += ' mobile';
			} else if (opts.cover) {
				wrapper += ' cover';
			}
			if (opts.multiple) {
				wrapper += ' multiple';
			} else {
				wrapper += ' closed';
			}
			if (opts.disabled) {
				wrapper += ' disabled';
			}
			wrapper += '" tabindex="' + opts.tabIndex + '">';
			wrapper += '</' + wrapperTag + '>';

			// Build inner
			if (!opts.multiple) {
				inner += '<span class="selecter-selected">';
				inner += $('<span></span>').text( _trim(originalLabel, opts.trim) ).html();
				inner += '</span>';
			}
			inner += '<div class="selecter-options">';
			inner += '</div>';

			// Modify DOM
			$select.addClass("selecter-element")
				   .wrap(wrapper)
				   .after(inner);

			// Store plugin data
			var $selecter = $select.parent(".selecter"),
				data = $.extend({
					$select: $select,
					$allOptions: $allOptions,
					$options: $options,
					$selecter: $selecter,
					$selected: $selecter.find(".selecter-selected"),
					$itemsWrapper: $selecter.find(".selecter-options"),
					index: -1,
					guid: guid++
				}, opts);

			_buildOptions(data);

			if (!data.multiple) {
				_update(originalIndex, data);
			}

			// Scroller support
			if ($.fn.scroller !== undefined) {
				data.$itemsWrapper.scroller();
			}

			// Bind click events
			data.$selecter.on("touchstart.selecter", ".selecter-selected", data, _onTouchStart)
						  .on("click.selecter", ".selecter-selected", data, _onClick)
						  .on("click.selecter", ".selecter-item", data, _onSelect)
						  .on("close.selecter", data, _onClose)
						  .data("selecter", data);

			// Change events
			data.$select.on("change.selecter", data, _onChange);

			// Focus/Blur events
			if (!isMobile) {
				data.$selecter.on("focusin.selecter", data, _onFocus)
							  .on("blur.selecter", data, _onBlur);

				// Handle clicks to associated labels
				data.$select.on("focusin.selecter", data, function(e) {
					e.data.$selecter.trigger("focus");
				});
			}
		}
	}

	/**
	 * @method private
	 * @name _buildOptions
	 * @description Builds instance's option set
	 * @param data [object] "Instance data"
	 */
	function _buildOptions(data) {
		var html = '',
			itemTag = (data.links) ? "a" : "span",
			j = 0;

		for (var i = 0, count = data.$allOptions.length; i < count; i++) {
			var $op = data.$allOptions.eq(i);

			// Option group
			if ($op[0].tagName === "OPTGROUP") {
				html += '<span class="selecter-group';
				// Disabled groups
				if ($op.is(":disabled")) {
					html += ' disabled';
				}
				html += '">' + $op.attr("label") + '</span>';
			} else {
				var opVal = $op.val();

				if (!$op.attr("value")) {
					$op.attr("value", opVal);
				}

				html += '<' + itemTag + ' class="selecter-item';
				if ($op.hasClass('selecter-placeholder')) {
					html += ' placeholder';
				}
				// Default selected value - now handles multi's thanks to @kuilkoff
				if ($op.is(':selected')) {
					html += ' selected';
				}
				// Disabled options
				if ($op.is(":disabled")) {
					html += ' disabled';
				}
				html += '" ';
				if (data.links) {
					html += 'href="' + opVal + '"';
				} else {
					html += 'data-value="' + opVal + '"';
				}
				html += '>' + $("<span></span>").text( _trim($op.text(), data.trim) ).html() + '</' + itemTag + '>';
				j++;
			}
		}

		data.$itemsWrapper.html(html);
		data.$items = data.$selecter.find(".selecter-item");
	}

	/**
	 * @method private
	 * @name _onTouchStart
	 * @description Handles touchstart to selected item
	 * @param e [object] "Event data"
	 */
	function _onTouchStart(e) {
		e.stopPropagation();

		var data = e.data;

		data.touchStartEvent = e.originalEvent;

		data.touchStartX = data.touchStartEvent.touches[0].clientX;
		data.touchStartY = data.touchStartEvent.touches[0].clientY;

		data.$selecter.on("touchmove.selecter", ".selecter-selected", data, _onTouchMove)
					  .on("touchend.selecter", ".selecter-selected", data, _onTouchEnd);
	}

	/**
	 * @method private
	 * @name _onTouchMove
	 * @description Handles touchmove to selected item
	 * @param e [object] "Event data"
	 */
	function _onTouchMove(e) {
		var data = e.data,
			oe = e.originalEvent;

		if (Math.abs(oe.touches[0].clientX - data.touchStartX) > 10 || Math.abs(oe.touches[0].clientY - data.touchStartY) > 10) {
			data.$selecter.off("touchmove.selecter touchend.selecter");
		}
	}

	/**
	 * @method private
	 * @name _onTouchEnd
	 * @description Handles touchend to selected item
	 * @param e [object] "Event data"
	 */
	function _onTouchEnd(e) {
		var data = e.data;

		data.touchStartEvent.preventDefault();

		data.$selecter.off("touchmove.selecter touchend.selecter");

		_onClick(e);
	}

	/**
	 * @method private
	 * @name _onClick
	 * @description Handles click to selected item
	 * @param e [object] "Event data"
	 */
	function _onClick(e) {
		e.preventDefault();
		e.stopPropagation();

		var data = e.data;

		if (!data.$select.is(":disabled")) {
			$(".selecter").not(data.$selecter).trigger("close.selecter", [data]);

			// Handle mobile, but not Firefox, unless desktop forced
			if (!data.mobile && isMobile && !isFirefoxMobile) {
				var el = data.$select[0];
				if (window.document.createEvent) { // All
					var evt = window.document.createEvent("MouseEvents");
					evt.initMouseEvent("mousedown", false, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
					el.dispatchEvent(evt);
				} else if (el.fireEvent) { // IE
					el.fireEvent("onmousedown");
				}
			} else {
				// Delegate intent
				if (data.$selecter.hasClass("closed")) {
					_onOpen(e);
				} else if (data.$selecter.hasClass("open")) {
					_onClose(e);
				}
			}
		}
	}

	/**
	 * @method private
	 * @name _onOpen
	 * @description Opens option set
	 * @param e [object] "Event data"
	 */
	function _onOpen(e) {
		e.preventDefault();
		e.stopPropagation();

		var data = e.data;

		// Make sure it's not alerady open
		if (!data.$selecter.hasClass("open")) {
			var offset = data.$selecter.offset(),
				bodyHeight = $body.outerHeight(),
				optionsHeight = data.$itemsWrapper.outerHeight(true),
				selectedOffset = (data.index >= 0) ? data.$items.eq(data.index).position() : { left: 0, top: 0 };

			// Calculate bottom of document
			if (offset.top + optionsHeight > bodyHeight) {
				data.$selecter.addClass("bottom");
			}

			data.$itemsWrapper.show();

			// Bind Events
			data.$selecter.removeClass("closed")
						  .addClass("open");
			$body.on("click.selecter-" + data.guid, ":not(.selecter-options)", data, _onCloseHelper);

			_scrollOptions(data);
		}
	}

	/**
	 * @method private
	 * @name _onCloseHelper
	 * @description Determines if event target is outside instance before closing
	 * @param e [object] "Event data"
	 */
	function _onCloseHelper(e) {
		e.preventDefault();
		e.stopPropagation();

		if ($(e.currentTarget).parents(".selecter").length === 0) {
			_onClose(e);
		}
	}

	/**
	 * @method private
	 * @name _onClose
	 * @description Closes option set
	 * @param e [object] "Event data"
	 */
	function _onClose(e) {
		e.preventDefault();
		e.stopPropagation();

		var data = e.data;

		// Make sure it's actually open
		if (data.$selecter.hasClass("open")) {
			data.$itemsWrapper.hide();
			data.$selecter.removeClass("open bottom")
						  .addClass("closed");

			$body.off(".selecter-" + data.guid);
		}
	}

	/**
	 * @method private
	 * @name _onSelect
	 * @description Handles option select
	 * @param e [object] "Event data"
	 */
	function _onSelect(e) {
		e.preventDefault();
		e.stopPropagation();

		var $target = $(this),
			data = e.data;

		if (!data.$select.is(":disabled")) {
			if (data.$itemsWrapper.is(":visible")) {
				// Update
				var index = data.$items.index($target);

				if (index !== data.index) {
					_update(index, data);
					_handleChange(data);
				}
			}

			if (!data.multiple) {
				// Clean up
				_onClose(e);
			}
		}
	}

	/**
	 * @method private
	 * @name _onChange
	 * @description Handles external changes
	 * @param e [object] "Event data"
	 */
	function _onChange(e, internal) {
		var $target = $(this),
			data = e.data;

		if (!internal && !data.multiple) {
			var index = data.$options.index(data.$options.filter("[value='" + _escape($target.val()) + "']"));

			_update(index, data);
			_handleChange(data);
		}
	}

	/**
	 * @method private
	 * @name _onFocus
	 * @description Handles instance focus
	 * @param e [object] "Event data"
	 */
	function _onFocus(e) {
		e.preventDefault();
		e.stopPropagation();

		var data = e.data;

		if (!data.$select.is(":disabled") && !data.multiple) {
			data.$selecter.addClass("focus")
						  .on("keydown.selecter-" + data.guid, data, _onKeypress);

			$(".selecter").not(data.$selecter)
						  .trigger("close.selecter", [ data ]);
		}
	}

	/**
	 * @method private
	 * @name _onBlur
	 * @description Handles instance focus
	 * @param e [object] "Event data"
	 */
	function _onBlur(e, internal, two) {
		e.preventDefault();
		e.stopPropagation();

		var data = e.data;

		data.$selecter.removeClass("focus")
					  .off("keydown.selecter-" + data.guid);

		$(".selecter").not(data.$selecter)
					  .trigger("close.selecter", [ data ]);
	}

	/**
	 * @method private
	 * @name _onKeypress
	 * @description Handles instance keypress, once focused
	 * @param e [object] "Event data"
	 */
	function _onKeypress(e) {
		var data = e.data;

		if (e.keyCode === 13) {
			if (data.$selecter.hasClass("open")) {
				_onClose(e);
				_update(data.index, data);
			}
			_handleChange(data);
		} else if (e.keyCode !== 9 && (!e.metaKey && !e.altKey && !e.ctrlKey && !e.shiftKey)) {
			// Ignore modifiers & tabs
			e.preventDefault();
			e.stopPropagation();

			var total = data.$items.length - 1,
				index = (data.index < 0) ? 0 : data.index;

			// Firefox left/right support thanks to Kylemade
			if ($.inArray(e.keyCode, (isFirefox) ? [38, 40, 37, 39] : [38, 40]) > -1) {
				// Increment / decrement using the arrow keys
				index = index + ((e.keyCode === 38 || (isFirefox && e.keyCode === 37)) ? -1 : 1);

				if (index < 0) {
					index = 0;
				}
				if (index > total) {
					index = total;
				}
			} else {
				var input = String.fromCharCode(e.keyCode).toUpperCase(),
					letter,
					i;

				// Search for input from original index
				for (i = data.index + 1; i <= total; i++) {
					letter = data.$options.eq(i).text().charAt(0).toUpperCase();
					if (letter === input) {
						index = i;
						break;
					}
				}

				// If not, start from the beginning
				if (index < 0 || index === data.index) {
					for (i = 0; i <= total; i++) {
						letter = data.$options.eq(i).text().charAt(0).toUpperCase();
						if (letter === input) {
							index = i;
							break;
						}
					}
				}
			}

			// Update
			if (index >= 0) {
				_update(index, data);
				_scrollOptions(data);
			}
		}
	}

	/**
	 * @method private
	 * @name _update
	 * @description Updates instance based on new target index
	 * @param index [int] "Selected option index"
	 * @param data [object] "instance data"
	 */
	function _update(index, data) {
		var $item = data.$items.eq(index),
			isSelected = $item.hasClass("selected"),
			isDisabled = $item.hasClass("disabled");

		// Check for disabled options
		if (!isDisabled) {
			if (data.multiple) {
				if (isSelected) {
					data.$options.eq(index).prop("selected", null);
					$item.removeClass("selected");
				} else {
					data.$options.eq(index).prop("selected", true);
					$item.addClass("selected");
				}
			} else if (index > -1 && index < data.$items.length) {
				var newLabel = $item.html(),
					newValue = $item.data("value");

				data.$selected.html(newLabel)
							  .removeClass('placeholder');

				data.$items.filter(".selected")
						   .removeClass("selected");

				data.$select[0].selectedIndex = index;

				$item.addClass("selected");
				data.index = index;
			} else if (data.label !== "") {
				data.$selected.html(data.label);
			}
		}
	}

	/**
	 * @method private
	 * @name _scrollOptions
	 * @description Scrolls options wrapper to specific option
	 * @param data [object] "Instance data"
	 */
	function _scrollOptions(data) {
		var $selected = data.$items.eq(data.index),
			selectedOffset = (data.index >= 0 && !$selected.hasClass("placeholder")) ? $selected.position() : { left: 0, top: 0 };

		if ($.fn.scroller !== undefined) {
			data.$itemsWrapper.scroller("scroll", (data.$itemsWrapper.find(".scroller-content").scrollTop() + selectedOffset.top), 0)
							  .scroller("reset");
		} else {
			data.$itemsWrapper.scrollTop( data.$itemsWrapper.scrollTop() + selectedOffset.top );
		}
	}

	/**
	 * @method private
	 * @name _handleChange
	 * @description Handles change events
	 * @param data [object] "Instance data"
	 */
	function _handleChange(data) {
		if (data.links) {
			_launch(data);
		} else {
			data.callback.call(data.$selecter, data.$select.val(), data.index);
			data.$select.trigger("change", [ true ]);
		}
	}

	/**
	 * @method private
	 * @name _launch
	 * @description Launches link
	 * @param data [object] "Instance data"
	 */
	function _launch(data) {
		//var url = (isMobile) ? data.$select.val() : data.$options.filter(":selected").attr("href");
		var url = data.$select.val();

		if (data.external) {
			// Open link in a new tab/window
			window.open(url);
		} else {
			// Open link in same tab/window
			window.location.href = url;
		}
	}

	/**
	 * @method private
	 * @name _trim
	 * @description Trims text, if specified length is greater then 0
	 * @param length [int] "Length to trim at"
	 * @param text [string] "Text to trim"
	 * @return [string] "Trimmed string"
	 */
	function _trim(text, length) {
		if (length === 0) {
			return text;
		} else {
			if (text.length > length) {
				return text.substring(0, length) + "...";
			} else {
				return text;
			}
		}
	}

	/**
	 * @method private
	 * @name _escape
	 * @description Escapes text
	 * @param text [string] "Text to escape"
	 */
	function _escape(text) {
		return (typeof text === "string") ? text.replace(/([;&,\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, '\\$1') : text;
	}

	$.fn.selecter = function(method) {
		if (pub[method]) {
			return pub[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return _init.apply(this, arguments);
		}
		return this;
	};

	$.selecter = function(method) {
		if (method === "defaults") {
			pub.defaults.apply(this, Array.prototype.slice.call(arguments, 1));
		}
	};
})(jQuery, window);
/*
 * Stepper v3.0.7 - 2014-11-25
 * A jQuery plugin for cross browser number inputs. Part of the Formstone Library.
 * http://formstone.it/stepper/
 *
 * Copyright 2014 Ben Plum; MIT Licensed
 */


;(function ($, window) {
	"use strict";

	/**
	 * @options
	 * @param customClass [string] <''> "Class applied to instance"
	 * @param lables.up [string] <'Up'> "Up arrow label"
	 * @param lables.down [string] <'Down'> "Down arrow label"
	 */
	var options = {
		customClass: "",
		labels: {
			up: "Up",
			down: "Down"
		}
	};

	var pub = {

		/**
		 * @method
		 * @name defaults
		 * @description Sets default plugin options
		 * @param opts [object] <{}> "Options object"
		 * @example $.stepper("defaults", opts);
		 */
		defaults: function(opts) {
			options = $.extend(options, opts || {});
			return (typeof this === 'object') ? $(this) : true;
		},

		/**
		 * @method
		 * @name destroy
		 * @description Removes instance of plugin
		 * @example $(".target").stepper("destroy");
		 */
		destroy: function() {
			return $(this).each(function(i) {
				var data = $(this).data("stepper");

				if (data) {
					// Unbind click events
					data.$stepper.off(".stepper")
								 .find(".stepper-arrow")
								 .remove();

					// Restore DOM
					data.$input.unwrap()
							   .removeClass("stepper-input");
				}
			});
		},

		/**
		 * @method
		 * @name disable
		 * @description Disables target instance
		 * @example $(".target").stepper("disable");
		 */
		disable: function() {
			return $(this).each(function(i) {
				var data = $(this).data("stepper");

				if (data) {
					data.$input.attr("disabled", "disabled");
					data.$stepper.addClass("disabled");
				}
			});
		},

		/**
		 * @method
		 * @name enable
		 * @description Enables target instance
		 * @example $(".target").stepper("enable");
		 */
		enable: function() {
			return $(this).each(function(i) {
				var data = $(this).data("stepper");

				if (data) {
					data.$input.attr("disabled", null);
					data.$stepper.removeClass("disabled");
				}
			});
		}
	};

	/**
	 * @method private
	 * @name _init
	 * @description Initializes plugin
	 * @param opts [object] "Initialization options"
	 */
	function _init(opts) {
		// Local options
		opts = $.extend({}, options, opts || {});

		// Apply to each element
		var $items = $(this);
		for (var i = 0, count = $items.length; i < count; i++) {
			_build($items.eq(i), opts);
		}
		return $items;
	}

	/**
	 * @method private
	 * @name _build
	 * @description Builds each instance
	 * @param $select [jQuery object] "Target jQuery object"
	 * @param opts [object] <{}> "Options object"
	 */
	function _build($input, opts) {
		if (!$input.hasClass("stepper-input")) {
			// EXTEND OPTIONS
			opts = $.extend({}, opts, $input.data("stepper-options"));

			// HTML5 attributes
			var min = parseFloat($input.attr("min")),
				max = parseFloat($input.attr("max")),
				step = parseFloat($input.attr("step")) || 1;

			// Modify DOM
			$input.addClass("stepper-input")
				  .wrap('<div class="stepper ' + opts.customClass + '" />')
				  .after('<span class="stepper-arrow up">' + opts.labels.up + '</span><span class="stepper-arrow down">' + opts.labels.down + '</span>');

			// Store data
			var $stepper = $input.parent(".stepper"),
				data = $.extend({
					$stepper: $stepper,
					$input: $input,
					$arrow: $stepper.find(".stepper-arrow"),
					min: (typeof min !== undefined && !isNaN(min)) ? min : false,
					max: (typeof max !== undefined && !isNaN(max)) ? max : false,
					step: (typeof step !== undefined && !isNaN(step)) ? step : 1,
					timer: null
				}, opts);

			data.digits = _digits(data.step);

			// Check disabled
			if ($input.is(":disabled")) {
				$stepper.addClass("disabled");
			}

			// Bind keyboard events
			$stepper.on("keypress", ".stepper-input", data, _onKeyup);

			// Bind click events
			$stepper.on("touchstart.stepper mousedown.stepper", ".stepper-arrow", data, _onMouseDown);

			// Store data on the element itself
			$input.data("stepper", data);
		}
	}

	/**
	 * @method private
	 * @name _onKeyup
	 * @description Handles keypress event on inputs
	 * @param e [object] "Event data"
	 */
	function _onKeyup(e) {
		var data = e.data;

		// If arrow keys
		if (e.keyCode === 38 || e.keyCode === 40) {
			e.preventDefault();

			_step(data, (e.keyCode === 38) ? data.step : -data.step);
		}
	}

	/**
	 * @method private
	 * @name _onMouseDown
	 * @description Handles mousedown event on instance arrows
	 * @param e [object] "Event data"
	 */
	function _onMouseDown(e) {
		e.preventDefault();
		e.stopPropagation();

		// Make sure we reset the states
		_onMouseUp(e);

		var data = e.data;

		if (!data.$input.is(':disabled') && !data.$stepper.hasClass("disabled")) {
			var change = $(e.target).hasClass("up") ? data.step : -data.step;

			data.timer = _startTimer(data.timer, 125, function() {
				_step(data, change, false);
			});
			_step(data, change);

			$("body").on("touchend.stepper mouseup.stepper", data, _onMouseUp);
		}
	}

	/**
	 * @method private
	 * @name _onMouseUp
	 * @description Handles mouseup event on instance arrows
	 * @param e [object] "Event data"
	 */
	function _onMouseUp(e) {
		e.preventDefault();
		e.stopPropagation();

		var data = e.data;

		_clearTimer(data.timer);

		$("body").off(".stepper");
	}

	/**
	 * @method private
	 * @name _step
	 * @description Steps through values
	 * @param e [object] "Event data"
	 * @param change [string] "Change value"
	 */
	function _step(data, change) {
		var originalValue = parseFloat(data.$input.val()),
			value = change;

		if (typeof originalValue === undefined || isNaN(originalValue)) {
			if (data.min !== false) {
				value = data.min;
			} else {
				value = 0;
			}
		} else if (data.min !== false && originalValue < data.min) {
			value = data.min;
		} else {
			value += originalValue;
		}

		var diff = (value - data.min) % data.step;
		if (diff !== 0) {
			value -= diff;
		}

		if (data.min !== false && value < data.min) {
			value = data.min;
		}
		if (data.max !== false && value > data.max) {
			value -= data.step;
		}

		if (value !== originalValue) {
			value = _round(value, data.digits);

			data.$input.val(value)
					   .trigger("change");
		}
	}

	/**
	 * @method private
	 * @name _startTimer
	 * @description Starts an internal timer
	 * @param timer [int] "Timer ID"
	 * @param time [int] "Time until execution"
	 * @param callback [int] "Function to execute"
	 */
	function _startTimer(timer, time, callback) {
		_clearTimer(timer);
		return setInterval(callback, time);
	}

	/**
	 * @method private
	 * @name _clearTimer
	 * @description Clears an internal timer
	 * @param timer [int] "Timer ID"
	 */
	function _clearTimer(timer) {
		if (timer) {
			clearInterval(timer);
			timer = null;
		}
	}

	/**
	 * @method private
	 * @name _digits
	 * @description Analyzes and returns significant digit count
	 * @param value [float] "Value to analyze"
	 * @return [int] "Number of significant digits"
	 */
	function _digits(value) {
		var test = String(value);
		if (test.indexOf(".") > -1) {
			return test.length - test.indexOf(".") - 1;
		} else {
			return 0;
		}
	}

	/**
	 * @method private
	 * @name _round
	 * @description Rounds a number to a sepcific significant digit count
	 * @param value [float] "Value to round"
	 * @param digits [float] "Digits to round to"
	 * @return [number] "Rounded number"
	 */
	function _round(value, digits) {
		var exp = Math.pow(10, digits);
		return Math.round(value * exp) / exp;
	}

	$.fn.stepper = function(method) {
		if (pub[method]) {
			return pub[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return _init.apply(this, arguments);
		}
		return this;
	};

	$.stepper = function(method) {
		if (method === "defaults") {
			pub.defaults.apply(this, Array.prototype.slice.call(arguments, 1));
		}
	};
})(jQuery, this);




