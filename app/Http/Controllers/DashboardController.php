<?php

namespace Admin\Http\Controllers;

use Admin\Http\Controllers\Controller;
use Admin\Repositories\Interfaces\AppUserInterface;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\MerchantInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Repositories\Interfaces\SnapShotInterface;
use Admin\Services\GenerateReport;
use Admin\SnapShot;
use Auth;
use Illuminate\Http\Request;

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
     * @var AppUserInterface
     */
    protected $appUser;

    /**
     * Create a new controller instance.
     *
     * @param CampaignInterface $campaign
     * @param RestaurantInterface $restaurant
     * @param SnapShotInterface $snapShot
     * @param MerchantInterface $merchant
     * @param AppUserInterface $appUser
     * @return void
     */
    public function __construct(CampaignInterface $campaign, RestaurantInterface $restaurant, SnapShotInterface $snapShot, MerchantInterface $merchant, AppUserInterface $appUser)
    {
        $this->campaign = $campaign;
        $this->restaurant = $restaurant;
        $this->snapShot = $snapShot;
        $this->merchant = $merchant;
        $this->appUser = $appUser;
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
            'campaigns' => $this->campaign->getAllByAttributesWithRelations(['cam_status' => 'Live'], ['restaurant', 'blurb'], 'created_at', 'DESC'),
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
            'totalMerchants' => $this->merchant->getTotalCount(),
            'lastWeekMerchants' => $this->merchant->getAllLastWeek(),
            'thisWeekMerchants' => $this->merchant->getAllThisWeek(),
            'totalAppUser' => $this->appUser->getCount(),
            'lastWeekAppUser' => $this->appUser->getAllLastWeek(),
            'thisWeekAppUser' => $this->appUser->getAllThisWeek(),

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

    /**
     * Generate Merchant report.
     *
     * @return Redirect
     */
    public function generateReport(Request $request)
    {
        $campaign = $this->campaign->getAllWithRelations(['blurb', 'snapshot', 'merchant'], 'campaign_name', 'ASC', ['cam_status' => 'Live']);

        $count_likes = 0;

        $c = array_map(function ($structure) use ($count_likes) {

            return [
                'Merchant Name' => $structure['merchant']['coy_name'],
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
            $request->cam_status . ' Live Campaign Report' => array_filter($c),
        );
        $generator->generate($report_type);

        return redirect()->back();
    }
}
