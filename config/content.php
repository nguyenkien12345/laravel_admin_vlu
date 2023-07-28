<?php

return [
    'crud' => [
        'list' => 'danh sách',
        'detail' => 'chi tiết',
        'add' => 'thêm',
        'update' => 'cập nhật',
        'delete' => 'xóa',
        'save' => 'lưu',
        'cancel' => 'hủy',
    ],
    'common' => [
        'notification' => 'thông báo',
        'exists' => 'này đã tồn tại',
    ],
    'status' => [
        'success' => 'thành công',
        'fail' => 'thất bại',
    ],
    'admissions' => [
        'name' => 'phương thức tuyển sinh',
    ],
    'icon' => [
        'detail' => 'fas fa-info-circle',
        'add' => 'fas fa-plus-circle',
        'update' => 'fas fa-edit',
        'delete' => 'fas fa-minus-circle',
        'search' => 'fas fa-search-plus',
        'filter' => 'far fa-filter',
        'sort_up' => 'fad fa-sort-up',
        'sort_down' => 'fad fa-sort-down',
    ],
    'search_profile' => [
        'title' => 'Phiếu đăng ký xét tuyển năm 2023',
        'description' => [
            'xet_tuyen_ket_qua_hoc_ba_thpt' => 'Dành cho thí sinh xét tuyển kết quả học bạ THPT',
            'xet_tuyen_thang' => 'Dành cho thí sinh xét tuyển thẳng',
            'xet_tuyen_ket_qua_dgnl' => 'Dành cho thí sinh xét tuyển kết quả đánh giá năng lực',
            'dang_ky_thi_nang_khieu' => 'Dành cho thí sinh xét tuyển thi năng khiếu',
            'xet_tuyen_cu_nhan_qt' => 'Dành cho thí sinh xét tuyển cử nhân quốc tế',
        ]
    ],
    'faqs' => [
        'tabs' => [
            [
                'type' => 1,
                'topic' => 'CHƯƠNG TRÌNH TUYỂN SINH'
            ],
            [
                'type' => 2,
                'topic' => 'CHƯƠNG TRÌNH ĐÀO TẠO ĐẶC BIỆT'
            ],
            [
                'type' => 3,
                'topic' => 'CHƯƠNG TRÌNH QUỐC TẾ'
            ]
        ]
    ],
    'table' => [
        'talent' => ['mã hồ sơ', 'môn thi', 'hình thức thi', 'điểm sơ khảo', 'điểm phỏng vấn', 'điểm tổng', 'trạng thái'],
        'university_national' => ['nguyện vọng', 'ngành xét tuyển', 'mã ngành', 'chương trình học', 'trạng thái'],
        'common' => ['nguyện vọng', 'ngành xét tuyển', 'mã ngành', 'mã tổ hợp', 'chương trình học', 'trạng thái'],
        'international_bachelor' => ['nguyện vọng', 'trường', 'ngành']
    ],
];
