<?php

namespace Admin\Http\Controllers;

use Admin\Http\Requests\FeaturedSectionRequest;
use Admin\Repositories\Interfaces\BlurbInterface;
use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\FeaturedSectionInterface;
use Admin\Repositories\Interfaces\MerchantInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Repositories\Interfaces\SnapShotInterface;
use Admin\Services\ImageUploader;
use Admin\SnapShot;
use Illuminate\Http\Request;

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
            'featured_sections' => $this->featuredSection->getAll(['merchant'], 'position'),
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
            'merchant' => $this->merchant->getAll(),
            'slides_count' => $this->featuredSection->getCount(),
        );

        return view('featured_section.create', $data);
    }

    /**
     * Create a featured request.
     *
     * @param FeaturedSectionRequest $request
     * @return Redirect
     */
    public function store(FeaturedSectionRequest $request, ImageUploader $imageUploader)
    {

        $file = $request->file('slide_image_temp');

        if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
            return Response::json(array(
                'code' => 404,
                'message' => 'Invalid format',
            ), 404);
        }

        $featured_sections = $this->featuredSection->all();

        $new_featured_sections = array();
        $idk = false;
        foreach ($featured_sections as $key => $value) {

            if ($value['position'] == $request->position) {

                $new_featured_sections[] = ['merchant_id' => $request->merchant_id, 'position' => $request->position, 'slide_image' => 'image_slides/' . ($this->featuredSection->getCount() + 1) . '/' . ($this->featuredSection->getCount() + 1) . '.jpg', 'status' => $request->status, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')];

                $idk = true;
            }

            if ($idk) {
                $value['position'] = $value['position'] + 1;
                $new_featured_sections[] = $value;
            } else {
                $new_featured_sections[] = $value;
            }

        }

        $this->featuredSection->deleteAll();
        foreach ($new_featured_sections as $key => $value) {
            $this->featuredSection->create(['merchant_id' => $value['merchant_id'], 'position' => $value['position'], 'slide_image' => $value['slide_image'], 'status' => $value['status']]);
        }

        return redirect('featured-section')->with('message', 'Created Successfully.');
    }

    /**
     * Display featured section page.
     *
     * @param integer $id
     * @return View
     */
    public function edit($id)
    {
        $data = array(
            'featured_section' => $this->featuredSection->getByIdWithRelations($id, ['merchant']),
            'merchant' => $this->merchant->getAll(),
            'featured_sections' => $this->featuredSection->getAll(['merchant'], 'position'),
        );

        return view('featured_section.edit', $data);
    }

    /**
     * Update a certain featured section.
     *
     * @param integer $id
     * @param FeaturedSectionRequest $request
     * @param ImageUploader $imageUploader
     * @return View
     */
    public function update($id, FeaturedSectionRequest $request, ImageUploader $imageUploader)
    {
        $this->featuredSection->updateById($id, ['status' => $request->status]);

        $file = $request->file('slide_image_temp');

        if ($file != null) {
            if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
                return redirect('featured-section/' . $id . '/edit/')->with('error', 'Uploaded image is not valid.');
            }

            $imageUploader->upload($file, $request->position, 500, 500, 'image_slides/', '/' . $request->position . '.jpg');
        }

        $to_update = $this->featuredSection->getByAttributes(['position' => $request->position], false);

        $findSelected = $this->featuredSection->getById($id);

        $request->merge(['slide_image' => $findSelected->slide_image]);

        if ($this->featuredSection->updateById($to_update->id, ['position' => $findSelected->position])) {

            $this->featuredSection->updateById($id, ['position' => $to_update->position]);

            return redirect('featured-section')->with('message', 'Updated Successfully.');
        }

        /*$to_update = $this->featuredSection->getByAttributes(['position' => $request->position], false);

        $findSelected = $this->featuredSection->getById($id);

        $request->merge(['slide_image' => $findSelected->slide_image]);

        if ($this->featuredSection->updateById($to_update->id, $request->except(['_token', '_method', 'featured_section_id', 'position', 'slide_image_temp']))) {
        //if ($request->position != $findSelected->position) {
        $this->featuredSection->updateById($id, ['merchant_id' => $to_update->merchant_id, 'slide_image' => $to_update->slide_image, 'status' => $to_update->status, 'created_at' => $to_update->created_at, 'updated_at' => $request->updated_at]);
        //}

        return redirect('featured-section')->with('message', 'Updated Successfully.');
        }*/

        return redirect('featured-section')->withInput();
    }

    /**
     * Update positing of image slide
     *
     * @param integer $id
     * @return View
     */
    public function move($merchant_id, $id, $direction)
    {
        if ($direction == 'down') {
            $to_update = $this->featuredSection->getById($id);

            $findSelected = $this->featuredSection->getByAttributes(['position' => $to_update->position + 1], false);

            $this->featuredSection->updateById($id, ['position' => $findSelected->position]);

            $this->featuredSection->updateById($findSelected->id, ['position' => $to_update->position]);
        } else {
            $to_update = $this->featuredSection->getById($id);

            $findSelected = $this->featuredSection->getByAttributes(['position' => $to_update->position - 1], false);

            $this->featuredSection->updateById($id, ['position' => $findSelected->position]);

            $this->featuredSection->updateById($findSelected->id, ['position' => $to_update->position]);
        }

        return redirect('featured-section')->with('message', 'Updated Successfully.');
        /* if ($direction == 'down') {

        if ($id == 1) {
        $findById = $this->featuredSection->getById($id);
        $findById2 = $this->featuredSection->getById(2);
        $to_update = $this->featuredSection->updateByAttributes(['id' => 2], ['merchant_id' => $findById->merchant_id], false);
        $to_update = $this->featuredSection->updateByAttributes(['id' => 1], ['merchant_id' => $findById2->merchant_id], false);
        }

        if ($id == 2) {
        $findById = $this->featuredSection->getById($id);
        $findById2 = $this->featuredSection->getById(3);
        $to_update = $this->featuredSection->updateByAttributes(['id' => 3], ['merchant_id' => $findById->merchant_id], false);
        $to_update = $this->featuredSection->updateByAttributes(['id' => 2], ['merchant_id' => $findById2->merchant_id], false);
        }
        } else {
        if ($id == 2) {
        $findById = $this->featuredSection->getById($id);
        $findById2 = $this->featuredSection->getById(1);
        $to_update = $this->featuredSection->updateByAttributes(['id' => 1], ['merchant_id' => $findById->merchant_id], false);
        $to_update = $this->featuredSection->updateByAttributes(['id' => 2], ['merchant_id' => $findById2->merchant_id], false);
        }

        if ($id == 3) {
        $findById = $this->featuredSection->getById($id);
        $findById2 = $this->featuredSection->getById(2);
        $to_update = $this->featuredSection->updateByAttributes(['id' => 2], ['merchant_id' => $findById->merchant_id], false);
        $to_update = $this->featuredSection->updateByAttributes(['id' => 3], ['merchant_id' => $findById2->merchant_id], false);
        }
        }*/

        return redirect('featured-section')->withInput();
    }
}
