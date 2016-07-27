<?php

namespace Admin\Http\Controllers;

use Admin\Repositories\Interfaces\BlurbReportInterface;
use Admin\Repositories\Interfaces\MerchantInterface;
use Admin\Services\Mailer;

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
     * Create a new controller instance.
     *
     * @param BlurbReportInterface $blurbReport
     * @param MerchantInterface $merchant
     * @return void
     */
    public function __construct(BlurbReportInterface $blurbReport, MerchantInterface $merchant)
    {
        $this->blurbReport = $blurbReport;
        $this->merchant = $merchant;
    }

    /**
     * Display administrators page.
     *
     * @return View
     */
    public function index()
    {
        $data = array(
            'blurb_reports' => $this->blurbReport->getAll(['notified' => 0]),
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

        if ($this->blurbReport->update($id, ['notified' => 1])) {
            $send = $mailer->send('emails.blurb_report', 'Your Blurb Has Been Reported', $data[0]);

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
