<?php
if (!is_active_sidebar('sidebar-1')) {
    return;
}

$show_sidebar = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 'xmlhttprequest' === strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_REQUEST['showsidebar']);
?>
<div class="col-md-3 col-sm-12 sidebar-filter">
    <nav class="navbar navbar-expand-lg">
        <button class="navbar-toggler filter-toggler <?php echo $show_sidebar ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#productFilterCollapse" aria-controls="productFilterCollapse" aria-expanded="<?php echo $show_sidebar ? 'true' : 'false'; ?>" aria-label="Toggle navigation">
            Filtros <i class="fas fa-sliders-h"></i>
        </button>

        <div class="collapse navbar-collapse <?php echo $show_sidebar ? 'show' : ''; ?>" id="productFilterCollapse">
            <aside id="filter-car" class="w-100">
                <div id="number-filter" class="mt-4">
                    <?php //woocommerce_result_count(); 
                    ?>
                </div>

                <?php if ($_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes()) : ?>
                    <div id="tags-filter">
                        <ul>
                            <?php
                            foreach ($_chosen_attributes as $taxonomy => $values) {
                                $attribute   = wc_attribute_taxonomy_slug($taxonomy);
                                $filter_name = "filter_$attribute";
                                $link        = remove_query_arg(array('add-to-cart', $filter_name), get_pagenum_link(1, false));

                                if (count($values['terms']) == 1) {
                                    $term = get_term_by('slug', $values['terms'][0], $taxonomy);
                                    if (!$term) {
                                        continue;
                                    }

                                    $link = remove_query_arg("query_type_$attribute", $link);

                                    echo '<li>' . esc_html($term->name) . ' <a href="' . esc_url($link) . '"><i class="fas fa-times-circle"></i></a></li>';
                                } else {
                                    foreach ($values['terms'] as $index => $term_slug) {
                                        $term = get_term_by('slug', $term_slug, $taxonomy);
                                        if (!$term) {
                                            continue;
                                        }

                                        $new_terms = array_slice($values['terms'], 0, $index) + array_slice($values['terms'], $index + 1);
                                        $link      = add_query_arg($filter_name, implode(',', $new_terms), $link);

                                        echo '<li>' . esc_html($term->name) . ' <a href="' . esc_url($link) . '"><i class="fas fa-times-circle"></i></a></li>';
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="accordion" id="accordionPanelsFilter">
                    <?php dynamic_sidebar('sidebar-1'); ?>
                </div>
            </aside>

            <button class="navbar-toggler filter-toggler <?php echo $show_sidebar ? '' : 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#productFilterCollapse" aria-controls="productFilterCollapse" aria-expanded="<?php echo $show_sidebar ? 'true' : 'false'; ?>" aria-label="Toggle navigation">
                Cerrar Filtros <i class="fas fa-chevron-up"></i>
            </button>
        </div>
    </nav>
</div> <!-- .col-lg-3 -->