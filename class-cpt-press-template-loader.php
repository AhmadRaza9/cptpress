<?php

if (!class_exists('CPT_PRESS_Template_Loader')) {
    if (!class_exists('Gamajo_Template_Loader')) {
        require_once CPT_PRESS_BASE_DIR . 'vendor/class-gamajo-template-loader.php';
    }

    class CPT_PRESS_Template_Loader extends Gamajo_Template_Loader
    {

        /** Prefix for filter names... */
        protected $filter_prefix = 'cpt_press';

        /** Direcotry name where custom templates for this plugin should be found in the theme... */
        protected $theme_template_directory = 'cptpress';

        /** Reference to the root directory path of this plugin */

        protected $plugin_directory = CPT_PRESS_BASE_DIR;

        /** Directory name where templates are found in this plugin... */

        protected $plugin_template_directory = 'templates';

    }
}
