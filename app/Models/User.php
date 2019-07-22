<?php

namespace App\Models;

use Spatie\MediaLibrary\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasRoles;
    use Notifiable;
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','first_name','last_name','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    function recipients(){
        return $this->hasMany(Recipient::class);
    }

    function details(){
        return $this->hasOne(UserDetail::class);
    }

    function items(){
        return $this->hasMany(Item::class);
    }

    function invoices(){
        return $this->hasMany(Invoice::class);
    }

    function generateToken()
    {
        $token = Str::random(60);
        $this->api_token = hash('sha256', $token);
        $this->save();

        return $this->api_token;
    }

    function registerMediaCollections()
    {
        return $this
            ->addMediaCollection('company-logo')
            ->singleFile();
    }

    function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(368)
              ->height(232)
              ->sharpen(10);
    }

    public function getFirstOrDefaultMediaUrl(string $collectionName = 'default', string $conversionName = '')
    {
        $url = '/img/avatar/avatar-01.jpg';
        if($this->getFirstMedia($collectionName))
            $url = $this->getFirstMedia($collectionName)->getFullUrl();

        return $url ? $url : '/img/avatar/avatar-01.jpg' ?? '';
    }

    function hasCompleteProfile(){
        return (($this->details && $this->details->business_name && $this->details->business_name) || $this->hasRole("Super Admin")) ? true : false;
    }
}
