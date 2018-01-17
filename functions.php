<?php
if (!class_exists('Timber')) {
    add_action('admin_notices', function () {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
    });
    return;
}

class StarterSite extends TimberSite
{

    public function __construct()
    {
        add_theme_support('post-formats');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_filter('timber_context', array($this, 'add_to_context'));
        add_filter('get_twig', array($this, 'add_to_twig'));
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        parent::__construct();
    }

    public function register_post_types()
    {

        //this is where you can register custom post types

    }

    public function register_taxonomies()
    {

        //this is where you can register custom taxonomies

    }

    public function add_to_context($context)
    {
        $context['menu']    = new TimberMenu('15');
        $context['submenu'] = new TimberMenu('16');
        $context['site']    = $this;
        $context['options'] = prepareSiteOptions();
        $context['assets']  = get_template_directory_uri() . '/app';

        return $context;
    }

    public function add_to_twig($twig)
    {

        /* this is where you can add your own fuctions to twig */
        $twig->addExtension(new Twig_Extension_StringLoader());
        $twig->addFilter('myfoo', new Twig_Filter_Function('myfoo'));
        return $twig;
    }
}

new StarterSite();

// Woocommerce settings

// integrating w/ twig

function timber_set_product( $post ) {
    global $product;
    
    if ( is_woocommerce() ) {
        $product = wc_get_product( $post->ID );
        foreach ($product as $product) {
            $product['hafields'] = prepareProductFields();
        }
    }
}
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
/**
 * Register our sidebars and widgetized areas.
 *
 */
function ha_add_woo_sidebar() {

    register_sidebar( array(
        'name'          => 'Shop Sidebar',
        'id'            => 'shopbar',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'ha_add_woo_sidebar' );

/**
* Replace add to cart button in the loop.
*/
function ha_change_loop_add_to_cart() {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    add_action( 'woocommerce_after_shop_loop_item', 'ha_template_loop_add_to_cart', 10 );
}
 
add_action( 'init', 'ha_change_loop_add_to_cart', 10 );

/**
* Use single add to cart button for variable products.
*/
function ha_template_loop_add_to_cart() {
    global $product;
 
    if ( ! $product->is_type( 'variable' ) ) {
        woocommerce_template_loop_add_to_cart();
        return;
    }
 
    remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
    add_action( 'woocommerce_single_variation', 'ha_loop_variation_add_to_cart_button', 20 );
 
    woocommerce_template_single_add_to_cart();
}
/**
 * Customise variable add to cart button for loop.
 *
 * Remove qty selector and simplify.
 */
function ha_loop_variation_add_to_cart_button() {
    global $product;

    ?>
    <div class="woocommerce-variation-add-to-cart variations_button">
        <button type="submit" class="single_add_to_cart_button button"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
        <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
        <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
        <input type="hidden" name="variation_id" class="variation_id" value="0" />
    </div>
    <?php
}
// Hide trailing zeros on prices.
add_filter( 'woocommerce_price_trim_zeros', 'wc_hide_trailing_zeros', 10, 1 );
function wc_hide_trailing_zeros( $trim ) {
    
    return true;
    
}


require_once 'library/admin.php';
// admin settings & customization

require_once 'library/buscemi.php';
// lots of extra theme stuff

