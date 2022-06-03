<?php
/**
 * 定数設定
 *
 */

namespace App\Config;

/**
 * 定数一元管理用
 *
 */
class Constants {

    /** 基本系  **/
    const OFF_FLG = 0;
    const ON_FLG = 1;

    // 審査環境URL
    const JUDGE_URL = "bbdw-judge.azurewebsites.net";

    // 画像ベースパス
    const IMG_PATH = '/web/img/';
    const CSS_PATH = '/web/css/';
    const JS_PATH = '/web/js/';

    // 環境名
    const PRODUCT = 'product'; //本番
    const DEVELOP = 'develop'; // AWS環境
    const STAGE = 'azure_stg'; // STG環境
    const JUDGE = 'azure_judge'; // 審査環境
    const AZURE_REVIEW = 'azure_review'; // レビュー環境
    const AZURE_DEV = 'azure_dev'; // DEV環境
    const DOCKER_REVIEW = 'docker_review'; // kakarot環境
    const DOCKER = 'docker'; //　ローカル環境

    // Azureサーバ仕様ENV名
    const AZURE_SERVER_ENV_LIST = [
        self::PRODUCT => true,
        self::JUDGE => true,
        self::STAGE => true,
        self::AZURE_REVIEW => true,
        self::AZURE_DEV => true,
    ];

    // OSタイプ
    const OS_TYPE_NONE = 0;
    const OS_TYPE_ANDROID = 1;  // Unityもここに含まれるが区別されてないので、無視します・・・
    const OS_TYPE_IOS = 2;

    // OSタイプ名
    const OS_TYPE_NAME = [
        self::OS_TYPE_NONE => "",
        self::OS_TYPE_ANDROID => "Android",
        self::OS_TYPE_IOS => "iOS",
    ];

    // Platform
    const PLATFORM_ANDROID = 1;
    const PLATFORM_IOS = 2;
    const PLATFORM_WEB = 4;
    const PLATFORM_LIST = [
        self::PLATFORM_IOS,
        self::PLATFORM_ANDROID,
    ];

    //事前処理判定時間
    const CHECK_PRE_EXEC_DATE = '2021-05-06 15:00:00';
    const CHECK_PRE_EXEC_DATE_2 = '2021-04-28 15:00:00';
    const CHECK_PRE_EXEC_DATE_3 = '2021-05-20 15:00:00';
    const CHECK_PRE_EXEC_DATE_4 = '2021-06-10 15:00:00';
    const CHECK_PRE_EXEC_DATE_5 = '2021-09-09 15:00:00';
    const CHECK_PRE_EXEC_DATE_6 = '2021-10-14 15:00:00';
    const CHECK_GRIMOIRE_PANEL_CHECK_START_AT = '2021-03-18 15:00:00';
    const CHECK_GRIMOIRE_PANEL_CHECK_END_AT = '2021-03-25 15:00:00';
    const CHECK_QUEST_PANEL_CHECK_END_AT = '2021-04-01 15:00:00';
    const CHECK_GRIMOIRE_EVENT_ID = 90105;
    const CHECK_EXTRA_BAN_LIST_DATE = '2021-06-03 14:00:00';
    const CHECK_PANEL_ID = 90005;

    //ボーナスタイプ
    const BONUS_TYPE_EXP = 1;
    const BONUS_TYPE_MONEY = 2;
    //固定と抽選ドロップ両方
    const BONUS_TYPE_ALL_DROP = 3;
    const BONUS_TYPE_CHARA_EXP = 4;
    //固定のみ
    const BONUS_TYPE_FIX_DROP = 5;
    //抽選ドロップのみ
    const BONUS_TYPE_DROP = 6;

    // ログイン状態定数
    const LOGIN_SAME_DAYS = 0;
    const LOGIN_NEW_DAYS_CONTINUE = 1;
    const LOGIN_NEW_DAYS_RESTART = 2;

    // クエスト種類
    const QUEST_CATEGORY_ALL = 0; // 全て
    const QUEST_CATEGORY_STORY = 1; // ストーリ
    const QUEST_CATEGORY_CHARACTER = 2; // キャラクタ
    const QUEST_CATEGORY_EVENT = 3; // イベント
    // クエスト難易度
    const QUEST_DIFFICULTY_NORMAL = 0;
    const QUEST_DIFFICULTY_HARD = 1;

    //キャラクエスト確定枠
    const NOT_SUBSCRIBE_CHARACTER_QUEST_FIX_REWARD_COUNT = 1;
    // ストーリークエストのチュートリアル枠
    const STORY_QUEST_TUTORIAL_ID_START = 99001;
    const STORY_QUEST_TUTORIAL_ID_END = 99999;

    //アイテム所持上限値
    const DEFAULT_NUM_LIMIT = 99999999; //基本的な所持上限値
    const CRISTAL_NUM_LIMIT = 99999999; //フレンドポイントの所持限界値
    const PLATINUM_DOLLAR_NUM_LIMIT = 99999999999; //P$の所持上限値
    const MAGIC_NUM_LIMIT = 99999999; //魔素の所持限界値
    const POWDER_NUM_LIMIT = 99999999; //欠片の所持限界値
    const FRIEND_POINT_NUM_LIMIT = 99999999; //フレンドポイントの所持限界値
    const ITEM_LIMIT_NUM = 99999; //アイテム全般の所持限界値
    //アイテムタイプ
    const ITEM_TYPE_CHARACTER = 1;
    const ITEM_TYPE_GRIMOIRE = 2;
    const ITEM_TYPE_ITEM = 3;
    //アイテムブロードカテゴリータイプ
    const ITEM_BROAD_CATEGORY_MONEY = 1;
    const ITEM_BROAD_CATEGORY_ITEM = 2;
    const ITEM_BROAD_CATEGORY_HEAL = 3;
    const ITEM_BROAD_CATEGORY_ORB = 4;
    const ITEM_BROAD_CATEGORY_PIECE = 5;

    //ミッションタイプ
    const MISSION_TYPE_DAILY = 1; // 1：デイリー
    const MISSION_TYPE_NORMAL = 2; // 2：ノーマル
    const MISSION_TYPE_EVENT = 3; // 3：イベント
    const MISSION_TYPE_QUEST = 4; // 4：クエスト達成ミッション
    const MISSION_TYPE_BEGINNER = 5; // 5：初心者

    // 引継ぎコード作成施行回数
    const TRANSIT_CODE_CREATE_TRY_MAX = 100;
    // 引継ぎコード文字数
    const TRANSIT_CODE_STR_NUM = 10;
    // 引継ぎコード再発行可能スパン
    const TRANSIT_SPAN_TTL = 60*3; // 3m
    // 引継ぎコード期限（1日）
    const TRANSIT_CODE_EXPIRE = 60 * 60 * 24;

    // メッセージ系
    const SHOP_CHARACTER_MESSAGE = "交換所で取得";
    const SHOP_GRIMOIRE_MESSAGE = "交換所で取得";
    const EVENT_SHOP_MESSAGE = "イベント交換所で取得";
    const TAKE_OVER_MESSAGE = "上限超過分です";
    const TUTORIAL_REWARD_TAKE_OVER_MESSAGE = "チュートリアル達成報酬です";

    // パーティー系
    const PARTY_MEMBER_MAX_NUM = 6;

    // クエスト系
    const QUEST_MISSION_MAX_NUM = 3;

    /*************************************/
    /** チュートリアル系 **/
    // フラグIDX
    const TUTORIAL_PROGRESS_IDX_START = 33;
    const TUTORIAL_PROGRESS_IDX_BTL_RESTART_A = 35;
    const TUTORIAL_PROGRESS_IDX_BTL_RESTART_B = 38;
    const TUTORIAL_PROGRESS_IDX_END = 47;
    /*************************************/

    /*************************************/
    /** キャラクター系 **/

    const REPEAT_BONUS_NONE = 0;
    const REPEAT_BONUS_BRONZE = 1;
    const REPEAT_BONUS_SILVER = 2;
    const REPEAT_BONUS_GOLD = 3;

    const MAX_RARITY = 7;

    const INITIAL_RARITY_MIN = 1;
    const INITIAL_RARITY_MAX = 4;
    const EVOLVE_PARAM_MIN = 0;
    const EVOLVE_PARAM_MAX = 6;

    // [初期レア, 進化度] -> スパイン段階
    const SPINE_LV_TABLE = [
        1 => [0, 0, 0, 0, 1, 2, 2], // 初期レア 1
        2 => [0, 0, 0, 1, 2, 2, 2], // 初期レア 2
        3 => [0, 0, 1, 2, 2, 2, 2], // 初期レア 3
        4 => [0, 1, 2, 2, 2, 2, 2], // 初期レア 4
    ];
    // [初期レア, 進化度] -> イラスト段階
    const ILLUST_LV_TABLE = [
        1 => [0, 0, 0, 0, 1, 2, 3], // 初期レア 1
        2 => [0, 0, 0, 1, 2, 3, 3], // 初期レア 2
        3 => [0, 0, 1, 2, 3, 3, 3], // 初期レア 3
        4 => [0, 1, 2, 3, 3, 3, 3], // 初期レア 4
    ];


    /*************************************/
    /** パーティ系 **/
    const DEFAULT_PARTY_NO = 1;
    const FRONT_CHARA_NO_LIST = [1,2,3];
    const REAR_CHARA_NO_LIST = [4,5,6];


    /*************************************/

    /** イベント系 **/

    //イベント開催系ステータス
    const EVENT_STATUS_OPEN_START = 0;
    const EVENT_STATUS_START_END = 1;
    const EVENT_STATUS_END_CLOSE = 2;
    const EVENT_STATUS_CLOSE = 3;

    //イベント種別
    const EVENT_TYPE_MARATHON_NORMAL = 1; //通常マラソン
    const EVENT_TYPE_MARATHON_BOSS = 2; //降臨
    const EVENT_TYPE_POINT_EVENT = 3; //ポイント報酬イベント
    const EVENT_TYPE_POINT_EVENT_SPLIT_QUEST = 4; //ポイント報酬イベント クエスト分割パターン
    const EVENT_TYPE_MARATHON_BOSS_SIMPLE = 5; //降臨簡素版
    const EVENT_TYPE_RANKING_EVENT = 6; //ランキング用(GFコラボで使用)

    const EVENT_TYPE_DAILY = 99; //デイリー

    //イベントボードタイプ
    const EVENT_BOARD_TYPE_PUZZLE = 1;

    //導入シナリオの確認用、questデータのpriority
    const INTRO_STORY = 0;

    // イベント特攻タイプ
    const SP_EFFECT_BONUS_TYPE_DROP_UP = 1; //ドロップアップ
    const SP_EFFECT_BONUS_TYPE_ATTACK_UP = 3; //攻撃力アップ
    const SP_EFFECT_BONUS_TYPE_ADD_DROP = 2; //固定ドロップ追加
    //ランキングデーター制限カウント
    const RANKINGDATA_SEND_LIMIT_COUNT = 1000;
    const DEFAULT_BEST_DAMAGE_COEFFIECIENT = 100;
    /*************************************/
    /* ガチャ */
    // ガチャ回数
    const GACHA_COUNT_SINGLE = 1;
    const GACHA_COUNT_TEN = 10;
    const GACHA_COUNT_OTHER = -1;

    // ガチャ演出ID
    const GACHA_EFFECT_TABLE_ID_NORMAL = 300;
    const GACHA_EFFECT_TABLE_ID_OVER_S = 200;
    const GACHA_EFFECT_TABLE_ID_OVER_SS = 100;

    /*************************************/
    /* キャラクターレアリティ*/
    const CH_RARITY_SS_PLUS_3 = 'SS+++';
    const CH_RARITY_SS_PLUS_2 = 'SS++';
    const CH_RARITY_SS_PLUS_1 = 'SS+';
    const CH_RARITY_SS = 'SS';
    const CH_RARITY_S = 'S';
    const CH_RARITY_A1 = 'A1';
    const CH_RARITY_A2 = 'A2';

    // キャラクターレアリティ数値
    const CH_RARITY_NUM_SS_PLUS_3 = 7;
    const CH_RARITY_NUM_SS_PLUS_2 = 6;
    const CH_RARITY_NUM_SS_PLUS_1 = 5;
    const CH_RARITY_NUM_SS = 4;
    const CH_RARITY_NUM_S = 3;
    const CH_RARITY_NUM_A1 = 2;
    const CH_RARITY_NUM_A2 = 1;

    const CH_RARITY_LIST = array(
        7 => self::CH_RARITY_SS_PLUS_3,
        6 => self::CH_RARITY_SS_PLUS_2,
        5 => self::CH_RARITY_SS_PLUS_1,
        4 => self::CH_RARITY_SS,
        3 => self::CH_RARITY_S,
        2 => self::CH_RARITY_A1,
        1 => self::CH_RARITY_A2,
    );

    //キャラクター属性
    const CH_ELEMENT_FIRE = 'fire';
    const CH_ELEMENT_WATER = 'water';
    const CH_ELEMENT_EARTH = 'graund';
    const CH_ELEMENT_WIND = 'wind';
    const CH_ELEMENT_LIGHT = 'light';
    const CH_ELEMENT_DARK = 'dark';

    const CH_ELEMENT = array(
        1 => self::CH_ELEMENT_FIRE,
        2 => self::CH_ELEMENT_WATER,
        3 => self::CH_ELEMENT_EARTH,
        4 => self::CH_ELEMENT_WIND,
        5 => self::CH_ELEMENT_LIGHT,
        6 => self::CH_ELEMENT_DARK,
    );

    // 魔道書レアリティ数値
    const GR_RARITY_NUM_5 = 5;
    const GR_RARITY_NUM_4 = 4;
    const GR_RARITY_NUM_3 = 3;
    const GR_RARITY_NUM_2 = 2;
    const GR_RARITY_NUM_1 = 1;

    const MISSION_SUCCESS_TYPE_QUEST_CLEAR = 1; // クエストクリア
    const MISSION_SUCCESS_TYPE_GACHE_EXEC = 2; // ガチャを回す
    const MISSION_SUCCESS_TYPE_PL_LV = 3; // プレイヤーレベル到達
    const MISSION_SUCCESS_TYPE_CHARA_GET = 4; // キャラ獲得
    const MISSION_SUCCESS_TYPE_CHARA_EVOLVE = 5; // キャラ進化
    const MISSION_SUCCESS_TYPE_CHARA_REINFORCE = 6; // キャラ強化
    const MISSION_SUCCESS_TYPE_NO_DEATH = 7; // キャラを失わずにクエストクリア
    const MISSION_SUCCESS_TYPE_EQUIP_ORB = 8; // オーブ装備
    const MISSION_SUCCESS_TYPE_GET_GRIMOIRE = 9; // 魔道書入手
    const MISSION_SUCCESS_TYPE_GRIMOIRE_REINFORCE = 10; // 魔道書強化
    const MISSION_SUCCESS_TYPE_BUY_SHOP = 11; // ショップで購入
    const MISSION_SUCCESS_TYPE_MISSION_CLEAR = 12; // 特定ミッションクリア
    const MISSION_SUCCESS_TYPE_SET_PARTY = 13; // 編成する
    const MISSION_SUCCESS_TYPE_CHARA_GRADEUP = 14; // キャラグレードアップ
    const MISSION_SUCCESS_TYPE_SKILL_REINFORCE = 15; // アクティブスキル強化
    const MISSION_SUCCESS_TYPE_GRIMOIRE_AWAKE = 16; // 魔道書覚醒
    const MISSION_SUCCESS_TYPE_CHANGE_PROF = 17; // プロフィール編集
    const MISSION_SUCCESS_TYPE_LOGIN_DAYS = 18; // ログイン日数count
    const MISSION_SUCCESS_TYPE_STORY_QUEST = 19; // ストーリークエスト
    const MISSION_SUCCESS_TYPE_CHARA_QUEST = 20; // キャラクタークエスト
    const MISSION_SUCCESS_TYPE_USE_ACTIVE_SKILL = 21; // アクティブスキル使用
    const MISSION_SUCCESS_TYPE_ANY_NON_DOWN_CLEAR = 22; // 〇体倒れずにクリア
    const MISSION_SUCCESS_TYPE_USE_COUNT_SKILL = 23; // アクティブスキル〇回使用してクリア
    const MISSION_SUCCESS_TYPE_NONUSE_SKILL = 24; // アクティブスキルを使用せずクリア
    const MISSION_SUCCESS_TYPE_USE_OD = 25; // ODを使用してクリア
    const MISSION_SUCCESS_TYPE_USE_DD = 26; // DDを使用してクリア
    const MISSION_SUCCESS_TYPE_USE_AH = 27; // AHを使用してクリア
    const MISSION_SUCCESS_TYPE_DEATH_FOR_OD = 28; // ODでとどめを刺してクリア
    const MISSION_SUCCESS_TYPE_DEATH_FOR_DD = 29; // DDでとどめを刺してクリア
    const MISSION_SUCCESS_TYPE_DEATH_FOR_AH = 30; // AHでとどめを刺してクリア
    const MISSION_SUCCESS_TYPE_ANY_CONBO = 31; // コンボ〇回以上で攻撃
    const MISSION_SUCCESS_TYPE_UNDER_ANY_MEMBER = 32; // 〇人以下の編成でクリア
    const MISSION_SUCCESS_TYPE_ANY_ELEMENT_CHARA_CLEAR = 33; // 〇属性のキャラクターを編成してクリア
    const MISSION_SUCCESS_TYPE_ANY_ELEMENT_CHARA_FINISH = 34; // 〇属性のキャラクターでとどめを刺してクリア
    const MISSION_SUCCESS_TYPE_BATTLE_CLEAR = 35; // バトルをクリア

    const MISSION_SUCCESS_TYPE_EVENT_QUEST_CLEAR_COUNT_ALL = 36;   // イベントクエスト〇回クリア（イベントIDでクエストリスト取得）(chapter_id)
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_CLEAR_COUNT_ONE = 37;  // 指定イベントクエスト〇回クリア(指定したイベントのクエストＩＤのみ)(quest_id)

    const MISSION_SUCCESS_TYPE_EVENT_QUEST_EVENT_POINT_COUNT = 38; // ポイント取得数(イベントマスターからアイテム取得)
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_CLEAR_PERCENT = 39;    // クリアパーセント(ステータス取得後チェック)

    const MISSION_SUCCESS_TYPE_EVENT_QUEST_PARTY_MEMBER_NUM = 40;    // 編成人数〇人以下(イベントクエストの場合チェック)
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_ALL_MISSION_CLEAR = 41;    // クエストミッションクリア回数〇回（クエストの星を3つともすべてクリアする、初回のみのカウント）
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_NO_ACTIVE_SKILL = 42;    // アクティブスキル仕様せず
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_EQUIP_GRIMOIRE_NUM = 43;    // 魔導書装備数〇個以下(編成情報から魔導書チェック)

    const MISSION_SUCCESS_TYPE_TUTORIAL_CLEAR = 44;    // チュートリアルクリア

    const MISSION_SUCCESS_TYPE_EVENT_QUEST_RESULT_USED_OD_NUM = 45;       //OD合計使用回数(chapter_id)
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_RESULT_USED_DD_NUM = 46;       //DD合計使用回数(chapter_id)
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_RESULT_USED_AH_NUM = 47;       //AH合計使用回数(chapter_id)
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_RESULT_USED_EXTRA_NUM = 48;    //エクストラアタック合計使用回数(chapter_id)
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_RESULT_TOTAL_CHAIN_NUM = 49;   //合計チェイン数(chapter_id)
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_RESULT_FINISH_OD_NUM = 50;     //とどめOD(chapter_id)
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_RESULT_FINISH_DD_NUM = 51;     //とどめDD(chapter_id)
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_RESULT_FINISH_AH_NUM = 52;     //とどめAH(chapter_id)
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_EVENT_ITEM_COUNT = 53;     //アイテム取得
    //ミッションにはあるけどパネミ未実装---------------------
    // TODO:数字注意、ずれてる
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_RESULT_FINISH_OD_QUEST = 53;     //クエスト指定とどめOD
    const MISSION_SUCCESS_TYPE_QUEST_NOT_DEAD = 56; //〇体倒れずにクリア(questId指定)
    //---------------------------------------------------
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_RESULT_FINISH_DD_QUEST = 54;     //クエスト指定とどめDD
    const MISSION_SUCCESS_TYPE_EVENT_QUEST_RESULT_FINISH_AH_QUEST = 55;     //クエスト指定とどめAH
    const MISSION_SUCCESS_TYPE_TURN = 57;     //〇ターン終了
    const MISSION_SUCCESS_TYPE_ONLY_CHARA_ROLE = 58; //指定ポジションのキャラのみ
    const MISSION_SUCCESS_TYPE_ONLY_CHARA_ELEMENT = 59; //指定属性のキャラのみ
    const MISSION_SUCCESS_TYPE_ANY_CHARA_ROLE_AND_NOT_DEAD = 60; //指定ポジションのキャラが存在しているかつ全員生存
    const MISSION_SUCCESS_TYPE_COST = 61; //指定コスト以下
    const MISSION_SUCCESS_TYPE_FRONT_OR_REAR_ONLY = 62; //前衛もしくは後衛のみ
    /*************************************/
    // パネルミッション
    const PANEL_OPEN_TRIGGER_QUEST = 'quest';
    const PANEL_OPEN_TRIGGER_LEVEL_LIMIT = 'level_limit';

    /*************************************/
    //ページング設定
    const PAGING_OFFSET = 0;
    const PAGING_LIMIT = 10;
    const PAGING_START = 2;
    const PAGING_END = 5;
    /*************************************/
    //お知らせ 不具合一覧 ID
    const TROUBLE_INFO_LIST_ID = 400000000;
    /*************************************/
    //ユーザー系設定
    const INITIAL_MESSAGE = "よろしくお願いします！";
    const MAX_ARENA_BATTLE_POINT = 5;
    /*************************************/

    /**
     * KPI用共通定数
     */
    const USE_CONTENT_STORY_QUEST = 1;
    const USE_CONTENT_CHARACTER_QUEST = 2;
    const USE_CONTENT_EVENT_QUEST = 3;
    const USE_CONTENT_DAILY_QUEST = 4;
    const USE_CONTENT_PLAY_GACHA = 100;
    const USE_CONTENT_ARENA = 200;
}
