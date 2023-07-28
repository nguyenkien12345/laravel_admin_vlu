<style>
    .information-preview {
        margin: 0px 25px 20px 25px;
    }

    .information-preview label.label-preview {
        font-weight: 600;
        font-size: 16px;
        letter-spacing: 0.17px;
        color: #1F2251;
        margin-right: 8px;
    }

    .information-preview span.value-preview {
        font-weight: 500;
        font-size: 18px;
        letter-spacing: 0.15px;
        color: #596274;
    }
</style>

<div class="row information-preview" {{$attributes}}>
    @if($value1 && $value2)
    <div class="col-6">
        <label class="label-preview">{{$value1[0]}}:</label>
        <span class="value-preview">{{$value1[1]}}</span>
    </div>
    <div class="col-6">
        <label class="label-preview">{{$value2[0]}}:</label>
        <span class="value-preview">{{$value2[1]}}</span>
    </div>
    @else
    <div class="col-12">
        <label class="label-preview">{{$value1[0]}}:</label>
        <span class="value-preview">{{$value1[1]}}</span>
    </div>
    @endif
</div>
