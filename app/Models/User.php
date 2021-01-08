<?php

namespace App\Models;

use App\Services\JwtAuthTrait;
use App\Services\ModelTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,ModelTrait,JwtAuthTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','phone','password','openid','nickname','avatar','sex','address','status_type','sign_up_time','status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * uid获取小程序Openid
     * @param string $uid
     * @return bool|mixed
     */
    public static function getOpenId($uid = '')
    {
        if ($uid == '') return false;
        return self::where('id', $uid)->first('openid');
    }


    /**
     * 小程序创建用户后返回uid
     * @param $routineInfo
     * @return mixed
     */
    public static function routineOauth($routine)
    {
        $routineInfo['nickname'] = filter_emoji($routine['nickName']);//姓名
        $routineInfo['sex'] = $routine['gender'];//性别
        $routineInfo['language'] = $routine['language'];//语言
        $routineInfo['city'] = $routine['city'];//城市
        $routineInfo['province'] = $routine['province'];//省份
        $routineInfo['country'] = $routine['country'];//国家
        $routineInfo['avatar'] = $routine['avatarUrl'];//头像
        $routineInfo['openid'] = $routine['openId'];//openid
        $routineInfo['session_key'] = $routine['session_key'];//会话密匙
        $routineInfo['unionid'] = $routine['unionId'];//用户在开放平台的唯一标识符


        $isCOde = false;
        //获取是否有扫码进小程序


        if ($routine['code']) {
            if ($info = RoutineQrcode::getRoutineQrcodeFindType($routine['code'])) {
                $spid = $info['third_id'];
                $isCOde = true;
            } else
                $spid = $routine['spid'];
        } else if ($routine['spid'])
            $spid = $routine['spid'];




        //  判断unionid  存在根据unionid判断
        if ($routineInfo['unionid'] != '' &&
            ($uid = self::where(['unionid' => $routineInfo['unionid']])->where('user_type', '<>', 'h5')->value('uid'))
        ) {
            self::edit($routineInfo, $uid, 'uid');
            $routineInfo['code'] = $spid;
            $routineInfo['isPromoter'] = $isCOde;
            if ($routine['login_type']) $routineInfo['login_type'] = $routine['login_type'];
            User::updateWechatUser($routineInfo, $uid);


        } else if (
        $uid = self::where(['routine_openid' => $routineInfo['routine_openid']])->where('user_type', '<>', 'h5')->value('uid')
        ) { //根据小程序openid判断
            self::edit($routineInfo, $uid, 'uid');
            $routineInfo['code'] = $spid;
            $routineInfo['isPromoter'] = $isCOde;
            if ($routine['login_type']) $routineInfo['login_type'] = $routine['login_type'];
            unset($routineInfo['nickname']);
            User::updateWechatUser($routineInfo, $uid);

        } else {
            $routineInfo['add_time'] = time();//用户添加时间
            $routineInfo = self::create($routineInfo);
            $res = User::setRoutineUser($routineInfo, $spid);
            $uid = $res->uid;

        }
        return $uid;
    }




    public static function loginAction($phone,$password)
    {
        $user=self::where('phone',$phone)->first();
        if(!$user){
           return  self::setErrorInfo('用户不存在');
        }
        if(md5($password)!==$user['password']){
           return self::setErrorInfo('密码错误');
        }
        if($user['status']==0){
            return self::setErrorInfo('账号已停用');
        }

        return $user;
    }

}
