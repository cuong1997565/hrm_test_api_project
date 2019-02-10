<?php

namespace Tests\Feature\Api\RestFulls;

use TestCase;
// use Traits\JWTAuth;
use Laravel\Lumen\Testing\DatabaseMigrations;

abstract class RestFull extends TestCase
{
    use DatabaseMigrations;
    /**
     * number row to test
     * @var [type]
     */
    protected $initDataNumber = 10;

    /**
     * data store not valid
     * @return array
     */
    abstract public function storeOrUpdateFailedDataProvider();

     /**
      * data update not valid
      * @return array
      */
    // abstract public function updateFailedDataProvider();

     /**
      *  data update status
    */
    // abstract public function updateStatusProvider();

    /**
     * create data for test by model factory & initDataNumber
     * @author KingDarkness <nguyentranhoan13@gmail.com>
     * @date   2018-10-16
     * @return [type]     [description]
     */
    public function setUp()
    {
        parent::setUp();

        $this->generateTestData();
            // $this->authWithSupperAdmin();
    }

    protected function generateTestData()
    {
        factory($this->model, $this->initDataNumber)->create();
        // factory($this->model)->create($this->seeder);

        factory($this->model)->create(['status' => 0]);
    }

    // public function failedResponse($errors){
    //     return [
    //         'code',
    //         'status',
    //         'data'  => [
    //             'errors' => $errors
    //         ],
    //         'message'
    //     ];
    // }

    //  public function failedResponses(){
    //      return [
    //         'code',
    //         'status',
    //         'data',
    //         'message'
    //      ];
    //  }

    // public function deleteResponse(){
    //     return [
    //     'code',
    //     'status',
    //     'data',
    //     'message'
    //     ];
    // }

    // public function successResponse($meta = true)
    // {
    //     if ($meta) {
    //         return [
    //         'code',
    //         'status',
    //         'data'  => [
    //         $this->transform
    //         ],
    //         'meta'  => [
    //         'pagination'
    //         ]
    //         ];
    //     } else {
    //         return [
    //         'code',
    //         'status',
    //         'data'  => $this->transform
    //         ];
    //     }
    // }
    // /**
    //  * Listting api with pagination
    //  * should return 200
    //  */
    // public function testListting()
    // {
    //     $this->json('GET', $this->endpoint)
    //     ->seeStatusCode(200)
    //     ->seeJsonStructure($this->successResponse());
    //     $this->assertCount(12, $this->response->getData()->data);
    //     //positon
    //     //$this->assertCount(12, $this->response->getData()->data);
    // }

    // /**
    //  * Listting api not pagination
    //  * should return 200
    // */
    // public function testListtingWithUnLimit(){
    //     $params = [
    //     'limit' => -1
    //     ];
    //     $this->json('GET', $this->endpoint . '?' . http_build_query($params))
    //     ->seeStatusCode(200)
    //     ->seeJsonStructure([
    //         'code',
    //         'status',
    //         'data' => [$this->transform]
    //         ]);
    //     $this->assertCount(\DB::table($this->table)->count(), $this->response->getData()->data);
    // }

    // /**
    //  * Listting api return none object
    //  * should return 200
    // */
    // public function testListtingSingle(){
    //     $params = [
    //     'limit' => 0
    //     ];

    //     $this->json('GET', $this->endpoint . '?' . http_build_query($params) , [])
    //     ->seeStatusCode(200)
    //     ->seeJsonStructure([
    //         'code',
    //         'status',
    //         'data'  => $this->transform
    //         ]);
    //     $this->assertEquals(1, count($this->response->getData()));
    // }


     /**
     * show api not found
     * should return 404
     */
    //  public function testShowNotFound(){
    //     $idNotFound = \DB::table($this->table)->count() + 1;
    //     $this->json('GET', $this->endpoint . '/' . $idNotFound)
    //     ->seeStatusCode(404)
    //     ->successResponse($this->failedResponses());
    //     $this->assertEquals(1, count($this->response->getData()->data));
    // }

    // /**
    //  * show api found
    //  * should return 200
    // */
    // public function testShowSuccess()
    // {
    //     $this->json('GET', $this->endpoint . '/1')
    //     ->seeStatusCode(200)
    //     ->seeJsonStructure($this->successResponse(false));
    //     $this->assertEquals(1, $this->response->getData()->data->id);
    // }

    /**
     * test store not valid data
     * should return 422
     *  @dataProvider storeOrUpdateFailedDataProvider
    */
    // public function testStoreFailed($data, $errors){
    //     $this->json('POST', $this->endpoint, $data)
    //     ->seeStatusCode(422)
    //     ->seeJsonStructure($this->failedResponse($errors));

    // }
    /**
     * store sucess
     * should return 200
    */

    // public function testStoreSucces(){
    //     $this->json('POST', $this->endpoint, $this->seederObject)
    //     ->seeStatusCode(200)
    //     ->seeJsonStructure($this->successResponse(false));
    // }
     /**
     * update not valid data
     * should return 422
     * @dataProvider storeOrUpdateFailedDataProvider
     */

    //  public function testUpdateFailed($data, $errors){
    //     $this->json('PUT', $this->endpoint . '/1', $data)
    //     ->seeStatusCode(422)
    //     ->seeJsonStructure($this->failedResponse($errors));
    // }

    /**
     * update not found
     * should return 404
     */
    // public function testUpdateNotFound(){
    //     $idNotFound = \DB::table($this->table)->count() + 1;
    //     $this->json('PUT', $this->endpoint . '/' . $idNotFound , $this->seederObject)
    //     ->seeStatusCode(404)
    //     ->seeJsonStructure($this->failedResponses());
    // }
    // // /**
    // //  * update success
    // //  * should return 200
    // //  */
    // public function testUpdateSuccess(){
    //     $this->json('PUT', $this->endpoint . '/1' , $this->seederUpdate)
    //     ->seeStatusCode(200)
    //     ->seeJsonStructure($this->successResponse(false));
    //     $success_data = array_merge(['id' => 1], $this->seederUpdate);
    //     $this->seeInDatabase($this->table, $success_data);

    // }
    //

     /**
     * delete not found
     * should return 404
     */
    //  public function testDeleteNotFound(){
    //     $idNotFound = \DB::table($this->table)->count() + 1;
    //     $this->json('DELETE', $this->endpoint. '/' . $idNotFound)
    //     ->seeStatusCode(404)
    //     ->seeJsonStructure($this->deleteResponse());
    // }


    // public function testDeleteSuccess(){
    //     $this->json('DELETE', $this->endpoint. '/1')
    //     ->seeStatusCode(200)
    //     ->seeJsonStructure($this->deleteResponse());

    //     // $this->notSeeInDatabase($this->table, [
    //     //     'id' => 1
    //     //     ]);
    // }



}
