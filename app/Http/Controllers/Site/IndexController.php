<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCompanyFormRequest;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use Session;


class IndexController extends Controller
{
    private $repository;


    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        if (request()->getHost() != config('tenant.domain_main')) {
            return redirect()->route('home');
        }

        return view('site.index');
    }

    public function showRegister()
    {
        return view('site.register');
    }

    public function register(StoreUpdateCompanyFormRequest $request)
    {
        $company = $this->repository->create($request->all());

        if (!$company) {
            //return redirect()->route('/');
            return redirect()->route('index');
        }

        return view('congratulations', compact('company'));
    }


   }
