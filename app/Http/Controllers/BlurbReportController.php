<?php

namespace Admin\Http\Controllers;

use Admin\BlurbReport;
use Admin\Repositories\Interfaces\BlurbReportInterface;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\MerchantInterface;
use Admin\Repositories\Interfaces\NotificationInterface;
use Admin\Services\Mailer;
use Auth;

class BlurbReportController extends Controller
{
    /**
     * @var BlurbReportInterface
     */
    protected $blurbReport;

    /**
     * @var MerchantInterface
     */
    protected $merchant;

    /**
     * @var NotificationInterface
     */
    protected $notification;

    /**
     * @var CampaignInterface
     */
    protected $campaign;

    /**
     * Create a new controller instance.
     *
     * @param BlurbReportInterface $blurbReport
     * @param MerchantInterface $merchant
     * @param NotificationInterface $notification
     * @param CampaignInterface $campaign
     * @return void
     */
    public function __construct(BlurbReportInterface $blurbReport, MerchantInterface $merchant, NotificationInterface $notification, CampaignInterface $campaign)
    {
        $this->blurbReport = $blurbReport;
        $this->merchant = $merchant;
        $this->notification = $notification;
        $this->campaign = $campaign;
    }

    /**
     * Display administrators page.
     *
     * @return View
     */
    public function index()
    {
        $data = array(
            'blurb_reports' => $this->blurbReport->getAll(),
        );

        return view('blurb_report.index', $data);
    }

    /**
     * Notify merchant.
     *
     * @param integer $id
     * @return View
     */
    public function notify($id, Mailer $mailer)
    {
        $blurb_report = $this->blurbReport->getById($id);

        $data = $this->merchant->getByAttributes(['id' => $blurb_report->merchant_id]);

        $campaign = $this->campaign->getById($blurb_report->campaign_id);

        if ($this->blurbReport->update($id, ['notified' => 1])) {
            date_default_timezone_set('UTC');
            $notif = $this->notification->create(['merchant_id' => $blurb_report->merchant_id, 'campaign_id' => $blurb_report->campaign_id, 'admin_id' => Auth::user()->id, 'status' => $campaign->cam_status, 'seen' => 0, 'blurb_report' => $blurb_report->blurb_id]);
            $data[0]['blurb_name'] = $blurb_report->blurb_name;
            $send = $mailer->send('emails.blurb_report', 'Your Blurb ' . $blurb_report->blurb_name . ' Has Been Reported', $data[0]);

            return response()->json(['result' => true, 'message' => 'Merchant has been notified.']);
        }

        return response()->json(['result' => false, 'message' => 'Merchant is already notified.']);
    }

    /**
     * Delete a blurb report.
     *
     * @return Redirect
     */
    public function destroy($id)
    {
        if ($this->blurbReport->delete($id)) {
            return response()->json(['result' => true, 'message' => 'Successfully deleted.']);
        }

        return response()->json(['result' => false, 'message' => 'Error while deleting campaign. Please try again.']);
    }
}
