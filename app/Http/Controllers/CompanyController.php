<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Admin\Repositories\Interfaces\MerchantInterface;
use Admin\Http\Requests\CompanyRequest;
use Admin\Repositories\Interfaces\CompanyInterface;

class CompanyController extends Controller
{
	/**
     * @var MerchantInterface
     */
    protected $merchant;

	/**
     * Create a new controller instance.
     *
     * @param MerchantInterface $merchant

     * @return void
     */
    public function __construct(MerchantInterface $merchant)
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

            return redirect('merchants/'.$id.'/edit')->with('message', 'Successfully updated.');
        }

        return redirect('merchants/'.$id.'/edit')->withInput();
    }
}
