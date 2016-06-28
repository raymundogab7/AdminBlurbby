<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Admin\Http\Requests\BlurbRequest;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Repositories\Interfaces\BlurbInterface;
use Admin\Http\Requests;
use Auth;
use Admin\Services\ImageUploader;
use Admin\Repositories\Interfaces\SnapShotInterface;
use Admin\Services\GenerateReport;
use Admin\SnapShot;

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
     * Create a new controller instance.
     *
     * @param CampaignInterface $campaign
	 * @param RestaurantInterface $restaurant
     * @param BlurbInterface $blurb
     * @param SnapShotInterface $snapShot
     * @return void
     */
    public function __construct(CampaignInterface $campaign, RestaurantInterface $restaurant, BlurbInterface $blurb, SnapShotInterface $snapShot)
    {
        $this->campaign = $campaign;
        $this->restaurant = $restaurant;
        $this->blurb = $blurb;
        $this->snapShot = $snapShot;
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
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false),
            'campaign' => $campaign,
            'blurbs' => $this->blurb->getAllByAttributes(['merchant_id' => Auth::user()->id, 'campaign_id' => $campaign->id, 'blurb_status' => ucfirst($cam_status)], 'created_at', 'DESC')
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
        $data = array(
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false),
            'campaign' => $this->campaign->getByAttributes(['control_no' => $control_no], false),
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
        $request->merge(array('merchant_id' => Auth::user()->id, 'campaign_id' => $request->campaign_id));

        if ($request->control_no != "") {
            $this->blurb->updateByAttributes(['control_no' => $request->control_no], $request->except('_token'));

            return redirect('campaign/' . $request->campaign_id);
        }

        $this->blurb->create($request->all());

        return redirect('campaign/'.$request->campaign_id);
    }

    /**
     * Display view blurb page.
     *
     * @param integer $id
     * @return View
     */
    public function show($id, $control_no)
    {
        $campaign = $this->campaign->getByAttributes(['merchant_id' => Auth::user()->id, 'control_no' => $control_no], false);

        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false);
        $data['campaign'] = $this->campaign->getById($campaign->id);
        $data['blurb'] = $this->blurb->getById($id);

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
        $campaign = $this->campaign->getByAttributes(['merchant_id' => Auth::user()->id, 'control_no' => $control_no], false);

        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false);
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
        if($this->blurb->updateById($id, $request->all())){
             return redirect('blurb/'.$id.'/'.$request->control_no)->with('message', 'Successfully updated.');
        }

        return redirect('blurb/'.$id.'/'.$request->control_no)->withInput()->with('message_error', 'Error while deleting campaign. Please try again.');
    }

    /**
     * Update a blurb.
     *
     * @return Redirect
     */
    public function destroy($id, $campaign_id)
    {
        if($this->blurb->delete($id)) {
            return redirect('campaign/'.$campaign_id)->with('message', 'Successfully deleted.');
        }

        return redirect('campaign/'.$campaign_id)->withInput()->with('message_error', 'Error while deleting campaign. Please try again.');
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
        $result = $this->blurb->create(['merchant_id' => Auth::user()->id,'campaign_id' => $campaign_id, 'blurb_logo' => 'blurb.png', 'control_no' => $control_no]);
        
        $user_id = Auth::user()->id;

        if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
            return Response::json(array(
                'code' => 404,
                'message' => 'Invalid format',
            ), 404);
        }

        $this->blurb->updateByAttributes(['merchant_id' => $user_id, 'campaign_id' => $campaign_id], ['blurb_logo' => 'campaigns/' . $campaign_id.'/'.$result->id.'.png']);

         $imageUploader->upload($file, $campaign_id, 500, 500, 'campaigns/', '/'.$result->id.'.png');

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
        
        $user_id = Auth::user()->id;

        if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
            return Response::json(array(
                'code' => 404,
                'message' => 'Invalid format',
            ), 404);
        }

        //$this->blurb->updateByAttributes(['merchant_id' => $user_id, 'campaign_id' => $campaign_id], ['blurb_logo' => 'campaigns/' . $campaign_id.'/'.$result->id.'.png']);
        $this->blurb->updateById($id, ['blurb_logo' => 'campaigns/'.$campaign_id.'/'.$id.'.png']);

        $imageUploader->upload($file, $campaign_id, 500, 500, 'campaigns/', '/'.$id.'.png');

        return ['blurb' => true];
    }

    /**
     * Generate Campaign report.
     *
     * @return Redirect
     */
    public function generateReport(Request $request)
    {
        $blurb = $this->blurb->getAllByAttributesWithRelations(['campaign_id' => $request->campaign_id, 'blurb_status' => $request->blurb_status, 'merchant_id' => Auth::user()->id], ['campaign'], 'blurb_name');
        $count_likes = 0;
        
        $c = array_map(function($structure) use ($count_likes){

            return [
                'Campaign Name' => $structure['campaign']['campaign_name'],
                'Blurb Title' => $structure['blurb_name'],
                'Category' => $structure['blurb_category'],
                'Status' => $structure['blurb_status'],
                'Start Date' => $structure['blurb_start'],
                'End Date' => $structure['blurb_end'],
                'No. of Likes' => Snapshot::where(['blurb_id' => $structure['id'], 'merchant_id' => Auth::user()->id])->sum('snapshot_likes'),
                'No. of Unique Views' => Snapshot::where(['blurb_id' => $structure['id'], 'merchant_id' => Auth::user()->id])->sum('snapshot_uviews'),
                'No. of Usage' => Snapshot::where(['blurb_id' => $structure['id'], 'merchant_id' => Auth::user()->id])->sum('snapshot_usage'),
            ];
        }, $blurb);
        
        
        $generator = new GenerateReport();

        $report_type = array(
            $request->blurb_status . ' Blurb Report' => array_filter($c),
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
    public function getLastSevenDays($blurb_id, $field)
    {
        return $this->snapShot->getByAttributesLastSevenDays(['blurb_id' => $blurb_id, 'merchant_id' => Auth::user()->id], $field);
    }
}
