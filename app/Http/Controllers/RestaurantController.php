<?php
/*use Admin\Http\Requests\ImageRequest;*/
namespace Admin\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Admin\Http\Requests\RestaurantRequest;
use Admin\Repositories\Interfaces\RestaurantCuisineInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Admin\Services\ImageUploader;
use Response;

class RestaurantController extends Controller
{
    /**
     * @var RestaurantInterface
     */
    protected $restaurant;

    /**
     * @var RestaurantCuisineInterface
     */
    protected $restaurantCuisine;

    /**
     * Create a new controller instance.
     *
     * @param RestaurantInterface $restaurant
     * @return void
     */
    public function __construct(RestaurantInterface $restaurant, RestaurantCuisineInterface $restaurantCuisine)
    {
        $this->restaurant = $restaurant;
        $this->restaurantCuisine = $restaurantCuisine;
    }

    /**
     * Edit an merchant profile restaurant.
     *
     * @param integer $id
     * @param Outlet $request
     * @return Redirect
     */
    public function update($id, RestaurantRequest $request)
    {
        $this->restaurantCuisine->deleteByAttributes(['restaurant_id' => $request->restaurant_id], $request->res_cuisine);
       
        if ($this->restaurant->updateById($id, $request->all())) {

            foreach ($request->res_cuisine as $key => $value) {

                if (!$this->restaurantCuisine->getByAttributes(['restaurant_id' => $id, 'cuisine_id' => $value])) {
                    $this->restaurantCuisine->create(['restaurant_id' => $id, 'cuisine_id' => $value]);
                }
            }

            return redirect('merchants/'.$request->merchant_id.'/edit')->with('message', 'Successfully updated.');
        }

        return redirect('merchants/'.$request->merchant_id.'/edit')->withInput();
    }

    /**
     * Upload photo for merchant profile picture.
     *
     * @param integer $id
     * @param Outlet $request
     * @param ImageUploader $imageUploader
     * @return Redirect
     */
    public function uploadProfilePicture(Request $request, ImageUploader $imageUploader)
    {
        $file = $request->file('file');

        $user_id = Auth::user()->id;

        if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
            return Response::json(array(
                'code' => 404,
                'message' => 'Invalid format',
            ), 404);
        }

        $this->restaurant->updateByAttributes(['merchant_id' => $user_id], ['res_logo' => 'uploads/' . $user_id]);

        return $imageUploader->upload($file, $user_id, 128, 128, 'uploads/');
    }

    /**
     * Upload photo for merchant cover photo.
     *
     * @param integer $id
     * @param Outlet $request
     * @param ImageUploader $imageUploader
     * @return Redirect
     */
    public function uploadCoverPhoto(Request $request, ImageUploader $imageUploader)
    {
/*
$fileArray = array('file' => $file);

$user_id = Auth::user()->id;*/

        $file = $request->file('file');

        $user_id = Auth::user()->id;

        if (!in_array($file->getClientOriginalExtension(), array('gif', 'png', 'jpg', 'jpeg', 'PNG', 'JPG'))) {
            return Response::json(array(
                'code' => 404,
                'message' => 'Invalid format',
            ), 404);
        }

        $this->restaurant->updateByAttributes(['merchant_id' => $user_id], ['res_logo_background' => 'uploads/' . $user_id]);

        return $imageUploader->upload($file, $user_id, 500, 500, 'uploads/', '/cover_photo.jpg');
    }
}
