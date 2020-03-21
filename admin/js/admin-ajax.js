
const formAdmin = document.getElementById('guardar-registro');

const listaDatos = $('.borrar-registro');

const formFile = document.getElementById('guardar-registro-archivo');



document.addEventListener('DOMContentLoaded',() =>{
   
    if(formAdmin){
        formAdmin.addEventListener('submit',insertarAdmin);
    }

    if(listaDatos){
        listaDatos.on('click',borrarAdmin);
    }

    if(formFile){
        formFile.addEventListener('submit',insertarRegistro);
    }

    // Cargar los producto en el modal
    $('.compra-id').on('click', function (e) {
        let id = $(this).attr('data-id');
        let registro = 'compra';
        let tabla = document.querySelector('.modal-productos');
        let template = '';
        console.log(id);    
        $.ajax({
            type: "POST",
            url: "modelo-compra.php",
            data: {
                registro,
                id
            },
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                let productos = response.productos;
                productos.forEach(producto => {
                    template += `
                        <tr>
                            <td>${producto.compra}</td>
                            <td>${producto.producto_id}</td>
                            <td>${producto.cantidad}</td>
                            <td>${producto.precio}</td>
                        </tr>
                    `;
                });
                tabla.innerHTML = template;

            }
        }); 
    });

});

function insertarAdmin(e){
    // Enviar datos para la creacion de administradores
    e.preventDefault();
    const datos = new FormData(formAdmin);
    const url = formAdmin.getAttribute('action');
    const method = formAdmin.getAttribute('method');
    // console.log(datos.get('foto').name);
    // Inicializar el objeto xmlhttprequest
    const xhr = new XMLHttpRequest();
    // Abrir la conexion
    xhr.open(method,url,true);
    // Comprobar la respuesta del servidor
    xhr.onload = function(){
        if(this.status == 200){
            const respuesta = this.responseText;
            const resultado = JSON.parse(respuesta.slice(0,respuesta.indexOf('}')+1));
            console.log(resultado);
            if(resultado.respuesta == 'exito'){
                Swal.fire(
                    'Correcto',
                    'El registro se guardo con exito',
                    'success'
                  )
            }else{
                Swal.fire(
                    'Error',
                    'Hubo un error',
                    'error'
                  )
            }
            formAdmin.reset();
        }
    };
    xhr.send(datos);
}

function insertarRegistro(e){
    e.preventDefault();
    const datos = new FormData(formFile);
    const url = formFile.getAttribute('action');
    const method = formFile.getAttribute('method');

    $.ajax({
        type: method,
        url: url,
        data: datos,
        dataType: "json",
        contentType: false,
        processData: false,
        async: true,
        cache: false,
        success: function (response) {
            console.log(response);
            if(response.respuesta == 'exito'){
                Swal.fire(
                    'Correcto',
                    'El registro se guardo con exito',
                    'success'
                  )
            }else{
                Swal.fire(
                    'Error',
                    'Hubo un error',
                    'error'
                  )
            }
        }
    });
}

function borrarAdmin(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    var tipo = $(this).attr('data-tipo');
    Swal.fire({
        title: '¿Estas seguro?',
        text: "Un registro eliminado no se puede recuperar",
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar'
      }).then(function(result){
        if(result.value){
            $.ajax({
                type: "post",
                url: 'modelo-'+tipo+'.php',
                data: {
                    id: id,
                    registro: 'eliminar'
                },
                // dataType: "json",
                success: function (data) {
                    var resultado = JSON.parse(data);
                    console.log(resultado);
                    if(resultado.respuesta == 'exito'){
                        Swal.fire(
                            'Eliminado!',
                            'Registro Eliminado',
                            'success'
                        )
                        jQuery('[data-id="'+resultado.id_eliminado+'"]').parents('tr').remove();
                    }else{
                        Swal.fire(
                            'Error!',
                            'No se puede eliminar',
                            'error'
                        )
                    }
                }
            });
        }
      })        
}



