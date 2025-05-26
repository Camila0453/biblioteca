
document.addEventListener("DOMContentLoaded",()=>{
    list()
    console.log("hola")
    cont=0;
          });

function list(){
    let estado="Inactivo";
    let id=document.getElementById("x").value;
  
     let cont=1;
           fetch("../../prestamo/showEjemplaresPres",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({id:id})
        
        
        })
           .then(response => response.json())
           .then(data => {
               if(data.error !== ""){
                   alert("ocurrió un error: " + data.error);
                   return;
               }
               if(data.result == ''){
                   let ph5= document.getElementById("liveAlertPlaceholderNoHay");
                 const appendAlert5= (message,type)=>{
                   const wrap5= document.createElement("div")
                   wrap5.innerHTML=[
                    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                  `   <div>${message}</div>`,
                 
                    '</div>'
                  ].join('')
         
                  ph5.append(wrap5)
                 return wrap5
                   };
                   const wrop5= appendAlert5("No hay prestamos para mostrar", 'danger')
                  
                  ;
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
                     html += '<td id="">' + ej.libro+ '</td>';
                   html += '</tr>';
         
           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });
           
           
       
       };
       