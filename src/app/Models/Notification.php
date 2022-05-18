<?php

namespace App\Models;

use App\Mail\NotificationSentMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'channel',
        'content',
        'clientId'
    ];

    /**
     * Get the clients that owns the notification.
     */
    public function getClients()
    {
        return $this->belongsTo(Client::class);
    }
}
