document.addEventListener("DOMContentLoaded",()=>{
    list()
    cont=0;
          });
function list(){
    let estado="Inactivo";
   let id=document.getElementById("x").value;
  
     let cont=1;
           fetch("../showEjemplaresPres",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({id:id})
        })
           .then(response => response.json())
           .then(data => {
               if(data.error !== ""){
                   alert("ocurrió un error: " + data.error);
                   return;
               }
               if(data.result == ''){
                   alert("No hay ejemplares para mostrar")
               }
               //procesar data.result en una tabla (mostrar los clientes)
               
               let ejems = data.result;
             ejems.forEach((ej)=>{
                let estado="Inactivo";
               let botonEstado= 'disabled';
            
                if(ej.estado==1){
                  estado= "Activo";
                  botonEstado='';
                
                }
  
                   let html= '<tr  id= "'+ej.id+'" class="">';
                   html += '<td id="inden">' +  cont+ '</td>';
                   html += '<td id="">' +  ej.codigo+ '</td>';
                   html += '<td id="">' + ej.observación+ '</td>';
                   html += '<td id="">' + ej.estado+ '</td>';
                   html += '<td id="">' + ej.libro+ '</td>';
         
           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });}