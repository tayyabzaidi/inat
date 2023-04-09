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

namespace __iibsys\__core\Uploader;

class Uploader {

    private $pdo;
    private $lib;

    public function __construct($dbo, $lib) {
        $this->pdo = $dbo;
        $this->lib = $lib;
    }

    function uploadFile($fdet, $fob) {

        $storage_path = __SYSTEM_STORAGE__ . $fdet['folder'];
        $src = $fdet['src'];
        $srcid = $fdet['srcid'];
        $srcid_string = $fdet['srcid_string'];
        $custom_name_en = $fdet['custom_name_en'];
        $custom_name_ar = $fdet['custom_name_ar'];
        $fname = basename(strtolower($fob['name']));
        $fstatus = $fdet['status'];
        $ftype = $fob['type'];
        $fext = strtolower(trim($this->lib->return_Ext($fob['name'])));


        $this->pdo->bind('fid', NULL);
        $this->pdo->bind('src', $src);
        $this->pdo->bind('srcid', $srcid);
        $this->pdo->bind('srcid_string', $srcid_string);
        $this->pdo->bind('custom_name_en', $custom_name_en);
        $this->pdo->bind('custom_name_ar', $custom_name_ar);
        $this->pdo->bind('fname', $fname);
        $this->pdo->bind('ftype', $ftype);
        $this->pdo->bind('fext', $fext);
        $this->pdo->bind('fstatus', $fstatus);
        $this->pdo->bind('ffolder', $fdet['folder']);
        $this->pdo->bind('createdate', date("Y-m-d H:i:s"));
        $this->pdo->bind('modifydate', date("Y-m-d H:i:s"));
        

        $iQuery = " INSERT INTO sys_storage SET 
                    fid=:fid,
                    src=:src,
                    srcid=:srcid,
                    srcid_string=:srcid_string,
                    custom_name_en=:custom_name_en,
                    custom_name_ar=:custom_name_ar,
                    fname=:fname,
                    ftype=:ftype,
                    fext=:fext,
                    fstatus=:fstatus,
                    ffolder=:ffolder,
                    createdate=:createdate,
                    modifydate=:modifydate;";


        $this->pdo->query($iQuery);

        $fid = $this->pdo->lastInsertId();
        $unique_file_name = $fid . '__' . $fname;


        $ftarget = $storage_path . $unique_file_name;



        if (move_uploaded_file($fob['tmp_name'], $ftarget)) {
            return $fid;
        } else {
            /*
             * Something Went Wrong Clear Storage Index
             */
            
            $this->pdo->bind('fid', $fid);
            $this->pdo->bind('fstatus', 'deleted');
            $dQuery = "UPDATE sys_storage SET fstatus=:fstatus WHERE fid=:fid;";
            $this->pdo->query($dQuery);

            return false;
        }
    }

}
