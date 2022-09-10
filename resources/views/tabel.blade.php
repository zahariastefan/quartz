@extends('layout')
@section('content')

    <form action="/tabel" method="get" class="d-inline-flex" id="form_tabel">
        <i class="fa fa-question-circle" aria-hidden="true"></i>

        <div class="col-md-4 m-2">

        <label for="searchTerm">
            <input type="search" class="form-control" placeholder="Cauta dupa nume" name="searchTerm" id="searchTerm" value="{{request()->get('searchTerm')}}">
        </label>
        </div>
        <div class="col-md-4 m-2">

            <label for="sortBy">
                <select name="sortBy" id="sortBy">
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
        <button type="submit" class="submit_button_with_icon d-sm-block d-md-none"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
        <button type="button" class="btn salary text-center">Vezi Media Salariilor Pe departament</button>
        <button type="button" class="btn classic_tabel d-none text-center">Vezi Angajatii impreuna cu numele si descrierea departamentului fiecaruia</button>
    </form>
    @csrf
    <table class="table all_data">
        <thead class="">
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
            <input type="hidden" id="hidden_description_{{$angajat->id_departament}}" value="{{ \App\Models\Departamentes::find($angajat->id_departament)->descriere }}">
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
                $('.classic_tabel').addClass('d-none');
                $('.salary').removeClass('d-none');
            } else {
                $('.all_data').addClass('d-none');
                $('.classic_tabel').removeClass('d-none');
                $('.salary').addClass('d-none');

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
        $(document).on('click', '.classic_tabel', () => {
            $('.salary').trigger('click');
        });
        $(document).on('click', '.descriere_departament', (e)=>{
            if($('.all_data td').length > 0){
                var currentID = $(e.currentTarget).attr('id');
                var decription = $('#hidden_description_'+currentID).val();
                if($(e.currentTarget).hasClass('clicked')){
                    $(e.currentTarget).removeClass('clicked');
                    $(e.currentTarget).text(decription.substring(0,50) + '...');
                }else{
                    $(e.currentTarget).addClass('clicked');
                    $(e.currentTarget).text(decription);
                }
            }
        });
        $( document).on('change', '#searchTerm', (e)=>{
            if(($('#searchTerm').val()).length === 0 ){
                $('#form_tabel').submit();
            }
        });

    </script>


    <script src="virtual-tour.js"></script>

    <script>


        if(typeof $.cookie('tutorial') === 'undefined' || $.cookie('tutorial') == 0){
            startTour();
        }

        $('.shepherd-cancel-icon').click(()=>{
            $.cookie('tutorial', 1);
        });
        $('.fa-question-circle').click(()=>{
            startTour();
        });
    </script>
@endsection
