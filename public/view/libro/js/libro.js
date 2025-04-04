
document.addEventListener("DOMContentLoaded",()=>{
   list()
   
          });
function showSave(){
  window.location.href = "showSave";
}
function buscarSocio(dni){
  let formAlta= document.getElementById("formAlta")
}
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

                   let html= '<tr  id= "'+lib.id+'" class="">';
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
                   html += '<td id=""><button '+botonEstado+' onclick="eliminar('+lib.id+')" type="button" class="btn btn-danger"  id="btnDesactivar">Desactivar</button></td>';
                   html += '<td id=""><a href="../ejemplar/ejemplar/'+ lib.id +'">Ejemplares</a></td>';
                   html += '</tr>';
         
           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });
           
           
       
       };

function modificar(lib){

       }

function eliminar(id){

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
                   body:JSON.stringify({id: id,motivo: motivo})
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

function sendNewBook(){
  let form = document.forms["formAlta"];
            
  if(form.reportValidity()){
   
    let request = {};
    request.datoISBN = form.datoISBN.value;
    request.datoTitulo=form.datoTitulo.value;
    request.datoNEjem=form.datoNEjem.value;
    request.datoAutor=form.datoAutor.value;
    request.datoDisciplina=form.datoDisciplina.value;
    request.datoEditorial=form.datoEditorial.value;
    request.datoEdicion=form.datoEdicion.value;

    fetch("save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
        
       
        let ph2= document.getElementById("liveAlertPlaceholder2");
        const appendAlert12= (message,type)=>{
          const wrap12= document.createElement("div")
          wrap12.innerHTML=[
           `<div class="alert alert-${type} alert-dismissible" role="alert">`,
         `   <div>${message}</div>`,
        
           '</div>'
         ].join('')

         ph2.append(wrap12)
        return wrap12
          };
          const wrop12= appendAlert12('El libro se registró exitosamente', 'success')
         
          setTimeout(()=>{
           wrop12.remove();
          },3000);
          setTimeout(()=>{
            window.location.href="index";
    
           },1000);
         
      
    })
    .catch(()=>{});

   //form.reset();
}
   

  
}
function modificar(lib){
   document.getElementById("datoISBN").value= lib.ISBN;
   document.getElementById("datoTitulo").value=lib.titulo;
   document.getElementById("datoEdicion").value=lib.edicion;
   //document.getElementById("datoId").value=lib.id;
   /*document.getElementById("datoEditorial").value= lib.editorial;
   document.getElementById("datoAutor").value=lib.autor;
   document.getElementById("datoDisciplina").value=lib.disciplina;*/
   document.getElementById("datoNEjem").value=lib.cantEjemplares;



  let selectAutor= document.getElementById("datoAutor");
  selectAutor.querySelectorAll("option").forEach(op=>{
      if( lib.autor== op.text){

    
          selectAutor.value=op.value;
      }
  })
  let selectEditorial= document.getElementById("datoEditorial");
  selectEditorial.querySelectorAll("option").forEach(op=>{
      if( lib.editorial== op.text){

    
          selectEditorial.value=op.value;
      }
  })
  let selectDisciplina= document.getElementById("datoDisciplina");
  selectDisciplina.querySelectorAll("option").forEach(op=>{
      if( lib.disciplina== op.text){

    
          selectDisciplina.value=op.value;
      }
  })

  let selectEstado= document.getElementById("datoEstado")
 
   selectEstado.value=lib.estado

  const myModal = new bootstrap.Modal(document.getElementById('myModal'))
  myModal.show();
let form= document.getElementById("formAct")


 document.getElementById("btnAct").addEventListener("click",()=>{
  let request= {}
  request.datoId=lib.id;
   request.datoISBN=form.datoISBN.value;
   request.datoTitulo= form.datoTitulo.value;
   request.datoEdicion=form.datoEdicion.value;
   request.datoEditorial=form.datoEditorial.value;
   request.datoNEjem= form.datoNEjem.value;
   request.datoDisciplina= form.datoDisciplina.value;
   request.datoAutor= form.datoAutor.value;
   request.datoEstado= form.datoEstado.value;

  fetch("update/libro",
    {
        method:'POST',
        headers:{ 'Content-Type':'application/json'},
        body:JSON.stringify(request)
      })
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
                alert("ocurrió un error: " + data.error);
                return;
            }
            else{
              
              myModal.hide()
              let ph= document.getElementById("liveAlertPlaceholder");
              const appendAlert1= (message,type)=>{
                const wrap1= document.createElement("div")
                wrap1.innerHTML=[
                 `<div class="alert alert-${type} alert-dismissible" role="alert">`,
               `   <div>${message}</div>`,
              
                 '</div>'
               ].join('')
 
               ph.append(wrap1)
              return wrap1
                };
                const wrop1= appendAlert1('El usuario se actualizó exitosamente', 'success')
               
                setTimeout(()=>{
                 wrop1.remove();
                },1000);
             
             //window.location.reload();
              
                /*let user= document.getElementById(id);
                user.querySelector("#btnMod").removeAttribute("disabled");
                user.querySelector("#btnDesactivar").removeAttribute("disabled");
                user.classList.remove("socio-inactivo");*/
            }
        
})
 })

}
