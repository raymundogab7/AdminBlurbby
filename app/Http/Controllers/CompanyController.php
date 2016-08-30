<?php

namespace Admin\Http\Controllers;

use Admin\Http\Requests\CompanyRequest;
use Admin\Repositories\Interfaces\MerchantInterface;
use Illuminate\Http\Request;

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
        if (substr($request->coy_url, 0, 4) == 'http') {
            return redirect('merchants/' . $request->merchant_id . '/edit')->with('error', 'Please remove "http://" from your URL.');
        }

        $request->merge(['coy_phone' => '+65 ' . substr($request->coy_phone, 0, 4) . ' ' . substr($request->coy_phone, 4, 7)]);

        if ($this->merchant->updateById($id, $request->all())) {

            return redirect('merchants/' . $id . '/edit')->with('message', 'Successfully updated.');
        }

        return redirect('merchants/' . $id . '/edit')->withInput();
    }
}
