<?php
namespace App\Controllers;

use App\Models\City; 
use App\Controllers\Controller;

class CityController extends Controller
{

    protected City $city;

    public function __construct()
    {
        $this->city = new City();
    }

    /**
     * @return string
     */
    public function read(...$params): string
    {
        try {
            return parent::output(
                $this->city->read($params)
            , 200);
        } catch (\Throwable $t) {
            return json_encode(['message' => $t->getMessage()]);
        }
    }

}
