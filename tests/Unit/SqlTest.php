<?php

namespace Tests\Unit;

use App\Components\Sql;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SqlTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRun()
    {
        $this->assertTrue(true);
    }

    public function testSelectAllColumns()
    {
        $sql = new Sql();
        $this->assertEquals(
            'select * from products',
            $sql->select('products')
        );
    }

    public function testSelectSpecificColumns()
    {
        $sql = new Sql();
        $this->assertEquals(
            'select id, name from products',
            $sql->select('products', ['id', 'name'])
        );
    }

    public function testSelectWithOrderBySingleColumn()
    {
        $sql = new Sql();
        $this->assertEquals(
            'select id, name from products order by id desc',
            $sql->select('products', ['id', 'name'], [['id', 'desc']])
        );
    }

    public function testSelectWithOrderByMultipleColumn()
    {
        $sql = new Sql();
        $this->assertEquals(
            'select id, name from products order by id desc, name asc',
            $sql->select('products', ['id', 'name'], [['id', 'desc'], ['name', 'asc']])
        );
    }
}
