<?php

namespace Admin\Http\Controllers;

use Admin\Http\Requests\MerchantRequest;
use Admin\Merchant;
use Admin\Repositories\Interfaces\BlurbCategoryInterface;
use Admin\Repositories\Interfaces\BlurbInterface;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\CuisineInterface;
use Admin\Repositories\Interfaces\MerchantInterface;
use Admin\Repositories\Interfaces\OutletInterface;
use Admin\Repositories\Interfaces\RestaurantCuisineInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Repositories\Interfaces\SnapShotInterface;
use Admin\Services\GenerateReport;
use Admin\Services\Mailer;
use Illuminate\Http\Request;

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
     * @var BlurbCategoryInterface
     */
    protected $blurbCategory;

    /**
     * Create a new controller instance.
     *
     * @param MerchantInterface $merchant
     * @param RestaurantInterface $restaurant
     * @param RestaurantCuisineInterface $restaurantCuisine
     * @param OutletInterface $outlet
     * @param CuisineInterface $cuisine
     * @param CampaignInterface $campaign
     * @param BlurbCategoryInterface $blurbCategory
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
        BlurbInterface $blurb,
        BlurbCategoryInterface $blurbCategory
    ) {
        $this->merchant = $merchant;
        $this->restaurant = $restaurant;
        $this->restaurantCuisine = $restaurantCuisine;
        $this->snapshot = $snapshot;
        $this->outlet = $outlet;
        $this->cuisine = $cuisine;
        $this->campaign = $campaign;
        $this->blurb = $blurb;
        $this->blurbCategory = $blurbCategory;
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
            'total_disabled' => $this->merchant->getCount(3),

        ); /*echo "<pre>";
        print_r($data['merchants']);die;*/
        return view('merchants.index', $data);
    }

    /**
     * Display merchant page by status.
     *
     * @param string $status
     * @return View
     */
    public function displayByStatus($status)
    {

        switch ($status) {
            case 'pending-admin':
                $status = 0;
                $title = 'Pending Admin Approval';
                break;
            case 'approved':
                $status = 1;
                $title = 'Approved';
                break;
            case 'blocked':
                $status = 2;
                $title = 'Blocked';
                break;
            case 'disabled':
                $status = 3;
                $title = 'Disabled';
                break;
            default:
                $status = "month";
                $title = "Created in last 30 days";
                break;
        }

        $query = $this->merchant->getAllWithAttributes(['status' => $status], true);

        if ($status === "month") {
            $query = $this->merchant->getLastThirtyDays();
        }

        $data = array(
            'title' => $title,
            'merchants' => $query,
            'total_merchants' => $this->merchant->getTotalCount(),
            'total_last_thirty_days' => $this->merchant->getTotalMonth(),
            'total_live_merchants' => $this->merchant->getCount(),
            'total_pending_admin_approval_merchants' => $this->merchant->getCount(0),
            'total_approved_merchants' => $this->merchant->getCount(1),
            'total_blocked_merchants' => $this->merchant->getCount(2),
            'total_disabled' => $this->merchant->getCount(3),
        );

        return view('merchants.index_by_status', $data);
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
            'total_disabled' => $this->merchant->getCount(3),
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
        $cuisines = $this->cuisine->lists();

        return view('merchants.create', ['cuisines' => $cuisines]);
    }

    /**
     * Create a new merchant.
     *
     * @param Request $request
     * @return Redirect
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'coy_name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'coy_email' => 'required|email',
            'coy_phone' => 'required|min:8|max:8',
            'last_name' => 'password|min:8',
        ]);
        $request->merge([
            'coy_phone' => '+65 ' . substr($request->coy_phone, 0, 4) . ' ' . substr($request->coy_phone, 4, 7),
        ]);

        $merchant_auth = Merchant::where(['email' => $request->email])->whereIn('status', [0, 1, 2])->get()->toArray();

        if (!empty($merchant_auth)) {
            return redirect('merchants/create')
                ->withInput()
                ->with('error', 'The email has been already taken');
        }
        date_default_timezone_set('UTC');

        $request->merge(array('email' => $request->coy_email, 'password' => bcrypt($request->password), 'date_created' => date('Y-m-d'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));

        if ($merchant = $this->merchant->create($request->except('_token'))) {
            $this->restaurant->create(['merchant_id' => $merchant->id]);
            $this->outlet->create(['merchant_id' => $merchant->id, 'main' => 1, 'outlet_no' => md5($merchant->id)]);
            return redirect('merchants')
                ->with('message', 'Merchant account successfully created.');
        }

        return redirect('merchants/create')
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

        $selected_cuisines = array();
        $cuisines_id = array();

        if (!is_null($restaurant)) {
            $selected_cuisines = $this->restaurantCuisine->getByAttributesWithRelations(['restaurant_id' => $restaurant->id], ['cuisine'])->toArray();

            $cuisines_id = array_map(function ($structure) {

                return $structure['cuisine']['id'];

            }, $selected_cuisines);
        }

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

        $request->merge(['coy_phone' => '+65 ' . substr($request->coy_phone, 0, 4) . ' ' . substr($request->coy_phone, 4, 7)]);

        $request_new = $request->except(['password', 'password_confirmation']);

        if ($request->password != "") {
            $request->merge(['password' => bcrypt($request->password)]);
            $request_new = $request->all();
        }
        $data = $this->merchant->getByAttributes(['id' => $id]);
        if ($merchant = $this->merchant->updateById($id, $request_new)) {

            if ($request->status == "1") {

                if ($data[0]['status'] != 1) {

                    date_default_timezone_set('UTC');
                    $this->merchant->updateById($id, ['date_approved' => date('Y-m-d H:i:s')]);
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
                    $status = "Disabled";
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

    public function createCampaign($id)
    {
        $data = [
            'merchant' => Merchant::find($id),
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => $id], false),
        ];

        return view('merchants.campaign.create', $data);
    }

    public function editCampaign($id)
    {
        $campaign = $this->campaign->getById($id);

        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => $campaign->merchant_id], false);
        $data['campaign'] = $campaign;
        $data['blurbs'] = $this->blurb->getAllByAttributes(['campaign_id' => $id], 'created_at', 'DESC');
        $data['merchants'] = Merchant::where('status', '!=', 3)->orderBy('coy_name')->get()->toArray();

        return view('merchants.campaign.view', $data);
    }

    public function createBlurb($id, $control_no)
    {
        $data = [
            'merchant' => Merchant::find($id),
        ];

        return view('merchants.blurb.create', $data);
    }

    public function editBlurb($id, $control_no)
    {
        $campaign = $this->campaign->getByAttributes(['control_no' => $control_no], false);

        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => $campaign->merchant_id], false);
        $data['campaign'] = $this->campaign->getById($campaign->id);
        $data['blurb'] = $this->blurb->getById($id);
        $data['blurb_category'] = $this->blurbCategory->getAll();

        return view('merchants.blurb.view', $data);
    }
}
