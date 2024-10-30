<?php
    /*
    Plugin Name: Current gallery support for NGG Public Uploader shortcode
    Description: Adds support for quickly uploading the current gallery via the NGG Public Uploader shortcode, simply by typing "current" for the gallery id: [ngg_uploader id=current].
    Version: 1.0
    Author: Aimbox
    Author URI: http://aimbox.com
    Depends: NextGEN Public Uploader
    */

    function nextgen_public_uploader_current_gallery_id__override_shortcode()
    {
        global $npuUpload;

        if (isset($npuUpload))
        {
            add_shortcode('ngg_uploader', 'nextgen_public_uploader_current_gallery_id__shortcode');
        }
    }

    function nextgen_public_uploader_current_gallery_id__shortcode($atts)
    {
        global $npuUpload;

        if (isset($npuUpload))
        {
            if (isset($atts['id']) && $atts['id'] === 'current')
            {
                $gallery = (int)get_query_var('gallery');
                if ($gallery <= 0)
                {
                    return null;
                }

                $atts['id'] = $gallery;
            }

            return $npuUpload->shortcode_show_uploader($atts);
        }

        return null;
    }

    add_action('plugins_loaded', 'nextgen_public_uploader_current_gallery_id__override_shortcode');
?>