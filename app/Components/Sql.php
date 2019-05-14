<?php

namespace App\Components;

class Sql
{

    private $sql = '';
    public function select($table, $columns = [], $order_by = [])
    {
        $_columns = '*';
        if (count($columns)) {
            $_columns = implode($columns, ", ");
        }
        $this->sql = "select $_columns from $table";
        $this->columnSetting($order_by);

        return $this->sql;
    }

    public function columnSetting($order_by)
    {

        if (!empty($order_by)) {
            $first_order_by = true;
            foreach ($order_by as $column) {
                if ($first_order_by) {
                    $first_order_by = false;
                    $this->sql .= " order by {$column[0]} {$column[1]}";
                    continue;
                }
                if (!$first_order_by) {
                    $this->sql .= ", {$column[0]} {$column[1]}";
                }
            }
        }
    }
}
