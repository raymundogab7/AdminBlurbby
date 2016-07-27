<?php

namespace Admin\Http\Controllers;

use Admin\Repositories\Interfaces\BlurbReportInterface;

class BlurbReportController extends Controller
{
    /**
     * @var BlurbReportInterface
     */
    protected $blurbReport;

    /**
     * Create a new controller instance.
     *
     * @param BlurbReportInterface $blurbReport
     * @return void
     */
    public function __construct(BlurbReportInterface $blurbReport)
    {
        $this->blurbReport = $blurbReport;
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
