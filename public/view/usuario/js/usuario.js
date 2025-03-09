document.addEventListener("DOMContentLoaded",()=>{
   console.log("holassss")
    list()
  
         });
         
 const showSave = ()=>{
   
            //window.location.href = "view/cliente/cliente_alta.php";
            window.location.href = "showSave";
        };
  function list(){
    let estado="Inactivo";
    let reseteo="No";

     let cont=1;
           fetch("list",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify()})
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
               let botonEstado= 'disabled';
               let botonAct= '';
              usuarios.forEach((us)=>{
                if(us.estado==1){
                  estado= "Activo";
                  botonEstado='';
                  botonAct='hidden';
                }
                if(reseteo==1){
                    reseteo="Si";
                }
                          
                   let html= '<tr  id= "'+us.id+'" class="'+(us.estado===0 ? 'socio-inactivo' :' ')+'">';
                   html += '<td id="inden">' +  cont+ '</td>';
                   html += '<td id="">' +  us.nomUser+ '</td>';
                   html += '<td id="">' + us.tipoUsuario + '</td>';
                   html += '<td>'+ estado + '</td>';
                   html += '<td id="">' + reseteo+ '</td>';
                   html += '<td id=""><button '+botonEstado+' onclick="actualizar('+us.id+')" type="button" class="btn btn-primary"  id="btnMod">Modificar</button></td>';
                   html += '<td id=""><button '+botonEstado+' onclick="eliminar('+us.id+')" type="button" class="btn btn-danger"  id="btnDesactivar">Desactivar</button></td>';
                   html += '<td id=""><button '+botonAct+' onclick="reactivar('+us.id+')" type="button" class="btn btn-success"  id="btnReactivar">Reactivar</button></td>';
       
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
                
                    alert("Se registro el usuario: " );
                    window.location.href="index";
            
              
            })
            .catch(()=>{});
        
           form.reset();
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
                   fetch("desactivar",{
                   
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
                            
                            const ph= document.getElementById("liveAlertPlaceholder");
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
                  
                    