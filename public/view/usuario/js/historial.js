function list(){
    let estado="Inactivo";
    
    
     let cont=1;
           fetch("listBajas/usuario",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify()})
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
                let tipou= us.tipoUsuario|| "";
                let estado="Inactivo";
               let botonEstado= 'disabled';
               let reseteo=us.reseteo;
                if(us.estado==1){
                  estado= "Activo";
                  botonEstado='';
                }
                if(us.reseteo==1){
                    reseteo="Si";
                }
                else{
                  reseteo="No";
                }
                console.log("boton estado es",botonEstado)
                          
                   let html= '<tr  id= "'+us.id+'" class="">';
                   html += '<td id="inden">' +  cont+ '</td>';
                   html += '<td id="">' +  us.nomUser+ '</td>';
                   html += '<td id="">' +  us.nombreCompleto+ '</td>';
                   html += '<td id="">' +  us.dni+ '</td>';
                   html += '<td id="">' + tipou + '</td>';
                   html += '<td>'+ estado + '</td>';
                   html += '<td id="">' + reseteo+ '</td>';
                   html += '<td id=""><button  onclick="modificar('+JSON.stringify(us).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Modificar</button></td>';
                   html += '<td id=""><button '+botonEstado+' onclick="eliminar('+us.id+')" type="button" class="btn btn-danger"  id="btnDesactivar">Desactivar</button></td>';
                   html += '</tr>';
         
           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });
           
           
       
       };