<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom menu control
 */
class WP_Store_WP_Customize_Menu_Dropdown extends WP_Customize_Control
{
    private $menus = false;

    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->menus = wp_get_nav_menus($options);

        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content on the theme customizer page
    */
    public function render_content()
    {
        ?>
            <label>
                <span class="customize-menu-dropdown"><h3><?php echo esc_html( $this->label ); ?></h3></span>
                <select data-customize-setting-link="<?php echo $this->id; ?>" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
                    <?php echo '<option value = "0" selected = "selected">'.__('Select Menu','wp-store').'</option>' ?>
                <?php
                     if(!empty($this->menus))
                     {   
                        foreach ( $this->menus as $menu )
                        {
                            printf('<option value="%s" %s>%s</option>', $menu->term_id, selected($this->value(), $menu->term_id, false), $menu->name);
                        }
                     }
                ?>
                </select>
                <br />
                <span class="description"><?php echo $this->description; ?></span>
            </label>
            <?php
    }
}

