<?php
namespace App\Controllers;

use App\Models\User; 
use App\Controllers\Controller;

class UserController extends Controller
{

    protected User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * @return string
     */
    public function read(...$params): string
    {
        try {
            return parent::output(
                $this->user->read($params)
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
                $this->user->create($params)
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
                $this->user->update($params)
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
                $this->user->delete($params)
            , 200);
        } catch (\Throwable $t) {
            return response()->json(['message' => $t->getMessage()], 500);
        }
    }

}
