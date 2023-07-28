<style>
    .preview-form-note {
        display: flex;
        flex-direction: row;
        align-items: center;
        background: #FFFFFF;
        padding: 8px 10px;
        margin: 10px;
    }

    .preview-form-note .icon {
        width: 20px;
        height: 20px;
        object-fit: cover;
        margin-right: 14px;
    }

    .preview-form-note .title {
        font-weight: 500;
        font-size: 16px;
        letter-spacing: 0.17px;
        color: #FDB528;
        margin-right: 8px;
    }

    .preview-form-note .content {
        font-weight: 400;
        font-size: 16px;
        letter-spacing: 0.15px;
        color: #6D788D;
    }
</style>

<div class="row" {{ $attributes }}>
    <div class="col-12">
        <div class="preview-form-note">
            <div class="icon">
                <img src="{{asset($icon)}}" alt="">
            </div>
           <span class="title">{{$title}}</span>
           <span class="content">{{$content}}</span>
        </div>
    </div>
</div>
