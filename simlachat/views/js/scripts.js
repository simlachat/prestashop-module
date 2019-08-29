/**
* MIT License
*
* Copyright (c) 2019 DIGITAL RETAIL TECHNOLOGIES SL
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
* 
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
* 
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    DIGITAL RETAIL TECHNOLOGIES SL <mail@simlachat.com>
*  @copyright 2007-2019 DIGITAL RETAIL TECHNOLOGIES SL
*  @license   https://opensource.org/licenses/MIT  The MIT License
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/
$(function(){
    var Main = {
        init: function() {
            this.tabs.init();
            this.popup.init();
            this.toggleBox();
        },
        tabs: {
            init: function () {
                $('.simla-tabs__btn').on('click', this.swithTab);
            },
            swithTab: function (e) {
                e.preventDefault();

                var id = $(this).attr('href');
                $('.simla-tabs__btn_active').removeClass('simla-tabs__btn_active');
                $(".simla-tabs__item_active").removeClass('simla-tabs__item_active')
                    .fadeOut(150, function () {
                        $(id).addClass("simla-tabs__item_active")
                            .fadeIn(150);
                    });
                $(this).addClass('simla-tabs__btn_active');
            }
        },
        popup: {
            init: function () {
                var _this = this;

                $('[data-popup]').on('click', function (e) {
                    var id = $(this).data('popup');
                    _this.open($(id));
                });
                $('.simla-popup-wrap').on('click', function (e) {
                    if (!$(e.target).hasClass('js-popup-close')) {
                        return;
                    }
                    var $popup = $(this).find('.simla-popup');
                    _this.close($popup);
                });
            },
            open: function (popup) {
                if (!popup) {
                    return;
                }
                var $wrap = popup.closest('.simla-popup-wrap');

                $wrap.fadeIn(200);
                popup.addClass('open');
                player.playVideo();
            },
            close: function (popup) {
                var $wrap = popup.closest('.simla-popup-wrap');
                popup.removeClass('open');
                $wrap.fadeOut(200);
                player.stopVideo();
            }
        },
        toggleBox: function () {
            $('.toggle-btn').on('click', function (e) {
                e.preventDefault();

                var id = $(this).attr('href');
                var $box = $(id);
                var $hideBox = $(this).closest('.simla-btns');

                $hideBox.addClass('simla-btns_hide').slideUp(100);
                $box.slideDown(100);
            })
        }
    };

    Main.init();
});


var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '100%',
        width: '100%',
        videoId: '8X1XVtC4wL4',
    });
}
