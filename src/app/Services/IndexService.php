<?php

namespace App\Services;

use App\Models\UserAddress;

class IndexService
{
    public static $name = "static index_service";
    public $_name = "local index_service";

    public static $genderStr = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
    ];

    /**
     * formのデータを保存
     *
     * @param $name
     * @param $email
     * @param $gender
     * @param $content
     * @return array
     */
    public static function saveData($name, $email, $gender, $content,)
    {
        // データを保存
        $userAddress = UserAddress::insert($name, $email, $gender, $content);

        // 男性のデータをとる
        $maleData = UserAddress::getForGender(1);
        $genderStr = [
            1 => '男性',
            2 => '女性',
            3 => '漢女',
        ];


        $response = [
            'name' => $userAddress->name,
            'email' => $userAddress->email,
            'gender' => $genderStr[$userAddress->gender],
            'content' => $userAddress->content,
            'maleCount' => $maleData->count()
        ];
        return $response;
    }

    public static function getDataList()
    {
        $data = UserAddress::getAllData();
        $responseList = [];
        foreach ($data as $val) { //繰り返し処理
            $setData = [
                'name' => $val->name,
                'email' => $val->email,
                'gender' => self::$genderStr[$val->gender],
                'content' => $val->content,
                'id' => $val->id,
            ];
            $responseList[] = json_decode(json_encode($setData));
        }

        return $responseList;
    }

    public static function editData($editId) //データ編集
    {
/*        $userAddressList = UserAddress::getForId($editId);
        $userAddress = $userAddressList->first();*/
        $userAddress = UserAddress::find($editId); //UserAddressから$editIdの一つを見つけてくる

        $response = [
            'id' => $userAddress->id,
            'name' => $userAddress->name,
            'email' => $userAddress->email,
            'gender' => $userAddress->gender,
            'content' => $userAddress->content,
        ];
        return $response;
    }

    public static function updateData($param)
    {
        $userAddress = UserAddress::find($param["id"]);

        $userAddress->updateName($param["name"], false);
        $userAddress->updateGender($param["gender"], false);
        $userAddress->updateEmail($param["email"], false);
        $userAddress->updateContent($param["content"]);

        $response = [
            'id' => $userAddress->id,
            'name' => $userAddress->name,
            'email' => $userAddress->email,
            'gender' => $userAddress->gender,
            'content' => $userAddress->content,
            'maleCount' => 0
        ];
        return $response;
    }

    public static function updateName($id, $name)
    {
        $userAddress = UserAddress::find($id);
        $userAddress->name = $name;
        $userAddress->save();

    }


    public function _saveData($name, $email, $gender, $content)
    {
        // データを保存
        $userAddress = UserAddress::insert($name, $email, $gender, $content,);

        // 男性のデータをとる
        $maleData = UserAddress::getForGender(1);
        $firstData = $maleData->first(); //first()メソッドでデータを取得
        $firstData->updataGender(2);
        $firstData->gender = 2;
        $firstData->save();

        $genderStr = [
            1 => '男性',
            2 => '女性',
            3 => '漢女',
        ];
        $response = [
            'name' => $userAddress->name,
            'email' => $userAddress->email,
            'gender' => $genderStr[$userAddress->gender],
            'content' => $userAddress->content,
            'maleCount' => $maleData->count()
        ];
        return $response;
    }
}
