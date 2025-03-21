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
            
                if(lib.estado==1){
                  estado= "Activo";
                  botonEstado='';
                
                }

                          console.log("hola isbn es"+lib.ISBN)
                   let html= '<tr  id= "'+lib.ISBN+'" class="">';
                   html += '<td id="inden">' +  cont+ '</td>';
                   html += '<td id="">' +  lib.ISBN+ '</td>';
                   html += '<td id="">' + lib.titulo+ '</td>';
                   html += '<td id="">' +  lib.autor+ '</td>';
                   html += '<td id="">' + lib.edicion + '</td>';
                   html += '<td>'+ lib.editorial + '</td>';
                   html += '<td id="">' + lib.disciplina+ '</td>';
                   html += '<td id="">' + lib.cantEjemplares+ '</td>';
                   html += '<td id="">' + estado+ '</td>';
                   html += '<td id=""><button  onclick="modificar('+JSON.stringify(lib).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Modificar</button></td>';
                   html += '<td id=""><button '+botonEstado+' onclick="eliminar('+lib.ISBN+')" type="button" class="btn btn-danger"  id="btnDesactivar">Desactivar</button></td>';
                   html += '</tr>';
         
           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });
           
           
       
       };

function modificar(lib){

       }

function eliminar(isbn){
  console.log("hola el isbn es"+isbn)
        btnAceptar=document.getElementById("btnAceptar")
        const toastLiveExample = document.getElementById('toastElim')
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
         toastBootstrap.show()
        
        
        
        
        btnAceptar.addEventListener('click',()=>{
            toastBootstrap.hide()
        const toast = document.getElementById('toastPrompt')
        const toastBootstrap1 = bootstrap.Toast.getOrCreateInstance(toast)
         toastBootstrap1.show()
         let btnMotivo= document.getElementById("btnMotivo")
        
        
        
        
         btnMotivo.addEventListener('click',()=>{
            toastBootstrap1.hide()
            let motivo= document.getElementById("inputMotivo").value;
            if(motivo){
               fetch("delete",{
               
                   method:'POST',
                   headers:{ 'Content-Type':'application/json'},
                   body:JSON.stringify({isbn: isbn,motivo: motivo})
                 })
                   .then(response => response.json())
                   .then(data => {
        
                    
                       if(data.error !== ""){
                           alert("ocurrió un error: " + data.error);
                           return;
                       }
                       else{
                        
                        let ph= document.getElementById("liveAlertPlaceholder");
                        if(ph.querySelector('.alert')){
                            return;
                        }
                       const appendAlert= (message,type)=>{
                       const wrap= document.createElement("div")
                       wrap.innerHTML=[
                        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                      `   <div>${message}</div>`,
                     
                        '</div>'
                      ].join('')
        
                      ph.append(wrap)
                     return wrap
                       };
                       const wrop= appendAlert('Baja realizada correctamente', 'success')
                      
                       setTimeout(()=>{
                        wrop.remove();
                       },3000);
        
                       
                       
                       
                      //window.location.reload();
                    
                   }}
                   )
              
        
        
        
        
        
        
            }
              
             
                    });
         })
         
          
        }