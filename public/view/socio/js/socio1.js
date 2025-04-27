let cont=1;

        
function validar(input){
   

   if(input.reportValidity()){

    input.style.border=" 2px solid green";
   }
   else{
    input.style.border=" 2px solid red";
   }

  }   

const showSave = ()=>{
  
window.location.href = "showSave";
 };

 document.addEventListener("DOMContentLoaded",()=>{
  list()


       });
       

function list(){
    let reseteo="No";
    console.log("ñaja")
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
             let socios = data.result;
            socios.forEach((so)=>{
              let carmat="xd"
            let estado= "Inactivo";
            let botonEstado= 'disabled';
            let botonAct= '';
                if(so.estado===1){
                    estado="Activo";
                    botonEstado='';
                    botonAct='hidden';
              
                      }
              

                      if(so.tsn=='alumno'){
                        fetch("carreras",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({dni: so.dni})})
                          .then(response => response.json())
                        .then(dataCar => {
                            if(dataCar.error !== ""){
                               alert(dataCar.error);
                                return;
                            }
                           
                            carmat = JSON.stringify(dataCar.result);
                            
                      
                            /*selectMatCar.addEventListener('change',()=>{
                                const seleccionados= selectMatCar.selectedOptions;
                                if(seleccionados.length>3 && datoTipoSocio!=1){
                                   alert("Solo puede seleccionar 3 carreras por alumno.")
                                }*/
                            
                                   let html= '<tr  id= "'+so.dni+'" class="'+(so.estado===0 ? 'socio-inactivo' :' ')+'">';
                                   html += '<td id="inden">' +  cont+ '</td>';
                                   html += '<td id="">' +  so.nombreSocio+ '</td>';
                                   html += '<td id="">' + so.apellido + '</td>';
                                   html += '<td>'+ + so.dni + '</td>';
                                   html += '<td id="">' + so.domicilio+ '</td>';
                                   html += '<td id="">'+so.localidad+ '</td>';
                                   html += '<td id="">'+so.provincia+ '</td>';
                                   html += '<td id="">'+so.telefono+ '</td>';
                                   html += '<td id="">'+ so.correo+ '</td>';
                                   html += '<td id="">'+ so.fechaAlta+ '</td>';
                                   html += '<td id="">'+ estado+ '</td>';
                                   html += '<td id="">'+ so.tsn+ '</td>';
                                   html += '<td id=""> '+  carmat+'</td>'; 
                                   html += '<td id=""><a href= "http://localhost/biblioteca/public/view/socio/' + so.frenteDni + '" target="_blank" > Ver </a></td>';
                                   html += '<td id=""><a href= "http://localhost/biblioteca/public/view/socio/' + so.dorsoDni + '" target="_blank" > Ver </a></td>';
                                   html += '<td id=""><button '+botonEstado+' onclick="actualizar('+JSON.stringify(so).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Modificar</button></td>';
                                   html += '<td id=""><button '+botonEstado+' onclick="eliminar('+so.dni+')" type="button" class="btn btn-danger"  id="btnDesactivar">Desactivar</button></td>';
                                   html += '<td id=""><button  onclick="reactivar('+so.dni+')" type="button" class="btn btn-success"  id="btnReactivar">Reactivar</button></td>';
                                   html += '</tr>';
                    
                  
                                   
                         
                           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
                       cont= cont+1;
                          
                        })
                        .catch();
                    
                     
                    
                       }





                       if(so.tsn=='profesor'){
                        console.log("ola es profesor")
                        fetch("materias",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({dni: so.dni})})
                          .then(response => response.json())
                        .then(dataCar => {
                            if(dataCar.error !== ""){
                               alert(dataCar.error);
                                return;
                            }
                           
                            carmat = JSON.stringify(dataCar.result);
                            
                      
                            /*selectMatCar.addEventListener('change',()=>{
                                const seleccionados= selectMatCar.selectedOptions;
                                if(seleccionados.length>3 && datoTipoSocio!=1){
                                   alert("Solo puede seleccionar 3 carreras por alumno.")
                                }*/
                            
                    
                                   let html= '<tr  id= "'+so.dni+'" class="'+(so.estado===0 ? 'socio-inactivo' :' ')+'">';
                                   html += '<td id="inden">' +  cont+ '</td>';
                                   html += '<td id="">' +  so.nombreSocio+ '</td>';
                                   html += '<td id="">' + so.apellido + '</td>';
                                   html += '<td>'+ + so.dni + '</td>';
                                   html += '<td id="">' + so.domicilio+ '</td>';
                                   html += '<td id="">'+so.localidad+ '</td>';
                                   html += '<td id="">'+so.provincia+ '</td>';
                                   html += '<td id="">'+so.telefono+ '</td>';
                                   html += '<td id="">'+ so.correo+ '</td>';
                                   html += '<td id="">'+ so.fechaAlta+ '</td>';
                                   html += '<td id="">'+ estado+ '</td>';
                                   html += '<td id="">'+ so.tsn+ '</td>';
                                   html += '<td id=""> '+  carmat+'</td>';
                                   html += '<td id=""><a href= "http://localhost/biblioteca/public/view/socio/' + so.frenteDni + '" target="_blank" > Ver </a></td>';
                                   html += '<td id=""><a href= "http://localhost/biblioteca/public/view/socio/' + so.dorsoDni + '" target="_blank" > Ver </a></td>';
                                   html += '<td id=""><button '+botonEstado+' onclick="actualizar('+JSON.stringify(so).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Modificar</button></td>';
                                   html += '<td id=""><button '+botonEstado+' onclick="eliminar('+so.dni+')" type="button" class="btn btn-danger"  id="btnDesactivar">Desactivar</button></td>';
                                   html += '<td id=""><button  onclick="reactivar('+so.dni+')" type="button" class="btn btn-success"  id="btnReactivar">Reactivar</button></td>';
                                   html += '</tr>';
                    
                  
                                   
                         
                           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
                       cont= cont+1;
                          
                        })
                        .catch();
                    
                     
                    
                       }
                      
                       
                
             });
            }
         )};
        
        
     


const sendNewClient = ()=>{
  
 
    let form = document.forms["formAlta"];
    
  if(form.reportValidity()){
    

    let selecs = Array.from(document.getElementById("datoMateriaCarrera").selectedOptions)
    .map(option => parseInt(option.value));

let formData = new FormData(form);



// Agregar las materias/carreras como array manualmente
selecs.forEach((val, i) => {
    formData.append(`datoMateriaCarrera[]`, val); // el [] es clave
});

    
    fetch("save",{"method":"POST", "body":formData})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
            const ph= document.getElementById("liveAlertPlaceholder6");
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
           const wrop= appendAlert(data.error, 'danger')
          
           setTimeout(()=>{
            wrop.remove();
           },4000);
              
                window.location.href="index";
        
        }
        const ph= document.getElementById("liveAlertPlaceholder6");
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
       const wrop= appendAlert('Se registro el cliente. Su usuario es su correo electrónico y la clave su dni, se le pedirá resetearla', 'success')
      
       setTimeout(()=>{
        wrop.remove();
       },4000);
          
           window.location.href="index";
    
      
    })
    .catch(()=>{});
    form.reset();

}
   }

function materiaOcarrera(){
   let selectTipoSocio= document.getElementById("datoTipoSocio").value;
   let seleccion;
   if(selectTipoSocio==1){
       seleccion='obtenerMaterias';}
   else{
    seleccion='obtenerCarreras';
   
   }
   fetch(seleccion)
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
       
        let selectMatCar= document.getElementById("datoMateriaCarrera");
        selectMatCar.innerHTML="";
        let resuls=data.result;
        
   
        resuls.forEach((elem)=>{
            const op= document.createElement('option');
            op.value=elem.codigo;
            op.textContent=elem.nombre;
            selectMatCar.appendChild(op);
        })
        
        /*selectMatCar.addEventListener('change',()=>{
            const seleccionados= selectMatCar.selectedOptions;
            if(seleccionados.length>3 && datoTipoSocio!=1){
               alert("Solo puede seleccionar 3 carreras por alumno.")
            }*/
        

    
      
    })
    .catch(error=>alert("error al cargar materias/carreras"));
}
function materiaOcarreraxSocio(id){
 let seleccionados=[];
 let todos=[];
  let selectTipoSocio= document.getElementById("datoTipoSocio").value;
  let seleccion;
  let seleccion1;
  if(selectTipoSocio==1){ // 1 es profesor
      seleccion='obtenerMateriasxSocio';
      seleccion1='obtenerMaterias';}
  else{
   seleccion='obtenerCarrerasxSocio'; //2 es alumno
   seleccion1='obtenerCarreras'; 
  }
   fetch(seleccion1,{method:'POST',headers:{ 'Content-Type':'application/json'},body:JSON.stringify({id: id})})
   .then(response => response.json())
   .then(data => {
       if(data.error !== ""){
          alert(data.error);
           return;
       }   
     
      

     let selectMatCar= document.getElementById("datoMateriaCarrera");
     selectMatCar.innerHTML="";
       todos= data.result;
       console.log("seleccionados es "+todos)
      todos.forEach((elem)=>{
           const op= document.createElement('option');
           op.value=elem.codigo;
           op.textContent=elem.nombre;
           selectMatCar.appendChild(op);})
           fetch(seleccion,{method:'POST',headers:{ 'Content-Type':'application/json'},body:JSON.stringify({id: id})})
           .then(response => response.json())
           .then(datax => {
               if(datax.error !== ""){
                  alert(datax.error);
                   return;
               }   
             let selectMatCar= document.getElementById("datoMateriaCarrera");
            // selectMatCar.innerHTML="";
               seleccionados= datax.result;
              // console.log("seleccionados es "+ seleccionados)
          
              todos.forEach((elem)=>{
                const matselec= seleccionados.find((seleccionada)=> seleccionada.codigo== elem.codigo)
                if(matselec){
                  console.log("ola entre al if")
                  const op= selectMatCar.querySelector(`option[value="${elem.codigo}"]`);
              if(op){
                op.selected= true;
              }
                
                }
               })
              
              
             })
              
          .catch();
       })
   .catch();

 
   /*let selectMatCar= document.getElementById("datoMateriaCarrera");
  
   selectMatCar.innerHTML="";
   seleccionados.forEach((elem)=>{
    console.log("estoy en el foreach")
    const op= document.createElement('option');
    op.value=elem.codigo;
    op.textContent=elem.nombre;
    selectMatCar.appendChild(op);})*/



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
       fetch("delete",{
       
           method:'POST',
           headers:{ 'Content-Type':'application/json'},
           body:JSON.stringify({id: id,motivo: motivo})
         })
           .then(response => response.json())
           .then(data => {

            
               if(data.error !== ""){
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
               const wrop= appendAlert(data.error, 'success')
              
               setTimeout(()=>{
                wrop.remove();
               },3000);

               window.location.href="index";
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

               window.location.href="index";
               
               
              //window.location.reload();
            
           }}
           )
      






    }
      
     
            });
 })
 
  
}
function reactivar(id){

fetch("reactivar",
    {
        method:'POST',
        headers:{ 'Content-Type':'application/json'},
        body:JSON.stringify({id: id})
      })
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
                const ph1= document.getElementById("liveAlertPlaceholderR");
                if(ph1.querySelector('.alert')){
                    return;
                }
               const appendAlert1= (message,type)=>{
               const wrapR= document.createElement("div")
               wrapR.innerHTML=[
                `<div class="alert alert-${type} alert-dismissible" role="alert">`,
              `   <div>${message}</div>`,
             
                '</div>'
              ].join('')

              ph.append(wrapR)
             return wrapR
               };
               const wrop= appendAlert1(data.error, 'success')
              
               setTimeout(()=>{
                wrop.remove();
               },3000);

               window.location.href="index";
               
            }
            else{
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
                setTimeout(()=>{
                  window.location.href="index";
          
                 },4000);
               
            }
        
})

   
}
  function actualizar(so){
    const myModal = new bootstrap.Modal(document.getElementById('myModal'))
    myModal.show();
    console.log("so es"+so);
  let form = document.forms["formAct"];
    

 // document.getElementById("datoMateriaCarrera").value=so.mate;
 
 document.getElementById("datoApellido").value= so.apellido
 document.getElementById("datoNombre").value=so.nombreSocio;
 document.getElementById("datoDni").value=so.dni;
 document.getElementById("datoLocalidad").value= so.localidad
 document.getElementById("datoProvincia").value=so.provincia;
 document.getElementById("datoTelefono").value=so.telefono;

 document.getElementById("datoCorreo").value= so.correo
 document.getElementById("datoDomicilio").value= so.domicilio

 document.getElementById("selectEstado").value= so.estado
 let selectTipoUser= document.getElementById("datoTipoSocio");

 document.getElementById("datoFrenteDni").dataset.imagenActual = so.frenteDni; // Guardamos la ruta actual como atributo de datos
document.getElementById("datoDorsoDni").dataset.imagenActual=so.dorsoDni;
 let imagenActual = document.getElementById("datoFrenteDni").dataset.imagenActual;

 let imagenActual1 = document.getElementById("datoDorsoDni").dataset.imagenActual;
 console.log("dorso es "+ imagenActual1)
 console.log("frente es "+ imagenActual)
 selectTipoUser.querySelectorAll("option").forEach(op=>{
     if( so.tsn== op.text){

     // console.log("ola el tsn so es "+ so.tsn);
         selectTipoUser.value=op.value;
     }
 })
 let selectEstado= document.getElementById("selectEstado")
  selectEstado.value=so.estado
  let selectMateria= document.getElementById("datoMateriaCarrera");
  materiaOcarreraxSocio(so.dni);
  



}


    
function modificar(){










  
 
  let form = document.forms["formAct"];
  let selecs = Array.from(document.getElementById("datoMateriaCarrera").selectedOptions)
    .map(option => parseInt(option.value));
  let formData = new FormData(form);
selecs.forEach((val, i) => {
    formData.append(`datoMateriaCarrera[]`, val); 
});
    
  fetch("update",
    {
        method:'POST',
        body: formData
      })
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
                alert("ocurrió un error: " + data.error);
                return;
            }
            else{
              
             // myModal.hide()
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
                setTimeout(()=>{
                  window.location.href="index";
          
                 },4000);
             // window.location.reload();
              
                /*let user= document.getElementById(id);
                user.querySelector("#btnMod").removeAttribute("disabled");
                user.querySelector("#btnDesactivar").removeAttribute("disabled");
                user.classList.remove("socio-inactivo");*/
            }
        
})
 
      
   
   

}

function buscarSocio(){
  console.log("ola soy buscar")
  let formBus=document.getElementById("formBus")
  let datoSocio=document.getElementById("datoBus")
  let socio= datoSocio.value;
 // if (formAlta.reportValidity()){
  datoSocio.style.border='';
   errSocio.style.display='none';

if(datoBus===""){
  return
}
fetch("../socio/buscar",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({datoBus:socio})})
.then(response => response.json())
.then(data => {
  
    if(data.error !== ""){
       alert(data.error);
        return;

    }
    let socio= data.result;
   
    if(data.result==""){
      //alert("no se encontró el socio");
       datoBus.style.border= "solid red"
       errSocio.style.display='block'
       errSocio.textContent='Socio no encontrado'
       let tab= document.getElementById("tablaClientes");
       let bodyx= tab.querySelector("tbody")
        bodyx.innerHTML="";
       setTimeout(()=>{
      errSocio.style.display='none';
 

       },3000)
      
      
       
   }else{
  //  toast.hide()
  
  datoSocio.style.border= "solid green"
  errSocio.style.display='none';
  let tab= document.getElementById("tablaClientes");
  let bodyx= tab.querySelector("tbody")
   bodyx.innerHTML="";
   

   socio.forEach((so)=>{
    let carmat="xd"
  let estado= "Inactivo";
  let botonEstado= 'disabled';
  let botonAct= '';
      if(so.estado===1){
          estado="Activo";
          botonEstado='';
          botonAct='hidden';
    
            }
    console.log("ola so tsn es "+so.tipoSocio)
            console.log("todo ok")
            if(so.tipoSocio== 2){
              fetch("carreras",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({dni: so.dni})})
                .then(response => response.json())
              .then(dataCar => {
                  if(dataCar.error !== ""){
                     alert(dataCar.error);
                      return;
                  }
                 
                  carmat = JSON.stringify(dataCar.result);
                  
            
                  /*selectMatCar.addEventListener('change',()=>{
                      const seleccionados= selectMatCar.selectedOptions;
                      if(seleccionados.length>3 && datoTipoSocio!=1){
                         alert("Solo puede seleccionar 3 carreras por alumno.")
                      }*/

                         
                  
                         let html= '<tr  id= "'+so.dni+'" class="'+(so.estado===0 ? 'socio-inactivo' :' ')+'">';
                         html += '<td id="inden">' +  cont+ '</td>';
                         html += '<td id="">' +  so.nombre+ '</td>';
                         html += '<td id="">' + so.apellido + '</td>';
                         html += '<td>'+ + so.dni + '</td>';
                         html += '<td id="">' + so.domicilio+ '</td>';
                         html += '<td id="">'+so.localidad+ '</td>';
                         html += '<td id="">'+so.provincia+ '</td>';
                         html += '<td id="">'+so.telefono+ '</td>';
                         html += '<td id="">'+ so.correo+ '</td>';
                         html += '<td id="">'+ so.fechaAlta+ '</td>';
                         html += '<td id="">'+ estado+ '</td>';
                         html += '<td id="">Alumno</td>';
                         html += '<td id=""> '+  carmat+'</td>'; 
                         html += '<td id=""><a href= "http://localhost/biblioteca/public/view/socio/' + so.frenteDni + '" target="_blank" > Ver </a></td>';
                         html += '<td id=""><a href= "http://localhost/biblioteca/public/view/socio/' + so.dorsoDni + '" target="_blank" > Ver </a></td>';
                         html += '<td id=""><button '+botonEstado+' onclick="actualizar('+JSON.stringify(so).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Modificar</button></td>';
                         html += '<td id=""><button '+botonEstado+' onclick="eliminar('+so.dni+')" type="button" class="btn btn-danger"  id="btnDesactivar">Desactivar</button></td>';
                         html += '<td id=""><button  onclick="reactivar('+so.dni+')" type="button" class="btn btn-success"  id="btnReactivar">Reactivar</button></td>';
                         html += '</tr>';
          
        
                         
               
                 document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
             cont= cont+1;
                
              })
              .catch();
          
           
          
             }





             if(so.tipoSocio== 1){
              console.log("ola es profesor")
              fetch("materias",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({dni: so.dni})})
                .then(response => response.json())
              .then(dataCar => {
                  if(dataCar.error !== ""){
                     alert(dataCar.error);
                      return;
                  }
                 
                  carmat = JSON.stringify(dataCar.result);
                  
            
                  /*selectMatCar.addEventListener('change',()=>{
                      const seleccionados= selectMatCar.selectedOptions;
                      if(seleccionados.length>3 && datoTipoSocio!=1){
                         alert("Solo puede seleccionar 3 carreras por alumno.")
                      }*/
                  
          
                         let html= '<tr  id= "'+so.dni+'" class="'+(so.estado===0 ? 'socio-inactivo' :' ')+'">';
                         html += '<td id="inden">' +  cont+ '</td>';
                         html += '<td id="">' +  so.nombre+ '</td>';
                         html += '<td id="">' + so.apellido + '</td>';
                         html += '<td>'+ + so.dni + '</td>';
                         html += '<td id="">' + so.domicilio+ '</td>';
                         html += '<td id="">'+so.localidad+ '</td>';
                         html += '<td id="">'+so.provincia+ '</td>';
                         html += '<td id="">'+so.telefono+ '</td>';
                         html += '<td id="">'+ so.correo+ '</td>';
                         html += '<td id="">'+ so.fechaAlta+ '</td>';
                         html += '<td id="">'+ estado+ '</td>';
                         html += '<td id="">Profesor</td>';
                         html += '<td id=""> '+  carmat+'</td>';
                         html += '<td id=""><a href= "http://localhost/biblioteca/public/view/socio/' + so.frenteDni + '" target="_blank" > Ver </a></td>';
                         html += '<td id=""><a href= "http://localhost/biblioteca/public/view/socio/' + so.dorsoDni + '" target="_blank" > Ver </a></td>';
                         html += '<td id=""><button '+botonEstado+' onclick="actualizar('+JSON.stringify(so).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Modificar</button></td>';
                         html += '<td id=""><button '+botonEstado+' onclick="eliminar('+so.dni+')" type="button" class="btn btn-danger"  id="btnDesactivar">Desactivar</button></td>';
                         html += '<td id=""><button  onclick="reactivar('+so.dni+')" type="button" class="btn btn-success"  id="btnReactivar">Reactivar</button></td>';
                         html += '</tr>';
          
        
                         
               
                 document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
             cont= cont+1;
                
              })
              .catch();
          
           
          
             }
                
             

            })








 
     



     
     }
      
  })

}