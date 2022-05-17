<?php


namespace App\Http\Controllers;

use App\Http\Middleware\ApiHelpers;
use App\Models\Client;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    use ApiHelpers;
    public function addNotifications(Request $request)
    {
        $validator = Validator::make($request->all(), $this->notificationValidatedRules());
        if ($validator->passes()) {

            if (!Client::Find($request->clientId)) {
                return $this->onError(404, 'Client not found by id.');
            }

            if ($request->channel === "sms") {
                $request->validate([
                    'content' => ['required', 'string', 'max:140']
                ]);
            }

            $notification = Notification::create([
                'clientId'  =>  $request->clientId,
                'channel'  =>  $request->channel,
                'content'  =>  $request->get('content'), // use ->get() because "content" declare in ORM
            ]);

            return $this->onSuccess($notification, 'Notification Created');
        }
        return $this->onError(400, $validator->errors());
    }

    public function getNotification(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->oneNotificationValidatedRules());
        if ($validator->passes()) {
            $notification = Notification::Find($request->id);
            if (!$notification) {
                return $this->onError(404, 'Notification not found by id.');
            }
            return $this->onSuccess($notification);
        }
        return $this->onError(400, $validator->errors());
    }

    public function getPaginatedNotifications(Request $request)
    {
        $validator = Validator::make($request->all(), $this->notificationFiltredValidatedRules());
        if ($validator->passes()) {
            $notifications = Notification::paginate(10);
            if ($request->clientId) {
                if (!Client::Find($request->clientId)) {
                    return $this->onError(404, 'Client not found by id.');
                }
                $notifications = Notification::where('clientId', $request->clientId)->paginate(10);
            }
            return $this->onSuccess($notifications);
        }
        return $this->onError(400, $validator->errors());
    }
}
