<?php

$routes = [
    'GET /readUser' => 'UserController@read',
    'POST /createUser' => 'UserController@create',
    'PUT /updateUser' => 'UserController@update',
    'DELETE /deleteUser' => 'UserController@delete',

    'GET /readAddress' => 'AddressController@read',
    'POST /createAddress' => 'AddressController@create',
    'PUT /updateAddress' => 'AddressController@update',
    'DELETE /deleteAddress' => 'AddressController@delete',

    'GET /readCity' => 'CityController@read',
    'GET /readState' => 'StateController@read',    
];

$request = $_SERVER['REQUEST_URI'];
$verb = $_SERVER['REQUEST_METHOD'];

foreach ($routes as $route => $controllerAction) {
    list($verb, $routePattern) = explode(' ', $route);
    $hostRoute = explode('?', $request);

    if ($routePattern === $request || ($routePattern !== $request) && $routePattern === $hostRoute[0]) {
        if ($routePattern === $request) {
            $pattern = preg_replace('/\/{\w+}/', '/(\w+)', $routePattern);
            $pattern = str_replace('/', '\/', $pattern);
        }

        if (($routePattern !== $request) && $routePattern === $hostRoute[0]) {
            $pattern = preg_replace('/\/{\w+}/', '/(\w+)', $routePattern);
            $pattern .= '(\?.*)?';
            $pattern = str_replace('/', '\/', $pattern);
        }
        
        if (preg_match('/^' . $pattern . '$/', $request, $matches)) {
            $queryString = array_slice($matches, 1);
            $queryString = str_replace('?', '', $queryString);
            
            $params = [];
            if (is_array($queryString) && count($queryString) > 0) {
                parse_str($queryString[0], $params);   
            }

            list($controller, $action) = explode('@', $controllerAction);
            
            $className = "App\\Controllers\\" . $controller;
            $controllerInstance = new $className();
            
            if ($verb === 'POST' || $verb === 'PUT' || $verb === 'DELETE') {
                $params = $_POST;
            } 

            echo json_encode($controllerInstance->$action(...$params));
            exit();
        }
    }
}

http_response_code(404);
echo json_encode(['error' => 'Rota não encontrada']);
