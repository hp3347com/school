<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2020/12/11
 * Time: 17:30
 */
namespace App\Services;

use Firebase\JWT\JWT;


trait JwtAuthTrait
{
    /**
     * @param string $type
     * @param array $params
     * @return array
     */
    public function getToken(string $type,array $params=[]):array
    {
        $id = $this->getJWTIdentifier(); //获取主键
        $host = request()->getHost();
        $time = time();

        $params +=[
            'iss'=>$host, //签发者
            'aud'=>$host, //接受该jwt的一方
            'iat'=>$time, //签发时间
            'nbf'=>$time,   ////(Not Before)：某个时间点后才能访问，比如设置time+30，表示当前时间30秒后才能使用
            'exp'=>$time+86400 ,
        ];

        $params['jti'] = compact('id','type');
        $token = JWT::encode($params,env('JWT_SECRET'));
        return compact('token', 'params');
    }

    public static function parseToken(string $jwt)
    {
        JWT::$leeway=60;
        $data = JWT::decode($jwt,env('JWT_SECRET'),array('HS256'));
        $model = new self();
        return [$model->where('id',$data->jti->id)->first(),$data->jti->type];
    }
}