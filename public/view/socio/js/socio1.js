
const showSave = ()=>{
  
window.location.href = "showSave";
 };

 document.addEventListener("DOMContentLoaded",()=>{
   console.log("hola");
  
   list();
   
       });
       

function list(){
   console.log("hola");
   let cont=0;
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
        
     
          
     
      if(cont== 0 ){
     
             clientes.forEach((so)=>{
                        
                 let html= '<tr  id= "'+so.id+'" class="">';
                 html += '<td id="inden">' +  so.id+ '</td>';
                 html += '<td id="">' +  so.apellido+ '</td>';
                 html += '<td id="">' + so.nombres + '</td>';
                 html += '<td>'+ + so.dni + '</td>';
                 html += '<td id="">' + so.domicilio+ '</td>';
                 html += '<td id="">'+so.localidad+ '</td>';
                 html += '<td id="">'+so.provincia+ '</td>';
                 html += '<td id="">'+so.telefono+ '</td>';
                 html += '<td id="">'+ so.codPostal+ '</td>';
                 html += '<td id="">'+ so.correo+ '</td>';
               
                 html += '<td id=""><a  href="socio/showUpdate/'+so.id+'" >Modificar</a></td>';
     
                 html += '<td id=""><a  href="socio/showDelete/'+so.id+'" >Eliminar</a></td>';
     
                 html += '</tr>';
       
         document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
     cont= 1;
             });
         }
         });
         
         
     
     };

























/*const sendNewClient = ()=>{
   alert("hola soy js")
 
    let form = document.forms["formAlta"];
    
  if(form.reportValidity()){
   
    let request = {};
    request.datoApellido = form.datoApellido.value;
    request.datoNombres = form.datoNombres.value;
    request.datoDNI = form.datoDNI.value;
    request.datoDomicilio= form.datoDomicilio.value;
    request.datoLocalidad=form.datoLocalidad.value;
    request.datoProvincia=form.datoProvincia.value;
    request.datoPostal=form.datoPostal.value;
    request.datoTelefono=form.datoTelefono.value;
    request.datoCorreo=form.datoCorreo.value;
 
    

    fetch("cliente/save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
        
            alert("Se registro el cliente: " +  data.apellido);
            window.location.href="cliente/index";
    
      
    })
    .catch(()=>{});

   form.reset();
}
   }*/