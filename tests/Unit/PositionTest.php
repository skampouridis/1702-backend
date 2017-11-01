<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Position;

class PositionTest extends TestCase
{

    /**
     * Test custom sql table is correct
     *
     * @covers \App\Models\Position::getTable
     */
    public function test_get_mysql_table_custom()
    {
        $item = new Position;

        $this->assertSame($item->getTable(), 'vessel_positions');
    }

    /**
     * Test method getTableFields
     *
     * @covers \App\Models\Position::getTableFields
     */
    public function test_get_table_fields()
    {
        $fields = Position::getTableFields();

        $this->assertTrue(count($fields) === 9);
    }

    /**
     * Test method normalizeItem
     *
     * @covers \App\Models\Position::normalizeItem
     */
    public function test_normalize_item()
    {
        $item = Position::first();
        Position::normalizeItem($item);

        $this->assertTrue(get_class($item) === 'App\Models\Position');
        $this->assertTrue(count($item->getOriginal()) === 9);
        // test more xtra fields... if needed e.g. $item->xtra_admin_url
    }

    /**
     * Test method normalizeItem throw exception wrong type hint
     *
     * @covers \App\Models\Position::normalizeItem
     */
    public function test_normalize_item_exception()
    {
        $item = new \stdClass();
        $item->mmsi = 'test';

        $this->expectException('ErrorException');
        $this->expectExceptionMessageRegExp('/stdClass/');

        Position::normalizeItem($item);
    }

}
