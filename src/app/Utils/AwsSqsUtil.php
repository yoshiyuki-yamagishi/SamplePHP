<?php
/**
 * AWS SQS のユーティリティクラス
 *
 */

namespace App\Utils;

use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;


/**
 * AWS SQS のユーティリティクラス
 *
 */
class AwsSqsUtil {

    /**
     * 送信
     *
     * @param string $table テーブル名
     * @param array $data 連想配列
     * @return boolean 成功したか否か
     */
    public static function send($name, $data) {
        try {
            $json = [];
            $json['name'] = $name;
            $json['data'] = $data;
            $body = json_encode($json);

            $sqs = SqsClient::factory([
                'credentials' => [
                    'key' => env('AWS_SQS_KEY'),
                    'secret' => env('AWS_SQS_SECRET'),
                ],
                'region' => env('AWS_SQS_REGION'),
                'version' => 'latest',
            ]);

            $sqs->sendMessage([
                'QueueUrl' => env('AWS_SQS_URL'),
                'MessageBody' => $body,
                'MessageGroupId' => uniqid(),
                'MessageDeduplicationId' => uniqid(),
            ]);

            return true;
        } catch (SqsException $error) {
            // TODO: ログを出力する
            //$e->getMessage();
            return false;
        }
    }

}
