<?php

namespace Admin\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Admin\Http\Requests\AdminRequest;
use Admin\Repositories\Interfaces\CuisineInterface;
use Admin\Repositories\Interfaces\MerchantInterface;
use Admin\Repositories\Interfaces\OutletInterface;
use Admin\Repositories\Interfaces\RestaurantCuisineInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Repositories\Interfaces\SnapShotInterface;

class MerchantController extends Controller
{
    /**
     * @var MerchantInterface
     */
    protected $merchant;

    /**
     * @var RestaurantInterface
     */
    protected $restaurant;

    /**
     * @var RestaurantCuisineInterface
     */
    protected $restaurantCuisine;

    /**
     * @var SnapshotInterface
     */
    protected $snapshot;

    /**
     * @var OutletInterface
     */
    protected $outlet;

    /**
     * @var CuisineInterface
     */
    protected $cuisine;

    /**
     * Create a new controller instance.
     *
     * @param MerchantInterface $merchant
     * @param RestaurantInterface $restaurant
     * @param RestaurantCuisineInterface $restaurantCuisine
     * @param OutletInterface $outlet
     * @param CuisineInterface $cuisine
     * @return void
     */
    public function __construct(
        MerchantInterface $merchant,
        RestaurantInterface $restaurant,
        RestaurantCuisineInterface $restaurantCuisine,
        SnapshotInterface $snapshot,
        OutletInterface $outlet,
        CuisineInterface $cuisine
    ) {
        $this->merchant = $merchant;
        $this->restaurant = $restaurant;
        $this->restaurantCuisine = $restaurantCuisine;
        $this->snapshot = $snapshot;
        $this->outlet = $outlet;
        $this->cuisine = $cuisine;
    }

    /**
     * Display merchant profile page.
     *
     * @return View
     */
    public function index()
    {
        $data = array(
            'merchants' => $this->merchant->getAll(true),
            'total_merchants' => $this->merchant->getTotalCount(),
            'total_last_thirty_days' => $this->merchant->getTotalMonth(),
            'total_live_merchants' => $this->merchant->getCount(),
            'total_pending_admin_approval_merchants' => $this->merchant->getCount(0),
            'total_approved_merchants' => $this->merchant->getCount(1),
            'total_blocked_merchants' => $this->merchant->getCount(2),
            'total_pending_email_verification' => $this->merchant->getCount(3),
            
        );/*echo "<pre>";
        print_r($data['merchants']);die;*/
        return view('merchants.index', $data);
    }

    /**
     * Create a new merchant.
     *
     * @param AdminRequest $request
     * @return Redirect
     */
    public function store(AdminRequest $request)
    {
        $request->merge(array('email' => $request->email, 'password' => bcrypt($request->password)));

        if ($merchant = $this->merchant->create($request->all())) {

            Auth::loginUsingId($merchant->id);

            return redirect('dashboard')
                ->with('message', 'Account successfully created.');
        }

        return redirect('register')
            ->withInput()
            ->withErrors(true);
    }

    /**
     * Edit a merchant.
     *
     * @param integer $id
     * @param AdminRequest $request
     * @return Redirect
     */
    public function update($id, AdminRequest $request)
    {
        $request_new = $request->except(['password', 'password_confirmation']);

        if ($request->password != "") {
            $request->merge(['password' => bcrypt($request->password)]);
            $request_new = $request->all();
        }

        if ($merchant = $this->merchant->updateById($id, $request_new)) {

            return redirect('merchant-profile')->with('message', 'Successfully updated.');
        }

        return redirect('merchant-profile')->withInput();
    }
}
