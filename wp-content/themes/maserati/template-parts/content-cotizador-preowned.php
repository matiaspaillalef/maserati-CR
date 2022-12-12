<?php get_template_part('parts/part', 'banner-page');
$size = 'full';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['preowned'])) :
    echo "<script>
            var modeloPO = '" . $_GET['preowned'] . "'; 
        </script>";
else :
    echo "<script>
            var modeloPO = '';    
        </script>";
endif;

?>

<section class="maserati-form">
    <div class="medium-container">
        <?php echo do_shortcode('[contact-form-7 id="1008" title="Cotizar PreOwned"]'); ?>
    </div>
</section>


<?php if (!empty($_GET['preowned'])) : ?>
    <script>
        jQuery(document).ready(function($) {
            $("[name='preowned'] option").each(function() {
                if (modeloPO != '') {
                    if (modeloPO == $(this).attr('value')) {
                        $(this).attr('selected', true);
                    }
                }
            });
        });
    </script>
<?php endif; ?>