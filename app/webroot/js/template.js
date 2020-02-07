(function($) {

    "use strict";

    Dropzone.autoDiscover = false;

    $(document).ready(function() {

        //
        // Detect mobile devices
        //

        var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPod|iPad/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };

        //
        // Emoji
        //

        if ( !isMobile.any() ) {
            [].forEach.call(document.querySelectorAll('[data-emoji-form]'), function (form) {
                var button = form.querySelector('[data-emoji-btn]');

                var picker = new EmojiButton({
                    position: "top",
                    zIndex: 1020
                });

                picker.on('emoji', function(emoji) {
                    form.querySelector('[data-emoji-input]').value += emoji;
                });

                button.addEventListener('click', function () {
                    picker.pickerVisible ? picker.hidePicker() : picker.showPicker(button);
                });
            });
        } else {
            [].forEach.call(document.querySelectorAll('[data-emoji-form]'), function (form) {
                form.querySelector('[data-emoji-btn]').style.display = 'none';
            });
        }

        //
        // Toggle chat
        //

        [].forEach.call(document.querySelectorAll('[data-chat="open"]'), function (a) {
            a.addEventListener('click', function () {
                document.querySelector('.main').classList.toggle('main-visible');
            }, false );
        });

        //
        // Toggle chat`s sidebar
        //

        [].forEach.call(document.querySelectorAll('[data-chat-sidebar-toggle]'), function (e) {
            e.addEventListener('click', function (event) {
                event.preventDefault();
                var chat_sidebar_id = e.getAttribute('data-chat-sidebar-toggle');
                var chat_sidebar = document.querySelector(chat_sidebar_id);

                if (typeof(chat_sidebar) != 'undefined' && chat_sidebar != null) {
                    if ( chat_sidebar.classList.contains('chat-sidebar-visible') ) {
                        chat_sidebar.classList.remove('chat-sidebar-visible')
                    } else {
                        [].forEach.call(document.querySelectorAll('.chat-sidebar'), function (e) {
                            e.classList.remove('chat-sidebar-visible');
                        });
                        chat_sidebar.classList.add('chat-sidebar-visible');
                    }
                }

            });
        });

        //
        // Close all chat`s sidebars
        //

        [].forEach.call(document.querySelectorAll('[data-chat-sidebar-close]'), function (a) {
            a.addEventListener('click', function (event) {
                event.preventDefault();
                [].forEach.call(document.querySelectorAll('.chat-sidebar'), function (a) {
                    a.classList.remove('chat-sidebar-visible');
                });
            }, false );
        });
        //
        // Mobile screen height minus toolbar height
        //

        function mobileScreenHeight() {
            if ( document.querySelectorAll('.navigation').length && document.querySelectorAll('.sidebar').length ) {
                document.querySelector('.sidebar').style.height = windowHeight - document.querySelector('.navigation').offsetHeight + 'px';
            }
        }

        if ( isMobile.any() && (document.documentElement.clientWidth < 1024) ) {
            var windowHeight = document.documentElement.clientHeight;
            mobileScreenHeight();

            window.addEventListener('resize', function(event){
                if (document.documentElement.clientHeight != windowHeight) {
                    windowHeight = document.documentElement.clientHeight;
                    mobileScreenHeight();
                }
            });
        }

        //
        // Scroll to end of chat
        //

        if (document.querySelector('.end-of-chat')) {
            document.querySelector('.end-of-chat').scrollIntoView();
        }

        //
        // Autosize
        //

        autosize(document.querySelectorAll('[data-autosize="true"]'));

        //
        // SVG inject
        //

        SVGInjector(document.querySelectorAll('img[data-inject-svg]'));

    });

})(jQuery);