// Variables
const tabla = document.getElementById('table-body');
const listaPorductos =document.getElementById('lista-productos');
const listaCarrito = document.getElementById('table-loader');
const vaciarCarrito = document.getElementById('btn-clear');

// Events Listeners
document.addEventListener('DOMContentLoaded',mostrarLocalStorage);
listaPorductos.addEventListener('click',agregarPorducto);
listaCarrito.addEventListener('click',borrarProducto);
vaciarCarrito.addEventListener('click',borrarCarrito);

// Funciones

// Funcion agregar producto al carrito
function agregarPorducto(e){
    e.preventDefault();
    // console.log(e.target);
    if(e.target.classList.contains('btn')){
        const producto = e.target.parentElement;
        leerProducto(producto);

    }else if(e.target.classList.contains('fa-plus')){
        const producto = e.target.parentElement.parentElement;
        leerProducto(producto);
    }
}

function leerProducto(producto){
    const infoProducto = {
        nombre: producto.querySelector('#title').textContent,
        precio: producto.querySelector('#price').textContent,
        sku: producto.querySelector('#sku').textContent,
        id: producto.querySelector('i').getAttribute('id')
    }
    // console.log(infoProducto);
    insertarProducto(infoProducto);
}

function insertarProducto(infoProducto){
    const itemProducto = document.createElement('tr');
    let template = `
        <td class="align-middle">
            ${infoProducto.nombre}
            <small class="d-block text-muted">SKU ${infoProducto.sku}</small>
        </td>
        <td class="align-middle text-center " width="5%">
            <input type="number" class="form-control form-contorl-sm" min="0" max="50" value="1">
        </td>
        <td class="align-middle text center">${infoProducto.precio}</td>
        <td class="text-center align-middle"><i class="fas fa-times text-danger borrar-curso" id=${infoProducto.id}></i></td>
    `;

    itemProducto.innerHTML = template;
    tabla.appendChild(itemProducto);
    guardarProductoLocalStorage(infoProducto);
}

// funcion borrar producto del carrito
function borrarProducto(e){
    e.preventDefault();
    let productoBorrar;
    if(e.target.classList.contains('borrar-curso')){
        e.target.parentElement.parentElement.remove();
        productoBorrar = e.target.getAttribute('id');
        borrarCarritoLocalStorage(productoBorrar);
    }
}

// funcion borrar el carrito de produtos
function borrarCarrito(e){
    e.preventDefault();
    // console.log(e.target);
    // tabla.innerHTML = "";
    while(tabla.firstElementChild){
        tabla.removeChild(tabla.firstElementChild);
    }
    borrarLocalStorage();
}

// funcion mostrar los productos del localstorage
function mostrarLocalStorage(){
    let productosLS = obetnerLocalStorage();
    productosLS.forEach(producto => {
        let itemProducto = document.createElement('tr');
        let template = `
            <td class="align-middle">
                ${producto.nombre}
                <small class="d-block text-muted">SKU ${producto.sku}</small>
            </td>
            <td class="align-middle text-center " width="5%">
                <input type="number" class="form-control form-contorl-sm" min="0" max="50" value="1">
            </td>
            <td class="align-middle text center">${producto.precio}</td>
            <td class="text-center align-middle"><i class="fas fa-times text-danger borrar-curso" id=${producto.id}></i></td>
        `;
    
        itemProducto.innerHTML = template;
        tabla.appendChild(itemProducto);
    });
}

//funcion agregar en localStorage
function guardarProductoLocalStorage(infoProducto){
    let productos;
    productos = obetnerLocalStorage();
    productos.push(infoProducto);
    localStorage.setItem('productos',JSON.stringify(productos));
}

//funcion obtener elemntos del localStorage
function obetnerLocalStorage(){
    let productosLS;
    if(localStorage.getItem('productos') == null){
        productosLS = [];
    }else{
        productosLS = JSON.parse(localStorage.getItem('productos'));
    }
    return productosLS;
}

//funcion eliminar en localStorage
function borrarCarritoLocalStorage(productoBorrar){
    let productosLS = obetnerLocalStorage();
    productosLS.forEach((producto,index) => {
        if(producto.id === productoBorrar){
            productosLS.splice(index,1);
        }
    });
    localStorage.setItem('productos',JSON.stringify(productosLS));
}

// funcion vaciar el localStorage
function borrarLocalStorage(){
    localStorage.clear('productos');
}

