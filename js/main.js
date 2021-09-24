function validar_cbx(){
    let tipo_doc = document.getElementById('tipo_documento').value,
        genero = document.getElementById('genero').value,
        dept = document.getElementById('departamento').value,
        municip = document.getElementById('municipio').value;
    if(tipo_doc == 0){
        alert('Debes seleccionar un tipo de documento valido');
    }

    if(genero == 0){
        alert('Debes seleccionar un genero valido');
    }

    if(dept == 0){
        alert('Debes seleccionar un departamento valido');
    }

    if(municip == 0){
        alert('Debes seleccionar un municipio valido');
    }
}

function rellenar_municipios(){  
    let dept = document.getElementById('departamento'),
        municip = document.getElementById('municipio');
    if(dept.value == 1){
        municip.innerHTML = '';
        municip.insertAdjacentHTML('beforeend', '<option value="1">Medellin</option>');
        municip.insertAdjacentHTML('beforeend', '<option value="2">Bello</option>');
    }else if(dept.value == 2){
        municip.innerHTML = '';
        municip.insertAdjacentHTML('beforeend', '<option value="3">Neiva</option>');
        municip.insertAdjacentHTML('beforeend', '<option value="4">Baraya</option>');
    }else if(dept.value == 3){
        municip.innerHTML = '';
        municip.insertAdjacentHTML('beforeend', '<option value="5">Leticia</option>');
        municip.insertAdjacentHTML('beforeend', '<option value="6">Puerto Nariño</option>');
    }else if(dept.value == 4){
        municip.innerHTML = '';
        municip.insertAdjacentHTML('beforeend', '<option value="7">Valledupar</option>');
        municip.insertAdjacentHTML('beforeend', '<option value="8">Aguachica</option>');
    }else if(dept.value == 5){
        municip.innerHTML = '';
        municip.insertAdjacentHTML('beforeend', '<option value="9">Espinal</option>');
        municip.insertAdjacentHTML('beforeend', '<option value="10">Ibague</option>');
    }else{
        municip.innerHTML = '';
        municip.insertAdjacentHTML('beforeend', '<option>Seleccione el municipio</option>');
    }
}