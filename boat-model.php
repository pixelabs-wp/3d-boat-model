<?php
/*
Plugin Name: Boat Modal
Description: Plugin to add a custom shortcode for displaying Modal.
Version: 1.1.3
Author: Pixelabs
*/

// Define function to enqueue scripts and styles
function enqueue_model_viewer_scripts()
{
    wp_enqueue_script('model-viewer-boat', 'https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js', array(), '3.4.0', true);
    wp_enqueue_script('boat-js', plugin_dir_url(__FILE__) . "script.js", array(), '3.4.0', true);
    wp_enqueue_style('model-viewer-boat', 'https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js', array(), '3.4.0', true);
    wp_enqueue_style('model-viewer-boat-css', plugin_dir_url(__FILE__) . "styles.css");
}

// Hook the enqueue function into the appropriate action
add_action('wp_enqueue_scripts', 'enqueue_model_viewer_scripts');


// Modify script tag to add type module
function add_module_type_to_model_viewer($tag, $handle)
{
    if ('model-viewer-boat' === $handle) {
        $tag = '<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.4.0/model-viewer.min.js"></script>';
    }
    return $tag;
}
add_filter('script_loader_tag', 'add_module_type_to_model_viewer', 10, 2);

function custom_shortcode_function()
{
    ob_start(); // Start output buffering
?>
    <div class="container">
        <div class="ym_split_content ym_split_content_left ym_split_content_rectangle">
            <div class="row">
                <div class="col-md-6 order-md-1">
                    <model-viewer id="boatModalViewer" loading="auto" camera-controls="" data-js-focus-visible="true" poster="" src="https://sea-machines.com/wp-content/uploads/2024/04/boat-transformed.glb" alt="A 3D model" shadow-intensity="1" shadow-softness="1" reveal="auto" data-animation="" exposure="3.1" disable-zoom="" ar-status="not-presenting" data-items="">
                    </model-viewer>

                    <div class="ym_image_slider_arrows">
                        <button type="button" class="slick-prev slick-arrow" role="button">Previous</button>
                        Click and drag to rotate
                        <button type="button" class="slick-next slick-arrow" role="button">Next</button>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 order-md-2 offset-lg-1">
                    <div class="ym_flex">
                        <div class="ym_text_content">
                            <div data-aos="fade-up" data-aos-delay="100" class="aos-init aos-animate">
                                <h3><span style="color: #ffffff;">BECAUSE WE <strong>KNOW</strong> AUTONOMY.</span></h3>
                                <p>Since 2017, we have pioneered the frontier of autonomous technology, refining our expertise to engineer the pinnacle vessel equipped with the industry’s most trusted autonomy system: the SM300 Autonomous Command and Control.</p>
                            </div>
                            <div class="ym_content_button aos-init aos-animate" data-aos="fade-up" data-aos-delay="150">
                                <a class="ym_button" target="_self" id="download-button">Download the Brochure</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="boatModal">
        <div class="modal-dialog">
            <div class="modal-content" id="content_1">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Download Brochure</h4>
                    <button type="button" id="modalDismiss" class="close" data-dismiss="modal"></button>

                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <?php echo do_shortcode('[gravityform id="8" title="true"]'); ?>
                </div>
            </div>
            <div class="modal-content" id="content_2">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Download Brochure</h4>
                    <button type="button" id="modalDismiss" class="close" data-dismiss="modal"></button>

                </div>
                <p style="padding: 10px;">Thanks for submitting the form, your download will start now</p>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean(); // Return buffered content
}


// Register shortcode
add_shortcode('boat_model', 'custom_shortcode_function');
