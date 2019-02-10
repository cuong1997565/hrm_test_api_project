<?php

namespace Tests\Feature\Api\Filter;

use TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;

abstract class Filter extends TestCase {
    use DatabaseMigrations;

    /**
     * url endpoint
     * @var [type]
     */
    protected $endpoint;
    /**
     * model class
     * @var string
    */
    protected $model;
    /**f
     * seeder data insert, update, show
     * @var array
    */
    protected $seederObject;
    /**
     * data transform
     * @var array
    */
    protected $transform;
    /**
     * data filter search
     * @return array
    */
    abstract public function listtingFilterSearchProvider();
    /**
     * data filter not is search
     * @return array
    */
    abstract public function listtingFilterNotIsSreachProvider();

    public function generateTestData(){
      factory($this->model, 20)->create();
      factory($this->model)->create($this->seederObject);
    }

     public function setUp()
    {
        parent::setUp();
        $this->generateTestData();
    }

    /**
     *@dataProvider listtingFilterSearchProvider
     * @return [type] [description]
     */
    public function testListtingFilterSearch($q)
    {
        $this->json('GET', $this->endpoint . '?' . http_build_query($q))
             ->seeStatusCode(200)
             ->seeJsonStructure([
                'code',
                'status',
                'data'   =>  [$this->transform],
                'meta'   =>  [
                    'pagination'
                ]
        ]);
    }

    /**
     * @dataProvider listtingFilterNotIsSreachProvider
     * screach limit -1
     * @return [type]
     */
    public function testListtingFilterSearchCanLimitOne($q , $limit){
        $param = http_build_query($q) . '&' . http_build_query($limit);

        $this->json('GET', $this->endpoint . '?' . $param)
             ->seeStatusCode(200)
             ->seeJsonStructure([
                'code',
                'status',
                'data'   =>  [],
        ]);
        if($limit['limit'] == -1){
            if($q['q'] == 'asdasdasdasdasd'){
                $this->assertEquals(1, count($this->response->getData()));
            } else if($q['q'] == ''){
                $this->assertEquals(21, count($this->response->getData()->data));
            } else if($q['q'] == 'An Giang'){
                $this->assertEquals(1, count($this->response->getData()->data));
            }
        }
    }

    /**
     * @dataProvider listtingFilterNotIsSreachProvider
     * screach limit 0
     * @return [type]
     */
    public function testListtingFilterSearchCanLimitZero($q , $limit){
        $param = http_build_query($q) . '&' . http_build_query($limit);

        $this->json('GET', $this->endpoint . '?' . $param)
             ->seeStatusCode(200)
             ->seeJsonStructure([
                'code',
                'status',
                'data'   =>  []
        ]);
        if($limit['limit'] == 0){
            if($q['q'] == 'asdasdasdasdasd'){
                $this->assertEquals(1, count($this->response->getData()));
            } else if($q['q'] == ''){
                $this->assertEquals(1, count($this->response->getData()->data));
            } else if($q['q'] == 'An Giang'){
                $this->assertEquals(1, count($this->response->getData()->data));
            }
        }
    }
}