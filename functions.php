<?php

function my_theme_style() {

	wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style('animate_css', get_template_directory_uri() . '/css/animate.css');
	wp_enqueue_style('font_awesome_css', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style('owl_carousel_css', get_template_directory_uri() . '/css/owl.carousel.css');
	wp_enqueue_style('owl_theme_css', get_template_directory_uri() . '/css/owl.theme.default.min.css');
	wp_enqueue_style('swiper_css', get_template_directory_uri() . '/css/swiper.min.css');
	wp_enqueue_style('hover_css', get_template_directory_uri() . '/css/hover.min.css');
	wp_enqueue_style('inston_icons_css', get_template_directory_uri() . '/plugins/inston-icons/style.css');
	wp_enqueue_style('main_style', get_template_directory_uri() . '/css/style.css');
	wp_enqueue_style('responsive_css', get_template_directory_uri() . '/css/responsive.css');

}

// call hook for load css files
add_action('wp_enqueue_scripts', 'my_theme_style');

function my_theme_js() {

	wp_enqueue_script('jquery_js', get_template_directory_uri() . '/js/jquery.js', array('jquery'), '', true);
	wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '', true);
	wp_enqueue_script('swipper_js', get_template_directory_uri() . '/js/swiper.min.js', array('jquery'), '', true);
	wp_enqueue_script('owl_carouser_js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '', true);
	wp_enqueue_script('theme_js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '', true);

}

// call hook for load javascript and jquery
add_action('wp_enqueue_scripts', 'my_theme_js');


function my_theme_nav_menu() {

    register_nav_menu('primary',__( 'Top Navigation' ));

}

// call hook for register navigation menu
add_action( 'init', 'my_theme_nav_menu' );


// for submenu
if (!class_exists('My_Custom_Nav_Walker')) {
class My_Custom_Nav_Walker extends Walker_Nav_Menu { 

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) { 
        if (!$element)
            return;
        $id_field = $this->db_fields['id'];

        if (is_array($args[0]))
            $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
        else if (is_object($args[0]))
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;
        if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {

            foreach ($children_elements[$id] as $child) {

                if (!isset($newlevel)) {
                    $newlevel = true;
                    $cb_args = array_merge(array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }
                $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
            }
            unset($children_elements[$id]);
        }

        if (isset($newlevel) && $newlevel) {
            $cb_args = array_merge(array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) { 
        if ((is_object($item) && $item->title == null) || (!is_object($item))) {
            return ;
        }

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        if (is_object($args) && $args->has_children) {
            //$classes[] = 'dropdown';
            $li_attributes .= ' data-dropdown="dropdown"';
        }
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = ($item->current) ? 'active' : '';

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $item_output = (is_object($args)) ? $args->before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= (is_object($args) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (is_object($args) ? $args->link_after : '');
        $item_output .= '</a>';
        $item_output .= (is_object($args) ? $args->after : '');

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }


    public function start_lvl(&$output, $depth = 0, $args = array()) { 
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"submenu\">\n";
    }


	}
}

?>