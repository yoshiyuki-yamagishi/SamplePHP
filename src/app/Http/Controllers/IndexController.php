<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Services\IndexService;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController
{
    /**
     * Index画面表示
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public static function index(Request $request) //フォームに入力したデータをすべて渡しす。それを$requestとする。
    {
        $param = $request->all();
        return view('index', $param);        //ここでトップを変えた
    }

    /**
     * formから入力された時
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public static function form(Request $request)  //requestファザード　httpリクエスト、データをもってきたり送信したりを簡単にする
    {
        $param_0 = $request->all(); //入力データをすべてparamにいれる
        $param = preg_replace( '/　|\s+/', '', $param_0);
        $response = IndexService::saveData($param['name'], $param['email'], $param['gender'], $param['content']);


        /*
            // email verify
            $emailVerify = false;
            if ($param['email'] == 'sample@example.com') {
                $emailVerify = true;
            }
            $passwordVerify = false;
            if ($param['password'] == 'nomunomu') {
                $passwordVerify = true;
            }

            if ($emailVerify && $passwordVerify) {
                return view('login', $param);
            } else {
                return view('logout', $param);
            }
        */

        return view('form3', $response);

    }

    //追加
    public static function dataList(Request $request)
    {
        $param_0 = $request->all(); //入力データをすべてparamにいれる
        $param = preg_replace( '/　|\s+/', '', $param_0);

        $data = IndexService::getDataList();
        $response = [
            'dataList' => $data
        ];

        return view('formData', $response);
    }

    //追加
    public static function dataEdit(Request $request)
    {
        $param_0 = $request->all(); //入力データをすべてparamにいれる
        $param = preg_replace( '/　|\s+/', '', $param_0);
    }

    //編集ボタンからレコードを抽出
    public static function getDataEdit(Request $request)
    {
        $param = $request->all(); //入力データをすべてparamにいれる
        $editId = $param["id"]; //$editIdにIdが入った$paramと定義する
        $response = IndexService::editData($editId); //
        return view('formDataEdit', $response);
    }


    //更新ボタンを押したとき
    public static function updateData(Request $request)
    {
        $param_0 = $request->all(); //入力データをすべてparamにいれる
        $param = preg_replace( '/　|\s+/', '', $param_0);
        $response = IndexService::updateData($param);
        //return view('form3', $response);
        return redirect()->route('dataList');
    }


}

