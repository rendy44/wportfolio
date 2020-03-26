'use strict';

import Ajax from "./ajax.js";

/**
 * Action classes
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */
export default class Action {

    /**
     * Action for liking a post.
     *
     * @param postId
     * @return {Ajax}
     */
    static likePost(postId) {
        return new Ajax('like_post', true, {
            post_id: postId
        })
    }
}
