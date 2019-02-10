<?php

namespace Tests\Unit\Model;

use TestCase;
use Illuminate\Support\Facades\Schema;
use Laravel\Lumen\Testing\DatabaseMigrations;

abstract class Model extends TestCase
{
    use DatabaseMigrations;

    /**
     * table
     * @var string
     */
    protected $table;
    /**
     * table
     * @var array
     */
    protected $columns;
    /**
     * Check the existence of the table
    */
    public function testHasTable()
    {
        $this->assertTrue(Schema::hasTable($this->table));
    }

    /**
     * Check existing columns of the table
    */
    // public function testHasColum(){
    //     $real_colums = Schema::getColumnListing($this->table);
    //     $this->assertEquals(0, count(array_diff($this->columns, $real_colums)));
    //     // $this->assertEquals(4, count(array_diff($real_colums, $this->columns)));
    // }



}
