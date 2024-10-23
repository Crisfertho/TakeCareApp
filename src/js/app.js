let paso = 1;
let startpaso = 1;
let endpaso = 3;

//Objeto
const cita = {
    id: '',
    name: '',
    date: '',
    time: '',
    services: []
}

document.addEventListener('DOMContentLoaded', function() {
    startApp();
});

function startApp() {
    showSection();
    tabs(); //cambia de seccion
    pagination(); //ocultar botones paginacion
    previouspage();
    nextpage();

    APIconsult(); //consulta la API

    clientId();
    clientName();
    selectDate();
    selectHour();

    showResume(); //Muestra Resumen
}

function showSection() {
    //ocultar secciones
    const sectionAnt = document.querySelector('.show');
    if(sectionAnt){
    sectionAnt.classList.remove('show');
    }

    //seleccionar la seccion
    const selector = `#paso-${paso}`;
    const section = document.querySelector(selector);
    section.classList.add('show');

    //Quita resalte actual // si lo pongo abajo del resaltar actual no funciona orden de metodos
    const tabAnt = document.querySelector('.actual');
    if(tabAnt) {
        tabAnt.classList.remove('actual');
    }

    //resaltar actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs(){
    const buttons = document.querySelectorAll('.tabs button');
    
    buttons.forEach( botton => {
        botton .addEventListener('click', function(e) {
           paso = parseInt(e.target.dataset.paso);
            
           showSection(); 
           pagination(); 
        });
    })

}

function pagination() {
    const previouspage = document.querySelector('#previous');
    const nextpage = document.querySelector('#next');

    if(paso === 1) {
        previouspage.classList.add('hide');
        nextpage.classList.remove('hide');
    } else if(paso === 3) {
        previouspage.classList.remove('hide');
        nextpage.classList.add('hide');
        showResume();   
    } else {
        previouspage.classList.remove('hide');
        nextpage.classList.remove('hide');
    }

    showSection();
}


function previouspage(){
    const previouspage = document.querySelector('#previous');
    previouspage.addEventListener('click', function() {
        if(paso <= startpaso) return
        paso--;

        pagination();
    })
}

function nextpage(){
    const nextpage = document.querySelector('#next');
    nextpage.addEventListener('click', function() {
        if(paso >= endpaso) return
        paso++;

        pagination();
    })
}

async function APIconsult() {
    try {
        const url = '/api/services';
        const result = await fetch(url);
        const services = await result.json();
        showServices(services);

    } catch (error) {
        console.log(error);
    }
}

function showServices(services) {
    services.forEach(service => {
        const {id, name, price} = service;

        const serviceName = document.createElement('P');
        serviceName.classList.add('name-service');
        serviceName.textContent = name;

        const servicePrice = document.createElement('P');
        servicePrice.classList.add('price-service');
        servicePrice.textContent = `$${price}`;

        const serviceDiv = document.createElement('P');
        serviceDiv.classList.add('service');
        serviceDiv.dataset.idService = id;
        serviceDiv.onclick = function() {
            selectService(service);
        };

        serviceDiv.appendChild(serviceName);
        serviceDiv.appendChild(servicePrice);

        document.querySelector('#services').appendChild(serviceDiv);

    });
}

function selectService(service) {
    const{id} = service;
    const {services} = cita; //Extraer arreglo de servicios

    //identificar al servicio selected
    const serviceDiv = document.querySelector(`[data-id-service="${id}"]`);
    //comprobar si servicio ya esta agregado
    if(services.some(inmemory => inmemory.id === id)) {
        //Eliminar
        cita.services = services.filter(inmemory => inmemory.id !== id);
        serviceDiv.classList.remove('selected');
    } else {
        //Agregarlo
        cita.services = [...services, service]; //toma una copia de los servicios y agrega nuevo
        serviceDiv.classList.add('selected');
    }

}

function clientId() {
    cita.id = document.querySelector('#id').value;
}

function clientName() {
    cita.name = document.querySelector('#name').value;

}

function selectDate() {
    const inputDate = document.querySelector('#date');
    inputDate.addEventListener('input', function(e) {
        const day = new Date(e.target.value).getUTCDay();

        if([6,0].includes(day)) {
            e.target.value = '';
            showAlert('error','No abrimos fines de semana', '.form');
        } else {
            cita.date = e.target.value;
        }
    });
}

function selectHour() {
    const inputTime = document.querySelector('#time');
    inputTime.addEventListener('input', function(e) {
        const citaTime = e.target.value;
        const time = citaTime.split(":")[0];

        if(time < 9 || time > 20) {
            e.target.value = '';
            showAlert('error', 'Cerrado', '.form')
        } else {
            cita.time = e.target.value; // Asignar la hora a cita
        }
    })
}

function showAlert(type, message, element, ghost = true) {

    const previousAlert = document.querySelector('.alert');
    if(previousAlert)  {
        previousAlert.remove();
    }
    //crear alerta
    const alert = document.createElement('DIV');
    alert.textContent = message;
    alert.classList.add('alert');
    alert.classList.add(type);

    const form = document.querySelector(element);
    form.appendChild(alert);

    //eliminar alerta
    if(ghost) {
        setTimeout( () => {
            alert.remove();
        }, 3200);
    }
}

function showResume() {
    const resume = document.querySelector('.resume-content');

    //clear content
    while(resume.firstChild) {
        resume.removeChild(resume.firstChild);
    }

    if(Object.values(cita).includes('') || cita.services.length === 0) {
        showAlert('error','Faltan datos de Servicios','.resume-content', false)
        return;
    }
    
    //Header service 
    const headingServices = document.createElement('H2');
    headingServices.textContent = 'Servicios Solicitados: ';
    resume.appendChild(headingServices);

     //Format resume
     const {name, date, time, services } = cita;

     //Total prices
     let totalPrice = 0;

    //show services
    services.forEach(service => {
        const {id, price, name} = service;
        const serviceContent = document.createElement('DIV');
        serviceContent.classList.add('service-content');

        const serviceText = document.createElement('P');
        serviceText.textContent = name;

        const servicePrice = document.createElement('P');
        servicePrice.innerHTML =  `<span>Precio:</span> $${price}`;

        serviceContent.appendChild(serviceText);
        serviceContent.appendChild(servicePrice);

        resume.appendChild(serviceContent);

        // Acumular el precio de cada servicio
        totalPrice += parseFloat(price);
    });

    const headingCita = document.createElement('H2');
    headingCita.textContent = 'Agenda Cita: ';
    resume.appendChild(headingCita);

    //Format resume
    const clientName = document.createElement('P');
    clientName.innerHTML = `<span>Nombre:</span> ${name}`;

    //format date
    const dateObj = new Date(date);
    const mes = dateObj.getMonth();
    const dia = dateObj.getDate() + 2;
    const year= dateObj.getFullYear();

    const dateUTC = new Date(Date.UTC(year, mes, dia));
    const options = {weekday: 'long', year:'numeric', month: 'long', day: 'numeric'};
    const formatDate = dateUTC.toLocaleDateString('es-MX', options);
    const citaDate = document.createElement('P');
    citaDate.innerHTML = `<span>Fecha:</span> ${formatDate}`;

    const citaHour = document.createElement('P');
    citaHour.innerHTML = `<span>Hora:</span> ${time}`;

    // Mostrar el total de precios al final
    const totalElement = document.createElement('P');
    totalElement.innerHTML = `<span>Total a Pagar:</span> $${totalPrice.toFixed(2)}`;

    //button cita
    const buttonReserve = document.createElement('BUTTON');
    buttonReserve.classList.add('button');
    buttonReserve.textContent = 'Reservar Cita';
    buttonReserve.onclick = reserveCita;

    resume.appendChild(clientName);
    resume.appendChild(citaDate);
    resume.appendChild(citaHour);
    resume.appendChild(totalElement);

    resume.appendChild(buttonReserve);

}

async function reserveCita() {

    const {date, time, services, id} = cita;
    const idService = services.map(service => service.id);

    const data = new FormData();
    
    data.append('date', date);
    data.append('time', time);
    data.append('userId', id);
    data.append('services', idService);

    try {
        //Peticion API
        const url = '/api/citas'
        const respt = await fetch(url, {
        method: 'POST',
        body: data
        });

        const resul = await respt.json();
        //console.log(resul.result);

        if(resul.result) {
            Swal.fire({
                icon: "success",
                title: "Cita Creada",
                text: "Tu cita ya esta registrada.",
                button: 'OK'
            }).then( () => {
                setTimeout(() => {
                window.location.reload();
                }, 2000);
            })
        } else if (!resul.result && resul.message === 'No hay disponibilidad para esta hora') {
            // Si no hay disponibilidad
            Swal.fire({
                icon: "error",
                title: "Sin disponibilidad",
                text: resul.message,
                button: 'OK'
            });
        }
        
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error...",
            text: "Algo salió mal!"
          });
    }
    
}
