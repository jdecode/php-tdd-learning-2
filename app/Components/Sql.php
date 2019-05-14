<?php

namespace App\Components;

class Sql
{

    private $sql = '';
    public function select($table, $columns = [], $order_by = [], $limit = [])
    {
        $_columns = '*';
        if (count($columns)) {
            $_columns = implode($columns, ", ");
        }
        $this->sql = "SELECT $_columns FROM $table";
        $this->orderBy($order_by);
        $this->limit($limit);

        return $this->sql;
    }

    public function limit($limit = [])
    {
        if (empty($limit)) {
            return;
        }
        $this->sql .= " LIMIT {$limit[0]}";
    }

    public function orderBy($order_by = [])
    {

        if (!empty($order_by)) {
            $first_order_by = true;
            foreach ($order_by as $column) {
                if ($first_order_by) {
                    $first_order_by = false;
                    $this->sql .= " ORDER BY {$column[0]} ".strtoupper($column[1]);
                    continue;
                }
                if (!$first_order_by) {
                    $this->sql .= ", {$column[0]} ".strtoupper($column[1]);
                }
            }
        }
    }
}
