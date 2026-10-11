<?php
add_action('acf/input/admin_head', 'my_acf_admin_head2');
function my_acf_admin_head2() {
?>

<style type="text/css">
[data-layout="sixteen_gap"] {
    width: calc(16.66% - .5%);
}
[data-layout="twentyfive_gap"] {
    width: calc(25% - .5%);
}
[data-layout="thirtythree_gap"] {
    width: calc(33.33% - .5%);
}

[data-layout="twentyfive_block"] {
    width: calc(25% - .5%);
}
        
[data-layout="thirtythree_block"] {
    width: calc(33.33% - .5%);
}
        
[data-layout="fifty_block"] {
    width: calc(50% - .5%);
}
        
[data-layout="sixtysix_block"] {
    width: calc(66.66% - .5%);
}
        
[data-layout="seventyfive_block"] {
    width: calc(75% - .5%);
}
              
        
[data-layout="onehundred_block"] {
    width: calc(100% - .5%);
}
        
[data-layout="video_block"] {
    width: calc(100% - .5%);
}
    
[data-key="field_61d07b7a29cd2"] .acf-flexible-content .layout {
    border-radius: 10px;
    margin-left: .125%;
    margin-right: .125%;
}
    
    [data-key="field_61d07b7a29cd2"] .acf-fc-layout-handle {
    width: 100%;
}
    
    [data-key="field_61d07b7a29cd2"] [data-type*="message"]{
    display: none;
}
</style>
<?php } 
