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
    public static function index(Request $request)
    {
        $param = $request->all();
        return view('index', $param);
    }

    /**
     * formから入力された時
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public static function form(Request $request)
    {
        $param_0 = $request->all();
        $param = preg_replace( '/　|\s+/', '', $param_0);
        $response = IndexService::saveData($param['name'], $param['email'], $param['gender'], $param['content']);

        return view('form3', $response);

    }


    /*
     *データ一覧を表示
     */
    public static function dataList(Request $request)
    {
        $param_0 = $request->all();
        $param = preg_replace( '/　|\s+/', '', $param_0);

        $data = IndexService::getDataList();
        $response = [
            'dataList' => $data
        ];

        return view('formData', $response);
    }

    public static function dataEdit(Request $request)
    {
        $param_0 = $request->all();
        $param = preg_replace( '/　|\s+/', '', $param_0);
    }

    /*
     * 編集ボタン
     */
    public static function getDataEdit(Request $request)
    {
        $param = $request->all();
        $editId = $param["id"];
        $response = IndexService::editData($editId);
        return view('formDataEdit', $response);
    }


    /*
     * 更新
     */
    public static function updateData(Request $request)
    {
        $param_0 = $request->all();
        $param = preg_replace( '/　|\s+/', '', $param_0);
        $response = IndexService::updateData($param);
        //return view('form3', $response);
        return redirect()->route('dataList');
    }


}

