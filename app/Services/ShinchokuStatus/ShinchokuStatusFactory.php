<?php
/**
 * Created by PhpStorm.
 * User: t-mikami
 * Date: 2019/07/20
 * Time: 17:40
 */

namespace App\Services\ShinchokuStatus;


class ShinchokuStatusFactory
{
    /**
     * @param $shinchoku
     * @param null $oldShinchoku
     * @return ShinchokuStatus|null
     */
    public static function create($shinchoku, $oldShinchoku = null)
    {
        switch ($shinchoku['id']) {
            case ShokaiIrai::ID:
                return new ShokaiIrai($shinchoku);
            default:
                return null;
        }
    }

public function sample1()
{
    // 入力値
    $isNurse = 1; // 看護師と表示
    $isManagement = 0; // 管理職と表示
    $isCertifiedNurse = 1; // 認定看護師と表示

    $value = '';

    if ($isNurse === 1) {
        if ($value !== '') {
            $value .= '/';
        }
        $value .= '看護師';
    } else {
        if ($value !== '') {
            $value .= '/';
        }
        $value .= 'その他';
    }

    if ($isManagement === 1) {
        if ($value !== '') {
            $value .= '/';
        }
        $value .= '管理職';
    }

    if ($isCertifiedNurse === 1) {
        if ($value !== '') {
            $value .= '/';
        }
        $value .= '認定看護師';
    }

    return $value; // 「看護師/認定看護師」
}

public function sample2()
{
    // 入力値
    $isNurse = 1; // 看護師と表示
    $isManagement = 0; // 管理職と表示
    $isCertifiedNurse = 1; // 認定看護師と表示

    $values = [];

    if ($isNurse === 1) {
        $values[] = '看護師';
    } else {
        $values[] = 'その他';
    }

    if ($isManagement === 1) {
        $value[] = '管理職';
    }

    if ($isCertifiedNurse === 1) {
        $value[] = '認定看護師';
    }

    return implode('/', $values); // 「看護師/認定看護師」
}

public function sample3()
{
    // 入力値
    $isNurse = 1; // 看護師と表示
    $isManagement = 0; // 管理職と表示
    $isCertifiedNurse = 1; // 認定看護師と表示

    $values = [
        $isNurse === 1 ? '看護師' : 'その他',
        $isManagement === 1 ? '管理職' : '',
        $isCertifiedNurse === 1 ? '認定看護師' : '',
    ];

    return implode('/', array_filter($values, function ($it) {
        return $it !== '';
    })); // 「看護師/認定看護師」
}

public function sample4()
{
    // 入力値
    $isNurse = 1; // 看護師と表示
    $isManagement = 0; // 管理職と表示
    $isCertifiedNurse = 1; // 認定看護師と表示

    return implode('/', array_filter([
        $isNurse === 1 ? '看護師' : 'その他',
        $isManagement === 1 ? '管理職' : '',
        $isCertifiedNurse === 1 ? '認定看護師' : '',
    ], function ($it) {
        return $it !== '';
    })); // 「看護師/認定看護師」
}

public function sample5()
{
    // 入力値
    $params = [
        [
            'name' => 'A',
            'isNurse' => 1,
            'isManagement' => 0,
            'isCertifiedNurse' => 1,
            'categoryId' => 1,
        ],
        [
            'name' => 'B',
            'isNurse' => 0,
            'isManagement' => 1,
            'isCertifiedNurse' => 0,
            'categoryId' => 0,
        ],
        [
            'name' => 'C',
            'isNurse' => 1,
            'isManagement' => 1,
            'isCertifiedNurse' => 1,
            'categoryId' => 1,
        ],
    ];

    $categoryMasterById = CategoryMaster::all()->keyBy('id');
    // $categoryMasterIdの内容
    // [
    //     [
    //         'id' => 1,
    //         'name' => 'ほげ'
    //     ],
    //     [
    //         'id' => 2,
    //         'name' => 'ふが'
    //     ],
    // ];

    return array_map(function ($param) use ($categoryMasterById) {
        implode('/', array_filter([
            $param['isNurse'] === 1 ? '看護師' : '',
            $param['isManagement'] === 1 ? '管理職' : '',
            $param['isCertifiedNurse'] === 1 ? '認定看護師' : '',
            array_get($categoryMasterById, $param['categoryId'], ''),
        ], function ($it) {
            return $it !== '';
        }));
    }, $params);
}
}
