<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class NBD_Admin_Setup_Wizard {
    private $step = '';
    private $is_next = false;
    private $is_https = false;
    private $steps = array();
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'admin_menus' ) );
        add_action( 'admin_init', array( $this, 'setup_wizard' ) );
    }
    public function admin_menus() {
        add_dashboard_page( '', '', 'manage_options', 'nbd-setup', '' );
    }
    public function setup_wizard() {
        $is_https   = NBD_Printcart_API::is_https();
        $this->is_next = NBD_Printcart_API::check_connection_with_printcart(true) && $is_https;
        if ( empty( $_GET['page'] ) || 'nbd-setup' !== $_GET['page'] ) {
            return;
        }
        $default_steps = array(
            'general_setup' => array(
                'name'    => esc_html__( 'General setup', 'web-to-print-online-designer' ),
                'view'    => array( $this, 'nbd_setup_general_setup' ),
                'handler' => array( $this, 'nbd_setup_general_setup_save' ),
            ),
            'page'          => array(
                'name'    => esc_html__( 'PCD Pages', 'web-to-print-online-designer' ),
                'view'    => array( $this, 'nbd_setup_page' ),
                'handler' => array( $this, 'nbd_setup_page_save' ),
            ),
            'overview'      => array(
                'name'    => esc_html__( 'Overview', 'web-to-print-online-designer' ),
                'view'    => array( $this, 'nbd_setup_overview' ),
                'handler' => '',
            )
        );
        $this->steps = $default_steps;
        $this->step  = isset( $_GET['step'] ) ? sanitize_key( $_GET['step'] ) : current( array_keys( $this->steps ) );
        
        wp_enqueue_style('nbd-setup', NBDESIGNER_CSS_URL . 'nbd-setup.css', array('dashicons', 'install'), NBDESIGNER_VERSION);
        wp_register_script( 'admin_printcart', NBDESIGNER_JS_URL . 'admin-printcart.js', array(), NBDESIGNER_VERSION );
        wp_register_script('nbd-setup', NBDESIGNER_JS_URL . 'nbd-setup.js', array('jquery', 'admin_printcart'), NBDESIGNER_VERSION);

        if ( ! empty( $_POST['save_step'] ) && isset( $this->steps[ $this->step ]['handler'] ) ) {
            if(!$this->is_next) return;
            call_user_func( $this->steps[ $this->step ]['handler'], $this );
        }

        ob_start();
        $this->setup_wizard_header();
        $this->setup_wizard_steps();
        $this->setup_wizard_content();
        $this->setup_wizard_footer();
        exit;
    }
    public function get_next_step_link( $step = '' ) {
        if ( ! $step ) {
            $step = $this->step;
        }
        $keys = array_keys( $this->steps );
        if ( end( $keys ) === $step ) {
            return admin_url();
        }
        $step_index = array_search( $step, $keys, true );
        if ( false === $step_index ) {
            return '';
        }
        return add_query_arg( 'step', $keys[ $step_index + 1 ], remove_query_arg( 'activate_error' ) );
    }
    public function setup_wizard_steps() {
        $output_steps = $this->steps;
        ?>
        <ol class="nbd-setup-steps">
            <?php foreach ( $output_steps as $step_key => $step ) : ?>
                <li class="
                    <?php
                    if ( $step_key === $this->step ) {
                        echo 'active';
                    } elseif ( array_search( $this->step, array_keys( $this->steps ), true ) > array_search( $step_key, array_keys( $this->steps ), true ) ) {
                        echo 'done';
                    }
                    ?>
                "><?php echo esc_html( $step['name'] ); ?></li>
            <?php endforeach; ?>
        </ol>
        <?php
    }
    public function setup_wizard_header() {
        ?>
        <!DOCTYPE html>
        <html <?php language_attributes(); ?>>
        <head>
                <meta name="viewport" content="width=device-width" />
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title><?php esc_html_e( 'PCDesigner &rsaquo; Setup Wizard', 'web-to-print-online-designer' ); ?></title>
                <?php wp_print_scripts( 'nbd-setup' ); ?>
                <?php do_action( 'admin_print_styles' ); ?>
                <?php do_action( 'admin_print_scripts' ); ?>
                <!-- No inline scripts or styles unless dynamic. -->
                <script type="text/javascript">
                    var ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
                </script>
        </head>
        <body class="nbd-setup wp-core-ui">
            <h1 id="nbd-logo"><a href="<?php echo esc_url(NBD_Printcart_API::$dashboard_url); ?>"><img src="<?php echo NBDESIGNER_PLUGIN_URL; ?>/assets/images/logo-printcart.svg" alt="NBDesigner" /></a></h1>
        <?php
    } 
    public function setup_wizard_footer() {
            if($this->step == 'overview') {
                ?>
                <a class="nbd-return-to-dashboard" href="<?php echo esc_url( admin_url() ); ?>"><?php esc_html_e( 'Return to your dashboard', 'web-to-print-online-designer' ); ?></a>
                <?php  
            } ?>
            </body>
        </html>
        <?php
    } 
    public function setup_wizard_content() {
        echo '<div class="nbd-setup-content">';
        if ( ! empty( $this->steps[ $this->step ]['view'] ) ) {
            call_user_func( $this->steps[ $this->step ]['view'], $this );
        }
        echo '</div>';
    }   
    public function nbd_setup_general_setup(){
        $dimension_unit         = nbdesigner_get_option( 'nbdesigner_dimensions_unit', 'cm' );
        $default_font_subset    = nbdesigner_get_option('nbdesigner_default_font_subset');
        $site_title             = get_bloginfo( 'name' );
        $site_url               = base64_encode(rtrim(get_bloginfo('wpurl'), '/'));

        $user       = wp_get_current_user();
        $user_email = $user->user_email;
        $user_name  = ($user->user_firstname ? $user->user_firstname . ' ' : '') . $user->user_lastname;
        $name       = $user->display_name ? $user->display_name : $user_name;
        $site_title = get_bloginfo();
        $home_url   = home_url();
        $is_https   = NBD_Printcart_API::is_https();

        ?>
        <h1><?php esc_html_e( 'General', 'web-to-print-online-designer' ); ?></h1>  
        <form method="post" class="general-step">
            <div class="nbd-setup-shipping-unit">
                <p>
                    <label for="printcart-connection-width-dashboard">
                        <?php 
                            echo wp_kses(__( 'To use cloud features, please "Connect to Printcart" or <b><a href="'. esc_url(NBD_Printcart_API::$dashboard_url) .'" target="_blank">Contact us for help</a></b>', 'web-to-print-online-designer'),
                                array( 'b' => array(), 'a' => array( 'href' => array(), 'target' => array() ), 'br' => array() ));
                        ?>
                    </label>
                </p>
                <div class="printcart-api-key">
                    <div data-shop-url="<?php esc_attr_e($home_url); ?>" data-user-email="<?php esc_attr_e($user_email); ?>" data-store-name="<?php esc_attr_e($site_title); ?>" data-user-name="<?php esc_attr_e($name); ?>" id="printcart-connection-width-dashboard" data-is-https="<?php esc_attr_e($is_https); ?>" class="button button-primary <?php esc_attr_e(!$is_https ? 'disabled' : ''); ?>">Connect to Printcart
                    </div>
                    <div class="printcart-results"></div>
                    <?php 
                    if(!$is_https) {
                        echo '<div style="color: red"><p>' . NBD_Printcart_API::$mess_ssl . '</p></div>';
                    }
                    ?>
                </div>

                <p>
                    <label for="dimension_unit">
                        <?php
                            printf( wp_kses(__( '<strong>Dimension unit</strong>—used to calculate design area.', 'web-to-print-online-designer' ),
                                array( 'strong' => array() )
                            ) );
                        ?>
                    </label>
                </p>
                <select id="dimension_unit" name="nbdesigner_dimensions_unit" class="wc-enhanced-select">
                    <option value="cm" <?php selected( $dimension_unit, 'cm' ); ?>><?php esc_html_e( 'cm', 'web-to-print-online-designer' ); ?></option>
                    <option value="in" <?php selected( $dimension_unit, 'in' ); ?>><?php esc_html_e( 'in', 'web-to-print-online-designer' ); ?></option>
                    <option value="mm" <?php selected( $dimension_unit, 'mm' ); ?>><?php esc_html_e( 'mm', 'web-to-print-online-designer' ); ?></option>
                    <option value="ft" <?php selected( $dimension_unit, 'ft' ); ?>><?php esc_html_e( 'ft', 'web-to-print-online-designer' ); ?></option>
                    <option value="px" <?php selected( $dimension_unit, 'px' ); ?>><?php esc_html_e( 'px', 'web-to-print-online-designer' ); ?></option>
                </select>
                <p>
                    <label for="font_subset">
                        <?php
                            printf( wp_kses(__( '<strong>Font subset</strong>—choose your language font subset.', 'web-to-print-online-designer' ),
                                array( 'strong' => array() )
                            ) );
                        ?>
                    </label>
                </p>
                <select id="font_subset" name="nbdesigner_default_font_subset" class="wc-enhanced-select">
                    <?php foreach( _nbd_font_subsets() as $key => $subset ): ?>
                    <option value="<?php echo( $key ) ?>" <?php selected( $default_font_subset, $key ); ?>><?php esc_html_e( $subset ); ?></option>
                    <?php  endforeach; ?>
                </select>
            </div>
            <p class="nbd-setup-actions step">
                <button type="submit" <?php echo esc_attr(!$this->is_next ? 'disabled' : ''); ?> class="button-primary button button-large button-next" value="<?php esc_attr_e( 'Continue', 'web-to-print-online-designer' ); ?>" name="save_step"><?php esc_html_e( 'Continue', 'web-to-print-online-designer' ); ?></button>
                <?php wp_nonce_field( 'nbd-setup' ); ?>
            </p>
        </form>
        <?php
    }
    public function nbd_setup_general_setup_save(){
        $license_key                    = sanitize_text_field( $_POST['nbdesigner_license'] );
        $nbdesigner_dimensions_unit     = sanitize_text_field( $_POST['nbdesigner_dimensions_unit'] );
        $nbdesigner_default_font_subset = sanitize_text_field( $_POST['nbdesigner_default_font_subset'] );
        if(NBD_Printcart_API::$enabled_license) {
            nbd_active_domain( $license_key );
        }
        update_option( 'nbdesigner_dimensions_unit', $nbdesigner_dimensions_unit );
        update_option( 'nbdesigner_default_font_subset', $nbdesigner_default_font_subset );
        wp_safe_redirect( esc_url_raw( $this->get_next_step_link() ) );
        exit;
    }
    public function nbd_setup_page(){
        $pages                              = nbd_get_pages();
        $nbdesigner_create_your_own_page_id = nbd_get_page_id( 'create_your_own' );
        $nbdesigner_designer_page_id        = nbd_get_page_id( 'designer' );
        $nbdesigner_gallery_page_id         = nbd_get_page_id( 'gallery' );
        $nbdesigner_logged_page_id          = nbd_get_page_id( 'logged' );
        ?>
        <p><?php esc_html_e( 'Create default PCDesigner pages', 'web-to-print-online-designer' ); ?></p>
        <form method="post" class="page-step">
            <div>
                <p><label for="nbdesigner_create_your_own_page_id"><?php echo '<strong>' . esc_html__('Create your own page', 'web-to-print-online-designer') . '</strong>' . esc_html__('—page contain design editor.', 'web-to-print-online-designer'); ?>	</label></p>
                <select id="nbdesigner_create_your_own_page_id" name="nbdesigner_create_your_own_page_id" class="wc-enhanced-select">
                    <?php foreach( $pages as $key => $page ): ?>
                    <option value="<?php echo( $key ); ?>" <?php selected( $nbdesigner_create_your_own_page_id, $key ); ?>><?php esc_html_e( $page ); ?></option>
                    <?php  endforeach; ?>
                </select>
                <p><label for="nbdesigner_designer_page_id"><?php echo '<strong>' . esc_html__('Designer page', 'web-to-print-online-designer') . '</strong>' . esc_html__('—designer page.', 'web-to-print-online-designer'); ?></label></p>
                <select id="nbdesigner_designer_page_id" name="nbdesigner_designer_page_id" class="wc-enhanced-select">
                    <?php foreach( $pages as $key => $page ): ?>
                    <option value="<?php echo( $key ); ?>" <?php selected( $nbdesigner_designer_page_id, $key ); ?>><?php esc_html_e( $page ); ?></option>
                    <?php  endforeach; ?>
                </select>
                <p><label for="nbdesigner_gallery_page_id"><?php echo '<strong>' . esc_html__('Gallery', 'web-to-print-online-designer') . '</strong>' . esc_html__('—The page show all templates.', 'web-to-print-online-designer'); ?></label></p>
                <select id="nbdesigner_gallery_page_id" name="nbdesigner_gallery_page_id" class="wc-enhanced-select">
                    <?php foreach( $pages as $key => $page ): ?>
                    <option value="<?php echo( $key ); ?>" <?php selected( $nbdesigner_gallery_page_id, $key ); ?>><?php esc_html_e( $page ); ?></option>
                    <?php  endforeach; ?>
                </select>
                <p><label for="nbdesigner_logged_page_id"><strong><?php esc_html_e('Redirect login', 'web-to-print-online-designer'); ?></strong></label></p>
                <select id="nbdesigner_logged_page_id" name="nbdesigner_logged_page_id" class="wc-enhanced-select">
                    <?php foreach( $pages as $key => $page ): ?>
                    <option value="<?php echo( $key ); ?>" <?php selected( $nbdesigner_logged_page_id, $key ); ?>><?php esc_html_e( $page ); ?></option>
                    <?php  endforeach; ?>
                </select>
            </div>
            <p class="nbd-setup-actions step">
                <button type="submit" <?php echo esc_attr(!$this->is_next ? 'disabled' : ''); ?> class="button-primary button button-large button-next" value="<?php esc_attr_e( 'Continue', 'web-to-print-online-designer' ); ?>" name="save_step"><?php esc_html_e( 'Continue', 'web-to-print-online-designer' ); ?></button>
                <?php wp_nonce_field( 'nbd-setup' ); ?>
            </p>
        </form>
        <?php
    }
    public function nbd_setup_page_save(){
        $nbdesigner_create_your_own_page_id     = sanitize_text_field( $_POST['nbdesigner_create_your_own_page_id'] );
        $nbdesigner_designer_page_id            = sanitize_text_field( $_POST['nbdesigner_designer_page_id'] );
        $nbdesigner_gallery_page_id             = sanitize_text_field( $_POST['nbdesigner_gallery_page_id'] );
        $nbdesigner_logged_page_id              = sanitize_text_field( $_POST['nbdesigner_logged_page_id'] );
        update_option( 'nbdesigner_create_your_own_page_id', $nbdesigner_create_your_own_page_id );
        update_option( 'nbdesigner_designer_page_id', $nbdesigner_designer_page_id );
        update_option( 'nbdesigner_gallery_page_id', $nbdesigner_gallery_page_id );
        update_option( 'nbdesigner_logged_page_id', $nbdesigner_logged_page_id );
        wp_safe_redirect( esc_url_raw( $this->get_next_step_link() ) );
        exit;
    }
    public function nbd_setup_overview(){
        ?>
        <p><?php esc_html_e( 'Go to product detail to setup custom design or upload design.', 'web-to-print-online-designer' ); ?></p>
        <p><img class="enable-design" src="<?php echo NBDESIGNER_PLUGIN_URL; ?>/assets/images/enable_nbdesign.png"/></p>
        <p><?php echo sprintf(__( '<strong>%s</strong> <a target="_blank" href="%s">%s</a>', 'web-to-print-online-designer'), esc_html__('More PCDesigner', 'web-to-print-online-designer'), esc_url( admin_url( 'admin.php?page=nbdesigner' ) ), esc_html__('settings', 'web-to-print-online-designer')); ?></p>
        <?php
    }
}
new NBD_Admin_Setup_Wizard();
