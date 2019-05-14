<?php

namespace App\Components;

class Sql
{

    private $sql = '';
    public function select($table, $columns = [], $order_by = [], $limit_offset = [], $agg_data = [], $group_by = [])
    {
        $this->sql = "SELECT " . $this->getColumns($columns, $agg_data) . " FROM $table";
        $this->groupBy($group_by);
        $this->orderBy($order_by);
        $this->limit($limit_offset);

        return $this->sql;
    }

    public function getColumns($columns, $agg_data)
    {
        $_columns = '*';
        if (count($columns)) {
            $_columns = implode($columns, ", ");
        }
        if (!empty($agg_data) && isset($agg_data[0]) && isset($agg_data[1])) {
            $_columns = strtoupper($agg_data[0])."(\"{$agg_data[1]}\")";
        }
        if (isset($agg_data[2])) {
            $_columns = "*, $_columns";
        }
        return $_columns;
    }

    public function groupBy($group_by = [])
    {
        $_group_by = "";
        if (!empty($group_by)) {
            $_group_by = implode(", ", $group_by);
            $this->sql .= " GROUP BY $_group_by";
        }
    }

    public function limit($limit_offset = [])
    {
        $limit = "";
        $offset = "";
        if (empty($limit_offset)) {
            return;
        }
        if (isset($limit_offset[0]) || isset($limit_offset[1])) {
            $limit = "LIMIT ALL";
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
