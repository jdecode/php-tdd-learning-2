<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class BuyerController extends Controller
{
    public function __construct()
    {
        $this->rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'firstName' => 'required',
            'lastName' => 'required',
        ];
    }

    public function save($attr = [])
    {
        $validation = \Validator::make($attr, $this->rules);
        if ($validation->fails()) {
            $err = $validation->messages();
            return $err->toArray();
        }
        return User::create($attr);
    }
}
