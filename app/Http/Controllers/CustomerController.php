<?php

namespace App\Http\Controllers;

use App\Services\Contracts\CustomerServiceInterface;
use App\Http\Requests\Customer\{ BindRequest, UnbindRequest, VerifyRequest, MeRequest, LoginRequest, ResetRequest };

class CustomerController extends Controller
{
    /**
     * The service instance.
     *
     * @var \App\Services\CustomerServiceInterface
     */
    protected $services;
    
    /**
     * Create the controller instance and resolve its service.
     * 
     * @param \App\Services\Contracts\CustomerServiceInterface $services
     */
    public function __construct(CustomerServiceInterface $services)
    {
        $this->services = $services;
    }

    /**
     * Bind a specific key.
     *
     * @param  \App\Http\Requests\Customer\BindRequest $request
     * @return \Illuminate\Http\Response
     */
    public function bind(BindRequest $request)
    {
        return $this->services->bind($request->validated());
    }

    /**
     * Unbind a specific key.
     *
     * @param  \App\Http\Requests\Customer\UnbindRequest $request
     * @return \Illuminate\Http\Response
     */
    public function unbind(UnbindRequest $request)
    {
        return $this->services->unbind($request->validated());
    }

    /**
     * Verify a specific key.
     *
     * @param  \App\Http\Requests\Customer\VerifyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function verify(VerifyRequest $request)
    {
        return $this->services->verify($request->validated());
    }

    /**
     * Return a customer info.
     *
     * @param  \App\Http\Requests\Customer\MeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function me(MeRequest $request)
    {
        return $this->services->me($request->validated());
    }

    /**
     * Login user.
     *
     * @param  \App\Http\Requests\Customer\LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        return $this->services->login($request->validated());
    }

    /**
     * Reset user.
     *
     * @param  \App\Http\Requests\Customer\ResetRequest $request
     * @return \Illuminate\Http\Response
     */
    public function reset(ResetRequest $request)
    {
        return $this->services->reset($request->validated());
    }
}
