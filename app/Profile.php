<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'title', 'description', 'url' , 'image',
    ];

    public function profileImage()
    {   
        $imagePath = ($this->image) ?  $this->image : 'uploads/ACAny2u2QD1zqq8wGj18UuDl1EU3soOyj14Oipo2.png';
        return '/storage/'. $imagePath;
    }
    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
