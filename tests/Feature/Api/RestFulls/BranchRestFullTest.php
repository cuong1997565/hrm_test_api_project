<?php

namespace Tests\Feature\Api\RestFulls;
use App\Repositories\Branches\Branch;
use App\Repositories\Branches\BranchRepository;
use Illuminate\Http\UploadedFile;
class BranchRestFullTest extends RestFull
{
    protected $endpoint = '/api/branches';
    protected $model    = \App\Repositories\Branches\Branch::class;
    protected $table = 'branches';
    protected $transform = [
        'name',
        'description',
        'about',
        'phone',
        'address',
        'website',
        'email',
        'facebook',
        'instagram',
        'zalo',
        'tax_number',
        'bank',
        'type',
        'city_id',
        'district_id',
        'status'
    ];

      protected $seederObject = [
      "name" => " 1234",
      "description" => "sadasdasd",
      "about" => "WOULasdasdasd",
      "phone" => "0915817423",
      "address" => "76702 Blanda Camp Apt. 822\nSouth Gladys, OR 68520-1730",
      "website" => "http:\/\/www.zieme.com\/tempora-error-numquam-repelle",
      "email" => "nayeli.jones@miller.org",
      "facebook" => "facebook.com/Weber-Williamson",
      "instagram" => "Cartwright, McCullough and Halvorson",
      "zalo" => "Lesch-Frami",
      "tax_number" => "02951522",
      "bank" => "Connelly, Lehner and Harber",
      "type" => 1,
      "city_id" => 2,
      "district_id" => 4,
      "status" => 0,
    ];

    protected $seeder = [
      "name"  => "Gulgowski, Carter and Grimes",
      "description" => "March Hare. 'It was the Hatter. 'I told you butter.",
      "about" => "Alice. 'Oh, don't talk about cats or dogs either, if you like!'",
      "phone" => "0215798083",
      "address" => "56316 Welch Plains Suite 514\nEast Corrinestad, FL 90864",
      "website" => "http:www.fahey.com\/voluptatum-eligendi-sunt-cons",
      "email" => "cuong1997@gmail.com",
      "facebook" => "facebook.com/Brown",
      "instagram" => "Yundt-Wisozk",
      "zalo" => "Barrows, Kunze and Schmidt",
      "tax_number" => "72907542",
      "bank" => "Nolan-Glover",
      "type" => 0,
      "city_id" => 2,
      "district_id" => 4,
      "status" => 0
    ];

    protected $seederUpdate = [
       "name"  => "Gulgowski, Carter and Grimes 1234567",
      "description" => "March Hare. 'It was the Hatter. 'I told you butter123.",
      "about" => "Alice.12 'Oh, don't talk about cats or dogs either, if you like!'",
      "phone" => "0215798000",
      "address" => "56316 Welch Plains Suite 514\nEast Corrinestad, FL 90864",
      "website" => "http:www.fahey.com\/voluptatum-eligendi-sunt-cons",
      "email" => "cuong19971234@gmail.com",
      "facebook" => "facebook.com/Brown",
      "instagram" => "Yundt-Wisozk",
      "zalo" => "Barrows, Kunze and Schmidt",
      "tax_number" => "72907212",
      "bank" => "Nolan-Glover",
      "type" => 0,
      "city_id" => 2,
      "district_id" => 4,
      "status" => 1
    ];


    public function storeOrUpdateFailedDataProvider(){
        return [
            [
                [
                    'type'      => 3
                ],
                [
                    'type'
                ]
            ],
            [
              [
                'name'          => '',
                'address'       => '',
                'phone'         => '',
                'tax_number'    => '',
                'email'         => ''
              ],
              [
                'name',
                'address',
                'tax_number',
                'email'
              ]
            ],
            [
              [
                'email'         => $this->seeder['email'],
                'phone'         => $this->seeder['phone']
              ],
              [
                'email',
                'phone'
              ]
            ],
            [
              [
                'email'         =>  ''
              ],
              [
                'email'
              ]
            ],

        ];
    }


    public function updateStatusProvider()
    {
        return [
            [
                'id' => 5
            ],
            [
                'id' => 6
            ]
        ];
    }

    public function updateChangeBranchMainProvider()
    {
        return [
           [
                'id' => 12
            ],
            [
                'id' => 2
            ],
            [
                'id'  => 13
            ]
        ];
    }

    public function updateImageProvider(){
        return [
           [
            [
                'name' => 'cuong.png'
            ],
            [
                'page' => 2
            ]
           ]

        ];

    }

    /**
     * test store not valid data
     * should return 422
     *  @dataProvider updateStatusProvider
    */
     public function testChangeStatus($id)
     {
        $this->json('PUT', $this->endpoint . '/change-status/' . $id)
               ->seeStatusCode(200)
               ->seeJsonStructure($this->successResponse(false));
        if($this->response->getData()->data->id == 5)
        {
            $this->assertEquals(1 , count($this->response->getData()));
        }
        if($this->response->getData()->data->id == 6)
        {
            $this->assertEquals(1 , count($this->response->getData()));
        }
     }

    public function testChangeStatusFound()
    {
          $idNotFound = \DB::table($this->table)->count()+1;
          $this->json('PUT', $this->endpoint .'/change-status/'. $idNotFound)
               ->seeStatusCode(404)
               ->seeJsonStructure($this->failedResponses());
    }

    /**
     * test store not valid data
     * should return 422
     *  @dataProvider updateChangeBranchMainProvider
    */
    public function testChangeBranchMainSuccess($id)
    {
      factory($this->model)->create(['type' => 1]);
        $this->json('PUT', $this->endpoint . '/change-branch-main/' . $id)
             ->seeStatusCode(200)
             ->seeJsonStructure($this->successResponse(false));
      // dd(\DB::table('branches')->select('id','name','type')->get());
        $this->assertEquals(1, count($this->response->getData()));

    }

    public function testChangeBranchMainFound()
    {
      $idNotFound = \DB::table($this->table)->count()+1;
      $this->json('PUT', $this->endpoint . '/change-branch-main/' . $idNotFound)
           ->seeStatusCode(404)
           ->seeJsonStructure($this->failedResponses());
    }

    public function testUpdateBranchMainOld()
    {
      factory($this->model)->create(['type' => 1]);
        parent::testStoreSucces();
        $data = \DB::table($this->table)->where('type' , Branch::MAIN)->get()->count();
        $this->assertEquals(1 , $data);
    }

}
