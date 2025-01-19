let cont=1;
const showSave = ()=>{
  
window.location.href = "showSave";
 };

 document.addEventListener("DOMContentLoaded",()=>{
   list()
       });
       

function list(){
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
                 html += '<td id="">'+ so.estado+ '</td>';
                 html += '<td id="">'+ so.tsn+ '</td>';
                 html += '<td id="">'+  '</td>';
                 html += '<td id="">'+  '</td>';
                 html += '<td id="">'+  '</td>';
                 html += '<td id=""><a  href="socio/showUpdate/'+so.id+'" >Modificar</a></td>';
                 html += '<td id=""><a  href="socio/showDelete/'+so.id+'" >Eliminar</a></td>';
     
                 html += '</tr>';
       
         document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
     cont= cont+1;
             });
         
         });
         
         
     
     };

const sendNewClient = ()=>{
  
 
    let form = document.forms["formAlta"];
    
  if(form.reportValidity()){
    alert("hola soy js")
    let request = {};
    request.datoApellido = form.datoApellido.value;
    request.datoNombres = form.datoNombre.value;
    request.datoDNI = form.datoDni.value;
    request.datoDomicilio= form.datoDomicilio.value;
    request.datoLocalidad=form.datoLocalidad.value;
    request.datoProvincia=form.datoProvincia.value;
    request.datoTelefono=form.datoTelefono.value;
    request.datoCorreo=form.datoCorreo.value;
    request.datoCorreo=form.datoTipoSocio.value;
    request.datoCorreo=form.datoFrenteDni.value;
    request.datoCorreo=form.datoDorsoDni.value;
    
    console.log("hola el nombre es", request.datoNombres)
    fetch("socio/save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
        
            alert("Se registro el cliente: " +  data.apellido);
            window.location.href="socio/index";
    
      
    })
    .catch(()=>{});

   form.reset();
}
   }