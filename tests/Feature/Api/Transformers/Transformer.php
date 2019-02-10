<?php

namespace Tests\Feature\Transformers;

use TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;

abstract class Transformer extends TestCase{
    use DatabaseMigrations;
    protected $object;
    /**
     * url endpoint
    */
   protected $endpoint;
   /**
    * model class
    * @var string
    */
   protected $model;
   /**
    * seeder data insert, update,show
    */
   protected $seederObject;
   /**
    * data transform
    * @var array
    */
    protected $transform;
    /**
     * params of testTransformisNull
    */
    protected $params_transform_is_null;

    /**
     * data relationship belongsTo
     * @return array
    */
   /**
    * create data for test by model factory
    */
    protected function geretateTestData(){
       $this->object  = factory($this->model)->create($this->seederObject);
    }

    public function setUp(){
       parent::setUp();
       $this->geretateTestData();
    }

   /**
    * Model is null
    * @return [type]
    */
    public function testTransformIsNull(){
      // dd($this->params_transform_is_null);
       $this->json('GET', $this->endpoint . '?' . http_build_query($this->params_transform_is_null), [])
              ->seeStatusCode(200)
              ->seeJsonStructure([
                'code',
                'data'  => []
            ]);
     }

     /**
     * test include of transformer
     * @dataProvider belongsToDataProvider
     * @param  [type] $info_factory     array           infomation array of the factories
     * @param  [type] $params           array           params query request
     * @param  [type] $transform_part   array           transform of model belongsTo
     */
     public function testTransformer($info_factory , $params, $transform_part){
        foreach ($info_factory as $key => $info) {
                 factory($info['class'], $info['init_data'])->create($info['value']);
        }
        $this->json('GET', $this->endpoint . '?' .http_build_query($params), [])
              ->seeStatusCode(200)
              ->seeJsonStructure([
                'code',
                'status',
                'data'  => [array_merge($this->transform, $transform_part)],
                'meta'  =>  [
                  'pagination'
                ]
              ]);
     }


}