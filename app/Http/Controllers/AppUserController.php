<?php

namespace Admin\Http\Controllers;

use Admin\Repositories\Interfaces\AppUserInterface;
use Admin\Services\GenerateReport;
use Illuminate\Http\Request;

class AppUserController extends Controller
{
    /**
     * @var AppUserInterface
     */
    protected $appUser;

    /**
     * Create a new controller instance.
     *
     * @param AdminInterface $admin
     * @return void
     */
    public function __construct(AppUserInterface $appUser)
    {
        $this->appUser = $appUser;
    }

    /**
     * Display administrators page.
     *
     * @return View
     */
    public function index()
    {
        $data = array(
            'app_users' => $this->appUser->getAll(),
            'app_user_paginate' => $this->appUser->paginate(),
            'total_app_users' => $this->appUser->getCount(),
            'total_registered_last_thirty_days' => $this->appUser->getTotalMonth(),
            'total_last_online_thirty_days' => $this->appUser->getLastOnlineTotalMonth(),
            'total_last_thirty_days' => $this->appUser->getTotalMonth(),
            'total_approved_app_users' => $this->appUser->getCountByStatus('Approved'),
            'total_pending_app_users' => $this->appUser->getCountByStatus('Pending Email Verification'),
            'total_blocked_app_users' => $this->appUser->getCountByStatus('Blocked'),
        );

        return view('app_user.index', $data);
    }

    /**
     * Display search result page.
     *
     * @param string $search_word
     * @param string $search_type
     * @return View
     */
    public function getSearchResult($search_word, $search_type)
    {
        $data = array(
            'app_users' => $this->appUser->getAll(),
            'app_user_paginate' => $this->appUser->search($search_word, $search_type),
            'total_app_users' => $this->appUser->getCount(),
            'total_registered_last_thirty_days' => $this->appUser->getTotalMonth(),
            'total_last_online_thirty_days' => $this->appUser->getLastOnlineTotalMonth(),
            'total_last_thirty_days' => $this->appUser->getTotalMonth(),
            'total_approved_app_users' => $this->appUser->getCountByStatus('Approved'),
            'total_pending_app_users' => $this->appUser->getCountByStatus('Pending Email Verification'),
            'total_blocked_app_users' => $this->appUser->getCountByStatus('Blocked'),
            'search_word' => $search_word,
            'search_type' => $search_type,
        );

        return view('app_user.search', $data);
    }

    /**
     * Generate Merchant report.
     *
     * @return Redirect
     */
    public function generateReport(Request $request)
    {
        $appUsers = $this->appUser->getAll();

        $a = array_map(function ($structure) {

            return [
                'App User Name' => $structure['first_name'] . ' ' . $structure['last_name'],
                'Status' => $structure['status'],
                'Joined Date' => date_format(date_create($structure['created_at']), 'd-M-Y'),
                'Last Online Date' => date_format(date_create($structure['last_online']), 'd-M-Y'),
                'Last Online Time' => date_format(date_create($structure['last_online']), 'H:i:s'),
                'Gender' => $structure['gender'],
                'Date of Birth.' => date_format(date_create($structure['date_of_birth']), 'd-M-Y'),
                'Email' => $structure['email'],
            ];
        }, $appUsers);

        $generator = new GenerateReport();

        $report_type = array(
            'App Users Report' => array_filter($a),
        );

        $generator->generate($report_type, "App Users List");

        return redirect()->back();
    }
}
