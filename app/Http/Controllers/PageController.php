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
        if ($this->page->updateById($id)) {
            return redirect('pages')->with('message', 'Successfully updated.');
        }

        return redirect('pages')->with('error', 'Error while updating.');
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
