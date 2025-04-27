
document.addEventListener("DOMContentLoaded",()=>{
    list()
    cont=0;
          });

function list(){
    let estado="Inactivo";
    
    
     let cont=1;
           fetch("../usuario/res",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({})
        
        
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
               
               let prestamos = data.result;
              prestamos.forEach((pres)=>{
                let estado="Inactivo";
                let tipo="A domicilio";
               let botonEstado= 'disabled';
               let botonEstadoRenovar= '';
               let botonEstadoDevolver= '';
            
               if(pres.estado==0){
                estado= "Inactivo";
                botonEstado='';
              
              }
                if(pres.estado==1){
                  estado= "Activo";
                  botonEstado='';
                
                }
                if(pres.estado==3){
                  estado= " Devuelto con retraso";
                  botonEstado='';
                  botonEstadoRenovar='disabled';
                
                }
                if(pres.estado==2){
                  estado= "Devuelto en tiempo y forma";
                  botonEstado='disabled';
                  botonEstadoRenovar='disabled';
                  botonEstadoDevolver='disabled';
                
                }
                if(pres.estado==4){
                  estado= "Renovado";
                  botonEstado='';
                
                }
                if(pres.estado==5){
                  estado= "Extendido por renovación";
                  botonEstadoRenovar='disabled';
                
                }
                if(pres.tipo==0){
                   tipo="En sala"
                  
                  }
                  else{
                    tipo="A domicilio"
                  }

                   let html= '<tr  id= "'+pres.id+'" class="">';
                   html += '<td id="inden">' +  cont+ '</td>';
                   html += '<td id="inden">' +  pres.idRes+ '</td>';
                   html += '<td id="">' +  pres.socioNombre+' ' +pres.socioApellido+'</td>';
                   html += '<td id="">' +  pres.fechaInicio+ '</td>';
                   html += '<td id="">' +  pres.fechaFin+ '</td>';
                   html += '<td id="">' +pres.fechaRetiro + '</td>';
                   html += '<td id="">' + estado+ '</td>';
                   html += '<td id=""><a href="ejemplaresReservaSocio/'+pres.idRes+'">Ver ejemplares </a></td>';
                  
                   html += '</tr>';
         
           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });
           
           
       
       };

