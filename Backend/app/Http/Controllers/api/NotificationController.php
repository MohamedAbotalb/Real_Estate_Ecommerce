<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function showLandlordNotifications($landlord_id)
    {
        $notifications = Notification::where('landlord_id', $landlord_id)
            ->whereIn('type', ['request'])
            ->get();

        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No notifications found for the landlord'], 404);
        }

        return response()->json(['data' => $notifications], 200);
    }
    public function showRenterNotifications($renter_id)
    {
        $notifications = Notification::where('user_id', $renter_id)
            ->whereIn('type', ['confirmation', 'cancelation'])
            ->get();

        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No notifications found for the renter'], 404);
        }

        return response()->json(['data' => $notifications], 200);
    }
}
