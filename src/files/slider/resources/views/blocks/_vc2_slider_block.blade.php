<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'slider-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if( $is_preview ) {
    $className .= ' is-admin';
}

$slide_height_desktop = get_field('slide_height_desktop');
$slide_height_laptop = get_field('slide_height_laptop');
$slide_height_tablet_large = get_field('slide_height_tablet_large');
$slide_height_tablet_small = get_field('slide_height_tablet_small');
$slide_height_mobile = get_field('slide_height_mobile');
$arr = [$slide_height_desktop, $slide_height_laptop, $slide_height_tablet_large, $slide_height_tablet_small, $slide_height_mobile];
$height = join('-',$arr);

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php if( have_rows('slides') ): ?>
        <div class="slides">
            <?php while( have_rows('slides') ): the_row(); 
                $image = get_sub_field('slide_image');
                $text = get_sub_field('slide_text');
                $link = get_sub_field('slide_link');
                $tlink = get_sub_field('slide_tlink');
                $link_img = wp_get_attachment_image_src( $image['id'], 'full', false );
                ?>
                <div class="content-slide">
                    <div class="image-slide <?php echo $height; ?>" style="background-image: url( <?php echo $link_img[0]; ?> );" >
                        <div class="slide-wrap">
                            <div class="text-slide">
                                <?php echo $text; ?>
                            </div>
                            <div class="link-slide">
                                <a href="<?php echo esc_url($link ); ?>"><?php echo $tlink; ?></a>
                            </div>
                        </div>
                            
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Please add some slides.</p>
    <?php endif; ?>
</div>