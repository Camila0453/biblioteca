let cont=1;
const showSave = ()=>{
  
window.location.href = "showSave";
 };

 document.addEventListener("DOMContentLoaded",()=>{
  list()

       });
       

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
             let socios = data.result;
            socios.forEach((so)=>{
                if(so.estado===1){
                    estado="Activo";

                }

                        
                 let html= '<tr  id= "'+so.dni+'" class="">';
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
                 html += '<td id=""> </td>';
                 html += '<td id=""></td>';
                 html += '<td id=""></td>';
                 html += '<td id=""></td>';
                 html += '<td id=""><a  href="socio/showUpdate/'+so.id+'" >Modificar</a></td>';
                 html += '<td id=""><button  onclick="eliminar('+so.dni+')" type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button></td>';
                 
                 html += '</tr>';

       
         document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
     cont= cont+1;
             });
         
         });
         
         
     
     };

const sendNewClient = ()=>{
  
 
    let form = document.forms["formAlta"];
    
  if(form.reportValidity()){
    let selecs= Array.from(document.getElementById("datoMateriaCarrera").selectedOptions).map(option =>parseInt(option.value));

    let request = {};
    request.datoApellido = form.datoApellido.value;
    request.datoNombres = form.datoNombre.value;
    request.datoDNI = parseInt(form.datoDni.value);
    request.datoDomicilio= form.datoDomicilio.value;
    request.datoLocalidad=form.datoLocalidad.value;
    request.datoProvincia=form.datoProvincia.value;
    request.datoTelefono=form.datoTelefono.value;
    request.datoCorreo=form.datoCorreo.value;
    request.datoTipoSocio=form.datoTipoSocio.value;
    request.datoFrenteDni=form.datoFrenteDni.value;
    request.datoDorsoDni=form.datoDorsoDni.value;
    request.datoMateriaCarrera=selecs;
    
    fetch("save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
        
            alert("Se registro el cliente: Su usuario es su correo electrónico y la clave su dni, se le pedirá resetearla");
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
            console.log("hola el codigo de la mat es",elem.codigo);
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
function eliminar(id){
    let tostada=`<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastElim" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">Bootstrap</strong>
       <small>11 mins ago</small>
       <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
   </div>
   <div class="toast-body">
    ¿Está seguro de que desea dar de baja al usuario?
   <div class="mt-2 pt-2 border-top">
     <button type="button" id="btnAceptar" class="btn btn-primary btn-sm">Aceptar/button>
     <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Cancelar</button>
  </div>
 </div>
</div>
</div>`


  
document.body.insertAdjacentHTML('beforeend',tostada);
btnAceptar=document.getElementById("btnAceptar")
console.log(btnAceptar)
const toastLiveExample = document.getElementById('toastElim')
const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
 toastBootstrap.show()

btnAceptar.addEventListener('click',()=>{
    let prompti=`<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastPrompt" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">

       <strong class="me-auto">Bootstrap</strong>
       <small>11 mins ago</small>
       <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
   </div>
   <div class="toast-body">
    Ingrese el motivo de la baja
    <form>
     <input id="inputMotivo" type= text>
    </form>
   <div class="mt-2 pt-2 border-top">
     <button type="button" id="btnMotivo" class="btn btn-primary btn-sm">Aceptar</button>
     <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Cancelar</button>
  </div>
 </div>
</div>
</div>`
document.body.insertAdjacentHTML('beforeend',prompti);
const toast = document.getElementById('toastPrompt')
const toastBootstrap1 = bootstrap.Toast.getOrCreateInstance(toast)
 toastBootstrap1.show()
 let btnMotivo= document.getElementById("btnMotivo")
 btnMotivo.addEventListener('click',()=>{
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
                   alert("ocurrió un error: " + data.error);
                   return;
               }
               else{
                   alert("Cliente borrado exitosamente")
                   window.location.href="index";

               }
           }
           )
      
    }
      
     
            });
 })
 
  
}
  
  
    
    
      
   
   



