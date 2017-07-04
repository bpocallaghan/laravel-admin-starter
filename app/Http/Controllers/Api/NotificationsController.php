<?php

namespace App\Http\Controllers\Api;

use App\Models\LogActivity;
use App\Models\Notification;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NotificationsController extends ApiController
{
    /**
     * Get all the notifications for a user
     * @param User $user
     * @param bool $unread
     * @return array
     */
    public function index(User $user, $unread = false)
    {
        $notifications = [];
        $rows = $user->notifications;
        if ($unread) {
            $rows = $user->unreadNotifications;
        }

        foreach ($rows as $k => $notification) {
            $notifications[] = [
                'id'         => $notification->id,
                'created_at' => $notification->created_at->format('l d F H:i'),
                'type'       => $notification->type,
                'message'    => $notification->data['message'],
                'read_at'    => $notification->read_at,
                'user_id'    => $user->id,
            ];
        }

        return json_response($notifications);
    }

    /**
     * Get all the unread notifications
     * @param User $user
     * @return array
     */
    public function unread(User $user)
    {
        return $this->index($user, 'unread');
    }

    /**
     * Read a notification
     * @param User         $user
     * @param Notification $notification
     * @return array
     */
    public function read(User $user, Notification $notification)
    {
        $notification->markAsRead();

        return $this->index($user, 'unread');
    }

    /**
     * Get the latest Website Actions
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLatestActions()
    {
        $activities = LogActivity::getLatestMinutes(12 * 60);

        $items = [];
        foreach ($activities as $k => $item) {
            $items [] = [
                'id'         => $item->id,
                'title'      => $item->title,
                'message'    => $item->description,
                'created_at' => $item->created_at->diffForHumans(),
            ];
        }

        return json_response($items);
    }
}