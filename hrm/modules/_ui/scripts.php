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
 * 
 * 
 * https://gitbrent.github.io/bootstrap4-toggle/
 */
?>
<script src="<?php echo __APP_URL__ ?>/ui_resources/jquery/jquery.js"></script>
<script src="<?php echo __APP_URL__ ?>/ui_resources/jquery/jquery-easing/jquery.easing.min.js"></script>
<script src="<?php echo __APP_URL__ ?>/ui_resources/bootstrap/js/popper.min.js"></script>
<script src="<?php echo __APP_URL__ ?>/ui_resources/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo __APP_URL__ ?>/ui_resources/theme/js/admin.js"></script>
<script src="<?php echo __APP_URL__ ?>/ui_resources/chart.js/Chart.min.js"></script>

<!---
<script src="<?php echo __APP_URL__ ?>/ui_resources/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo __APP_URL__ ?>/ui_resources/datatables/dataTables.bootstrap4.min.js"></script>
--->


<script src="<?php echo __APP_URL__ ?>/ui_resources/svg_style/svg_style.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo __APP_URL__ ?>/ui_resources/bootstrap/bootstrap-select/bootstrap-select.min.js"></script>

<script src="<?php echo __APP_URL__ ?>/ui_resources/datatables/datatables.min.js"></script>
<script src="<?php echo __APP_URL__ ?>/ui_resources/select2/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>


<script>
    // imitation of new page loading
    window.onload = function () {
        $body = $('body'),
                $btn = $('.btn');

        loader(10);

        $btn.on('click', function () {
            $body.removeClass().addClass('restart');
            loader(getRandomNumber(300, 3000));
        });

        function loader(delay) {
            setTimeout(function () {
                $body.addClass('loading');
            }, delay);

            setTimeout(function () {
                $body.addClass('loaded');
            }, delay + 1700);

            setTimeout(function () {
                $body.removeClass('restart').addClass('new-page');
            }, delay + 1950);
        }

        function getRandomNumber(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
    }
</script>