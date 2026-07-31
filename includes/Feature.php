<?php
declare(strict_types=1);
namespace SangPortfolio\ElementorCustomWidgets;
if (! defined('ABSPATH')) { exit; }
final class Feature {
    private const OPTION = 'elementor_custom_widgets_enabled';
    private const SLUG = 'elementor-custom-widgets';
    private const TITLE = 'Elementor Custom Widgets';
    public function register(): void {
        add_action('admin_init', [$this, 'registerSettings']);
        add_action('admin_menu', [$this, 'registerPage']);
        if (Support::enabled(self::OPTION)) { $this->registerFeature(); }
    }
    public function registerSettings(): void { register_setting(self::SLUG, self::OPTION, ['sanitize_callback' => static fn($value): string => empty($value) ? '0' : '1']); }
    public function registerPage(): void { add_options_page(self::TITLE, self::TITLE, 'manage_options', self::SLUG, [$this, 'renderPage']); }
    public function renderPage(): void { if (! current_user_can('manage_options')) { return; } echo '<div class="wrap"><h1>' . esc_html(self::TITLE) . '</h1><form method="post" action="options.php">'; settings_fields(self::SLUG); echo '<label><input type="checkbox" name="' . esc_attr(self::OPTION) . '" value="1" ' . checked(Support::enabled(self::OPTION), true, false) . '> ' . esc_html__('Enable feature', 'sang-portfolio') . '</label>'; submit_button(); echo '</form></div>'; }
    private function registerFeature(): void { add_action('elementor/widgets/register', [$this, 'registerWidget']); }
    public function registerWidget($manager): void { if (! class_exists('\Elementor\Widget_Base')) { return; } $manager->register(new class extends \Elementor\Widget_Base { public function get_name(): string { return 'sang_notice'; } public function get_title(): string { return 'Sang Notice'; } public function get_icon(): string { return 'eicon-info-circle'; } public function get_categories(): array { return ['basic']; } protected function render(): void { echo '<div class="sang-elementor-notice">' . esc_html__('Reusable client notice widget.', 'sang-portfolio') . '</div>'; } }); }
}
