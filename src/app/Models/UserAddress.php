<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * class UserAddress
 * desc  user_addressテーブル操作クラス
 */
class UserAddress extends Model
{
    use HasFactory;

    protected $table = "user_address";
    public $timestamps = false;
    protected $primaryKey = "id";

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
     * 特定のgenderのデータだけを取ってくる
     *
     * @param $gender
     * @return mixed
     */
    public static function getForGender($gender)
    {
        $model = self::where('gender', $gender)->get();  //where(カラム,
        return $model;
    }

    //idからレコード抽出
    public static function getForId($id)
    {
        $model = self::where('id', $id)->get();
        return $model;
    }

    public static function getAllData() //getAllDataをつくって
    {
        $Data = self::get(); //$dataをつくってgetで自分自身つまりUseraddressからデータをもってくる
        return $Data;
    }

    //編集後の更新
    public function updateName($name, $isSave=true)
    {
        $this->name = $name;
        if ($isSave) {
            $this->save();
        }
    }
    public function updateGender($gender, $isSave=true)
    {
        $this->gender = $gender;
        if ($isSave) {
            $this->save();
        }
    }
    public function updateEmail($email, $isSave=true)
    {
        $this->email = $email;
        if ($isSave) {
            $this->save();
        }
    }
    public function updateContent($content, $isSave=true)
    {
        $this->content = $content;
        if ($isSave) {
            $this->save();
        }
    }

}
