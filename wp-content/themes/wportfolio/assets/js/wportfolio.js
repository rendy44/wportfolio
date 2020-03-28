'use strict';

import Action from "./class/action.js";

(function ($) {

    /**
     * Class initiator.
     *
     * @author WPerfekt
     * @package WPortfolio
     * @version 0.0.2
     */
    new class {

        /**
         * Class constructor.
         */
        constructor() {
            this.eventScrollNav();
            this.eventLikePost();
        }

        /**
         * Event when navbar being scrolled.
         *
         * @since 0.0.2
         */
        eventScrollNav() {
            const navBar = $('nav.nav');
            $(window).scroll(function () {
                const position = $(this).scrollTop();

                // Add class depends on scroll position.
                if (position > 100) {
                    navBar.addClass('scrolled');
                } else {
                    navBar.removeClass('scrolled');
                }
            })
        }

        /**
         * Event when like button in single post being triggered.
         *
         * @since 0.0.1
         */
        eventLikePost() {
            $('.button-like').click(function (e) {
                e.preventDefault();

                // Define variables.
                let btn = $(this),
                    postId = btn.data('id'),
                    contentText = btn.siblings('.counter');

                // Proceed to like.
                Action.likePost(postId)
                    .then(function (data) {

                        // Validate result.
                        if (!data.errors) {
                            contentText.text(data);
                            btn.addClass('liked');
                        }
                    })
            })
        }
    }
})(jQuery);