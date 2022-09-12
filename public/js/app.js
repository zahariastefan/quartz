var t = 0;

function App() {
    function enter(e) {
        e.preventDefault()
        t++
        document.getElementById('ot').innerHTML = `You Clicked The Button ${t} times`
    }

    return (
        <div>
            <button onClick={enter}>Click me</button>
        </div>
    )
}

function Ajax(url) {
    var data;
    $.ajax({
        type: "GET",
        url: url,
        datatype: "json",
        async: false,
        complete: (e) => {
            data = e.responseText;
        }
    });
    return data;
}

function getParam(name) {
    let result;
    const windowUrl = window.location.search;
    const params = new URLSearchParams(windowUrl);
    (typeof params !== 'undefined') ? result = params.get(name) : result = '';
    return result;
}
function checkParam(name) {
    let result;
    (typeof getParam(name) !== 'undefined') ? result = true : result = false;
    return result;
}

function showHide(){
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
}

function descriptionLength(e)
{
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
}

class TableApp extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            highlightedRowId: null
        };

    }

    render() {
        var pageParam;
        if(getParam('page') !== ''){
            var nrPage = getParam('page');
            pageParam = setParam('page', nrPage);
        }else{
            pageParam = '';
        }
        const urlAngajati = location.protocol+'//'+window.location.host + '/angajati?'+pageParam;
        const urlSalariiDep = location.protocol+'//'+window.location.host + '/salarii-departament?'+pageParam;
        const ajaxCall = JSON.parse(Ajax(urlAngajati));
        const ajaxCallSD = JSON.parse(Ajax(urlSalariiDep));
        const {highlightedRowId} = this.state;
        return (
            <div>
                <button type="button" className="btn salary text-center" onClick={()=>{showHide()}}>Vezi Media Salariilor Pe departament</button>
                <button type="button" className="btn classic_tabel d-none text-center" onClick={()=>{$('.salary').trigger('click')}}>Vezi Angajatii impreuna cu numele
                    si descrierea departamentului fiecaruia
                </button>
                <table className="table table-striped all_data">
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
                    {ajaxCall['data'].map((singleHttpJsonResponse) => (
                        <tr
                            key={singleHttpJsonResponse.id}
                            className={highlightedRowId === singleHttpJsonResponse.id ? 'bg-info' : ''}
                            onClick={() => this.setState({highlightedRowId: singleHttpJsonResponse.id})}
                        >
                            <td>{singleHttpJsonResponse.id}</td>
                            <td>{singleHttpJsonResponse.nume}</td>
                            <td>{singleHttpJsonResponse.prenume}</td>
                            <td>{singleHttpJsonResponse.departament}</td>
                            <td id={singleHttpJsonResponse.id_departament} onClick={(e)=>{descriptionLength(e)}}>{singleHttpJsonResponse.descriere_departament.substring(0, 50) + '...'}</td>
                            <td>{singleHttpJsonResponse.cnp}</td>
                            <td>{singleHttpJsonResponse.functie}</td>
                            <td>{singleHttpJsonResponse.salariu}</td>
                            <td>{singleHttpJsonResponse.zile_concediu}</td>
                            <input type="hidden" id={"hidden_description_"+singleHttpJsonResponse.id_departament} value={singleHttpJsonResponse.descriere_departament}/>

                        </tr>

                        ))}
                    </tbody>
                </table>
                <table className="table table-striped by_salary d-none">
                    <thead>
                    <tr>
                        <th scope="col">Departament</th>
                        <th scope="col">Media Salariilor In RON</th>
                    </tr>
                    </thead>
                    <tbody>
                    {ajaxCallSD.map((singleHttpJsonResponse) => (
                        <tr
                            key={singleHttpJsonResponse.id}
                        >
                            <td>{singleHttpJsonResponse.nume}</td>
                            <td>{singleHttpJsonResponse.salariu}</td>
                        </tr>
                    ))}
                    </tbody>
                </table>
                <nav >
                    <ul className="pagination justify-content-center">
                        <li className="page-item"><a className="page-link" onClick={()=>{pagination('-1')}}>Previous</a></li>
                        <li className="page-item"><a className="page-link" onClick={()=>{pagination('+1')}}>Next</a></li>
                    </ul>
                </nav>
                <p>Total Angajati : {ajaxCall['meta']['total']}</p>
            </div>
        );
    }
}

function pagination(data)
{
    var param = getParam('page');
    var value;
        switch(data){
            case '-1':
                if(param !== '' && param > 1 ) {
                    value = parseInt(param) - 1;
                }
                break;
            case '+1':
                if(param !== '' && param >=0 ) {
                    if(param === 0 || param === null) {
                        value = 1;
                    }else{
                        value = parseInt(param) + 1;
                    }
                }
                break;
        }
        if(typeof value !== 'undefined'){
            var newParams = setParam('page', value);
            window.location.replace(location.protocol+'//'+window.location.host + '/tabel-react?'+newParams)
        }

}

function setParam(name, value)
{
    const windowUrl = window.location.search;
    const params = new URLSearchParams(windowUrl);
    params.set(name,value);
    return params.toString();
}


const root = document.getElementById('root');
ReactDOM.render(<TableApp/>, root)
