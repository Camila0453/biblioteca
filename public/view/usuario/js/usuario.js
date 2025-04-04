console.log("usuario")
document.addEventListener("DOMContentLoaded",()=>{
   
   list()
  
         });

         const showIndex = ()=>{
   
          //window.location.href = "view/cliente/cliente_alta.php";
          window.location.href = "index";
      };  

const showLibros=()=>{
  window.location.href = "../libro/index";
}
const showEjemplares=()=>{
  window.location.href = "../ejemplar/index";
}
      
const showSocios =()=>{
  window.location.href = "../socio/index";
}
const showPrestamos =()=>{
  window.location.href = "../prestamo/index";
}
 const showSave = ()=>{
   
            //window.location.href = "view/cliente/cliente_alta.php";
            window.location.href = "showSave";
        };
  function list(){
    let estado="Inactivo";
    
    
     let cont=1;
           fetch("list/usuario",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify()})
           .then(response => response.json())
           .then(data => {
               if(data.error !== ""){
                   alert("ocurrió un error: " + data.error);
                   return;
               }
               if(data.result == ''){
                   alert("No hay clientes para mostrar")
               }
               //procesar data.result en una tabla (mostrar los clientes)
               
               let usuarios = data.result;
              usuarios.forEach((us)=>{
                let tipou= us.tipoUsuario|| "";
                let estado="Inactivo";
               let botonEstado= 'disabled';
               let reseteo=us.reseteo;
                if(us.estado==1){
                  estado= "Activo";
                  botonEstado='';
                }
                if(us.reseteo==1){
                    reseteo="Si";
                }
                else{
                  reseteo="No";
                }
                console.log("boton estado es",botonEstado)
                          
                   let html= '<tr  id= "'+us.id+'" class="">';
                   html += '<td id="inden">' +  cont+ '</td>';
                   html += '<td id="">' +  us.nomUser+ '</td>';
                   html += '<td id="">' +  us.nombreCompleto+ '</td>';
                   html += '<td id="">' +  us.dni+ '</td>';
                   html += '<td id="">' + tipou + '</td>';
                   html += '<td>'+ estado + '</td>';
                   html += '<td id="">' + reseteo+ '</td>';
                   html += '<td id=""><button  onclick="modificar('+JSON.stringify(us).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Modificar</button></td>';
                   html += '<td id=""><button '+botonEstado+' onclick="eliminar('+us.id+')" type="button" class="btn btn-danger"  id="btnDesactivar">Desactivar</button></td>';
                   html += '</tr>';
         
           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });
           
           
       
       };


const sendNewUser = ()=>{
 let form = document.forms["formAlta"];
            
          if(form.reportValidity()){
           
            let request = {};
            request.datoCorreo = form.datoCorreo.value;
            request.datoTipoUsuario=form.datoTipoUsuario.value;
            request.datoNombre=form.datoNombre.value;
            request.datoDni=form.datoDni.value;
            
        
            fetch("save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
            .then(response => response.json())
            .then(data => {
                if(data.error !== ""){
                   alert(data.error);
                    return;
                }
                
               
                let ph2= document.getElementById("liveAlertPlaceholder2");
                const appendAlert12= (message,type)=>{
                  const wrap12= document.createElement("div")
                  wrap12.innerHTML=[
                   `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                 `   <div>${message}</div>`,
                
                   '</div>'
                 ].join('')
   
                 ph2.append(wrap12)
                return wrap12
                  };
                  const wrop12= appendAlert12('El usuario se registró exitosamente, su nombre de usuario es el correo y la clave su dni, deberá resetearla al iniciar sesión por primera vez', 'success')
                 
                  setTimeout(()=>{
                   wrop12.remove();
                  },3000);
                  setTimeout(()=>{
                    window.location.href="index";
            
                   },1000);
                 
              
            })
            .catch(()=>{});
        
           //form.reset();
        }
           }
        
  const limpiar  = (id)=>{
  id.reset();
        }


 function eliminar(id){
            btnAceptar=document.getElementById("btnAceptar")
            const toastLiveExample = document.getElementById('toastElim')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
             toastBootstrap.show()
            
            
            
            
            btnAceptar.addEventListener('click',()=>{
                toastBootstrap.hide()
            const toast = document.getElementById('toastPrompt')
            const toastBootstrap1 = bootstrap.Toast.getOrCreateInstance(toast)
             toastBootstrap1.show()
             let btnMotivo= document.getElementById("btnMotivo")
            
            
            
            
             btnMotivo.addEventListener('click',()=>{
                toastBootstrap1.hide()
                let motivo= document.getElementById("inputMotivo").value;
                if(motivo){
                   fetch("delete/usuario",{
                   
                       method:'POST',
                       headers:{ 'Content-Type':'application/json'},
                       body:JSON.stringify({id: id,motivo: motivo})
                     })
                       .then(response => response.json())
                       .then(data => {
            
                        
                           if(data.error !== ""){
                               alert("ocurrió un error: " + data.error);
                               return;
                           }
                           else{
                            
                            let ph= document.getElementById("liveAlertPlaceholder");
                            if(ph.querySelector('.alert')){
                                return;
                            }
                           const appendAlert= (message,type)=>{
                           const wrap= document.createElement("div")
                           wrap.innerHTML=[
                            `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                          `   <div>${message}</div>`,
                         
                            '</div>'
                          ].join('')
            
                          ph.append(wrap)
                         return wrap
                           };
                           const wrop= appendAlert('Baja realizada correctamente', 'success')
                          
                           setTimeout(()=>{
                            wrop.remove();
                           },3000);
            
                           
                           
                           
                          //window.location.reload();
                        
                       }}
                       )
                  
            
            
            
            
            
            
                }
                  
                 
                        });
             })
             
              
            }
 function reactivar(id){

                fetch("activar",
                    {
                        method:'POST',
                        headers:{ 'Content-Type':'application/json'},
                        body:JSON.stringify({id: id})
                      })
                        .then(response => response.json())
                        .then(data => {
                            if(data.error !== ""){
                                alert("ocurrió un error: " + data.error);
                                return;
                            }
                            else{
                                let user= document.getElementById(id);
                                user.querySelector("#btnMod").removeAttribute("disabled");
                                user.querySelector("#btnDesactivar").removeAttribute("disabled");
                                user.classList.remove("socio-inactivo");
                            }
                        
                })
                
                   
                }
function modificar(us){
    console.log(us)
   document.getElementById("datoNombre").value= us.nombreCompleto;
   document.getElementById("datoCorreo").value=us.nomUser;
   document.getElementById("datoDni").value=us.dni;
   
  let selectTipoUser= document.getElementById("datoTipoUsuario");
  selectTipoUser.querySelectorAll("option").forEach(op=>{
      if( us.tipoUsuario== op.text){

    
          selectTipoUser.value=op.value;
      }
  })
  let selectEstado= document.getElementById("selectEstado")
 
   selectEstado.value=us.estado
  console.log("select estado es"+ selectEstado.value)
  const myModal = new bootstrap.Modal(document.getElementById('myModal'))
  myModal.show();
let form= document.getElementById("formAct")


 document.getElementById("btnAct").addEventListener("click",()=>{
  let request= {}
   request.datoEstado=form.selectEstado.value;
   request.datoNombreC= form.datoNombre.value;
   request.datoCorreox=form.datoCorreo.value;
   request.datoDni=form.datoDni.value;
   request.datoTipoUsuario= form.datoTipoUsuario.value;
   request.datoId= us.id;

  fetch("update/usuario",
    {
        method:'POST',
        headers:{ 'Content-Type':'application/json'},
        body:JSON.stringify(request)
      })
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
                alert("ocurrió un error: " + data.error);
                return;
            }
            else{
              
              myModal.hide()
              let ph= document.getElementById("liveAlertPlaceholder");
              const appendAlert1= (message,type)=>{
                const wrap1= document.createElement("div")
                wrap1.innerHTML=[
                 `<div class="alert alert-${type} alert-dismissible" role="alert">`,
               `   <div>${message}</div>`,
              
                 '</div>'
               ].join('')
 
               ph.append(wrap1)
              return wrap1
                };
                const wrop1= appendAlert1('El usuario se actualizó exitosamente', 'success')
               
                setTimeout(()=>{
                 wrop1.remove();
                },1000);
             
             // window.location.reload();
              
                /*let user= document.getElementById(id);
                user.querySelector("#btnMod").removeAttribute("disabled");
                user.querySelector("#btnDesactivar").removeAttribute("disabled");
                user.classList.remove("socio-inactivo");*/
            }
        
})
 })

   
  // console.log(us.nomUser);
       
    
    /**/
}

                  
                    