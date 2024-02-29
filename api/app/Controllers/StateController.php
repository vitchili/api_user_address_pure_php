<?php
namespace App\Controllers;

use App\Models\State; 
use App\Controllers\Controller;

class StateController extends Controller
{

    protected State $state;

    public function __construct()
    {
        $this->state = new State();
    }

    /**
     * @return string
     */
    public function read(...$params): string
    {
        try {
            return parent::output(
                $this->state->read($params)
            , 200);
        } catch (\Throwable $t) {
            return json_encode(['message' => $t->getMessage()]);
        }
    }

}
