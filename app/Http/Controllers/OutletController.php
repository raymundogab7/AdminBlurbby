<?php

namespace Admin\Http\Controllers;

use Admin\Http\Requests\OutletRequest;
use Admin\Repositories\Interfaces\OutletInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Illuminate\Http\Request;
use Admin\Services\LongLat;

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
    public function create($merchant_id)
    {
        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => $merchant_id], false);

        return view('outlets.create', $data);
    }

    /**
     * Create an merchant profile outlet.
     *
     * @param Outlet $request
     * @return Redirect
     */
    public function store(OutletRequest $request, LongLat $longLat)
    {
        $data = $longLat->get($request);
        
        if(empty($data)){
            return redirect('outlets/' . $request->merchant_id . '/create')->withInput()->with('error', 'Invalid address.');;
        }

        $request->merge(array('outlet_no' => uniqid(), 'longitude' => $data['longitude'], 'latitude'=>$data['latitude']));

        if ($this->outlet->create($request->all())) {

            return redirect('merchants/' . $request->merchant_id . '/edit')->with('message', 'Successfully created.');
        }

        return redirect('outlets/' . $request->merchant_id . '/create')->withInput();
    }

    /**
     * Display edit outlet page.
     *
     * @param integer $id
     * @return View
     */
    public function edit($id, $merchant_id)
    {
        $data['outlet'] = $this->outlet->getById($id);
        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => $merchant_id], false);

        return view('outlets.edit', $data);
    }

    /**
     * Edit an merchant profile outlet.
     *
     * @param integer $id
     * @param Outlet $request
     * @return Redirect
     */
    public function update($id, OutletRequest $request, LongLat $longLat)
    {
        $data = $longLat->get($request);
        
        $request->merge(array('longitude' => $data['longitude'], 'latitude'=>$data['latitude']));

        if(empty($data)){
            return back()->withInput()->with('error', 'Invalid address.');
        }

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

            return back()->with('message', 'Successfully deleted.');
        }

        return back()->with('message', 'Error while deleting.');
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
