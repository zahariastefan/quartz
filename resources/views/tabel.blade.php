@extends('layout')
@section('content')
    <form action="/tabel" method="get" class="d-inline-flex" id="form_tabel">
        <label for="searchTerm">Cauta Dupa Nume
            <input type="search" class="form-control" name="searchTerm" id="searchTerm" value="{{request()->get('searchTerm')}}">
        </label>
        <div class="col-md-4">

            <label for="sortBy">Sorteaza
                <select name="sortBy" id="sortBy" class="form-control">
                    <option
                        @php if (isset($_GET['sortBy']) && ($_GET['sortBy'])  == '' ) {echo 'selected'; } @endphp value="">
                        Sorteaza
                    </option>
                    <option
                        @php if (isset($_GET['sortBy']) && ($_GET['sortBy'])  == 'desc') {echo 'selected'; } @endphp value="desc">
                        Descrescator (Nume)
                    </option>
                    <option
                        @php if (isset($_GET['sortBy']) && ($_GET['sortBy'])  == 'asc') {echo 'selected'; } @endphp  value="asc">
                        Crescator (Nume)
                    </option>
                    {{--                    <option @php if (isset($_GET['sortBy']) && ($_GET['sortBy'])  == 'salary') {echo 'selected'; } @endphp  value="salary">Media Salariilor Pe departament</option>--}}
                </select>
            </label>
        </div>
        <button type="button" class="btn btn-primary salary">Media Salariilor Pe departament</button>
    </form>
    @csrf
    <table class="table all_data">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nume</th>
            <th scope="col">Prenume</th>
            <th scope="col">Departament</th>
            <th scope="col">Descriere Departament</th>
            <th scope="col">Cod Numeric Personal</th>
            <th scope="col">Functie</th>
            <th scope="col">Salariu</th>
            <th scope="col">Zile de Concediu</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($angajati as $index => $angajat)
            @if (request()->get('page') > 1)
                @php $multiplier = ( request()->get('page')) -1 @endphp
            @else
                @php $multiplier = 0 @endphp
            @endif
            <tr>
                <th scope="row">{{ $index +1 + (15 * $multiplier) }}</th>
                <td>{{ $angajat->nume }}</td>
                <td>{{ $angajat->prenume }}</td>
                <td>{{ \App\Models\Departamentes::find($angajat->id_departament)->nume }}</td>
                <td class="descriere_departament" id="{{$angajat->id_departament}}">{{ Str::limit(\App\Models\Departamentes::find($angajat->id_departament)->descriere, 50) }}</td>
                <td>{{ $angajat->cnp }}</td>
                <td>{{ $angajat->functie }}</td>
                <td>{{ $angajat->salariu }}</td>
                <td>{{ $angajat->zile_concediu }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <table class="table by_salary d-none ">
        <thead>
        <tr>
            <th scope="col">Departament</th>
            <th scope="col">Media Salariilor In RON</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($averageSalaryByDepart as $departament => $salariuMediu)
            <tr>
                <td>{{ $departament }}</td>
                <td>{{ $salariuMediu }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $angajati->links('pagination.custom_pagination') }}

    <script>
        $(document).on('change', '#sortBy', () => {
            $('#form_tabel').submit();
        });
        $(document).on('click', '.salary', () => {
            if ($('.all_data').hasClass('d-none') === true) {
                $('.all_data').removeClass('d-none');
            } else {
                $('.all_data').addClass('d-none');
            }
            if ($('.by_salary').hasClass('d-none') === true) {
                $('.by_salary').removeClass('d-none');
            } else {
                $('.by_salary').addClass('d-none');
            }
            if ($('.nav_pagination').hasClass('d-none') === true) {
                $('.nav_pagination').removeClass('d-none');
            } else {
                $('.nav_pagination').addClass('d-none');
            }

        });

        $(document).on('click', '.descriere_departament', (e)=>{
            if($('.all_data td').length > 0){
                {{--alert('{{ (\App\Models\Departamentes::find($angajat->id_departament)->descriere) }}');--}}
            }
        });
        $( document).on('change', '#searchTerm', (e)=>{
            if(($('#searchTerm').val()).length === 0 ){
                $('#form_tabel').submit();
            }
        });

    </script>

@endsection
