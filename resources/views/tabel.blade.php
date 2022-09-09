@extends('layout')

@section('content')
    <form action="/tabel" method="get" class="d-inline-flex" id="form_tabel">
        <label for="searchTerm">Cauta Dupa Nume
            <input type="search" class="form-control" name="searchTerm" value="{{request()->get('searchTerm')}}">
        </label>
        <div class="col-md-4">
            <label for="orderBy">Sorteaza
                <select name="orderBy" id="orderBy" class="form-control">
                    <option>Sorteaza</option>
                    <option value="DESC">Descrescator</option>
                    <option value="ASC">Crescator</option>
                    <option value="salary">Media Salariilor Pe departament</option>
                </select>
            </label>
        </div>
    </form>
    @csrf
    <div id="content">
        @include('partials/table')

    </div>


    <script>
        $(document).on('change','#orderBy', (e)=>{
            // $('#form_tabel').submit();
            var selectedValue = $(e.target).find(":selected").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#content").load('{{ asset('/partials/table') }}');

            {{--$.ajax({--}}
            {{--    url:'{{ url('/ajax') }}',--}}
            {{--    method: 'POST',--}}
            {{--    data: {sortBy:selectedValue, _token:'<?php echo csrf_token() ?>'},--}}
            {{--    complete: function(e){--}}
            {{--        console.log({{url('partials/table')}});--}}
            {{--        $("#content").load({{ url('partials/table') }});--}}

            {{--        console.log(e.responseText);--}}
            {{--    }--}}
            {{--});--}}
        });
    </script>
@endsection
