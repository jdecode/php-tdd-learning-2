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
            'SELECT * FROM products',
            $sql->select('products')
        );
    }

    public function testSelectSpecificColumns()
    {
        $sql = new Sql();
        $this->assertEquals(
            'SELECT id, name FROM products',
            $sql->select('products', ['id', 'name'])
        );
    }

    public function testSelectWithOrderBySingleColumn()
    {
        $sql = new Sql();
        $this->assertEquals(
            'SELECT id, name FROM products ORDER BY id DESC',
            $sql->select('products', ['id', 'name'], [['id', 'desc']])
        );
    }

    public function testSelectWithOrderByMultipleColumn()
    {
        $sql = new Sql();
        $this->assertEquals(
            'SELECT id, name FROM products ORDER BY id DESC, name ASC',
            $sql->select('products', ['id', 'name'], [['id', 'desc'], ['name', 'asc']])
        );
    }

    public function testSelectWithCapitalizedKeywords()
    {
        $sql = new Sql();
        $this->assertEquals(
            'SELECT id, name FROM products ORDER BY id DESC',
            $sql->select('products', ['id', 'name'], [['id', 'desc']])
        );
    }
}