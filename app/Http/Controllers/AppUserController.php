<?php

namespace Admin\Http\Controllers;

use Admin\Http\Requests\AppUserRequest;
use Admin\Repositories\Interfaces\AppUserInterface;
use Admin\Services\GenerateReport;
use Admin\Services\ImageUploader;
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
     * Display app users page.
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
     * Display create app user page.
     *
     * @return View
     */
    public function create()
    {
        return view('app_user.create');
    }

    /**
     * Display edit app user page.
     *
     * @return View
     */
    public function edit($id)
    {
        $data = array(
            'app_user' => $this->appUser->getById($id),
        );

        return view('app_user.edit', $data);
    }

    /**
     * Store an app user.
     *
     * @param AppUserRequest $request
     * @param ImageUploader $imageUploader
     * @return View
     */
    public function store(AppUserRequest $request, ImageUploader $imageUploader)
    {
        if (is_null($request->file('profile_photo'))) {
            return redirect('app-users/create')->with('error', 'The profile photo is required.')->withInput();
        }

        $file = $request->file('profile_photo');

        if (!$file->isValid()) {
            return redirect('app-users/create')->with('error', 'Profile photo file size is too large.')->withInput();
        }

        if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
            return redirect('app-users/create')->with('error', 'Invalid Format')->withInput();
        }

        $request->merge(['date_created' => 'Y-m-d', 'status' => 'Pending Email Approval', 'date_of_birth' => date_format(date_create($request->date_of_birth), 'Y-m-d')]);

        $new_app_user = $this->appUser->create($request->except('_token'));

        $this->appUser->updateByAttributes(['id' => $new_app_user->id], ['profile_photo' => 'app_user_profile_photo/' . $new_app_user->id . '/' . $new_app_user->id . '.' . $file->getClientOriginalExtension()]);

        $imageUploader->upload($file, $new_app_user->id, 128, 128, 'app_user_profile_photo/', '/' . $new_app_user->id . '.' . $file->getClientOriginalExtension());

        return redirect('app-users')->with('message', 'Successfully Created.');
    }

    /**
     * Update an app user.
     *
     * @param integer $id
     * @param AppUserRequest $request
     * @param ImageUploader $imageUploader
     * @return View
     */
    public function update($id, AppUserRequest $request, ImageUploader $imageUploader)
    {
        if (!is_null($request->file('profile_photo'))) {
            $file = $request->file('profile_photo');

            if (!$file->isValid()) {
                return redirect('app-users/' . $id . '/edit')->with('error', 'Profile photo file size is too large.')->withInput();
            }

            if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
                return redirect('app-users/' . $id . '/edit')->with('error', 'Invalid Format')->withInput();
            }

            $imageUploader->upload($file, $new_app_user->id, 128, 128, 'app_user_profile_photo/', '/' . $new_app_user->id . '.' . $file->getClientOriginalExtension());
        }

        $request->merge(['date_of_birth' => date_format(date_create($request->date_of_birth), 'Y-m-d')]);

        $this->appUser->updateByAttributes(['id' => $id], $request->except('_token', '_method', 'app_user_id', 'password_confirmation'));

        return redirect('app-users/' . $id . '/edit')->with('message', 'Successfully Updated.');
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
