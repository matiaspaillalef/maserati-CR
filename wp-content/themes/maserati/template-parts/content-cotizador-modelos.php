<?php get_template_part('parts/part', 'banner-page');
$size = 'full';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['version'])) :
    echo "<script>
            var modelo = '" . $_GET['version'] . "'; 
        </script>";
else :
    echo "<script>
            var modelo = '';    
    </script>";
endif;

?>

<section class="maserati-form">
    <div class="medium-container">
        <?php echo do_shortcode('[contact-form-7 id="1000" title="Cotizar Modelo"]'); ?>
    </div>
</section>


<?php if (!empty($_GET['version'])) : ?>
    <script>
        jQuery(document).ready(function($) {
            $("[name='modelos'] option").each(function() {
                if (modelo != '') {
                    if (modelo == $(this).attr('value')) {
                        $(this).attr('selected', true);
                    }
                }
            });
        });
    </script>
<?php endif; ?>