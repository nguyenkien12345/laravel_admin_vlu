<?php

namespace App\Constants;

class Common
{
    // Kết quả học tập
    public const Academic_Performance = [
        'EXCELLENT' => 1,
        'GOOD' => 2,
        'AVERAGE' => 3,
        'WEAK' => 4,
    ];

    // Kết quả Hạnh kiểm
    public const Conduct_Performance = [
        'EXCELLENT' => 1,
        'GOOD' => 2,
        'AVERAGE' => 3,
        'WEAK' => 4,
    ];

    // Chương trình học
    public const Study_Program = [
        'THPT' => 1,
        'GDTX' => 2,
    ];

    // Áp dụng với Xét tuyển thẳng và Xét tuyển điểm học bạ THPT
    public const Admission_Plan = [
        'PLAN1' => 1,
        'PLAN2' => 2,
    ];

    // Độ ưu tiên
    public const Priority_Type = [
        'ONE' => 1,
        'TWO' => 2,
        'THREE' => 3,
        'FOUR' => 4,
        'FIVE' => 5,
        'SIX' => 6,
        'SEVEN' => 7,
    ];

    // Khu vực
    public const Area_Type = [
        'KV1' => [
            'code' => 1,
            'name' => 'Khu vực 1'
        ],
        'KV2' => [
            'code' => 2,
            'name' => 'Khu vực 2'
        ],
        'KV2NT' => [
            'code' => 3,
            'name' => 'Khu vực 2 nông thôn'
        ],
        'KV4' => [
            'code' => 4,
            'name' => 'Khu vực 3'
        ],
    ];

    // Chương trình đại học
    public const University_Program = [
        'standard' => 1,
        'special' => 2,
    ];

    // Loại học lực / loại hạnh kiểm
    public const Type_Academic_Conduct = [
        'ACADEMIC' => 1,
        'CONDUCT' => 2,
    ];
}
