'use strict';

/**
 * Cookie classes
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */
export default class Cookie {

    /**
     * Store cookie
     *
     * @param key
     * @param value
     * @param length_in_days
     *
     * @since 0.0.1
     */
    static set(key, value, length_in_days) {
        let expires = "";
        if (length_in_days) {
            let date = new Date();
            date.setTime(date.getTime() + (length_in_days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = key + "=" + (value || "") + expires + "; path=/";
    }

    /**
     * Get cookie
     *
     * @param key
     * @return {string|null}
     *
     * @since 0.0.1
     */
    static get(key) {
        const nameEQ = key + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (' ' === c.charAt(0)) c = c.substring(1, c.length);
            if (0 === c.indexOf(nameEQ)) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    /**
     * Delete cookie
     *
     * @param key
     *
     * @since 0.0.1
     */
    static delete(key) {
        document.cookie = key + '=; Max-Age=-99999999;';
    }
}
