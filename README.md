# WPMU Fatal Error When Translation Too Early

A WordPress must-use plugin that turns WordPress's early translation-loading warning into a fatal error.

This helps identify plugins and themes that trigger translation loading before the `init` action. WordPress introduced this warning in version 6.7.

## Requirements

- PHP 7.4 or later
- WordPress 6.7 or later

## Installation

Install the package with Composer:

```sh
composer require helsingborg-stad/wpmu-fatal-error-when-translation-too-early
```

Composer installers places the plugin in WordPress's `mu-plugins` directory. Alternatively, copy `wpmu-fatal-error-when-translation-too-early.php` directly to `wp-content/mu-plugins/`.

## Behavior

The plugin listens to WordPress's `doing_it_wrong_run` action. When WordPress reports misuse of `_load_textdomain_just_in_time`, it throws a `RuntimeException` containing WordPress's original message.

Other `doing_it_wrong_run` notices are not affected.

## License

MIT