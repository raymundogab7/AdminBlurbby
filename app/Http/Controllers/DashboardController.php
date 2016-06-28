<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use Admin\Http\Requests;
use Admin\Http\Controllers\Controller;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Auth;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\SnapShotInterface;

class DashboardController extends Controller
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
     * @var SnapShotInterface
     */
    protected $snapShot;

    /**
     * Create a new controller instance.
     *
     * @param CampaignInterface $campaign

     * @return void
     */
    public function __construct(CampaignInterface $campaign, RestaurantInterface $restaurant, SnapShotInterface $snapShot)
    {
        $this->campaign = $campaign;
        $this->restaurant = $restaurant;
        $this->snapShot = $snapShot;
    }

    /**
     * Display dashboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($this->snapShot->getByAttributesLastSevenDays(['merchant_id' => Auth::user()->id], 'snapshot_likes'));die;
        $data = array(
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false),
            'campaigns' => $this->campaign->getAllByAttributesWithRelations(['merchant_id' => Auth::user()->id, 'cam_status' => 'Live'], ['restaurant', 'blurb'], 'created_at', 'DESC'),
            'snapShotLikes' => $this->snapShot->getByAttributesWithSum(['merchant_id' => Auth::user()->id], 'snapshot_likes'),
            'uniqueViews' => $this->snapShot->getByAttributesWithSum(['merchant_id' => Auth::user()->id], 'snapshot_uviews'),
            'blurbsUsage' => $this->snapShot->getByAttributesWithSum(['merchant_id' => Auth::user()->id], 'snapshot_usage'),
            'thisWeekLikes' => $this->snapShot->getByAttributesThisWeek(['merchant_id' => Auth::user()->id], 'snapshot_likes'),
            'thisWeekViews' => $this->snapShot->getByAttributesThisWeek(['merchant_id' => Auth::user()->id], 'snapshot_uviews'),
            'thisWeekUsage' => $this->snapShot->getByAttributesThisWeek(['merchant_id' => Auth::user()->id], 'snapshot_usage'),
            'lastWeekLikes' => $this->snapShot->getByAttributesLastWeek(['merchant_id' => Auth::user()->id], 'snapshot_likes'),
            'lastWeekViews' => $this->snapShot->getByAttributesLastWeek(['merchant_id' => Auth::user()->id], 'snapshot_uviews'),
            'lastWeekUsage' => $this->snapShot->getByAttributesLastWeek(['merchant_id' => Auth::user()->id], 'snapshot_usage'),
        );
        
        return view('dashboard.index', $data);
    }

    /**
     * Get SnapShot by attributes last seven days.
     *
     * @param array $attributes
     * @param string $field
     * @return SnapShot
     */
    public function getLastSevenDays($field)
    {
        return $this->snapShot->getByAttributesLastSevenDays(['merchant_id' => Auth::user()->id], $field);
    }
}
