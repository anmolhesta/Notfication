<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Notification;
use App\Notifications\UserApproved;

class NotificationController extends Controller
{

    public function __construct()
    {

    }

    public function sendNotification(Request $request) {

        $Data = $request['user'];
        $user = User::whereId($Data['id'])->first();
        if(empty($user)){;
            User::create([
                'id' => $Data['id'],
                'name' => $Data['name'],
                'email' => $Data['email'],
                'password' => '',
            ]);
            Notification::send($user,new UserApproved($Data));
        }else {
            Notification::send($user,new UserApproved($Data));
        }
    }
}
