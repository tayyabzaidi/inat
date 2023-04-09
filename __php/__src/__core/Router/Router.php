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

namespace __iibsys\__core\Router;

class Router {

    public $q;
    public $subpage;
    public $op;
    public $act;
    public $recid;

    public function __construct() {
        $this->init();
    }

    public function init() {
        $url = $this->parseUrl();

        $this->q = (isset($url[0])) ? $url[0] : false;
        $this->subpage = (isset($url[1])) ? $url[1] : false;
        $this->op = (isset($url[2])) ? $url[2] : false;
        $this->act = (isset($url[3])) ? $url[3] : false;
        $this->recid = (isset($url[4])) ? $url[4] : false;
    }

    public function parseUrl() {
        if (isset($_GET['_go'])) {
            return $url = explode('/', filter_var(rtrim($_GET['_go'], '/'), FILTER_SANITIZE_URL));
        }
    }

    public function normalizeUrl($origin) {
        echo $origin;
    }

}
