

document.addEventListener("DOMContentLoaded",()=>{
    list()

});


function showSave(){
  let x= document.getElementById("x").value;
  window.location.href = `../showSave/${x}`;
}
function list(){
    let estado="Inactivo";
   let id=document.getElementById("x").value;

     let cont=1;
           fetch("../showEjemplaresLibro",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({id:id})
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
                   html += '<td id=""><button  onclick="modificar('+JSON.stringify(ej).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Modificar</button></td>';
                   html += '<td id=""><button '+botonEstado+' onclick="eliminar('+ej.id+')" type="button" class="btn btn-danger"  id="btnDesactivar">Desactivar</button></td>';
                   html += '</tr>';
         
           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });}

function eliminar(id){
    console.log("holaa")
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
          console.log("ñao entre al if")
           fetch("../delete",{
           
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

function modificar(ejem){
  document.getElementById("datoCodigo").value= ejem.codigo;
 // document.getElementById("datoLibro").value=lib.libro;
  document.getElementById("datoObservacion").value=ejem.observación;
  //document.getElementById("datoId").value=lib.id;
  



 let selectLibro= document.getElementById("datoLibro");
 selectLibro.querySelectorAll("option").forEach(op=>{
     if(ejem.libro== op.value){
         selectLibro.value=op.value;
     }
 })
 
 let selectEstado= document.getElementById("datoEstado")

  selectEstado.value=ejem.estado

 const myModal = new bootstrap.Modal(document.getElementById('myModal'))
 myModal.show();
let form= document.getElementById("formAct")


document.getElementById("btnAct").addEventListener("click",()=>{
 let request= {}
 request.datoId=ejem.id;
  request.datoCodigo=form.datoCodigo.value;
  request.datoObservacion= form.datoObservacion.value;
  request.datoLibro=form.datoLibro.value;
  request.datoEstado= form.datoEstado.value;

 fetch("../update",
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

function sendNewEjem(){
  let form = document.forms["formAlta"];
            
  if(form.reportValidity()){
   console.log("hola pase el rkkeport")
    let request = {};
    request.datoCodigo= form.datoCodigo.value;
    request.datoLibro=form.datoLibro.value;
    request.datoObservacion=form.datoObservacion.value;
    

    fetch("../save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
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
}}
