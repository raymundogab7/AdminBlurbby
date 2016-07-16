<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Admin\Repositories\Interfaces\AdminInterface;
use Admin\Http\Requests;
use Admin\Http\Requests\AdministratorRequest;

class AdministratorController extends Controller
{
	/**
     * @var AdminInterface
     */
    protected $admin;

    public function __construct(AdminInterface $admin)
    {
    	$this->admin = $admin;
    }

    /**
     * Display administrators page.
     *
     * @return View
     */
    public function index()
    {
        $data = array(
            'admins' => $this->admin->getAll(),
            'administrators' => $this->admin->paginate(),
            'admin_count' => $this->admin->getAllByAttributes(['role_id' => 1], 'first_name'),
            'super_admin_count' => $this->admin->getAllByAttributes(['role_id' => 2], 'first_name'),
        );

        return view('administrators.index', $data);
    }

    /**
     * Get search result page.
     *
     * @return View
     */
    public function getSearchResult($search_word, $search_type)
    {
        $data = array(
            'admins' => $this->admin->getAll(),
            'administrators' => $this->admin->search($search_word, $search_type),
            'admin_count' => $this->admin->getAllByAttributes(['role_id' => 1], 'first_name'),
            'super_admin_count' => $this->admin->getAllByAttributes(['role_id' => 2], 'first_name'),
            'search_word' => $search_word,
            'search_type' => $search_type,
        );
        return view('administrators.search', $data);
    }

    /**
     * Display administrators page.
     *
     * @return View
     */
    public function create()
    {
        return view('administrators.create');
    }

    /**
     * Store a new administrator.
     *
     * @param AdministratorRequest $request
     * @return View
     */
    public function store(AdministratorRequest $request)
    {
        $request->merge(['status' => 'Pending Admin Approval']);

        $this->admin->create($request->except('_token'));
    }
}
