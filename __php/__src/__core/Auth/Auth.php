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

namespace __iibsys\__core\Auth;

class Auth {

    private $cookies_timeout = 15;
    private $dataTable = '';
    private $db;
    private $fun;

    public function __construct($dataTable, $dbo, $fun) {
        $this->dataTable = $dataTable;
        $this->fun = $fun;
        $this->db = $dbo;
    }

    public function getUser($authId = null) {

        if ($authId) {
            $this->db->bind("authId", $authId);
            $qry = "SELECT * FROM $this->dataTable WHERE 1 AND authId=:authId";
        } else {
            $qry = "SELECT * FROM $this->dataTable ";
        }

        return $this->db->row($qry);
    }

    public function login($authId, $authPass, $authRemember = false) {

        $authCondition = (strpos($authId, '@') === false) ? "authName='$authId'" : "authEmail='$authId'";
        $authUser = $this->db->query("SELECT * FROM $this->dataTable WHERE $authCondition");

        if (count($authUser) === 1) {

            $authUser = $authUser[0];


            if ($authUser['authPassword'] != $this->fun->_pwdhash($authPass, substr($authUser['authPassword'], 0, 9))) {
                $res['status'] = false;
                $res['response'] = 'Invalid Password';
                return $res;
            }


            if ($authUser['authStatus'] != 'active') {
                $res['status'] = false;
                $res['response'] = 'Access denied. Contact Admin.';
                return $res;
            }

            $_SESSION['authId'] = $authUser['authId'];
            $_SESSION['authName'] = $authUser['authName'];
            $_SESSION['authEmail'] = $authUser['authEmail'];
            $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);

            $stamp = time();
            $ckey = sha1($this->fun->_genkey());


            if ($authRemember) {
                $lifeTime = time() + 60 * 60 * 24 * $this->cookies_timeout;
                setcookie("authId", $_SESSION['authId'], $lifeTime, "/");
                setcookie("authKey", $ckey, $lifeTime, "/");
                setcookie("authEmail", $_SESSION['authEmail'], $lifeTime, "/");
            }

            $this->db->bind("authId", $authUser['authId']);

            if ($this->db->query("UPDATE $this->dataTable SET ctime='$stamp', ckey='$ckey' WHERE authId=:authId")) {
                $res['status'] = true;
                $res['response'] = 'Signin Successfully.';
                return $res;
            } else {
                $res['status'] = false;
                $res['response'] = 'Error in signing in.';
                return $res;
            }
        } else {
            $res['status'] = false;
            $res['response'] = 'Unknown User';
            return $res;
        }
    }

    private function checkUserAgent() {
        return (isset($_SESSION['HTTP_USER_AGENT']) && $_SESSION['HTTP_USER_AGENT'] == md5($_SERVER['HTTP_USER_AGENT'])) ? true : false;
    }

    private function checkSession() {
        return (isset($_SESSION['authId']) && isset($_SESSION['authId'])) ? true : false;
    }

    private function checkCookies() {
        $hasCookies = (isset($_COOKIE['authId']) && isset($_COOKIE['authKey'])) ? true : false;
        if ($hasCookies) {

            $cookie_auth_id = $_COOKIE['authId'];
            $cookie_auth_email = $_COOKIE['authEmail'];
            $cookie_auth_key = $_COOKIE['authKey'];

            $authUser = $this->getUser($cookie_auth_id);

            $ctime = $authUser['ctime'];
            $ckey = $authUser['ckey'];
            $cemail = $authUser['authEmail'];

            $timeLimit = $ctime;
            $timeCurrent = time();

            $isCookieExpired = ($timeCurrent > $timeLimit) ? true : false;
            $isCookieValid = (!empty($ckey) && ($cookie_auth_email == $cemail) && $cookie_auth_key == $ckey) ? true : false;

            if ($isCookieExpired && $isCookieValid) {

                /*
                 * Reset Session
                 */
                $_SESSION['authId'] = $authUser['authId'];
                $_SESSION['authName'] = $authUser['authName'];
                $_SESSION['authEmail'] = $authUser['authEmail'];
                $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function checkAuth() {

        if ($this->checkUserAgent() && $this->checkSession()) {
            return true;
        } elseif ($this->checkCookies()) {
            return true;
        }

        return false;
    }

    public function logout() {

        $currId = isset($_SESSION['authId']) ? $_SESSION['authId'] : false;

        unset($_SESSION['authId']);
        unset($_SESSION['authName']);
        unset($_SESSION['authEmail']);
        unset($_SESSION['HTTP_USER_AGENT']);

        session_unset();
        session_destroy();

        $desTime = time() - 60 * 60 * 24 * $this->cookies_timeout;

        setcookie("authId", '', $desTime, "/");
        setcookie("authKey", '', time() - 60 * 60 * 24 * (int) $this->cookies_timeout, "/");
        setcookie("authEmail", '', time() - 60 * 60 * 24 * (int) $this->cookies_timeout, "/");


        if ($currId) {
            $this->db->bind('authId', $currId);
            if ($this->db->query("UPDATE $this->dataTable SET ckey= '', ctime= ''  WHERE authId=:authId")) {
                return true;
            }
        } else {
            return false;
        }

        return true;
    }

}
