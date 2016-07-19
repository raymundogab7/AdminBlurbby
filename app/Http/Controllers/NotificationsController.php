<?php

namespace Admin\Http\Controllers;

use Admin\Repositories\Interfaces\CampaignInterface;
use Admin\Repositories\Interfaces\NotificationInterface;
use Admin\Repositories\Interfaces\RestaurantInterface;
use Auth;
use Illuminate\Http\Request;

class NotificationsController extends Controller
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
     * @var NotificationInterface
     */
    protected $notification;

    /**
     * Create a new controller instance.
     *
     * @param CampaignInterface $campaign

     * @return void
     */
    public function __construct(CampaignInterface $campaign, RestaurantInterface $restaurant, NotificationInterface $notification)
    {
        $this->campaign = $campaign;
        $this->restaurant = $restaurant;
        $this->notification = $notification;
    }

    /**
     * Display campaign page.
     *
     * @return View
     */
    public function index()
    {

        $data = array(
            'restaurant' => $this->restaurant->getByAttributes(['merchant_id' => Auth::user()->id], false),
//          'campaigns' => $this->campaign->getAllByAttributes(['merchant_id' => Auth::user()->id], 'updated_at', 'DESC'),
            'campaigns' => $this->notification->get(),
        );

        return view('notifications.index', $data);
    }

    /**
     * Update a campaign.
     *
     * @return Redirect
     */
    public function updateNotifToRead($id, Request $request)
    {
        if ($this->notification->updateById($id, $request->all())) {
            return response()->json(['result' => true]);
        }

        return response()->json(['result' => false]);
    }

    /**
     * Update a notification.
     *
     * @return Redirect
     */
    public function updateStatus($notification_id)
    {
        if ($this->notification->updateById($id, $request->all())) {
            return redirect('notifications')->with('message', 'Successfully updated.');
        }

        return redirect('notifications')->with('message_error', 'Error while updating campaign. Please try again.');
    }
}
