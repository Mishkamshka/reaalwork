<div style="background:pink">

<?php
foreach ($blocks as $block) { 
    if ($block['blockName'] === 'reaal-block-patterns/hero-sub' && 
        isset($block['attrs']['data']['hero_sub']) && 
        !empty($block['attrs']['data']['hero_sub'])) {
        
        echo '<p><strong>' . render_block($block) . '</strong></p>';
    } 
}
?>
</div>

<div class="home-header_section-one">
<?php
foreach ($blocks as $block) {
    // Check if the block is a group block with the specific pattern metadata
    if ($block['blockName'] === 'core/group' && 
        isset($block['attrs']['metadata']['patternName']) && 
        $block['attrs']['metadata']['patternName'] === 'header/home-pattern') {

        echo '<div class="custom-pattern-content">' . render_block($block) . '</div>';
    }
}
?>
</div>

<div class="home-header_section-two">
<?php
foreach ($blocks as $block) {
    // Check if the block is a group block with the specific pattern metadata
    if ($block['blockName'] === 'core/group' && 
        isset($block['attrs']['metadata']['patternName']) && 
        $block['attrs']['metadata']['patternName'] === 'header/home-pattern') {

        echo '<div class="custom-pattern-content">' . render_block($block) . '</div>';
    }
}
?>
</div>
