document.addEventListener("DOMContentLoaded",()=>{
    list()
    console.log("olaaa")
  
         });
         function list(){
            let reseteo="No";
        
           let cont=1;
                 fetch("listBajas",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify()})
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
                     let bajas = data.result;
                    bajas.forEach((so)=>{
                    let estado= "Inactivo";
                    let botonEstado= 'disabled';
                    let botonAct= '';
                        if(so.estado===1){
                            estado="Activo";
                            botonEstado='';
                            botonAct='hidden';
                      
                              }
                      
                               
                         let html= '<tr  id= "'+so.dni+'" class="'+(so.estado===0 ? 'socio-inactivo' :' ')+'">';
                         html += '<td id="inden">' +  cont+ '</td>';
                         html += '<td id="">' +  so.id+ '</td>';
                         html += '<td id="">' + so.socio + '</td>';
                         html += '<td>'+ so.fechaInicio + '</td>';
                         html += '<td id="">' + so.fechaFin+ '</td>';
                         html += '<td id="">'+so.tipo+ '</td>';
                         html += '<td id="">'+ so.estado+ '</td>';
                         html += '<td id="">'+ so.nombreUsuario+ '</td>';
                         html += '<td id="">'+ so.fechaHora+ '</td>';
                         html += '<td id="">'+ so.motivo+ '</td>';
                        
                     
                         html += '</tr>';
        
               
                 document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
             cont= cont+1;
                     });
                    }
                 )};
                
                  