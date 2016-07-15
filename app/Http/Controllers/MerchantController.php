<?php

namespace Admin\Http\Controllers;

use Admin\Http\Requests\MerchantRequest;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\CuisineInterface;
use Admin\Repositories\Interfaces\MerchantInterface;
use Admin\Repositories\Interfaces\OutletInterface;
use Admin\Repositories\Interfaces\RestaurantCuisineInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Repositories\Interfaces\SnapShotInterface;
use Admin\Services\GenerateReport;
use Admin\Merchant;
use Auth;
use Illuminate\Http\Request;
use Admin\Services\Mailer;
use Admin\Repositories\Interfaces\BlurbInterface;

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
     * @var CampaignInterface
     */
    protected $campaign;

    /**
     * @var BlurbInterface
     */
    protected $blurb;

    /**
     * Create a new controller instance.
     *
     * @param MerchantInterface $merchant
     * @param RestaurantInterface $restaurant
     * @param RestaurantCuisineInterface $restaurantCuisine
     * @param OutletInterface $outlet
     * @param CuisineInterface $cuisine
     * @param CampaignInterface $campaign
     * @return void
     */
    public function __construct(
        MerchantInterface $merchant,
        RestaurantInterface $restaurant,
        RestaurantCuisineInterface $restaurantCuisine,
        SnapshotInterface $snapshot,
        OutletInterface $outlet,
        CuisineInterface $cuisine,
        CampaignInterface $campaign,
        BlurbInterface $blurb
    ) {
        $this->merchant = $merchant;
        $this->restaurant = $restaurant;
        $this->restaurantCuisine = $restaurantCuisine;
        $this->snapshot = $snapshot;
        $this->outlet = $outlet;
        $this->cuisine = $cuisine;
        $this->campaign = $campaign;
        $this->blurb = $blurb;
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

        ); /*echo "<pre>";
        print_r($data['merchants']);die;*/
        return view('merchants.index', $data);
    }

    /**
     * Get search result page.
     *
     * @return View
     */
    public function getSearchResult($search_word, $search_type)
    {
        $data = array(
            'merchants' => $this->merchant->search($search_word, $search_type),
            'total_merchants' => $this->merchant->getTotalCount(),
            'total_last_thirty_days' => $this->merchant->getTotalMonth(),
            'total_live_merchants' => $this->merchant->getCount(),
            'total_pending_admin_approval_merchants' => $this->merchant->getCount(0),
            'total_approved_merchants' => $this->merchant->getCount(1),
            'total_blocked_merchants' => $this->merchant->getCount(2),
            'total_pending_email_verification' => $this->merchant->getCount(3),
            'search_word' => $search_word,
            'search_type' => $search_type,
        );
        /* echo "<pre>";
        print_r($data['campaigns']);die;*/
        return view('merchants.search', $data);
    }

    /**
     * Display create merchant page.
     *
     * @return View
     */
    public function create()
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

        ); /*echo "<pre>";
        print_r($data['merchants']);die;*/
        return view('merchants.create', $data);
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
     * Display edit merchant profile page.
     *
     * @return View
     */
    public function edit($id)
    {
        $merchant_id = $id;

        $restaurant = $this->restaurant->getByAttributes(['merchant_id' => $merchant_id], false);

        $selected_cuisines = $this->restaurantCuisine->getByAttributesWithRelations(['restaurant_id' => $restaurant->id], ['cuisine'])->toArray();

        $cuisines_id = array_map(function ($structure) {

            return $structure['cuisine']['id'];

        }, $selected_cuisines);

        $data = array(
            'merchant' => $this->merchant->getById($merchant_id),
            'campaigns' => $this->campaign->getAllWithRelations(['blurb'], 'campaign_name', 'ASC', ['merchant_id' => $merchant_id]),
            'restaurant' => $restaurant,
            'snapshot' => $this->snapshot->getByAttributes(['merchant_id' => $merchant_id]),
            'outlet' => $this->outlet->getByAttributes(['merchant_id' => $merchant_id, 'main' => 1], false),
            'outlets' => $this->outlet->getByAttributes(['merchant_id' => $merchant_id, 'main' => 0]),
            'restaurant_cuisine' => $selected_cuisines,
            'cuisines' => $this->cuisine->getAll(),
            'cuisines_id' => $cuisines_id,
            'merchant_id' => $id,
        );

        return view('merchants.edit', $data);
    }

    /**
     * Edit a merchant.
     *
     * @param integer $id
     * @param MerchantRequest $request
     * @return Redirect
     */
    public function update($id, MerchantRequest $request, Mailer $mailer)
    {

        $request_new = $request->except(['password', 'password_confirmation']);

        if ($request->password != "") {
            $request->merge(['password' => bcrypt($request->password)]);
            $request_new = $request->all();
        }
        
        if ($merchant = $this->merchant->updateById($id, $request_new)) {
            
            if($request->status == "1") {

                $data = $this->merchant->getByAttributes(['id' => $id]);

                if($data[0]['status'] != 1) {
                    $mailer->send('emails.approved', 'Congratulations, Your Account Has Been Approved', $data[0]);
                }
            }
            
            return redirect('merchants/' . $request->merchant_id . '/edit')->with('message', 'Successfully updated.');
        }

        return redirect('merchants/' . $request->merchant_id . '/edit')->withInput();
    }

    /**
     * Generate Campaign report.
     *
     * @return Redirect
     */
    public function generateReport(Request $request)
    {
        $merchant = $this->merchant->getAll();

        $c = array_map(function ($structure) {

            switch ($structure['status']) {
                case 1:
                    $status = "Approved";
                    break;
                case 2:
                    $status = "Blocked";
                    break;
                case 3:
                    $status = "Pending Email Verification";
                    break;
                default:
                    $status = "Pending Admin Approval";
                    break;
            }
            return [
                'Merchant Name' => $structure['coy_name'],
                'Status' => $status,
                'Joined Date' => date_format(date_create($structure['date_created']), 'd-M-Y'),
                'Last Online Date' => date_format(date_create($structure['last_online']), 'd-M-Y'),
                'Last Online Time' => date_format(date_create($structure['last_online']), 'H:i:s'),
                'Contact Person Name' => $structure['first_name'] . ' ' . $structure['last_name'],
                'Tel No' => $structure['coy_phone'],
                'Email' => $structure['email'],

            ];
        }, $merchant);

        $generator = new GenerateReport();

        $report_type = array(
            $request->blurb_status . ' Merchants Report' => array_filter($c),
        );
        $generator->generate($report_type, 'Merchants Report');

        return redirect()->back();
    }

    public function create_campaign($id)
    {
        $data = [
            'merchant' => Merchant::find($id),
        ];

        return view('merchants.campaign.create', $data);
    }

    public function edit_campaign($id)
    {
        $campaign = $this->campaign->getById($id);

        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => $campaign->merchant_id], false);
        $data['campaign'] = $campaign;
        $data['blurbs'] = $this->blurb->getAllByAttributes(['campaign_id' => $id], 'created_at', 'DESC');
        $data['merchants'] = Merchant::where('status', '!=', 3)->orderBy('coy_name')->get()->toArray();

        return view('merchants.campaign.view', $data);
    }
}
