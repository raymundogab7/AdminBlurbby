<?php

namespace Admin\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Admin\Http\Requests\CampaignRequest;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Repositories\Interfaces\BlurbInterface;
use Admin\Repositories\Interfaces\NotificationInterface;
use Admin\Services\GenerateReport;
use Admin\SnapShot;
use Admin\Repositories\Interfaces\SnapShotInterface;

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
     * Create a new controller instance.
     *
     * @param CampaignInterface $campaign
     * @param RestaurantInterface $restaurant
     * @param BlurbInterface $blurb
     * @param NotificationInterface $notification
     * @param SnapShotInterface $snapShot
     * @return void
     */
    public function __construct(CampaignInterface $campaign, RestaurantInterface $restaurant, BlurbInterface $blurb, NotificationInterface $notification, SnapShotInterface $snapShot)
    {
        $this->campaign = $campaign;
        $this->restaurant = $restaurant;
        $this->blurb = $blurb;
        $this->notification = $notification;
        $this->snapShot = $snapShot;
    }

    /**
     * Display campaign page.
     *
     * @return View
     */
    public function index()
    {
        $this->blurb->deleteByAttributes(['merchant_id' => Auth::user()->id, 'blurb_name' => null]);

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
        );/*echo "<pre>";
        print_r($data['campaigns']);die;*/
        return view('campaigns.index', $data);
    }

    /**
     * Get search result page.
     *
     * @return View
     */
    public function getSearchResult($search_word, $search_type)
    {
        
        
        $this->blurb->deleteByAttributes(['merchant_id' => Auth::user()->id, 'blurb_name' => null]);

        $data = array(
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false),
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
        );
       /* echo "<pre>";
        print_r($data['campaigns']);die;*/
        return view('campaigns.search', $data);
    }

    /**
     * Display search result page.
     *
     * @return View
     */
    public function showSearchResult($search_word, $search_type)
    {
        
        
        $this->blurb->deleteByAttributes(['merchant_id' => Auth::user()->id, 'blurb_name' => null]);

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
        return view('campaigns.index', $data);
    }

    /**
     * Display campaign details.
     *
     * @param integer $id
     * @return View
     */
    public function show($id)
    {
        $this->blurb->deleteByAttributes(['merchant_id' => Auth::user()->id, 'blurb_name' => null]);

        if(! $campaign = $this->campaign->getByIdAndAttiributes($id, ['merchant_id' => Auth::user()->id])){
            return abort(404);
        }

        $data = array(
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false),
            'campaign' => $campaign,
            'blurbs' => $this->blurb->getAllByAttributes(['merchant_id' => Auth::user()->id, 'campaign_id' => $id], 'created_at', 'DESC')
        );

        return view('campaigns.view', $data);
    }

    /**
     * Edit a campaign campaign.
     *
     * @return View
     */
    public function create()
    {
        $data = [
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false)
        ];

        return view('campaigns.create', $data);
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

        $request->merge(array('merchant_id' => Auth::user()->id, 'cam_status' => 'Draft', 'control_no' => $control_no));

        if ($this->campaign->create($request->all())) {

            return redirect('blurb/create/'.$control_no);
        }

        return redirect('campaign/create')->withInput();
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
        
        $campaign = $this->campaign->getByIdAndAttiributes($id, ['merchant_id' => Auth::user()->id])->toArray();

        $campaign['cam_status'] = 'Draft';
        
        if ($duplicated_campaign = $this->campaign->create($campaign)) {
            
            $duplicate_blurbs = $this->blurb->getAllByAttributes(['campaign_id' => $id, 'merchant_id' => Auth::user()->id], 'blurb_name', 'DESC');

            foreach ($duplicate_blurbs as $key => $value) {
                $value['campaign_id'] = $duplicated_campaign->id;
                $value['blurb_status'] = 'Created';
                $this->blurb->create($value);
            }

            return redirect('campaign/'.$id)->with('message', 'Successfully duplicated.');
        }

        return redirect('campaign/'.$id)->withInput()->with('message_error', 'Error while duplicating campaign. Please try again.');
    }

    /**
     * Display edit campaign page.
     *
     * @param integer $id
     * @return View
     */
    public function edit($id)
    {
        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false);
        $data['campaign'] = $this->campaign->getById($id);

        return view('campaigns.edit', $data);
    }

    /**
     * Update a campaign.
     *
     * @return Redirect
     */
    public function update($id, CampaignRequest $request)
    {
        if($this->campaign->updateById($id, $request->all())){
             return redirect('campaign/'.$id)->with('message', 'Successfully updated.');
        }

        return redirect('campaign/'.$id)->withInput()->with('message_error', 'Error while deleting campaign. Please try again.');
    }

    /**
     * Update a campaign by attributes.
     *
     * @return Redirect
     */
    public function markAllAsRead()
    {
        if($this->campaign->updateByAttributes(['merchant_id' => Auth::user()->id], ['cam_read' => 1])){

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
        if(empty($this->blurb->getAllByAttributes(['campaign_id' => $id, 'merchant_id' => Auth::user()->id], 'created_at'))) {
            return redirect('campaign/'.$id)->withInput()->with('message_error', 'There are no blurbs in this campaign.');     
        }
        
        if(!$this->campaign->updateById($id, $request->all())){
            return redirect('campaign/'.$id)->withInput()->with('message_error', 'Error while updating campaign. Please try again.');     
        }

        

        if($request->cam_status == 'Draft'){
            $duplicate_blurbs = $this->blurb->updateByAttributes(['campaign_id' => $id, 'merchant_id' => Auth::user()->id], ['blurb_status' => 'Created'], 'DESC');

            $request->cam_status = 'Created';
        }

        $test =$this->blurb->updateByAttributesWithCondition(['merchant_id' => Auth::user()->id, 'campaign_id' => $id], ['blurb_status' => $request->cam_status]);

        return redirect('campaign/'.$id)->with('message', 'Successfully updated.');
    }

    /**
     * Update a campaign.
     *
     * @return Redirect
     */
    public function updateCamRead($id, Request $request)
    {
        if($this->campaign->updateById($id, $request->all())){
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
        if($this->campaign->delete($id)) {
            return redirect('campaign')->with('message', 'Successfully deleted.');
        }

        return redirect('campaign/'.$id)->withInput()->with('message_error', 'Error while deleting campaign. Please try again.');
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

        $c = array_map(function($structure) use ($count_likes){

            return [
                'Campaign Name' => $structure['campaign_name'],
                'Status' => $structure['cam_status'],
                'Start Date' => $structure['cam_start'],
                'End Date' => $structure['cam_end'],
                'No. of Blurbs' => count($structure['blurb']),
                'No. of Likes' => Snapshot::where(['campaign_id' => $structure['id'], 'merchant_id' => Auth::user()->id])->sum('snapshot_likes'),
                'No. of Unique Views' => Snapshot::where(['campaign_id' => $structure['id'], 'merchant_id' => Auth::user()->id])->sum('snapshot_uviews'),
                'No. of Usage' => Snapshot::where(['campaign_id' => $structure['id'], 'merchant_id' => Auth::user()->id])->sum('snapshot_usage'),
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
        //$campaign = $this->campaign->getAllByAttributesWithRelations(['id' => $id, 'cam_status' => $request->cam_status, 'merchant_id' => Auth::user()->id], ['blurb', 'snapshot'], 'campaign_name');
        $snapshots = Snapshot::with('campaign')->where(['campaign_id' => $id, 'merchant_id' => Auth::user()->id])->get()->toArray();

        
        $c = array_map(function($structure) use ($id, $snapshots){

            return [
                'Campaign Name' => $structure['campaign']['campaign_name'],
                'Status' => $structure['campaign']['cam_status'],
                'Start Date' => $structure['campaign']['cam_start'],
                'End Date' => $structure['campaign']['cam_end'],
                'No. of Blurbs' => count($snapshots),
                'No. of Likes' => $structure['snapshot_likes'],
                'No. of Unique Views' => $structure['snapshot_uviews'],
                'No. of Usage' => $structure['snapshot_usage'],
            ];
        }, $snapshots);

        $generator = new GenerateReport();

        $report_type = array(
            $request->cam_status . ' Campaign Report' => array_filter($c),
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
        return $this->snapShot->getByAttributesLastSevenDays(['campaign_id' => $campaign_id, 'merchant_id' => Auth::user()->id], $field);
    }
}
