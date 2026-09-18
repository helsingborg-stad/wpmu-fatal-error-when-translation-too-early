<?php

/**
 * Plugin Name: wpmu-fatal-error-when-translation-too-early
 * Description: Throws a fatal error when WordPress detects translations loading too early.
 * Version: 0.0.1
 * Author:      Helsingborgs stad
 */

namespace WPMUFatalErrorWhenTranslationTooEarly;

use RuntimeException;

/**
 * Converts WordPress early-translation notices into fatal errors.
 */
class WPMUFatalErrorWhenTranslationTooEarly
{
    /**
    * Registers the WordPress validation hook.
     *
     * @return void
     */
    public function __construct()
    {
        add_action('doing_it_wrong_run', [$this, 'throwExceptionForEarlyTranslation'], 10, 3);
    }

    /**
     * Throws an exception when WordPress detects a translation loading too early.
     *
     * @param string $functionName Function WordPress identified as being used incorrectly.
     * @param string $message      Description supplied by WordPress.
     * @param string $version      WordPress version in which the warning was added.
     *
     * @return void
     *
     * @throws RuntimeException When a translation is loaded too early.
     */
    public function throwExceptionForEarlyTranslation(
        string $functionName,
        string $message,
        string $version
    ): void
    {
        if ($functionName !== '_load_textdomain_just_in_time') {
            return;
        }

        throw new RuntimeException(
            "A translation was loaded too early. WordPress reported: {$message}"
        );
    }
}

new WPMUFatalErrorWhenTranslationTooEarly();
