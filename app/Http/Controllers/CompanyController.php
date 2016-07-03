<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Admin\Repositories\Interfaces\AdminInterface;
use Admin\Http\Requests\CompanyRequest;
use Admin\Repositories\Interfaces\CompanyInterface;

class CompanyController extends Controller
{
	/**
     * @var AdminInterface
     */
    protected $merchant;

	/**
     * Create a new controller instance.
     *
     * @param AdminInterface $merchant

     * @return void
     */
    public function __construct(AdminInterface $merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * Edit a merchant profile company.
     *
     * @param integer $id
     * @param Company $request
     * @return Redirect
     */
    public function update($id, CompanyRequest $request)
    {
        if ($this->merchant->updateById($id, $request->all())) {

            return redirect('merchant-profile')->with('message', 'Successfully updated.');
        }

        return redirect('merchant-profile')->withInput();
    }
}