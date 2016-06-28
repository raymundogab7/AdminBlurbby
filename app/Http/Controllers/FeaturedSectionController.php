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
use Admin\Repositories\Interfaces\FeaturedSectionInterface;
use Admin\Services\GenerateReport;
use Admin\SnapShot;

class FeaturedSectionController extends Controller
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
     * @var FeaturedSectionInterface
     */
    protected $featuredSection;

    /**
     * Create a new controller instance.
     *
     * @param CampaignInterface $campaign
	 * @param RestaurantInterface $restaurant
     * @param BlurbInterface $blurb
     * @param SnapShotInterface $snapShot
     * @return void
     */
    public function __construct(CampaignInterface $campaign, RestaurantInterface $restaurant, BlurbInterface $blurb, SnapShotInterface $snapShot, FeaturedSectionInterface $featuredSection)
    {
        $this->campaign = $campaign;
        $this->restaurant = $restaurant;
        $this->blurb = $blurb;
        $this->snapShot = $snapShot;
        $this->featuredSection = $featuredSection;
    }

    /**
     * Display blurb page.
     *
     * @return View
     */
    public function index()
    {
    	/*$data = array(
    			'featured_section' => $this->featuredSection->
    		);*/
        return view('featured_section.index');
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
}
