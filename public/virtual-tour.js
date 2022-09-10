function startTour(){
    if(!$('.shepherd-element').is(':visible')){
        const tour = new Shepherd.Tour({

            useModalOverlay: true,

            defaultStepOptions: {
                cancelIcon: {
                    enabled: true
                },
                classes: 'shadow-md bg-purple-dark',
                scrollTo: { behavior: 'smooth', block: 'center' }
            }
        });
        tour.addStep({
            title: 'Prezentare',
            text: `Numele meu este Zaharia Stefan si sper sa va placa acest proiect realizat pentru dumneavoastra. In urmatoarele clipe va urma o prezentare ghidata a website-ului. Dati click pe Urmatorul pentru continuare sau dati click pe X pentru a iesi din tutorial.`,
            attachTo: {
                element: '.fa-question-circle',
                on: 'bottom'
            },
            classes: 'presentation_step_one',
            buttons: [
                {
                    action() {
                        $.cookie('tutorial', 1);
                        return this.cancel();
                    },
                    classes: 'shepherd-button-secondary step1',
                    text: 'Renunta'
                },
                {
                    action() {
                        return this.next();
                    },
                    text: 'Continua'
                }
            ]
        });
        tour.addStep({
            title: 'Cautare',
            text: `Aici se pot cauta angajatii dupa nume. Daca se doreste pot implementa cautarea si dupa alte criterii.`,
            attachTo: {
                element: '#searchTerm',
                on: 'bottom'
            },
            buttons: [
                {
                    action() {
                        return this.back();
                    },
                    classes: 'shepherd-button-secondary',
                    text: 'Inapoi'
                },
                {
                    action() {
                        return this.next();
                    },
                    text: 'Urmatorul'
                }
            ],
            id: 'creating'
        });
        tour.addStep({
            title: 'Sortare',
            text: `Aici se pot sorta rezultatele.`,
            attachTo: {
                element: '#sortBy',
                on: 'bottom'
            },
            buttons: [
                {
                    action() {
                        return this.back();
                    },
                    classes: 'shepherd-button-secondary',
                    text: 'Inapoi'
                },
                {
                    action() {
                        return this.next();
                    },
                    text: 'Urmatorul'
                }
            ],
            id: 'creating'
        });
        tour.addStep({
            title: 'Tip Tabel',
            text: `Dati click aici pentru a schimba tipul de tabela`,
            attachTo: {
                element: '.salary',
                on: 'bottom'
            },
            buttons: [
                {
                    action() {
                        return this.back();
                    },
                    classes: 'shepherd-button-secondary',
                    text: 'Inapoi'
                },
                {
                    action() {
                        return this.next();
                    },
                    text: 'Urmatorul'
                }
            ],
            id: 'creating'
        });
        tour.addStep({
            title: 'Descriere',
            text: `Pentru a vedea toata descrierea...dati click!`,
            attachTo: {
                element: '.descriere_departament',
                on: 'bottom'
            },
            classes: 'departament_description',
            buttons: [
                {
                    action() {
                        return this.back();
                    },
                    classes: 'shepherd-button-secondary',
                    text: 'Inapoi'
                },
                {
                    action() {
                        $.cookie('tutorial', 1);
                        return this.next();
                    },
                    text: 'Termina'
                }
            ],
        });
        tour.start();
    }
}


