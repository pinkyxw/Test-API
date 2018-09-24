<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User
{
    public function create($user){

        $client = new \Guzzle\Service\Client('http://5b8eb3cbeb676700148a4c73.mockapi.io');
        $req = $client->post("users", array('content-type' => 'application/json'),array());
        $req->setBody(json_encode($user)); #set body!
        $response = $req->send();

        return json_decode((string) $response->getBody(), true);
    }

    public function readAll(){

        $client = new \Guzzle\Service\Client('http://5b8eb3cbeb676700148a4c73.mockapi.io');
        $response = $client->get("users")->send();

        return json_decode((string) $response->getBody(), true);
    }

    public function login($credentials){

        foreach (User::readAll() as $item) {

            if ($item['email'] == $credentials['email'] && password_verify($credentials['pass'], $item['pass']))
            {
                $token = Auth::SignIn([
                    'id' => $item['id'],
                    'email' => $item['email'],
                    'pass' => $item['pass'],
                    'name' => $item['name']
                ]); 
                
                return $token;
            }
        }
        return "nope";
    }


}
