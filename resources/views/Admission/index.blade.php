@extends('Layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center bg bg-primary bg-opacity-50 py-2 mb-3">{{ $title }}</h3>

            <table id="tableAdmission" class="table">
                <thead id="theadTableAdmission">
                    <tr>
                        @foreach ($columns as $column)
                        <th class="text-left fw-bold fs-5">{{ $column }}</th>
                        @endforeach
                        <th class="text-left fw-bold fs-5"></i></th>
                    </tr>
                </thead>
                <tbody id="tbodyTableAdmission">
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            <span>
                                <a href='route("admission.edit", {{$item->id}})'>
                                    <i class="{{config('content.icon.update')}} btn-lg"></i>
                                </a>
                            </span>
                            <span>
                                <a href='route("admission.delete", {{$item->id}})'>
                                    <i class="{{config('content.icon.delete')}} btn-lg"></i>
                                </a>
                            </span>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot id=" tfootTableAdmission">
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#tableAdmission').DataTable();
    });
</script>
@endsection
