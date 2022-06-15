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
    public static function saveData($name, $email, $gender, $content)
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

//追加
    public static function getDataList()
    {
        $data = UserAddress::getAllData();
        $responseList = [];
        foreach ($data as $val) {
            $setData = [
                'name' => $val->name,
                'email' => $val->email,
                'gender' => self::$genderStr[$val->gender],
                'content' => $val->content,
            ];
            $responseList[] = json_decode(json_encode($setData));
        }

        return $responseList;
    }






    public function _saveData($name, $email, $gender, $content)
    {
        // データを保存
        $userAddress = UserAddress::insert($name, $email, $gender, $content);

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
