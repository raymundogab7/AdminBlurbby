<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use Admin\Http\Requests;
use Admin\Repositories\Interfaces\PageInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Auth;

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
