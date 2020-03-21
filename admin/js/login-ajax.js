const formLogin = document.getElementById('login-admin');

document.addEventListener('DOMContentLoaded',() =>{

    if(formLogin){
        formLogin.addEventListener('submit',loginAdmin);
    }

});

function loginAdmin(e){
    // Eniar datos para el loogin de administradores
    e.preventDefault();
    const datos = new FormData(formLogin);
    const url = formLogin.getAttribute('action');
    const method = formLogin.getAttribute('method');

    // Inicializar el objeto xmlhttprequest
    const xhr = new XMLHttpRequest();
    // Abrir la conexion
    xhr.open(method,url,true);
    // Comprobar la respuesta del servidor
    xhr.onload = function(){
        if(this.status == 200){
            const respuesta = this.responseText;
            const resultado = JSON.parse(respuesta.slice(0,respuesta.indexOf('}')+1));
            if(resultado.respuesta == 'exitoso'){
                Swal.fire(
                    'Login Correcto',
                    "Bienvenid@ "+resultado.usuario,
                    'success'
                  )
                  setTimeout(() => {
                    window.location.href = 'admin-area.php';
                  }, 2000);
            }else{
                Swal.fire(
                    'Error',    
                    'Usuario o password Incorrectos',
                    'error'
                  )
            }
            formLogin.reset();
        }
    };
    xhr.send(datos);
     
}