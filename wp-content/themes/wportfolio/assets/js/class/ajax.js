'use strict';

/**
 * Ajax classes
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */
export default class Ajax {

    /**
     * Ajax constructor
     *
     * @param action
     * @param is_post
     * @param data
     *
     * @returns {jQuery}
     */
    constructor(action, is_post = true, data = []) {
        return jQuery.ajax({
            url: obj.ajax_url,
            type: is_post ? 'POST' : 'GET',
            data: {
                action: obj.prefix + action,
                data: data
            },
            dataType: 'json',
        });
    }
}
