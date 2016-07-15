<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Admin\Repositories\Interfaces\AdminInterface;
use Admin\Http\Requests;

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
            'admin_count' => $this->admin->getAllByAttributes(['role_id' => 1], 'first_name'),
            'super_admin_count' => $this->admin->getAllByAttributes(['role_id' => 2], 'first_name'),
        );

        return view('administrators.index', $data);
    }
}
