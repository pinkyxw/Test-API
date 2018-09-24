<?php

namespace App\Http\Controllers;

use App\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function test(Request $request)
    {
    	$id = 1;

    	$client = new \Guzzle\Service\Client('http://5b8eb3cbeb676700148a4c73.mockapi.io');
    	$response = $client->get("users/$id")->send();
    	//dd($response);

      	return $response->getBody();
    }

    public function read(Request $request)
    {
    	//autentificacion
    	$token = $request->header('Authorization');
    	$user = Auth::GetData($token);

      	$id = $user->id;
      	$client = new \Guzzle\Service\Client('http://5b8eb3cbeb676700148a4c73.mockapi.io');
    	$response = $client->get("users/$id")->send();

      	return $response->getBody();
    }

    public function update(Request $request)
    {
    	//autentificacion
    	$token = $request->header('Authorization');
    	$user = Auth::GetData($token);

    	//update
    	$data = $request->only(['pass', 'name']);
    	$user->pass = bcrypt($data['pass']);
    	$user->name = $data['name'];

    	$id = $user->id;
    	$client = new \Guzzle\Service\Client('http://5b8eb3cbeb676700148a4c73.mockapi.io');
    	$req = $client->put("users/$id", array('content-type' => 'application/json'),array());
    	$req->setBody(json_encode($user)); #set body!
		$response = $req->send();

      	return $response->getBody();
    }

    public function delete(Request $request)
    {
    	//autentificacion
    	$token = $request->header('Authorization');
    	$user = Auth::GetData($token);

      	$id = $user->id;
      	$client = new \Guzzle\Service\Client('http://5b8eb3cbeb676700148a4c73.mockapi.io');
    	$response = $client->delete("users/$id")->send();

      	return $response->getBody();
    }
}
