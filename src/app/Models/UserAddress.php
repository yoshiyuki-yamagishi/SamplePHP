<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = "user_address";
    public $timestamps = false;


    /**
     * データの保存
     *
     * @param $name
     * @param $email
     * @param $gender
     * @param $content
     * @return UserAddress
     */
    public static function insert($name, $email, $gender, $content)
    {
        $model = new self();
        $model->name = $name;
        $model->email = $email;
        $model->gender = $gender;
        $model->content = $content;
        $model->save();

        return $model;
    }
    /**
     * 指定したgenderのデータ取得
     *
     * @param $gender
     * @return mixed
     */
    public static function getForGender($gender)
    {
        $model = self::where('gender', $gender)->get();  //where(カラム,
        return $model;
    }

    public function updateGender($gender)
    {
        $this->gender = $gender;
        $this->save();
    }

    public static function getAllData()             //getAllDataをつくって
    {
        $Data = self::get();        //$dataをつくってgetで自分自身つまりUseraddressからデータをもってくる
        return $Data;
    }
}
