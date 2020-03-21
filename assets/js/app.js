$(document).ready(function () {
    // Cargar el carro 
    function loard_cart(){
        // tabla de pago (resumen de orden)
        var tablaPagos = $('#table-pay');
        var action = 'get';
        // Contenedor de las tablas producto y pago
        var tablas = $('#wraper');

        // botones de pago y cancelar compra
        var btnPay = $('.btn-pay');
        var btnCancel = $('#btn-clear');
        // peticion ajax que devuelva el carrito
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                action
            },
            dataType: "JSON",
            beforeSend: function() {
                tablas.waitMe();
            }
        }).done(function (response) {
            console.log(response);
            $('#tabla-productos').html("");
            $('#table-body').html("");
            tablaPagos.html("");
            if(response.respuesta == 'exito'){
                // Si hay productos las botones se habilitan
                btnPay.attr('disabled',false);
                btnCancel.attr('disabled',false);

                // extrayendo los valores de la peticion ajax
                const carro = response.carrito; // carrito con productos
                const pagos = response.pagos; // resumen de costo de productos
                let tablaContent = `
                    <div class="table-responsive" id="tabla-productos">
                    <table class="table table-hover table-striped table-sm" id="table-loader">
                        <thead id="table-head">
                        <tr>
                            <th>Producto</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-right">Total</th>
                            <th class="text-right"></th>
                        </tr>
                        </thead>
                        <tbody id="table-body">
                        <!-- Contenido del carrito -->
        
                        </tbody>
                    </table>
                </div>
                `;
                $('#tabla-productos').html(tablaContent);
                setTimeout(() => {
                    carro.forEach(producto => {
                        const fila = document.createElement('tr');
                        const precio = parseFloat(producto.precio);
                        const precioTotal = precio * producto.cantidad;
                        let template = `
                            <td class="align-middle" width="25%">
                                <span class="d-block text-truncate">${producto.nombre}</span>
                                <small class="d-block text-muted">SKU ${producto.sku}</small>
                            </td>
                            <td class="align-middle text-center">S/. ${producto.precio}</td>
                            <td class="align-middle text-center" width="5%">
                                <input data-id=${producto.id} data-cantidad="${producto.cantidad}" type="text" class="form-control form-control-sm text-center do_update_cart" value=${producto.cantidad}>
                            </td>
                            <td class="align-middle text-right">
                                S/. ${precioTotal} 
                            </td>
                            <td class="text-right align-middle">
                                <button class="btn btn-sm btn-danger do_delete_from_cart" data-id=${producto.id}>
                                <i class="fas fa-times"></i>
                                </button>
                            </td>
                        `;
                        fila.innerHTML = template;
                        $('#table-body').append(fila);
                    });
    
                    let contenido = `
                        <tr>
                            <th class="border-0">Subtotal</th>
                            <td class="text-primary text-right border-0">${pagos.subtotal}</td>
                        </tr>
                        <tr>
                            <th>Envio</th>
                            <td class="text-primary text-right">S/. ${pagos.shipment}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td class="text-primary text-right "><h3 class="font-weight-bold">S/. ${pagos.total} </h3></td>
                        </tr>
                    `;
                    tablaPagos.html(contenido);
                    tablas.waitMe('hide');
                }, 1500);
                
            }else if(response.respuesta == 'no hay productos'){
                // Si no hay productos las botones se desahabilitan
                btnPay.attr('disabled',true);
                btnCancel.attr('disabled',true);

                setTimeout(() => {
                    let contenido = `
                        <div class="text-center py-5">
                            <img src="assets/images/empty-cart.png" title="No hay productos" class="img-fluid mb-3" style="width: 80px;">
                            <p class="text-muted">No hay productos en el carrito</p>
                        </div>
                    `;

                    let contenidoPago = `
                        <tr>
                            <th class="border-0">Subtotal</th>
                            <td class="text-primary text-right border-0">S/. 0</td>
                        </tr>
                        <tr>
                            <th>Envio</th>
                            <td class="text-primary text-right">S/. 10</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td class="text-primary text-right "><h3 class="font-weight-bold">S/. 0 </h3></td>
                        </tr>
                    `;
                    $('#tabla-productos').html(contenido);
                    tablaPagos.html(contenidoPago);
                    tablas.waitMe('hide');
                }, 1500);
            }else{
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: 'Upps, hubo un error',
                    timer: 1500
                  })
            }
        }).fail(function(error){
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Upps, hubo un error',
                timer: 1500
              })
        });
    }
    loard_cart();

    // Agregar al carro al dar clic en botón
     // Actualizar las cantidad del carro si el producto ya existe dentro
    $('.do_add_to_cart').on('click', function (e) {
        e.preventDefault();
        var boton = $(this),
        id = $(this).data('id'),
        cantidad = $(this).data('cantidad'),
        action = 'post',
        old_label = boton.html(),
        spinner = '<i class="fas fa-spinner fa-spin d-block text-center"></i>';

        
        $.ajax({
            type: "POST",
            url: "ajax.php",
            // cache: false,
            data: {
                action,
                id,
                cantidad
            },
            dataType: "JSON",
            beforeSend: function() {
                boton.html(spinner);
            }
        }).done(function (response) {
            // console.log(response.producto);
            if(response.respuesta == 'exito'){
                Swal.fire({
                    type: 'success',
                    title: 'Correcto',
                    text: 'Producto agregado al carrito',
                    timer: 1500
                  })
                loard_cart();
            }else{
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: 'No se pudo agregar al carrito',
                    timer: 1500
                  })
            }
        }).fail(function(error){
            Swal.fire({
                type: 'error',
                title: 'Upps',
                text: 'Ocurrio un problema',
                timer: 1500
              })
        }).always(function(){
            setTimeout(() => {
                boton.html(old_label);
            }, 1500);
        });


    });

    // Actualizar carro con input
    $('body').on('blur','.do_update_cart' , do_update_cart);
    function do_update_cart(event){
        var input = $(this),
        cantidad = parseInt(input.val()),
        id = input.data('id'),  
        action = 'put',
        cant_original = parseInt(input.data('cantidad'));


        // Validar que sea un número integro
        if(Math.floor(cantidad) !== cantidad) {
            cantidad = 1;
        }

        // Validar que el número ingresado sea mayor a 0 y menor a 99
        if(cantidad < 1){
            loard_cart();
            return false;
            // cantidad = 1;
 
        }else if(cantidad > 99){
            cantidad = 99;
        }

        if(cantidad === cant_original) return false;

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                cantidad,
                action,
                id
            },
            dataType: "JSON"
        }).done(function (response) {
            console.log(response);
            if(response.respuesta == 'exito'){
                Swal.fire({
                    type: 'success',
                    title: 'Correcto',
                    text: 'Se actualizo el producto',
                    timer: 1500
                  })
            }else{
                Swal.fire({
                    type: 'error',
                    title: 'Upps',
                    text: 'Ocurrio un problema',
                    timer: 1500
                  })
            }
            loard_cart();
        }).fail(function(error){
            Swal.fire({
                type: 'error',
                title: 'Upps',
                text: 'Ocurrio un problema',
                timer: 1500
              })
        });

    }

    // Borrar elemento del carro
    $('body').on('click','.do_delete_from_cart',delete_from_cart);
    function delete_from_cart(event){
        event.preventDefault();
        var id = $(this).data('id'),
        action ='delete';
        console.log(id);

        Swal.fire({
            title: '¿Estas seguro?',
            text: "EL producto se eliminara",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar'
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: {
                        action,
                        id
                    },
                    dataType: "JSON"
                }).done(function (response) {
                    console.log(response);
                    if(response.respuesta == 'exito'){
                        Swal.fire({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Producto eliminado',
                            timer: 1500
                          })
                        loard_cart();
                    }else{
                        Swal.fire({
                            type: 'error',
                            title: 'Upps',
                            text: 'Ocurrio un problema',
                            timer: 1500
                          })
                    }
                    
                }).fail(function(error){
                    Swal.fire({
                        type: 'error',
                        title: 'Upps',
                        text: 'Ocurrio un problema',
                        timer: 1500
                      })
                });
            }
          })

        
    }

    // Vaciar carro
    $('body').on('click', '.do_destroy_cart' , destroy_cart);
    function destroy_cart(event){
        event.preventDefault();
        var action = 'destroy';
        Swal.fire({
            title: '¿Estas seguro?',
            text: "Los productos no se podran recuperar",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar'
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: {
                        action
                    },
                    dataType: "JSON"
                }).done(function (response) {
                    console.log(response);
                    if(response.respuesta == "exito"){
                        Swal.fire({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Productos eliminados',
                            timer: 1500
                          })
   
                        loard_cart();
                    }else{
                        Swal.fire({
                            type: 'error',
                            title: 'Upps',
                            text: 'Ocurrio un problema',
                            timer: 1500
                          })
                    }
                }).fail(function(error){
                    Swal.fire({
                        type: 'error',
                        title: 'Upps',
                        text: 'Ocurrio un problema',
                        timer: 1500
                      })
                });
            }
          })

    }

    // Pagar carrito
    $('body').on('submit', '#do_pay',pay_cart);
    function pay_cart(event){
        event.preventDefault();
        console.log('pay carrito');
        // Leer los datos del cliente
        const formulario = document.querySelector('#do_pay');
        const datos = new FormData(formulario);
        let nombre = datos.get('card_name');
        let tarjeta = datos.get('card_number');
        let fecha = datos.get('card_date');
        let cvc = datos.get('card_cvc');
        let email = datos.get('card_email');
        var action = 'pay';
        console.log(action);
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                action,
                nombre,
                tarjeta,
                fecha,
                cvc,
                email
            },
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                if(response.respuesta == "exito"){
                    Swal.fire({
                        type: 'success',
                        title: 'Correcto',
                        text: 'Compra Exitosa',
                        timer: 1500
                      })
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Upps',
                        text: 'Ocurrio un problema',
                        timer: 1500
                      })
                }

                formulario.reset();
                
            }
        });


    }

});