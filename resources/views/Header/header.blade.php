@push('styles')
    <link rel="stylesheet" href="{{ asset('css/Header/header.css') }}">
@endpush

<nav class="container-header">
    <div class="top-header fl-sb">
        <img class="logo-img" src="{{ asset('images/logo_text.png') }}" alt="">
        <div class="box-btn fl-sb">
            <button class="btn-header" style="background: #D72134; color:#FFFFFF">Đăng nhập</button>
            <button class="btn-header btn-register" style="border: 1px solid #D72134; background: #FFFFFF; color: #D72134">Đăng ký</button>
            <img class="menu-img" src="{{ asset('images/icon-menu.png') }}" alt="">
        </div>
    </div>
    <div class="bottom-header fl-st wrap-select">
        <button class="btn-item m-1">TRANG CHỦ</button>
        <select class="select-item">
            <option value="1">Khám phá VLU</option>
            <option value="2">Lịch sử</option>
            <option value="3">Sứ  mạng - Triết lý</option>
            <option value="4">Cơ sở vật chất</option>
            <option value="5">Campus tour online</option>
            <option value="6">Đời sống sinh viên</option>
            <option value="7">Miễn giảm học phí</option>
            <option value="8">Học bổng tuyển sinh</option>
        </select>
        <select class="select-item">
            <option value="1">Ngành tuyển sinh 2023</option>
            <option value="2"><a>Danh mục 61 ngành đại học</a></option>
        </select>
        <select class="select-item">
            <option value="1">Chương trình Đại học</option>
            <option value="2">Chương trình Tiêu chuẩn</option>
            <option value="3">Chương trình Đặc biệt</option>
            <option value="4">Chương trình Quốc tế</option>
        </select>
        <select class="select-item">
            <option value="1">Tuyển sinh VLU</option>
            <option value="2">Xét Điểm Học Bạ THPT</option>
            <option value="3">Xét Tuyển Thẳng</option>
            <option value="4">Xét Điểm Thi ĐGNL</option>
            <option value="5">Đăng Ký Thi Năng Khiếu</option>
            <option value="6">Lộ Trình Tuyển Sinh 2023</option>
            <option value="7">Biểu Mẫu Tuyển Sinh 2023</option>
        </select>
        <button class="btn-item m-1">HỒ SƠ CỦA TÔI</button>
        <button class="btn-item m-1">CÂU HỎI THƯỜNG GẶP</button>
    </div>
</nav>
<script>
    $(document).ready(function() {
        $('.select-item').select2({
            minimumResultsForSearch: -1,
            width: 'auto'
        });
    });
</script>
