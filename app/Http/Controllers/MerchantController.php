<?php

namespace Admin\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Admin\Http\Requests\AdminRequest;
use Admin\Repositories\Interfaces\CuisineInterface;
use Admin\Repositories\Interfaces\AdminInterface;
use Admin\Repositories\Interfaces\OutletInterface;
use Admin\Repositories\Interfaces\RestaurantCuisineInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Repositories\Interfaces\SnapShotInterface;

class AdminController extends Controller
{
    /**
     * @var AdminInterface
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
     * @param AdminInterface $merchant
     * @param RestaurantInterface $restaurant
     * @param RestaurantCuisineInterface $restaurantCuisine
     * @param OutletInterface $outlet
     * @param CuisineInterface $cuisine
     * @return void
     */
    public function __construct(
        AdminInterface $merchant,
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
        $merchant_id = Auth::user()->id;

        $restaurant = $this->restaurant->getByAttributes(['merchant_id' => $merchant_id], false);

        $selected_cuisines = $this->restaurantCuisine->getByAttributesWithRelations(['restaurant_id' => $restaurant->id], ['cuisine'])->toArray();

        $cuisines_id = array_map(function ($structure) {

            return $structure['cuisine']['id'];

        }, $selected_cuisines);

        $data = array(
            'merchant' => $this->merchant->getById($merchant_id),
            'restaurant' => $restaurant,
            'snapshot' => $this->snapshot->getByAttributes(['merchant_id' => $merchant_id]),
            'outlet' => $this->outlet->getByAttributes(['merchant_id' => $merchant_id, 'main' => 1], false),
            'outlets' => $this->outlet->getByAttributes(['merchant_id' => $merchant_id, 'main' => 0]),
            'restaurant_cuisine' => $selected_cuisines,
            'cuisines' => $this->cuisine->getAll(),
            'cuisines_id' => $cuisines_id,
        );

        return view('merchant.profile', $data);
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
