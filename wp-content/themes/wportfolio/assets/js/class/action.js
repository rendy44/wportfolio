'use strict';

import Ajax from "./ajax.js";
import Cookie from "./cookie.js";

/**
 * Action classes
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.2
 */
export default class Action {

    /**
     * Action for liking a post.
     *
     * @param postId
     * @return {Ajax}
     *
     * @since 0.0.1
     */
    static likePost(postId) {
        return new Ajax('like_post', true, {
            post_id: postId
        })
    }

    /**
     * Save cookie
     *
     * @param postId
     *
     * @since 0.0.2
     */
    static saveLikePostCookie(postId) {
        Cookie.set('like_post_' + postId, 'yes', 30);
    }

    /**
     * Check whether post is liked.
     *
     * @param postId
     * @return {string}
     *
     * @since 0.0.2
     */
    static isPostLiked(postId) {
        return Cookie.get('like_post_' + postId);
    }
}
