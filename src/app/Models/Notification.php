<?php

namespace App\Models;

use App\Http\Controllers\API\Swagger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    use Swagger;

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
