<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Admin\Repositories\Interfaces\AdminInterface;
use Admin\Http\Requests;
use Admin\Http\Requests\AdministratorRequest;
use Admin\Services\ImageUploader;

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
     * Display create administrators page.
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
    public function store(AdministratorRequest $request, ImageUploader $imageUploader)
    {
        if(is_null($request->file('profile_photo'))) {
            return redirect('administrators/create')->with('error', 'The profile photo is required.')->withInput();
        }

        $file = $request->file('profile_photo');

        if(!$file->isValid()) {
            return redirect('administrators/create')->with('error', 'Profile photo file size is too large.')->withInput();
        }

        if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
            return redirect('administrators/create')->with('error', 'Invalid Format')->withInput();
        }

        $request->merge(['status' => 'Pending Admin Approval', 'date_of_birth' => date_format(date_create($request->date_of_birth), 'Y-m-d')]);

        $new_admin = $this->admin->create($request->except('_token'));

        $imageUploader->upload($file, $new_admin->id, 500, 500, 'profile_photo/', '/' . $new_admin->id . '.jpg');

        return redirect('administrators/create')->with('messsage', 'Successfully Created.');
    }

    /**
     * Display edit administrators page.
     *
     * @return View
     */
    public function edit($id)
    {
        return view('administrators.edit', ['admin' => $this->admin->getById($id)]);
    }

    /**
     * Store a new administrator.
     *
     * @param AdministratorRequest $request
     * @return View
     */
    public function update($id, AdministratorRequest $request, ImageUploader $imageUploader)
    {

        $file = $request->file('profile_photo');

        if(!is_null($file)) {
            return redirect('administrators/create')->with('error', 'The profile photo is required.')->withInput();

            if(!$file->isValid()) {
                return redirect('administrators/create')->with('error', 'Profile photo file size is too large.')->withInput();
            }

            if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
                return redirect('administrators/create')->with('error', 'Invalid Format')->withInput();
            }

            $imageUploader->upload($file, $id, 500, 500, 'profile_photo/', '/' . $id . '.jpg');
        }
        
        $request->merge(['date_of_birth' => date_format(date_create($request->date_of_birth), 'Y-m-d')]);

        $this->admin->updateByAttributes(['id' => $id], $request->except('_token'));

        return redirect('administrators/'.$id.'/edit')->with('messsage', 'Successfully Created.');
    }
}