<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\userInvoice;
use App\Models\recipient;
use App\Models\Member;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'role',
        'username',
        'realname',
        'birthday',
        'gender',
        // 'credits',
        'phone',
        // 'ext',
        'email',
        'password',
        'status'
    ];

    public function invoice(){
        return $this->hasMany(userInvoice::class);
    }

    public function recipient(){
        
        return $this->hasMany(UserRecipient::class);
    }

    public static function newOne(){
        $user = new User();
        $data = array_combine(
            $user->getFillable(),
            array_fill(0, count($user->getFillable()), '')
        );
        $user->fill($data);

        return $user;
    }

    public static function exist($email){
        $u = User::where(['email'=>$email])->first();
        if ($u == null) return FALSE;

        $s = ['inreview', 'normal', 'block'];
        if (in_array($u->status, $s)) return TRUE;
        
        $u->delete();
        return FALSE;
    }


    /*
        指派的業務
    */
    public function manage_user(){
        return $this->belongsToMany(Member::class, 'user_managers', 'user_id', 'member_id', 'id', 'id');
    }

    //後台使用 使用with()先撈出值的情況下
    public function manager_array(){
        $data = array();
        foreach ($this->manage_user as $t) {
            $data[] = $t->id;
        }
        return $data;
    }

    //Update
    public function manager_refresh($new_arr){
        $this->manage_user()->detach($this->manager_array());
        if ($new_arr == null || $new_arr == '') return;
        foreach ($new_arr as $item) {
            $this->manage_user()->attach($item);
        }
    }

}
