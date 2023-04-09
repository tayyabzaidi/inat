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

namespace __iibsys\__core\Stats;

class Stats {

    private $pdo;
    private $lib;

    public function __construct($pdo, $lib) {
        $this->lib = $lib;
        $this->pdo = $pdo;
    }

    public function __get_active_employees() {
        $result = $this->pdo->row("SELECT COUNT(empId) AS result FROM employees WHERE empRecStatus='active'");
        return $result['result'];
    }

    public function __get_active_departments() {
        $result = $this->pdo->row("SELECT COUNT(deptId) AS result FROM departments WHERE `status`='active';");
        return $result['result'];
    }

    public function __emp_get_type_balance($empId,$__action_for) {
        

        $this->pdo->bind("empId", $empId);
        $this->pdo->bind("type", $__action_for);
        $this->pdo->bind("typStatus", 'active');
        $this->pdo->bind("rt_type", $__action_for);
        $this->pdo->bind("rt_status", 'active');

        return $this->pdo->query("SELECT eb.*,rt.*
                                 FROM employee_balances AS eb
                                 LEFT JOIN request_types AS  rt ON (rt.id =eb.typId AND rt.type=:type)
                                 WHERE eb.empId =:empId AND eb.typStatus=:typStatus AND rt.type=:rt_type AND rt.status=:rt_status  ORDER BY rt.id ASC ");
    }

}
