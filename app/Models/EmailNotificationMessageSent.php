<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailNotificationMessageSent extends Model
{
    use HasFactory;

    protected $table = "email_notification_messages_sent";
}
