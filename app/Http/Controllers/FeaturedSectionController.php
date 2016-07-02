<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;
use Admin\Http\Requests\FeaturedSectionRequest;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\MerchantInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Repositories\Interfaces\BlurbInterface;
use Admin\Http\Requests;
use Auth;
use Admin\Services\ImageUploader;
use Admin\Repositories\Interfaces\SnapShotInterface;
use Admin\Repositories\Interfaces\FeaturedSectionInterface;
use Admin\Services\GenerateReport;
use Admin\SnapShot;

class FeaturedSectionController extends Controller
{
    
    /**
     * @var CampaignInterface
     */
    protected $campaign;

    /**
     * @var RestaurantInterface
     */
    protected $restaurant;

    /**
     * @var BlurbInterface
     */
    protected $blurb;

    /**
     * @var SnapShotInterface
     */
    protected $snapShot;

    /**
     * @var FeaturedSectionInterface
     */
    protected $featuredSection;

    /**
     * @var MerchantInterface
     */
    protected $merchant;

    /**
     * Create a new controller instance.
     *
     * @param CampaignInterface $campaign
	 * @param RestaurantInterface $restaurant
     * @param BlurbInterface $blurb
     * @param SnapShotInterface $snapShot
     * @param FeaturedSectionInterface $featuredSection
     * @param MerchantInterface $merchant
     * @return void
     */
    public function __construct(CampaignInterface $campaign, RestaurantInterface $restaurant, BlurbInterface $blurb, SnapShotInterface $snapShot, FeaturedSectionInterface $featuredSection, MerchantInterface $merchant)
    {
        $this->campaign = $campaign;
        $this->restaurant = $restaurant;
        $this->blurb = $blurb;
        $this->snapShot = $snapShot;
        $this->featuredSection = $featuredSection;
        $this->merchant = $merchant;
    }

    /**
     * Display featured section index page.
     *
     * @return View
     */
    public function index()
    {
    	$data = array(
			'featured_section' => $this->featuredSection->getAll(['merchant'], 'position')
		);

        return view('featured_section.index', $data);
    }

    /**
     * Display featured section create page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'merchant' => $this->merchant->getAll()
        );

        return view('featured_section.create', $data);
    }

    /**
     * Create a featured request.
     *
     * @param FeaturedRequest $request
     * @return Redirect
     */
    public function store(FeaturedSectionRequest $request, ImageUploader $imageUploader)
    {
        $file = $request->file('slide_image');
        
        if ($this->featuredSection->updateByAttributes(['position' => $request->position], $request->except('_token'))) {

            if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
                return Response::json(array(
                    'code' => 404,
                    'message' => 'Invalid format',
                ), 404);
            }

            $imageUploader->upload($file, $request->position, 500, 500, 'image_slides/', '/'.$request->position.'.jpg');

            return redirect('featured-section/create');
        }

        return redirect('featured-section/create')->withInput();
    }

    /**
     * Display featured section page.
     *
     * @return View
     */
    public function view($control_no, $cam_status)
    {
        $campaign = $this->campaign->getByAttributes(['control_no' => $control_no], false);
        $data = array(
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false),
            'campaign' => $campaign,
            'blurbs' => $this->blurb->getAllByAttributes(['merchant_id' => Auth::user()->id, 'campaign_id' => $campaign->id, 'blurb_status' => ucfirst($cam_status)], 'created_at', 'DESC'),
            'featured_section' => $this->featuredSection->getAll('position')
        );

        return view('blurb.view_blurbs', $data);
    }
}
