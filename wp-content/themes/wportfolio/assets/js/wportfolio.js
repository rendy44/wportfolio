'use strict';

import Action from "./class/action.js";

(function ($) {

    /**
     * Class initiator.
     *
     * @author WPerfekt
     * @package WPortfolio
     * @version 0.0.1
     */
    new class {

        /**
         * Class constructor.
         */
        constructor() {
            this.eventLikePost();
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