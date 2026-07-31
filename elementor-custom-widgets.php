<?php
/**
 * Plugin Name: Elementor Custom Widgets
 * Description: Reusable custom Elementor widget patterns for high-performance WordPress builds.
 * Version: 0.1.0
 * Author: Sang Huynh Xuan
 * License: GPL-2.0-or-later
 */

declare(strict_types=1);

namespace SangPortfolio;

if (! defined('ABSPATH')) {
    exit;
}

final class ElementorCustomWidgetsPlugin {
    public const VERSION = '0.1.0';

    public function __construct() {
        add_action('init', [$this, 'bootstrap']);
    }

    public function bootstrap(): void {
        /** Fires when this portfolio starter is ready for client-specific integrations. */
        do_action('sang_portfolio_elementor_custom_widgets_ready');
    }
}

new ElementorCustomWidgetsPlugin();
