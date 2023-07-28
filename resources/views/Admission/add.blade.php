@extends('Layouts.app')

@section('content')
<div class="main mt-3">
    <div class="py-2 bg-success bg-gradient rounded-3">
        <h1 class="fs-4 fw-bolder text-white text-center" style="margin-bottom: 0px;">
            {{ ucwords(config('content.crud.add')) . ' ' . ucwords(config('content.admissions.name')) }}
        </h1>
    </div>

    <form method="POST" action="{{route('admission.store')}}" novalidate class="my-5 d-flex flex-column">
        @csrf
        <div class="form-group mb-3">
            <label for="" class="form-label">
                {{ ucfirst(config('content.admissions.name')) }}
                <span class="text-danger fw-bold">*</span>
            </label>
            <input type="text" class="form-control" name="name" id="name"
                placeholder="Vui lòng nhập {{config('content.admissions.name')}}">
            @error('name')
            <p class="btn btn-outline-danger fw-bolder my-1 w-100 text-start" id="errorName">{{ $message }}</p>
            @enderror
        </div>

        <div class="d-flex flex-row justify-content-around">
            <button type="submit" class="btn btn-primary fw-bold font-medium py-1 text-white fs-5 px-5 py-1"
                id="btnSaveAdmission">
                {{ucfirst(config('content.crud.save'))}}
            </button>

            <button type="button" class="btn btn-danger fw-bold font-medium py-1 text-white fs-5 px-5 py-1"
                id="btnCancel">
                {{ucfirst(config('content.crud.cancel'))}}
            </button>
        </div>
    </form>

    {{-- Admission is exists --}}
    @if(Session::has('exists'))
    <script>
        const title = "{{ ucfirst(config('content.common.notification')) }}";
        const message = "{{ ucfirst(Session::get('exists')) }}";
        const type = "info";
        const options = { button: true, button: 'OK', timer: 3000, dangerMode: true };
        swal(title, message, type, options);
    </script>
    @endif

    {{-- Admission add success --}}
    @if(Session::has('success'))
    <script>
        const title = "{{ ucfirst(config('content.common.notification')) }}";
        const message = "{{ ucfirst(Session::get('success')) }}";
        const type = "success";
        const options = { button: true, button: 'OK', timer: 3000 };
        swal(title, message, type, options);
    </script>
    @endif
</div>

<script type="text/javascript">
    $('#name').on('input', function(){
        $('#errorName').css('display', 'none');
    });

    $('#btnCancel').on('click', function(){
        location.href = "{{ redirect()->route('admission.all')->getTargetUrl() }}";
    });
</script>
@endsection
