<?php
add_action('acf/input/admin_head', 'my_acf_admin_head');
function my_acf_admin_head() {
    ?>


    <style type="text/css">
/* 
:root :where(.editor-styles-wrapper)::after {
    height: auto !important;
}
.components-resizable-box__container.editor-resizable-editor {
    height: auto !important;
}

.interface-interface-skeleton__content {
    display: block !important;
} */


/* :root :where(.editor-styles-wrapper)::after {
    height: 0vh !important;
}
.components-resizable-box__container.editor-resizable-editor {
    height: 100% !important;
} */

/* .interface-interface-skeleton__body {
    display: block !important;
} */

/* .editor-visual-editor{
    height: auto;
} */

/* .wp-editor-tools:after{
    display: none;
} */
.meet-rows {
    width: 23%;
    padding: 1%;
    margin-top: 40px;
}

.meet-the-team {
    padding: 10px;
}

.member-photo{
    position:relative;
    overflow:hidden;
    padding-bottom:100%;
}
.member-photo img{
    position:absolute;
    height: 100%;
    object-fit: cover;
}


.funders-supporters {
    background: rgb(157 172 184);
    border-radius: 7px;
    margin-top: 30px;
    padding: 10px;
}
/* .funders-supporters h3{
    color: #efefef;
} */

.fs-tax .acf-input {
    background: rgb(157 172 184);
}


.fs-tax .acf-gallery .acf-gallery-attachment .margin {
    background: transparent;
}



.wp-block-reaal-block-patterns-meet {
    flex-wrap: wrap;
}


[data-type="reaal-block-patterns/meet"] {
    display: flex;
}

.edit-tag-actions {
    position: relative;
}

#delete-link {
    right: 0;
    position: absolute;
    border: 1px solid red;
    padding: 0 5px;
    opacity: 0.3;display: none!important;
}

#delete-link:hover {
    opacity: 1;
    background-color: red;
    color:#fff;
}

.block-editor-block-list__block[data-type="core/separator"] {
    margin-bottom: 2em;
    margin-top: 2em;
    border: 0;
    height: 1px;
    background: var(--blackacf);
}

button.down-load-btn {
    background: #f8a8ff;
    border-radius: 0;
    border: none;
    margin: 0;
    padding: 0.25em 1em;
}

button.down-load-btn p {
    margin: 0;
    text-transform: uppercase;
    font-weight: 700;
}

.intro-block-acf {
    border-bottom: 1px solid #b4b7c8;
    margin-bottom: 20px;
    padding-bottom: 10px;
}

.intro-block-acf:before {
    display: block;
    content: "Post summary:";
    opacity: 0.6;
    text-transform: uppercase;
    font-size: 12px;
}

.mce-toolbar .mce-ico {
    color: var(--blackacf);
}

.mce-toolbar .mce-btn-group .mce-btn.mce-listbox {
    background: var(--lightacf);
    border: 0px solid #dcdcde;
    box-shadow: none;
    border-radius: 3px;
}



.acf-label.acf-accordion-title {
    background: var(--pink-acf);
}

.acf-accordion .acf-accordion-title label {
    background: #ffffff !important;
    font-weight: 600 !important;
    text-transform: uppercase;
    font-size: 18px !important;
}

.acf-fields > .acf-tab-wrap {
    background: #fff9ff;
    border-top: 1px solid #ffc1f3;
}

.acf-fields > .acf-tab-wrap .acf-tab-group {
    padding-bottom: 5px;
}

.acf-fields > .acf-tab-wrap .acf-tab-group li.active a {
    font-weight: 500;
    font-size: 13px;
    display: inline-block;
    background: var(--pinkacf);
    border-radius: 5px;
    margin-left: 0;
    border-color: transparent;
}

.acf-fields > .acf-tab-wrap .acf-tab-group li a:hover {
    background: #ffffff91;
    border-color: rgb(251 204 255);
}



.acf-fields > .acf-tab-wrap .acf-tab-group li a {
    background: transparent;
    border-color: var(--blackacf);
    color: var(--blackacf);
    font-weight: 500;
    border-radius: 5px;
    border-width: 1px;
    border-color: transparent;
	border-bottom-width: 1px;
    border-bottom-style: solid;
}




/* .acf-tab-group li:nth-of-type(1) {
    padding-left: 0;
} */
.acf-tab-group li {
    padding: 0 0.5em;
}
    

.acf-fields.-sidebar:before {
    background: #fff9ff;
    border-top: 1px solid #ffc1f3;
}



 
.metabox-location-side .postbox-header {
    border: 0;
    border-radius:0;
}

.metabox-location-side .postbox {
    border-radius: 0 !important;
    border-top: 0 !important;
    border-left: 0 !important;
    border-right: 0 !important;
}

.metabox-location-side #poststuff h2 {
       padding: 16px 48px 16px 16px !important;
}

.editor-styles-wrapper .is-layout-flex {
    margin: 20px auto;
/*    background: #fcfcfc;*/
    cursor: pointer;
    border-radius: 10px;
        border: 1px dashed #ccc;
}

.editor-styles-wrapper .is-layout-flex > * {
    /* box-shadow: 0px 0px 10px #efefef; */
    border-radius: 5px;
    padding: 10px;
    border: 1px solid #efefef;
        height: 100%;
}
        
        html :where(.wp-block) {
    margin-top: 0;
    margin-bottom: 0;
}
        


        
:root {
--darkacf: #eedfdf;
--lightacf: var(--darkacf);
--blackacf:#310434;
--pinkacf: rgb(251 204 255 / 26%);
--pink-acf: rgb(251 204 255 / 26%);
--mad-pink:#ff57fb;
}

input[type=checkbox]:focus, input[type=color]:focus, input[type=date]:focus, input[type=datetime-local]:focus, input[type=datetime]:focus, input[type=email]:focus, input[type=month]:focus, input[type=number]:focus, input[type=password]:focus, input[type=radio]:focus, input[type=search]:focus, input[type=tel]:focus, input[type=text]:focus, input[type=time]:focus, input[type=url]:focus, input[type=week]:focus, select:focus, textarea:focus {
    border-color: var(--mad-pink);
    box-shadow: 0 0 0 1px var(--mad-pink);
	transition: ease all 0.2s;
}

.acf-accordion .acf-accordion-title:hover {
    background: rgb(251 204 255 / 71%);
    transition: ease all 0.2s;
}
.acf-accordion .acf-accordion-title {
    transition: ease all 0.2s;
}
#editor .postbox {
	color: var(--blackacf);
}
.edit-post-layout__metaboxes .edit-post-meta-boxes-area #poststuff h2.hndle {
	font-size: 30px;
	margin-left: 0;
	padding-left: 15px;
	padding-top: 15px;
	padding-bottom: 30px;
}
.edit-post-meta-boxes-area .postbox-header {
	border-bottom: 1px solid var(--darkacf);
	border-top: 0;
	border-radius: 10px 10px 0 0px;
}
#editor .postbox > .postbox-header {
	background: #ffffff;
	transition: all 0.25s ease;
}
#editor .postbox > .postbox-header:hover {
	background: rgb(251 204 255 / 71%);
	border-bottom: 1px solid #ffffff;
	transition: all 0.25s ease;
}
#normal-sortables .acf-field .acf-label label {
    font-size: 14px;
    display: inline-block;
    background: var(--pink-acf);
    padding: 4px 8px;
    border-radius: 5px;
}
    
        
.acf-field[data-width] + .acf-field[data-width] {
	border-left: 0px solid #eeeeee;
}
.acf-fields > .acf-field {
	padding: 32px 16px;
	border-top-color: var(--lightacf);
}
.acf-field[data-width] + .acf-field[data-width] {
	border-top: 0;
}
.postbox {
	box-shadow: 0 0 0 rgb(255 255 255);
}
.wp-core-ui select, input[type=color], input[type=date], input[type=datetime-local], input[type=datetime], input[type=email], input[type=month], input[type=number], input[type=password], input[type=search], input[type=tel], input[type=text], input[type=time], input[type=url], input[type=week], select, textarea {
	border: 1px solid var(--darkacf);
	color: var(--blackacf);
	padding: 4px 8px;
}
.acf-field input[type=text], .acf-field input[type=password], .acf-field input[type=date], .acf-field input[type=datetime], .acf-field input[type=datetime-local], .acf-field input[type=email], .acf-field input[type=month], .acf-field input[type=number], .acf-field input[type=search], .acf-field input[type=tel], .acf-field input[type=time], .acf-field input[type=url], .acf-field input[type=week], .acf-field textarea, .acf-field select {
	padding: 4px 8px;
}
.acf-table > thead > tr > th {
	border-color: var(--darkacf);
	border-width: 1px 0;
	font-weight: 500;
	font-size: 15px;
	color: var(--blackacf);
	border-top: 0;
	text-align: center
}
#editor .postbox.closed {
	border-color: transparent;
	margin-bottom: 0px;
	margin-top: 0px;
	transition: all 0.5s ease;
}
#editor .postbox {
	border-radius: 10px;
	margin-top: 25px;
	margin-bottom: 25px;
	border: 1px solid var(--darkacf);
	transition: all 0.5s ease;
}
.acf-image-uploader .image-wrap {
	max-width: 100% !important;
	width: 100%;
}
.acf-image-uploader .image-wrap img {
	width: 100%;
	margin: auto;
	object-fit: contain;
}
.acf-flexible-content .layout {
	border: 1px solid var(--lightacf);
display: inline-flex;
    flex-wrap: wrap;
  flex: 0 0 auto;
        align-items: start;
    margin-bottom: auto;
}
.acf-flexible-content .layout .acf-fc-layout-handle {
	border-bottom: var(--lightacf) solid 1px;
}
.acf-table > tbody > tr:first-child > td {
	border-top-width: 1px;
}
.values.ui-sortable {
	display: flex;
	flex-wrap: wrap;
    justify-content: space-between;
}
.acf-flexible-content .layout:first-child {
	margin-top: 20px;
}
.acf-repeater th.acf-row-handle:before {
	content: "#";
	width: 16px;
	display: block;
	height: 1px;
}
#editor .edit-post-layout__metaboxes {
    padding: 0;
    max-width: 840px;
    margin: auto;
    width: 100%;
}
.acf-table > tbody > tr > th, .acf-table > tbody > tr > td, .acf-table > thead > tr > th, .acf-table > thead > tr > td {
	padding: 16px;
}
/*  repeater      */
.acf-repeater.-row > table > tbody > tr > td, .acf-repeater.-block > table > tbody > tr > td {
	border-top-color: var(--lightacf);
}
.acf-fields.-left > .acf-field:before {
	background: #ffffff;
	border-color: #ffffff;
}
.acf-repeater .acf-row-handle.order {
	background: var(--pink-acf);
	color: var(--blackacf);
	text-shadow: none;
	font-weight: 500;
	border-radius: 10px 0px 0px 10px;
}
.acf-table > tbody > tr > td {
	border-width: 0;
}
/*
.acf-table td:nth-last-of-type(2) {
    border-radius: 0px 10px 10px 0px;
}
*/
        
td.acf-row-handle.order.ui-sortable-handle {
	border-radius: 10px 0px 0 10px;
}
.acf-repeater .acf-row-handle.remove {
	background: var(--pink-acf);
	border-left-color: transparent;
	border-radius: 0px 10px 10px 0px;
}
.acf-table {
	border-spacing: 0 20px;
}
.acf-table > tbody > tr > td {
	border-width: 1px 0;
}
.acf-image-uploader .image-wrap img {
	background: #ffffff;
	border: 1px solid var(--darkacf);
	border-radius: 5px;
	padding: 0;
}
.acf-repeater > table {
	margin: 0;
	background: #ffffff;
	border: 0;
}
.interface-complementary-area .postbox {
	border-top: 0;
	border-left: 0;
	border-right: 0;
	border-radius: 0;
}
.acf-field[data-width] + .acf-field[data-width] {
	border-top: 1px solid var(--lightacf);
}
.acf-icon:before {
	margin: auto;
}
.acf-actions.-hover .acf-icon {
	width: 2em;
	height: 2em;
	display: flex;
	justify-content: center;
	align-self: center;
	transition: all 0.25s ease;
}
.acf-icon.dark {
	border-color: transparent !important;
	background: var(--lightacf);
	color: var(--blackacf);
	transition: all 0.25s ease;
}
a.acf-icon.dark:hover {
	background: var(--blackacf);
	color: #ffffff;
}
a.acf-icon.dark.-cancel:hover {
	background: #D54E21;
	color: #ffffff;
}
.acf-image-uploader .image-wrap:hover .acf-actions {
	transition: all 0.25s ease;
}
.acf-image-uploader .image-wrap .acf-actions {
	transition: all 0.25s ease;
}
        
        
.acf-gallery .acf-gallery-attachment .thumbnail img {
    height: 100%;
    width: 100%;
    object-fit: cover;
}

.acf-gallery .acf-gallery-attachment .margin {
    border: var(--lightacf) solid 1px;
    background: #eaecf0;
    border-radius: 5px;
}
        
.acf-gallery-attachments .acf-icon.dark {
    height: 1.25em;
    width: 1.25em;
    display: flex;
}
        
        .acf-gallery {
    border: var(--lightacf) solid 1px;
    border-radius: 5px;
}
    
        
        .acf-gallery .acf-gallery-toolbar {
    border-top: var(--lightacf) solid 1px;
    background: #fff0;
}
        .acf-gallery .acf-gallery-side {
    border-left: #ccd0d4 solid 0;
}
        
        .acf-gallery .acf-gallery-main {
    background: #fff0;

}
        
        
.acf-field-wysiwyg .mce-container-body {
    background: #ffffff;
    border-radius: 5px;
}

.acf-field-wysiwyg div.mce-toolbar-grp{
border: 0;
}

.acf-field-wysiwyg     div.mce-toolbar-grp {
border-bottom: 1px solid var(--darkacf);
border-radius: 5px;
background: transparent
}
.acf-field-wysiwyg .mce-top-part::before {
box-shadow: none;
}

.acf-editor-wrap .wp-editor-container {
border: 1px solid var(--darkacf);
border-radius: 5px 0 5px 5px;
}
        
.acf-field-wysiwyg div.mce-panel {
    border: 0;
    background: #fff;
    border-radius: 5px;
}
        
.acf-field-wysiwyg .block-editor .autosize .mce-top-part {
    top: 0;
    border-bottom: 1px solid var(--darkacf);
}

        
.acf-field-wysiwyg .mce-tinymce {
    box-shadow: none;
}
        
.acf-field-wysiwyg div.mce-edit-area {

    border-top: 1px solid var(--darkacf)!important;
}

        
[data-name*="gap_holder"]{
    display: none;
}
        
            </style>
<?php }