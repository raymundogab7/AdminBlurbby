<?php

namespace Admin\Http\Controllers;

use Admin\Repositories\Interfaces\PageInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Auth;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @var PageInterface
     */
    protected $page;

    /**
     * @var RestaurantInterface
     */
    protected $restaurant;

    /**
     * Create a new controller instance.
     *
     * @param PageInterface $outlet

     * @return void
     */
    public function __construct(PageInterface $page, RestaurantInterface $restaurant)
    {
        $this->page = $page;
        $this->restaurant = $restaurant;
    }

    /**
     * Display tutorials page
     *
     * @return Redirect
     */
    public function index($id)
    {
        $data['page'] = $this->page->getById($id);

        return view('pages.index', $data);
    }

    /**
     * Display tutorials page
     *
     * @return Redirect
     */
    public function update($id, Request $request)
    {
        if ($this->page->updateById($id, $request->except('_token', '_method'))) {
            return redirect('pages/' . $id . '/edit')->with('message', 'Successfully updated.');
        }

        return redirect('pages/' . $id . '/edit')->with('error', 'Error while updating.');
    }

    /**
     * Upload image to server.
     *
     * @return Response
     */
    public function upload(Request $request)
    {

        $target_dir = "ckfinder/userfiles/images/";

        $target_file = $target_dir . basename($_FILES["upload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        $check = getimagesize($_FILES["upload"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
                echo "Image successfully uploaded.";
            }

            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    /**
     * Get page by id.
     *
     * @return Redirect
     */
    public function show($id)
    {
        return $this->page->getById($id);
    }

    /**
     * Display tutorials page
     *
     * @return Redirect
     */
    public function tutorials()
    {
        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false);
        $data['tutorials'] = $this->page->getById(1);

        return view('page.tutorials', $data);
    }

    /**
     * Display FAQs page
     *
     * @return Redirect
     */
    public function faqs()
    {
        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false);
        $data['faqs'] = $this->page->getById(2);

        return view('page.faqs', $data);
    }

    /**
     * Display Terms of Use page
     *
     * @return Redirect
     */
    public function terms()
    {
        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false);
        $data['terms'] = $this->page->getById(3);

        return view('page.terms', $data);
    }

    /**
     * Display Privacy Policy page
     *
     * @return Redirect
     */
    public function privacPolicy()
    {
        $data['restaurant'] = $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false);

        return view('page.privacy_policy', $data);
    }
}
