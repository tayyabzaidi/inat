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

namespace __iibsys\__core\Utilities;

class Utilities {

    const SALT_LENGTH = 10;

    private $__translation = array();

    public static function _print($arr) {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    function sanitizeTheVar($var) {
        /* Serverside Post Sanitizer */
        /* Receives the var and sanitizes it */
        //$var = $this->do_filter($var);
        return trim(stripcslashes($var));
    }

    public static function _rand($from = 0, $to = 999) {
        return rand($from, $to);
    }

    public static function _prepeartime($time) {
        return strftime("%I:%M %p", strtotime(str_replace(" : ", ":", $time)));
    }

    public static function _rand_color() {
        return dechex(self::_rand(0, 10000000));
    }

    public static function _pwdhash($pwd, $salt = null) {
        if ($salt === null) {
            $salt = substr(md5(uniqid(rand(), true)), 0, self::SALT_LENGTH);
        } else {
            $salt = substr($salt, 0, self::SALT_LENGTH);
        }
        return $salt . sha1($pwd . $salt);
    }

    function _gen_pwdhash($pwd, $salt = null) {
        $SALT_LENGTH = 9;
        if ($salt === null) {
            $salt = substr(md5(uniqid(rand(), true)), 0, $SALT_LENGTH);
        } else {
            $salt = substr($salt, 0, $SALT_LENGTH);
        }
        return $salt . sha1($pwd . $salt);
    }

    public static function _genkey($length = 7) {
        $password = "";
        $possible = "0123456789abcdefghijkmnopqrstuvwxyz";
        $i = 0;
        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if (!strstr($password, $char)) {
                $password .= $char;
                $i++;
            }
        }
        return $password;
    }

    public static function _gennumkey($length = 7) {
        $password = "";
        $possible = "0123456789";
        $i = 0;
        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if (!strstr($password, $char)) {
                $password .= $char;
                $i++;
            }
        }
        return $password;
    }

    public static function _chopstring($str, $len, $endwith = '') {
        if (strlen($str) < $len) {
            return $str;
        } else {
            $str = substr($str, 0, $len);
            $spc_pos = (strrpos($str, " ")) ? strrpos($str, " ") : 0;
            if ($spc_pos) {
                $str = substr($str, 0, $spc_pos);
            }
        }
        return $str . $endwith;
    }

    public static function _extension_of($filename) {
        $ext = explode(".", $filename);
        $extension = count($ext) - 1;
        return strtolower($ext[$extension]);
    }

    public static function _filter($input) {
        return trim(htmlentities(strip_tags($input)));
    }

    /*
     * Translation Control
     */

    public function _setTranslation($translation) {
        $this->__translation = $translation;
    }

    public function _($key) {
        if (isset($this->__translation[$key])) {
            return $this->__translation[$key];
        } else {
            return $key;
        }
    }

    function return_Ext($file) {
        $ext = explode(".", $file);
        $extension = count($ext) - 1;
        return strtolower($ext[$extension]);
    }

    function isValidFile($fo, $v__Exts) {

        /*
         * Update This Function / Will Be Used In All File Releated Action 
         */

        $fo['extension'] = trim($this->return_Ext($fo['name']));

        if (!in_array($fo['extension'], $v__Exts) || (isset($fo['name']) && $fo['name'] == '' && $fo['error'] == 4)) {
            return false;
        } else {
            return true;
        }
    }

    public function _printMsg($type = 'e', $title = '__Translation_Key__') {
        $theHtml = '';
        $string = '';

        if (isset($_SESSION['msg'])) {
            $strarray = array();

            foreach ($_SESSION['msg'] as $msgvalue) {
                $strarray[] = $msgvalue;
            }
            $string .= implode("<br>", $strarray);

            unset($_SESSION['msg']);

            $box_class = 'danger';
            switch ($type) {
                case 's' :
                    $box_class = 'success';
                    break;

                case 'i' :
                    $box_class = 'info';
                    break;

                case 'w' :
                    $box_class = 'warning';
                    break;

                case 'e' :
                    $box_class = 'danger';
                    break;
            }

            $theHtml = '<div class="alert card bg-' . $box_class . ' text-white m-0 p-0 mb-3 shadow">
                            <div class="card-body p-2">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span class="material-icons imageIconDirection" style="font-size:0.8em;">clear</span></button>
                                <h5 class="p-0 m-0" style="color:white;text-decoration: underline;">' . $this->_($title) . '</h5>
                                <span>' . $string . '</span>
                            </div>
                        </div>';

            return $theHtml;
        } else {
            return $string;
        }
    }

    public function _printCheckOutMsg($type = 'e', $title = '__Translation_Key__') {
        $theHtml = '';
        $string = '';

        if ($type == 'e') {
            $stl = 'style="color:tomato;"';
        } else {
            $stl = 'style="color:black;"';
        }

        $title = $this->_($title);
        if (isset($_SESSION['msg'])) {
            $strarray = array();
            if (is_array($_SESSION['msg'])) {
                foreach ($_SESSION['msg'] as $msgvalue) {
                    $strarray[] = $msgvalue;
                }
                $string .= implode("<br>", $strarray);
            } else {
                $string .= $_SESSION['msg'];
            }

            unset($_SESSION['msg']);

            $btn_dir = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') ? 'right' : 'left';

            $theHtml = '<div style="background-color:white; color:black; padding:10px; margin:2%; overflow:auto;border-radius: 10px;">
                        <div align="' . $btn_dir . '">
                            
                                    <button type="button" onclick="closeCheckOutErrorDiv();" class="btn btn-close btn-sm"><i class="fa fa-plus-circle" style="color:#01764a; font-size: 25px;transform: rotate(45deg);" ></i></button>
                        </div>
                        <h5>' . $title . '</h5>
                        <hr/>
                        <p ' . $stl . '>' . $string . '</p>
                        </div>    ';

            return $theHtml;
        } else {
            return $string;
        }
    }

}
