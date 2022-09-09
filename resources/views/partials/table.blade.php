
<table class="table">
    <thead>

    <tr>
        <th scope="col">#</th>
        <th scope="col">Nume</th>
        <th scope="col">Prenume</th>
        <th scope="col">Departament</th>
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
            <td>{{ $angajat->cnp }}</td>
            <td>{{ $angajat->functie }}</td>
            <td>{{ $angajat->salariu }}</td>
            <td>{{ $angajat->zile_concediu }}</td>
        </tr>
    @endforeach
    </tbody>

</table>

{{ $angajati->links('pagination.custom_pagination') }}
