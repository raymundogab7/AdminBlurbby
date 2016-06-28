<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Admin\Http\Requests\OutletRequest;
use Admin\Repositories\Interfaces\OutletInterface;
use Auth;
use Admin\Repositories\Interfaces\RestaurantInterface;

class OutletController extends Controller
{
    /**
     * @var OutletInterface
     */
    protected $outlet;

    /**
     * @var RestaurantInterface
     */
    protected $restaurant;

    /**
     * Create a new controller instance.
     *
     * @param OutletInterface $outlet

     * @return void
     */
    public function __construct(OutletInterface $outlet, RestaurantInterface $restaurant)
    {
        $this->outlet = $outlet;
        $this->restaurant = $restaurant;
    }

    /**
     * Edit an merchant profile outlet.
     *
     * @param Outlet $request
     * @return Redirect
     */
    public function create()
    {
        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false);

        return view('outlets.create', $data);
    }

    /**
     * Create an merchant profile outlet.
     *
     * @param Outlet $request
     * @return Redirect
     */
    public function store(OutletRequest $request)
    {
        $request->merge(array('merchant_id' => \Auth::user()->id, 'outlet_no' => uniqid()));

        if ($this->outlet->create($request->all())) {

            return redirect('outlets/create')->with('message', 'Successfully created.');
        }

        return redirect('outlets/create')->withInput();
    }

    /**
     * Display edit outlet page.
     *
     * @param integer $id
     * @return View
     */
    public function edit($id)
    {
        $data['outlet'] = $this->outlet->getById($id);
        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false);
        
        return view('outlets.edit', $data);
    }

    /**
     * Edit an merchant profile outlet.
     *
     * @param integer $id
     * @param Outlet $request
     * @return Redirect
     */
    public function update($id, OutletRequest $request)
    {
        if ($this->outlet->updateById($id, $request->all())) {

            return back()->with('message', 'Successfully updated.');
        }

        return back()->withInput();
    }

    /**
     * Delete an merchant profile outlet.
     *
     * @param integer $id
     * @return Redirect
     */
    public function destroy($id)
    {
        if ($this->outlet->delete($id)) {

            return redirect('merchant-profile')->with('message', 'Successfully deleted.');
        }

        return redirect('merchant-profile')->with('message', 'Error while deleting.');
    }

    /**
     * Generate random string
     *
     * @return Redirect
     */
    private function _generateRandomString($length = 10)
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 5, $length);
    }
}
