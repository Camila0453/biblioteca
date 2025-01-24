document.addEventListener("DOMContentLoaded",()=>{
   console.log("hola")
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
               let usuarios = data.result;
              usuarios.forEach((us)=>{
                          
                   let html= '<tr  id= "'+us.id+'" class="">';
                   html += '<td id="inden">' +  cont+ '</td>';
                   html += '<td id="">' +  us.nomUser+ '</td>';
                   html += '<td id="">' + us.tipoUsuario + '</td>';
                   html += '<td>'+ + us.estado + '</td>';
                   html += '<td id="">' + us.reseteoClave+ '</td>';
                   html += '<td id=""><a  href="socio/showUpdate/'+us.id+'" >Modificar</a></td>';
                   html += '<td id=""><button  onclick="eliminar('+us.dni+')" >Eliminar</button></td>';
       
                   html += '</tr>';
         
           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });
           
           
       
       };

       function eliminar(id){
   
        fetch("delete",{
          method:'POST',
          body:id
        })
          .then(response => response.json())
          .then(data => {
              if(data.error !== ""){
                  alert("ocurrió un error: " + data.error);
                  return;
              }
              else{
                  alert("Usuario borrado exitosamente")
                  window.location.href="index";
              }
          }
          )}