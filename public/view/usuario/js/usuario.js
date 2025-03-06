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
              usuarios.forEach((us)=>{
                if(us.estado==1){
                  estado= "Activo";
                }
                if(reseteo==1){
                    reseteo="Si";
                }
                          
                   let html= '<tr  id= "'+us.id+'" class="">';
                   html += '<td id="inden">' +  us.id+ '</td>';
                   html += '<td id="">' +  us.nomUser+ '</td>';
                   html += '<td id="">' + us.tipoUsuario + '</td>';
                   html += '<td>'+ estado + '</td>';
                   html += '<td id="">' + reseteo+ '</td>';
                   html += '<td id=""><a  href="socio/showUpdate/'+us.id+'" >Modificar</a></td>';
                   html += '<td id=""><button onclick="eliminar('+ us.id+')">Dar de baja </button></td>';
       
                   html += '</tr>';
         
           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });
           
           
       
       };

       const eliminar = (id )=>{
        console.log("hola id esss")+id;
        fetch("delete",{
          method:'POST',
          body:JSON.stringify({id})
        })
          .then(response => response.json())
          .then(data => {
              if(data.error !== ""){
                  alert("ocurrió un error: " + data.error);
                  return;
              }
              else{
                  alert("Usuario borrado exitosamente")
                  window.location.href="usuario/index";
              }
          }
          )}
const sendNewUser = ()=>{
 let form = document.forms["formAlta"];
            
          if(form.reportValidity()){
           
            let request = {};
            request.datoCorreo = form.datoCorreo.value;
            request.datoTipoUsuario=form.datoTipoUsuario.value;
            if(form.datoClave.value=== form.datoClave2.value){
                request.datoClave=form.datoClave.value;
            }
            else{
                alert("Las contraseñas deben coincidir")
                  throw new error("La contraseña debe coincidir")
            }
            
        
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