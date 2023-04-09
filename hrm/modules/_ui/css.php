<?php
/*
 * Copyright (C) 2015 Zeeshan Abbas <zeeshan@iibsys.com> <+966 55 4137245>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */
?>



<link href="<?php echo __APP_URL__ ?>/ui_resources/theme/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


<link href="<?php echo __APP_URL__ ?>/ui_resources/bootstrap/<?php echo $page_direction; ?>/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo __APP_URL__ ?>/ui_resources/bootstrap/bootstrap-select/bootstrap-select.min.css">


<!-- <link href="<?php echo __APP_URL__ ?>/ui_resources/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->

<link href="<?php echo __APP_URL__ ?>/ui_resources/datatables/datatables.min.css" rel="stylesheet" />


<link href="<?php echo __APP_URL__ ?>/ui_resources/select2/select2.min.css" rel="stylesheet" />
<link href="<?php echo __APP_URL__ ?>/ui_resources/select2/select2-bootstrap4.min.css" rel="stylesheet" />



<link href="<?php echo __APP_URL__ ?>/ui_resources/theme/css/<?php echo $page_direction; ?>/admin.css" rel="stylesheet" type="text/css">


<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

<style>


    .overlay {
        display:none;
        height: 100%;
        width: 100%;
        position: fixed; 
        z-index: 9999; 
        left: 0;
        top: 0;
        background-color: rgba(0,0,56, 0.8);
        overflow-x: hidden; 
        transition: 0.5s;
        color:#0082c8;
    }

    .overlay-content {
        position: relative;
        top: 25%; 
        width: 100%; 
        text-align: center; 
        margin-top: 30px;
        color:#020041;

    }

    *{
        font-family: 'Jost', sans-serif;
    }


    a {
        color: #020041;
        text-decoration: none;
        background-color: transparent;
    }

    a:hover {
        color: #020041;
        text-decoration: underline;
    }

    a:not([href]):not([tabindex]) {
        color: inherit;
        text-decoration: none;
    }

    a:not([href]):not([tabindex]):hover, a:not([href]):not([tabindex]):focus {
        color: inherit;
        text-decoration: none;
    }

    a:not([href]):not([tabindex]):focus {
        outline: 0;
    }


    .topbar .dropdown-list .dropdown-header {
        background-color: #020041;
        border: 1px solid #020041;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        color: #fff;
    }




    .dropdown-divider {
        height: 0;
        margin: 0.5rem 0;
        overflow: hidden;
        border-top: 1px solid #eaecf4;
    }

    .dropdown-item {
        display: block;
        width: 100%;
        padding: 0.25rem 1.5rem;
        clear: both;
        font-weight: 400;
        color: #3a3b45;
        text-align: inherit;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
    }

    .dropdown-item:hover, .dropdown-item:focus {
        color: #2e2f37;
        text-decoration: none;
        background-color: #f8f9fc;
    }

    .dropdown-item.active, .dropdown-item:active {
        color: #fff;
        text-decoration: none;
        background-color: #020041;
    }

    .dropdown-item.disabled, .dropdown-item:disabled {
        color: #858796;
        pointer-events: none;
        background-color: transparent;
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-header {
        display: block;
        padding: 0.5rem 1.5rem;
        margin-bottom: 0;
        font-size: 0.875rem;
        color: #858796;
        white-space: nowrap;
    }

    .dropdown-item-text {
        display: block;
        padding: 0.25rem 1.5rem;
        color: #3a3b45;
    }



    /*
        Progress Bar
    */


    progress {
        display: block; /* default: inline-block */
        width: 300px;
        margin: 2em auto;
        padding: 4px;
        border: 0 none;
        background: #0082c8;
        border: 1px solid #6c432d;


    }
    progress::-moz-progress-bar {
        border: 1px solid #6c432d;
        background: #552b13;


    }
    /* webkit */
    @media screen and (-webkit-min-device-pixel-ratio:0) {
        progress {
            height: 15px;
        }
    }
    progress::-webkit-progress-bar {
        background: transparent;
    }  
    progress::-webkit-progress-value {  
        background: #6c432d;

    } 

    <?php $imageIconDirction = ($page_direction == 'rtl') ? '-1' : '1'; ?> 
    .imageIconDirection {


        transform: scaleX(<?php echo $imageIconDirction; ?>);
        -o-transform: scaleX(<?php echo $imageIconDirction; ?>);
        -moz-transform: scaleX(<?php echo $imageIconDirction; ?>);
        -webkit-transform: scaleX(<?php echo $imageIconDirction; ?>);
        -ms-transform: scaleX(<?php echo $imageIconDirction; ?>);
    }


    .tab-content-side-border {
        border-width: 0px 1px 0px 1px; border-style: solid; border-color: #dddfeb ;


    }

    .tab-content-end-border {
        border-width: 0px 1px 1px 1px; 
        border-style: solid; 
        border-color: #dddfeb ;

    }


    .no_margin_padding {
        margin:0px;
        padding: 0px;
    }

    .active_nav {
        border-<?php echo $_right; ?>: 3px solid #e19d23;
    }


    .filter-option-inner-inner {
        text-align: <?php echo $_left; ?>;
    }


    .dataTables_filter > label {
        padding: 10px;

    }

    .dataTables_length > label {
        padding: 9px;
    }

    .dataTables_length {

        float: <?php echo $_left; ?>;
    }

    .dataTables_filter  {
        float: <?php echo $_right; ?>;
    }

    .filter-option-inner-inner {
        text-align: <?php echo $_left; ?>;
    }

    div.dataTables_length select {
        width:80px !important;
    }

    .dataTables_filter > label {
        padding: 10px;

    }

    .dataTables_length > label {
        padding: 9px;
    }

    .dataTables_length {

        float: <?php echo $_left; ?>;
    }

    .dataTables_filter  {
        float: <?php echo $_right; ?>;
    }

    .filter-option-inner-inner {
        text-align: <?php echo $_left; ?>;
    }

    div.dataTables_length select {
        width:80px !important;
    }

    div.brokersTable_filter {
        float:none;
        text-align:center;
    }

    .bs-searchbox {
        margin:10px;
    }


    .ulDetailsWithIcons li {
        list-style-image: none;
        list-style: none;

    }






    /* Page Header */

    .pageheader {
        padding: 15px;
        position: relative;
        /* background: #ffffff; */
        background: linear-gradient(to <?php echo $_right; ?>, rgb(78, 115, 223) 10%, rgb(31, 114, 162) 100%);
        /* Old browsers */
        background: -moz-linear-gradient(to <?php echo $_right; ?>, rgb(78, 115, 223) 10%, rgb(31, 114, 162) 100%);
        /* FF3.6-15 */
        background: -webkit-linear-gradient(to <?php echo $_right; ?>, rgb(78, 115, 223) 10%, rgb(31, 114, 162) 100%);
        /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to <?php echo $_right; ?>, rgb(78, 115, 223) 10%, rgb(31, 114, 162) 100%);
        /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */	
        margin: -20px -5px 10px -5px;
        padding: 35px 15px 25px 20px;
        color: #fff;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
    }
    .pageheader h3 {
        font-size: 22px;
        color: #fff;
        letter-spacing: -.5px;
        margin: 0;
    }
    .pageheader .fa, .pageheader .glyphicon {
        font-size: 24px;
        margin-right: 5px;
        padding: 6px 7px;
        border: 2px solid #fff;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
    }
    .pageheader .fa.fa-pencil {
        padding: 6px 9px
    }
    .pageheader .fa.fa-hand-o-up {
        padding: 6px 9px 6px 7px
    }
    .pageheader .fa-file-o, .pageheader .fa-file-text, .pageheader .fa-user {
        padding: 6px 10px
    }
    .pageheader .fa-dollar, .pageheader .fa-map-marker {
        padding: 6px 12px
    }
    .pageheader .fa-clock-o {
        padding: 6px 8px
    }
    .pageheader .breadcrumb-wrapper {
        position: absolute;
        top: 45px;
        right: 25px
    }
    .pageheader .breadcrumb-wrapper .label {
        color: #fff;
        text-transform: uppercase;
        font-weight: 400;
        display: inline-block;
    }
    .pageheader .breadcrumb li a {
        color: #fff;
    }
    .pageheader .breadcrumb {
        background: 0 0;
        display: inline-block;
        padding: 0
    }
    .pageheader .breadcrumb li.active {
        color: #fff
    }

    .modal-body{
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }



    .table thead th {
        color: #020041;
        border-color:#020041;

    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(243, 151, 15, 0.1) !important;
    }

    .table-striped tbody tr:hover{
        background-color: rgba(243, 151, 15, 0.2) !important;
    }



    .sidebar .nav-item .nav-link[data-toggle="collapse"]::after {

        content: '\f068';

    }
    .sidebar .nav-item .nav-link[data-toggle="collapse"].collapsed::after {
        content: '\f067';
    }




    .bg-login-image {
        background: url("<?php echo __STORAGE_URL__ . 'artwork/login-banner-600x800.png'; ?>");
        background-position: center;
        background-size: cover;
    }

    .bg-register-image {
        background: url("https://source.unsplash.com/Mv9hjnEUHR4/600x800");
        background-position: center;
        background-size: cover;
    }

    .bg-password-image {
        background: url("https://source.unsplash.com/oWTW-jNGl9I/600x800");
        background-position: center;
        background-size: cover;
    }

    h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
        color:#020041;
    }





    .pageheader {
        padding: 15px;
        position: relative;
        /* background: #ffffff; */
        background: linear-gradient(to right, rgb(1, 118, 74) 100%, rgb(25, 133, 92) 10%);
        background: -moz-linear-gradient(to right, rgb(1, 118, 74) 100%, rgb(25, 133, 92) 10%);
        background: -webkit-linear-gradient(to right, rgb(1, 118, 74) 100%, rgb(25, 133, 92) 10%);
        background: linear-gradient(to right, rgb(1, 118, 74) 100%, rgb(25, 133, 92) 80%);
        margin: -20px -5px 10px -5px;
        padding: 35px 15px 25px 20px;
        color: #fff;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
    }


    .select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow b {
        display:none;
    }


    table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td.dtr-control:before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th.dtr-control:before {

        background-color: #020041 !important;
    }

    .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20rem; }
    .toggle.ios .toggle-handle { border-radius: 20rem; }

    .toggle-group { transition: <?php echo $_left; ?> 0.7s; -webkit-transition: left 0.7s; }


    /* width */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background-color: #fff;

    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #020041;
    }



    .lds-ripple {
        display: inline-block;
        position: relative;
        width: 100px;
        height: 100px;
    }
    .lds-ripple div {
        position: absolute;
        border: 5px solid #eb9817;
        opacity: 1;
        border-radius: 50%;
        animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
    }
    .lds-ripple div:nth-child(2) {
        animation-delay: -0.5s;
    }
    @keyframes lds-ripple {
        0% {
            top: 60px;
            left: 60px;
            width: 0;
            height: 0;
            opacity: 1;
        }
        100% {
            top: 0px;
            left: 0px;
            width: 120px;
            height: 120px;
            opacity: 0;
        }
    }



    textarea:focus,
    input[type="radio"]:focus, 
    input[type="checkbox"]:focus,
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="password"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    .custom-select:focus,
    .page-item.active .page-link,
    .page-link:focus,
    .select2-container:focus,
    .select2-selection--single:focus, 
    .select2-selection__rendered:focus,
    .uneditable-input:focus {   
        border-color: rgba(235, 152, 23, 0.7) !important;
        box-shadow:  5px 0px  #eb9817 !important;

    }

    .btn:focus {
        border-color: rgba(235, 152, 23, 0.7) !important;
        box-shadow:  5px 0px  #eb9817 !important;

    }

    hr {
        border-color: rgba(235, 152, 23, 0.7) !important;
    }


    .fade-in-top{animation:fade-in-top 1s cubic-bezier(.47,0.000,.745,.715) .1s both}
    @keyframes fade-in-top{0%{transform:translateY(-50px);opacity:0}100vh{transform:translateY(0);opacity:1}}

    .select2-search--dropdown .select2-search__field {
        width:50%;
    }


    .select2-search--dropdown:before {
        content: "Search : ";
    }
</style>

