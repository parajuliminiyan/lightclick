<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','email','password','address','phone','gender','dob','post ','image','user_id','likeable_id','likeable_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function posts(){

        return $this->hasMany('App\Post');

    }

        public function likes(){
            return $this->hasMany('App\Like', 'user_id');
        }

        function comment(){
            return $this->hasMany('App\comment');
        }

        public function friendOfMine(){

            return $this->belongsToMany('App\User','friends','user_id','friend_id');
        }

        public function friendof(){
            return $this->belongsToMany('App\User','friends','friend_id','user_id');
        }

        public function friends(){

            return $this->friendOfMine()->wherePivot('accepted',true)->get()->merge($this->friendof()->wherePivot('accepted',true)->get());
        }

        public function friendRequests(){
            return $this->friendOfMine()->wherePivot('accepted', false)->get();

        }

        public function friendRequestPending(){
            return $this->friendof()->wherePivot('accepted',false)->get();
        }

        public function hasFriendRequestPending(User $user){
            return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
        }

        public function hasFriendRequestRecived(User $user){
            return (bool) $this->friendRequests()->where('id',$user->id)->count();
        }

        public function addFriend(User $user){
            $this->friendof()->attach($user->id);
        }

        public function acceptFriendRequest(User $user){
            $this->friendRequests()->where('id',$user->id)->first()->pivot->update([
                'accepted' => true,
            ]);

        }

        public function isFriendsWith(User $user){
            return (bool) $this->friends()->where('id',$user->id)->count();
        }

        public function hasLikedPost(Post $post){
            return (bool) $post->likes()
                ->where('likeable_id',$post->id)
                ->where('likeable_type',get_class($post))
                ->where('user_id',$this->id)
                ->count();
        }
}
