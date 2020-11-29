<?php

namespace App\Http\Controllers;

use App\Services\Contracts\UserServiceInterface;
use App\Http\Requests\User\{ BindRequest, UnbindRequest, VerifyRequest };

class UserController extends Controller
{
    /**
     * The service instance.
     *
     * @var \App\Services\UserServiceInterface
     */
    protected $services;
    
    /**
     * Create the controller instance and resolve its service.
     * 
     * @param \App\Services\Contracts\UserServiceInterface $services
     */
    public function __construct(UserServiceInterface $services)
    {
        $this->services = $services;
    }

    /**
     * Bind a specific key.
     *
     * @param  \App\Http\Requests\User\BindRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function bind(BindRequest $request)
    {
        return $this->services->bind($request->validated());
    }

    /**
     * Unbind a specific key.
     *
     * @param  \App\Http\Requests\User\UnbindRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function unbind(UnbindRequest $request)
    {
        return $this->services->unbind($request->validated());
    }

    /**
     * Verify a user key.
     *
     * @param  \App\Http\Requests\User\VerifyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(VerifyRequest $request)
    {
        return $this->services->verify($request->validated());
    }
}
