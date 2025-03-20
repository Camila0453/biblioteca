document.addEventListener("DOMContentLoaded",()=>{
   
    list()
   
          });

function list(){
    let estado="Inactivo";
    
    
     let cont=1;
           fetch("list/libro",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify()})
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
               
               let libros = data.result;
              libros.forEach((lib)=>{
                let estado="Inactivo";
               let botonEstado= 'disabled';
               let reseteo=us.reseteo;
                if(lib.estado==1){
                  estado= "Activo";
                
                }

                          
                   let html= '<tr  id= "'+lib.id+'" class="">';
                   html += '<td id="inden">' +  cont+ '</td>';
                   html += '<td id="">' + lib.titulo+ '</td>';
                   html += '<td id="">' +  lib.ISBN+ '</td>';
                   html += '<td id="">' +  lib.autor+ '</td>';
                   html += '<td id="">' + lib.edicion + '</td>';
                   html += '<td>'+ lib.editorial + '</td>';
                   html += '<td id="">' + lib.disciplina+ '</td>';
                   tml += '<td id="">' + lib.cantEjemplares+ '</td>';
                   html += '<td id=""><button  onclick="modificar('+JSON.stringify(lib).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Modificar</button></td>';
                   html += '<td id=""><button '+botonEstado+' onclick="eliminar('+lib.id+')" type="button" class="btn btn-danger"  id="btnDesactivar">Desactivar</button></td>';
                   html += '</tr>';
         
           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });
           
           
       
       };

       function modificar(lib){

       }

       function eliminar(id){

       }