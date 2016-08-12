<?php

namespace Admin\Http\Controllers;

use Admin\Http\Requests\CampaignRequest;
use Admin\Merchant;
use Admin\Repositories\Interfaces\BlurbInterface;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\MerchantInterface;
use Admin\Repositories\Interfaces\NotificationInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Repositories\Interfaces\SnapShotInterface;
use Admin\Restaurant;
use Admin\Services\GenerateReport;
use Admin\Services\Mailer;
use Admin\SnapShot;
use Auth;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * @var CampaignInterface
     */
    protected $campaign;

    /**
     * @var RestaurantInterface
     */
    protected $restaurant;

    /**
     * @var BlurbInterface
     */
    protected $blurb;

    /**
     * @var NotificationInterface
     */
    protected $notification;

    /**
     * @var SnapShotInterface
     */
    protected $snapShot;

    /**
     * @var MerchantInterface
     */
    protected $merchant;

    /**
     * Create a new controller instance.
     *
     * @param CampaignInterface $campaign
     * @param RestaurantInterface $restaurant
     * @param BlurbInterface $blurb
     * @param NotificationInterface $notification
     * @param SnapShotInterface $snapShot
     * @return void
     */
    public function __construct(CampaignInterface $campaign, RestaurantInterface $restaurant, BlurbInterface $blurb, NotificationInterface $notification, SnapShotInterface $snapShot, MerchantInterface $merchant)
    {
        $this->campaign = $campaign;
        $this->restaurant = $restaurant;
        $this->blurb = $blurb;
        $this->notification = $notification;
        $this->snapShot = $snapShot;
        $this->merchant = $merchant;
    }

    /**
     * Display campaign page.
     *
     * @return View
     */
    public function index()
    {
        $this->blurb->deleteByAttributes(['blurb_name' => null]);

        $data = array(
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false),
            'campaigns' => $this->campaign->getAll(true),
            'total_campaigns' => $this->campaign->getTotalCount(),
            'total_last_thirty_days' => $this->campaign->getTotalMonth(),
            'total_live_campaigns' => $this->campaign->getCount(),
            'total_approved_campaigns' => $this->campaign->getCount('Approved'),
            'total_rejected_campaigns' => $this->campaign->getCount('Rejected'),
            'total_pending_approval_campaigns' => $this->campaign->getCount('Pending Approval'),
            'total_draft_campaigns' => $this->campaign->getCount('Draft'),
            'total_expired_campaigns' => $this->campaign->getCount('Expired'),
        ); /*echo "<pre>";
        print_r($data['campaigns']);die;*/
        return view('campaign.index', $data);
    }

    /**
     * Get search result page.
     *
     * @param string $search_word
     * @param string $search_type
     * @return View
     */
    public function getSearchResult($search_word, $search_type)
    {
        $data = array(
            'campaigns' => $this->campaign->search($search_word, $search_type),
            'total_campaigns' => $this->campaign->getTotalCount(),
            'total_last_thirty_days' => $this->campaign->getTotalMonth(),
            'total_live_campaigns' => $this->campaign->getCount(),
            'total_approved_campaigns' => $this->campaign->getCount('Approved'),
            'total_rejected_campaigns' => $this->campaign->getCount('Rejected'),
            'total_pending_approval_campaigns' => $this->campaign->getCount('Pending Approval'),
            'total_draft_campaigns' => $this->campaign->getCount('Draft'),
            'total_expired_campaigns' => $this->campaign->getCount('Expired'),
            'search_word' => $search_word,
            'search_type' => $search_type,
        );
        /* echo "<pre>";
        print_r($data['campaigns']);die;*/
        return view('campaign.search', $data);
    }

    /**
     * Display search result page.
     *
     * @return View
     */
    public function showSearchResult($search_word, $search_type)
    {

        $this->blurb->deleteByAttributes(['blurb_name' => null]);

        $data = array(
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false),
            'campaigns' => $this->campaign->getAll(true),
            'total_campaigns' => $this->campaign->getTotalCount(),
            'total_last_thirty_days' => $this->campaign->getTotalMonth(),
            'total_live_campaigns' => $this->campaign->getCount(),
            'total_approved_campaigns' => $this->campaign->getCount('Approved'),
            'total_rejected_campaigns' => $this->campaign->getCount('Rejected'),
            'total_pending_approval_campaigns' => $this->campaign->getCount('Pending Approval'),
            'total_draft_campaigns' => $this->campaign->getCount('Draft'),
            'total_expired_campaigns' => $this->campaign->getCount('Expired'),
        );
        return view('campaign.index', $data);
    }

    /**
     * Display campaign details.
     *
     * @param integer $id
     * @return View
     */
    public function show($id)
    {
        $campaign = $this->campaign->getById($id);

        $this->blurb->deleteByAttributes(['merchant_id' => $campaign->merchant_id, 'blurb_name' => null]);

        if (!$campaign) {
            return abort(404);
        }

        $data = array(
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => $campaign->merchant_id], false),
            'campaign' => $campaign,
            'blurbs' => $this->blurb->getAllByAttributes(['campaign_id' => $id], 'created_at', 'DESC'),
            'merchants' => Merchant::where('status', 1)->orderBy('coy_name')->get()->toArray(),
            'restaurants' => Restaurant::orderBy('res_name')->get()->toArray(),
        );

        return view('campaign.view', $data);
    }

    /**dd
     * Edit a campaign campaign.
     *
     * @return View
     */
    public function create()
    {
        $data = [
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false),
            'merchants' => Merchant::where('status', '!=', 3)->orderBy('coy_name')->get()->toArray(),
            'restaurants' => Restaurant::orderBy('res_name')->get()->toArray(),
        ];

        return view('campaign.create', $data);
    }

    /**
     * Create a campaign.
     *
     * @param Campaign $request
     * @return Redirect
     */
    public function store(CampaignRequest $request)
    {
        $control_no = uniqid();

        $restaurant = $this->restaurant->getByAttributes(['id' => $request->restaurant_id], false);

        $request->merge(array('cam_start' => date_format(date_create($request->cam_start), 'Y-m-d'), 'cam_end' => date_format(date_create($request->cam_end), 'Y-m-d'), 'merchant_id' => $restaurant->merchant_id, 'cam_status' => 'Draft', 'control_no' => $control_no));

        if ($campaign = $this->campaign->create($request->all())) {

            return redirect('campaigns/' . $campaign->id);
        }

        return redirect('campaigns/create')->withInput();
    }

    /**
     * Duplicate a campaign.
     *
     * @param Campaign $request
     * @return Redirect
     */
    public function duplicate($id)
    {
        //$request->merge(array('merchant_id' => Auth::user()->id, 'cam_status' => 'Pending Approval'));

        $campaign = $this->campaign->getById($id)->toArray();

        $campaign['cam_status'] = 'Draft';

        if ($duplicated_campaign = $this->campaign->create($campaign)) {

            $duplicate_blurbs = $this->blurb->getAllByAttributes(['campaign_id' => $id], 'blurb_name', 'DESC');

            foreach ($duplicate_blurbs as $key => $value) {
                $value['campaign_id'] = $duplicated_campaign->id;
                $value['blurb_status'] = 'Created';

                if ($value['control_no'] != null || $value['control_no'] != '') {
                    $value['control_no'] = uniqid();
                } else {
                    $value['control_no'] = null;
                }

                $this->blurb->create($value);

            }

            return redirect('campaigns/' . $id)->with('message', 'Successfully duplicated.');
        }

        return redirect('campaigns/' . $id)->withInput()->with('message_error', 'Error while duplicating campaign. Please try again.');
    }

    /**
     * Display edit campaign page.
     *
     * @param integer $id
     * @return View
     */
    public function edit($id)
    {
        $campaign = $this->campaign->getById($id);

        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => $campaign->merchant_id], false);
        $data['campaign'] = $campaign;
        $data['merchants'] = Merchant::where('status', '!=', 3)->orderBy('coy_name')->get()->toArray();

        return view('campaign.edit', $data);
    }

    /**
     * Update a campaign.
     *
     * @return Redirect
     */
    public function update($id, CampaignRequest $request, Mailer $mailer)
    {

        $restaurant = $this->restaurant->getByAttributes(['id' => $request->restaurant_id], false);

        $campaign = $this->campaign->getById($id);
        $request->merge(array('merchant_id' => $restaurant->merchant_id, 'cam_start' => date_format(date_create($request->cam_start), 'Y-m-d'), 'cam_end' => date_format(date_create($request->cam_end), 'Y-m-d')));

        if ($this->campaign->updateById($id, $request->all())) {

            if ($request->cam_status == "Approved") {

                $data = $this->merchant->getByAttributes(['id' => $request->merchant_id]);

                if ($campaign->cam_status != "Approved") {

                    $this->notification->create(['merchant_id' => $request->merchant_id, 'campaign_id' => $id, 'admin_id' => Auth::user()->id, 'status' => 'Approved', 'seen' => 0]);

                    $mailer->send('emails.campaign_approved', 'Your Campaign Has been Approved', $data[0]);
                }

                if (date('Y-m-d') >= $campaign->cam_start || date('Y-m-d') >= $request->cam_start) {

                    $this->campaign->updateById($id, ['cam_status' => 'Live']);

                    $mailer->send('emails.campaign_live', 'Your Campaign is Live', $data[0]);
                }

                if (date('Y-m-d') > $campaign->cam_end || date('Y-m-d') > $request->cam_end) {

                    $this->campaign->updateById($id, ['cam_status' => 'Expired']);

                    $mailer->send('emails.campaign_live', 'Your Campaign is Live', $data[0]);
                }
            }

            if ($request->cam_status == "Rejected") {

                $data = $this->merchant->getByAttributes(['id' => $request->merchant_id]);

                if ($campaign->cam_status != "Rejected") {

                    $this->notification->create(['merchant_id' => $request->merchant_id, 'campaign_id' => $id, 'admin_id' => Auth::user()->id, 'status' => 'Rejected', 'seen' => 0]);

                    $mailer->send('emails.campaign_rejected', 'Your Campaign Needs Some Revision(s)', $data[0]);
                }
            }

            if ($request->cam_status == "Pending Approval") {
                $this->blurb->updateByAttributesWithCondition(['campaign_id' => $id], ['blurb_status' => 'Pending Admin Approval']);
            }

            if ($request->cam_status == "Draft") {
                $this->blurb->updateByAttributesWithCondition(['campaign_id' => $id], ['blurb_status' => 'Created']);
            }

            $this->blurb->updateByAttributesWithCondition(['campaign_id' => $id], ['merchant_id' => $restaurant->merchant_id, 'campaign_id' => $id]);

            if (is_null($request->cam_status)) {
                return redirect('merchants/' . $id . '/edit-campaign')->with('message', 'Successfully updated.');
            }

            return redirect('campaigns/' . $id)->with('message', 'Successfully updated.');

        }

        if (is_null($request->cam_status)) {
            return redirect('merchants/' . $id . '/edit-campaign')->withInput()->with('message_error', 'Error while deleting campaign. Please try again.');
        }

        return redirect('campaigns/' . $id)->withInput()->with('message_error', 'Error while deleting campaign. Please try again.');
    }

    /**
     * Update a campaign by attributes.
     *
     * @return Redirect
     */
    public function markAllAsRead()
    {
        if ($this->campaign->updateByAttributes(['merchant_id' => Auth::user()->id], ['cam_read' => 1])) {

            $this->notification->updateByAttributes(['merchant_id' => Auth::user()->id], ['seen' => 1]);

            return response()->json(['result' => true]);
        }

        return response()->json(['result' => false]);
    }

    /**
     * Update a campaign.
     *
     * @return Redirect
     */
    public function updateStatus($id, Request $request)
    {
        if (empty($this->blurb->getAllByAttributes(['campaign_id' => $id], 'created_at'))) {
            return redirect('campaigns/' . $id)->withInput()->with('message_error', 'There are no blurbs in this campaign.');
        }

        if (!$this->campaign->updateById($id, $request->all())) {
            return redirect('campaigns/' . $id)->withInput()->with('message_error', 'Error while updating campaign. Please try again.');
        }

        if ($request->cam_status == 'Pending Approval') {
            $data = $this->merchant->getByAttributes(['id' => Auth::user()->id]);

            $request->cam_status = 'Pending Admin Approval';
            //$mailer->send('emails.campaign_sent', 'We Have Received Your Campaign', $data[0]);
        }

        if ($request->cam_status == 'Draft') {
            $duplicate_blurbs = $this->blurb->updateByAttributes(['campaign_id' => $id], ['blurb_status' => 'Created'], 'DESC');

            $request->cam_status = 'Created';
        }

        $test = $this->blurb->updateByAttributesWithCondition(['campaign_id' => $id], ['blurb_status' => $request->cam_status]);

        return redirect('campaigns/' . $id)->with('message', 'Successfully updated.');
    }

    /**
     * Update a campaign.
     *
     * @return Redirect
     */
    public function updateCamRead($id, Request $request)
    {
        if ($this->campaign->updateById($id, $request->all())) {
            return response()->json(['result' => true]);
        }

        return response()->json(['result' => false]);
    }

    /**
     * Delete a campaign
     *
     * @param integer $id
     * @return Redirect
     */
    public function destroy($id)
    {
        if ($this->campaign->delete($id)) {
            return redirect('campaigns')->with('message', 'Successfully deleted.');
        }

        return redirect('campaigns/' . $id)->withInput()->with('message_error', 'Error while deleting campaign. Please try again.');
    }

    /**
     * Generate Campaign report.
     *
     * @return Redirect
     */
    public function generateReport(Request $request)
    {
        $campaign = $this->campaign->getAllWithRelations(['blurb', 'snapshot'], 'campaign_name');
        $count_likes = 0;

        $c = array_map(function ($structure) use ($count_likes) {

            return [
                'Campaign Name' => $structure['campaign_name'],
                'Status' => $structure['cam_status'],
                'Start Date' => $structure['cam_start'],
                'End Date' => $structure['cam_end'],
                'No. of Blurbs' => count($structure['blurb']),
                'No. of Likes' => Snapshot::where(['campaign_id' => $structure['id']])->sum('snapshot_likes'),
                'No. of Unique Views' => Snapshot::where(['campaign_id' => $structure['id']])->sum('snapshot_uviews'),
                'No. of Usage' => Snapshot::where(['campaign_id' => $structure['id']])->sum('snapshot_usage'),
            ];
        }, $campaign);

        $generator = new GenerateReport();

        $report_type = array(
            $request->cam_status . ' Campaign Report' => array_filter($c),
        );
        $generator->generate($report_type);

        return redirect()->back();
    }

    /**
     * Generate a Campaign report.
     *
     * @return Redirect
     */
    public function generateCampaignReport($id, Request $request)
    {
        $campaign = $this->campaign->getById($id);

        $snapshots = Snapshot::with('campaign')->where(['campaign_id' => $id, 'merchant_id' => Auth::user()->id])->get()->toArray();

        $dates_between = $this->getDatesFromRange($campaign->cam_start, $campaign->cam_end);

        $data = array();

        foreach ($dates_between as $db) {
            $data[] = [
                'Campaign Name' => $campaign->campaign_name,
                'Start Date' => $campaign->cam_start,
                'End Date' => $campaign->cam_end,
                'No. of Blurbs' => count($snapshots),
                'Performance Date' => $db,
                'No. of Likes' => Snapshot::where(['campaign_id' => $id, 'snapshot_date' => $db, 'merchant_id' => Auth::user()->id])->sum('snapshot_likes'),
                'No. of Unique Views' => Snapshot::where(['campaign_id' => $id, 'snapshot_date' => $db, 'merchant_id' => Auth::user()->id])->sum('snapshot_uviews'),
                'No. of Usage' => Snapshot::where(['campaign_id' => $id, 'snapshot_date' => $db, 'merchant_id' => Auth::user()->id])->sum('snapshot_usage'),
            ];
        }

        $generator = new GenerateReport();

        $report_type = array(
            $request->cam_status . ' Campaign Report' => $data,
        );

        $generator->generate($report_type);

        return redirect()->back();
    }

    /**
     * Get SnapShot by attributes last seven days.
     *
     * @param array $attributes
     * @param string $field
     * @return SnapShot
     */
    public function getLastSevenDays($campaign_id, $field)
    {
        return $this->snapShot->getByAttributesLastSevenDays(['campaign_id' => $campaign_id], $field);
    }

    /**
     * Get dates between campaign start and campaign end.
     *
     * @param array $date_time_from
     * @param string $date_time_to
     * @return array
     */
    private function getDatesFromRange($date_time_from, $date_time_to)
    {

        // cut hours, because not getting last day when hours of time to is less than hours of time_from
        // see while loop
        $start = \Carbon\Carbon::createFromFormat('Y-m-d', substr($date_time_from, 0, 10));
        $end = \Carbon\Carbon::createFromFormat('Y-m-d', substr($date_time_to, 0, 10));

        $dates = [];

        while ($start->lte($end)) {

            $dates[] = $start->copy()->format('Y-m-d');

            $start->addDay();
        }

        return $dates;
    }
}
