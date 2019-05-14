<?php

namespace App\Components;

class Sql
{

    private $sql = '';
    public function select($table, $columns = [], $order_by = [], $limit_offset = [])
    {
        $_columns = '*';
        if (count($columns)) {
            $_columns = implode($columns, ", ");
        }
        $this->sql = "SELECT $_columns FROM $table";
        $this->orderBy($order_by);
        $this->limit($limit_offset);

        return $this->sql;
    }

    public function limit($limit_offset = [])
    {
        $limit = "LIMIT ALL";
        $offset = "";
        if (empty($limit_offset)) {
            return;
        }
        if (!empty($limit_offset[0]) && is_numeric($limit_offset[0]) && $limit_offset[0]) {
            $limit = "LIMIT {$limit_offset[0]}";
        }
        if (!empty($limit_offset[1]) && is_numeric($limit_offset[1]) && $limit_offset[1]) {
            $offset = " OFFSET {$limit_offset[1]}";
        }
        $this->sql .= " $limit$offset";
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
