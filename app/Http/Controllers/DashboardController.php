<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use Admin\Http\Requests;
use Admin\Http\Controllers\Controller;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Auth;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\SnapShotInterface;
use Admin\Repositories\Interfaces\MerchantInterface;

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
     * @var MerchantInterface
     */
    protected $merchant;

    /**
     * Create a new controller instance.
     *
     * @param CampaignInterface $campaign
     * @param RestaurantInterface $restaurant
     * @param SnapShotInterface $snapShot
     * @param MerchantInterface $merchant
     * @return void
     */
    public function __construct(CampaignInterface $campaign, RestaurantInterface $restaurant, SnapShotInterface $snapShot, MerchantInterface $merchant)
    {
        $this->campaign = $campaign;
        $this->restaurant = $restaurant;
        $this->snapShot = $snapShot;
        $this->merchant = $merchant;
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
            'totalSnapShotLikes' => $this->snapShot->getAllWithSum('snapshot_likes'),
            'uniqueViews' => $this->snapShot->getAllWithSum('snapshot_uviews'),
            'blurbsUsage' => $this->snapShot->getAllWithSum('snapshot_usage'),
            'thisWeekTotalLikes' => $this->snapShot->getAllThisWeek('snapshot_likes'),
            'thisWeekTotalViews' => $this->snapShot->getAllThisWeek('snapshot_uviews'),
            'thisWeekTotalUsage' => $this->snapShot->getAllThisWeek('snapshot_usage'),
            'lastWeekTotalLikes' => $this->snapShot->getAllLastWeek('snapshot_likes'),
            'lastWeekTotalViews' => $this->snapShot->getAllLastWeek('snapshot_uviews'),
            'lastWeekTotalUsage' => $this->snapShot->getAllLastWeek('snapshot_usage'),
            'totalLiveCampaigns' => $this->campaign->getCount(),
            'thisWeekTotalLiveCampaignLikes' => $this->campaign->getAllThisWeek(['cam_status' => 'Live']),
            'lastWeekTotalLiveCampaignLikes' => $this->campaign->getAllLastWeek(['cam_status' => 'Live']),

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
