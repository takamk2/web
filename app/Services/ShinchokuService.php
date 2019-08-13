<?php
/**
 * Created by PhpStorm.
 * User: t-mikami
 * Date: 2019/07/20
 * Time: 17:38
 */

namespace App\Services;


use App\Services\ShinchokuStatus\ShinchokuStatusFactory;

class ShinchokuService
{

    public function edit()
    {
        // 進捗の更新
        $shinchoku = $this->addShinchoku(); //

        // 進捗ステータスごとの更新
        $shinchokuStatus = ShinchokuStatusFactory::create($shinchoku);
        $shinchokuStatus->update();

        // メール送信系
//        $shinchokuStatus->message();
    }

    private function addShinchoku()
    {
        $shinchoku = [
            'id' => 1,
        ];

        return $shinchoku;
    }
}
