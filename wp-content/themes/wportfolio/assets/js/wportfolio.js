'use strict';

import Action from "./class/action.js";

(function ($) {

    /**
     * Class initiator.
     *
     * @author WPerfekt
     * @package WPortfolio
     * @version 0.0.4
     */
    new class {

        /**
         * Class constructor.
         *
         * @version 0.0.2
         * @since 0.0.1
         */
        constructor() {
            this.eventScrollNav();
            this.eventCheckLikePost();
            this.eventLikePost();
            this.eventCountActivity();
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
                if (position > 80) {
                    navBar.addClass('scrolled');
                } else {
                    navBar.removeClass('scrolled');
                }
            })
        }

        /**
         * Event to check post like status.
         *
         * @since 0.0.4
         */
        eventCheckLikePost() {
            $('button.button-like').each(function () {
                const postId = $(this).data('id');

                // Validate the like status.
                if (postId) {
                    if (Action.isPostLiked(postId)) {

                        // Add a class.
                        $(this).addClass('liked');
                    }
                }
            });
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

                // Make sure it hasn't been liked.
                if (Action.isPostLiked(postId)) {
                    return;
                }

                // Proceed to like.
                Action.likePost(postId)
                    .then(function (data) {

                        // Validate result.
                        if (!data.errors) {
                            contentText.text(data);
                            btn.addClass('liked');

                            // Save the cookie.
                            Action.saveLikePostCookie(postId);
                        }
                    })
            })
        }

        /**
         * Event when activity count is rendered and then animate it.
         *
         * @since 0.0.3
         */
        eventCountActivity() {
            $('.activity-count').each(function () {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        }
    }
})(jQuery);