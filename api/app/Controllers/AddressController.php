<?php
namespace App\Controllers;

use App\Models\Address; 
use App\Controllers\Controller;

class AddressController extends Controller
{

    protected Address $address;

    public function __construct()
    {
        $this->address = new Address();
    }

    /**
     * @return string
     */
    public function read(...$params): string
    {
        try {
            return parent::output(
                $this->address->read($params)
            , 200);
        } catch (\Throwable $t) {
            return json_encode(['message' => $t->getMessage()]);
        }
    }

    /**
     * @return string
     */
    public function create(...$params): string
    {
        try {
            return parent::output(
                $this->address->create($params)
            , 201);
        } catch (\Throwable $t) {
            return response()->json(['message' => $t->getMessage()], 500);
        }
    }

    /**
     * @return string
     */
    public function update(...$params): string
    {
        try {
            return parent::output(
                $this->address->update($params)
            , 200);
        } catch (\Throwable $t) {
            return response()->json(['message' => $t->getMessage()], 500);
        }
    }

    /**
     * @return string
     */
    public function delete(...$params): string
    {
        try {
            return parent::output(
                $this->address->delete($params)
            , 200);
        } catch (\Throwable $t) {
            return response()->json(['message' => $t->getMessage()], 500);
        }
    }

}
