<style>
    .preview-form-title {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 8px 10px;
        margin: 10px;
        background: #1F2251;
        box-shadow: 0px 2px 10px rgba(76, 78, 100, 0.22);
        border-radius: 8px;
    }

    .preview-form-title .icon {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 6px 4px;
        background: rgba(102, 108, 255, 0.5);
        border-radius: 8px;
        margin-right: 8px;
    }

    .preview-form-title .icon img {
        width: 100%;
        display: block;
        object-fit: cover;
    }

    .preview-form-title .title {
        font-weight: 600;
        font-size: 16px;
        letter-spacing: 0.15px;
        color: #FAFAFA;
    }
</style>

<div class="row" {{ $attributes }}>
    <div class="col-12">
        <div class="preview-form-title">
            <div class="icon">
                <img src="{{asset($icon)}}" alt="">
            </div>
            <span class="title">{{$content}}</span>
        </div>
    </div>
</div>
