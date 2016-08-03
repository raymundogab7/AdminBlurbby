<?php

namespace Admin\Http\Controllers;

use Admin\Http\Requests\BlurbRequest;
use Admin\Repositories\Interfaces\BlurbCategoryInterface;
use Admin\Repositories\Interfaces\BlurbInterface;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Repositories\Interfaces\SnapShotInterface;
use Admin\Services\GenerateReport;
use Admin\Services\ImageUploader;
use Admin\SnapShot;
use Illuminate\Http\Request;

class BlurbController extends Controller
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
     * @var SnapShotInterface
     */
    protected $snapShot;

    /**
     * @var BlurbCategoryInterface
     */
    protected $blurbCategory;

    /**
     * Create a new controller instance.
     *
     * @param CampaignInterface $campaign
     * @param RestaurantInterface $restaurant
     * @param BlurbInterface $blurb
     * @param SnapShotInterface $snapShot
     * @return void
     */
    public function __construct(CampaignInterface $campaign, RestaurantInterface $restaurant, BlurbInterface $blurb, SnapShotInterface $snapShot, BlurbCategoryInterface $blurbCategory)
    {
        $this->campaign = $campaign;
        $this->restaurant = $restaurant;
        $this->blurb = $blurb;
        $this->snapShot = $snapShot;
        $this->blurbCategory = $blurbCategory;
    }

    /**
     * Display blurb page.
     *
     * @return View
     */
    public function view($control_no, $cam_status)
    {
        $campaign = $this->campaign->getByAttributes(['control_no' => $control_no], false);
        $data = array(
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => $campaign->merchant_id], false),
            'campaign' => $campaign,
            'blurbs' => $this->blurb->getAllByAttributes(['merchant_id' => $campaign->merchant_id, 'campaign_id' => $campaign->id, 'blurb_status' => ucfirst($cam_status)], 'created_at', 'DESC'),
            'blurb_category' => $this->blurbCategory->getAll(),
        );

        return view('blurb.view_blurbs', $data);
    }

    /**
     * Display blurb page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($control_no)
    {
        $campaign = $this->campaign->getByAttributes(['control_no' => $control_no], false);

        $data = array(
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => $campaign->merchant_id], false),
            'campaign' => $campaign,
            'blurb_category' => $this->blurbCategory->getAll(),
        );

        return view('blurb.create', $data);
    }

    /**
     * Create a blurb.
     *
     * @param Blurb $request
     * @return Redirect
     */
    public function store(BlurbRequest $request)
    {

        $request->merge(array('blurb_start' => date_format(date_create($request->blurb_start), 'Y-m-d'), 'blurb_end' => date_format(date_create($request->blurb_end), 'Y-m-d'), 'merchant_id' => $request->merchant_id, 'campaign_id' => $request->campaign_id));

        if ($request->control_no != "") {
            $this->blurb->updateByAttributes(['control_no' => $request->control_no], $request->except('_token'));

            return redirect('campaigns/' . $request->campaign_id);
        }

        $this->blurb->create($request->all());

        return redirect('campaigns/' . $request->campaign_id);
    }

    /**
     * Display view blurb page.
     *
     * @param integer $id
     * @return View
     */
    public function show($id, $control_no)
    {
        $campaign = $this->campaign->getByAttributes(['control_no' => $control_no], false);

        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => $campaign->merchant_id], false);
        $data['campaign'] = $this->campaign->getById($campaign->id);
        $data['blurb'] = $this->blurb->getById($id);
        $data['blurb_category'] = $this->blurbCategory->getAll();

        return view('blurb.view', $data);
    }

    /**
     * Display edit blurb page.
     *
     * @param integer $id
     * @return View
     */
    public function edit($id, $control_no)
    {
        $campaign = $this->campaign->getByAttributes(['control_no' => $control_no], false);

        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => $campaign->merchant_id], false);
        $data['campaign'] = $this->campaign->getById($campaign->id);
        $data['blurb'] = $this->blurb->getById($id);

        return view('blurb.view', $data);
    }

    /**
     * Update a blurb.
     *
     * @return Redirect
     */
    public function update($id, BlurbRequest $request)
    {
        $request->merge(array('blurb_start' => date_format(date_create($request->blurb_start), 'Y-m-d'), 'blurb_end' => date_format(date_create($request->blurb_end), 'Y-m-d')));

        if ($this->blurb->updateById($id, $request->all())) {
            return redirect('blurb/' . $id . '/' . $request->control_no)->with('message', 'Successfully updated.');
        }

        return redirect('blurb/' . $id . '/' . $request->control_no)->withInput()->with('message_error', 'Error while deleting campaign. Please try again.');
    }

    /**
     * Update a blurb.
     *
     * @return Redirect
     */
    public function destroy($id, $campaign_id)
    {
        if ($this->blurb->delete($id)) {
            return redirect('campaigns/' . $campaign_id)->with('message', 'Successfully deleted.');
        }

        return redirect('campaigns/' . $campaign_id)->withInput()->with('message_error', 'Error while deleting campaign. Please try again.');
    }

    /**
     * Upload photo for merchant profile picture.
     *
     * @param integer $id
     * @param Outlet $request
     * @param ImageUploader $imageUploader
     * @return Redirect
     */
    public function uploadLogo($campaign_id, Request $request, ImageUploader $imageUploader)
    {
        $file = $request->file('file');
        $control_no = uniqid();

        $campaign = $this->campaign->getByAttributes(['id' => $campaign_id], false);

        $result = $this->blurb->create(['photo_location' => 'admin', 'merchant_id' => $campaign->merchant_id, 'campaign_id' => $campaign_id, 'blurb_logo' => 'blurb.png', 'control_no' => $control_no]);

        $user_id = $campaign->merchant_id;

        if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
            return Response::json(array(
                'code' => 404,
                'message' => 'Invalid format',
            ), 404);
        }

        $this->blurb->updateByAttributes(['merchant_id' => $user_id, 'campaign_id' => $campaign_id], ['photo_location' => 'admin', 'blurb_logo' => 'campaign/' . $campaign_id . '/' . $result->id . '.png']);

        $imageUploader->upload($file, $campaign_id, 500, 500, 'campaign/', '/' . $result->id . '.png');

        return ['blurb' => $result];
    }

    /**
     * Update photo for merchant profile picture.
     *
     * @param integer $id
     * @param Outlet $request
     * @param ImageUploader $imageUploader
     * @return Redirect
     */
    public function updateLogo($id, $campaign_id, Request $request, ImageUploader $imageUploader)
    {
        $file = $request->file('file');
        $control_no = uniqid();

        if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
            return Response::json(array(
                'code' => 404,
                'message' => 'Invalid format',
            ), 404);
        }

        //$this->blurb->updateByAttributes(['merchant_id' => $user_id, 'campaign_id' => $campaign_id], ['blurb_logo' => 'campaigns/' . $campaign_id.'/'.$result->id.'.png']);
        $this->blurb->updateById($id, ['photo_location' => 'admin', 'blurb_logo' => 'campaign/' . $campaign_id . '/' . $id . '.png']);

        $imageUploader->upload($file, $campaign_id, 500, 500, 'campaign/', '/' . $id . '.png');

        return ['blurb' => true];
    }

    /**
     * Generate Campaign report.
     *
     * @return Redirect
     */
    public function generateReport(Request $request)
    {
        $campaign = $this->campaign->getByAttributes(['id' => $request->campaign_id], false);

        $blurb = $this->blurb->getAllByAttributesWithRelations(['campaign_id' => $request->campaign_id, 'blurb_status' => $request->blurb_status, 'merchant_id' => $campaign->merchant_id], ['campaign', 'category'], 'blurb_name');

        $count_likes = 0;

        $c = array_map(function ($structure) use ($count_likes) {

            return [
                'Campaign Name' => $structure['campaign']['campaign_name'],
                'Blurb Title' => $structure['blurb_name'],
                'Category' => $structure['category']['blurb_cat_name'],
                'Status' => $structure['blurb_status'],
                'Start Date' => $structure['blurb_start'],
                'End Date' => $structure['blurb_end'],
                'No. of Likes' => Snapshot::where(['blurb_id' => $structure['id'], 'merchant_id' => $campaign->merchant_id])->sum('snapshot_likes'),
                'No. of Unique Views' => Snapshot::where(['blurb_id' => $structure['id'], 'merchant_id' => $campaign->merchant_id])->sum('snapshot_uviews'),
                'No. of Usage' => Snapshot::where(['blurb_id' => $structure['id'], 'merchant_id' => $campaign->merchant_id])->sum('snapshot_usage'),
            ];
        }, $blurb);

        $generator = new GenerateReport();

        $report_type = array(
            $request->blurb_status . ' Blurb Report' => array_filter($c),
        );
        $generator->generate($report_type, 'Blurb Report');

        return redirect()->back();
    }

    /**
     * Generate a Campaign report.
     *
     * @return Redirect
     */
    public function generateBlurbReport($id, Request $request)
    {
        $blurb = $this->blurb->getByIdWithRelations($id, ['campaign', 'category']);

        $snapshots = Snapshot::with('campaign')->where(['blurb_id' => $id, 'campaign_id' => $request->campaign_id, 'merchant_id' => $blurb->merchant_id])->get()->toArray();

        $dates_between = $this->getDatesFromRange($blurb->blurb_start, $blurb->blurb_end);

        $data = array();

        foreach ($dates_between as $db) {
            $data[] = [
                'Campaign Name' => $blurb->campaign->campaign_name,
                'Blurb Title' => $blurb->blurb_name,
                'Status' => $blurb->blurb_status,
                'Category' => $blurb->category->blurb_cat_name,
                'Start Date' => $blurb->blurb_start,
                'End Date' => $blurb->blurb_end,
                'Performance Date' => $db,
                'No. of Likes' => Snapshot::where(['blurb_id' => $id, 'campaign_id' => $request->campaign_id, 'snapshot_date' => $db, 'merchant_id' => $blurb->merchant_id])->sum('snapshot_likes'),
                'No. of Unique Views' => Snapshot::where(['blurb_id' => $id, 'campaign_id' => $request->campaign_id, 'snapshot_date' => $db, 'merchant_id' => $blurb->merchant_id])->sum('snapshot_uviews'),
                'No. of Usage' => Snapshot::where(['blurb_id' => $id, 'campaign_id' => $request->campaign_id, 'snapshot_date' => $db, 'merchant_id' => $blurb->merchant_id])->sum('snapshot_usage'),
            ];
        }

        $generator = new GenerateReport();

        $report_type = array(
            $request->cam_status . ' Campaign Report' => $data,
        );

        $generator->generate($report_type, 'Blurb Report');

        return redirect()->back();
    }

    /**
     * Get SnapShot by attributes last seven days.
     *
     * @param array $attributes
     * @param string $field
     * @return SnapShot
     */
    public function getLastSevenDays($blurb_id, $field)
    {
        $blurb = $this->blurb->getById($blurb_id);

        return $this->snapShot->getByAttributesLastSevenDays(['blurb_id' => $blurb_id, 'merchant_id' => $blurb->merchant_id], $field);
    }

    /**
     * Get dates between blurb start and blurb end.
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
