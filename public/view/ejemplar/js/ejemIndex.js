

function validar(input){
   

  if(input.reportValidity()){

   input.style.border=" 2px solid green";
  }
  else{
   input.style.border=" 2px solid red";
  }

 } 
document.addEventListener("DOMContentLoaded",()=>{
   list()

});
function showSave(){
  window.location.href = `showSaveEjemplares`;
}
function sendNewEjem(){
  let form = document.forms["formAlta"];
            
  if(form.reportValidity()){
    let request = {};
    request.datoCodigo= form.datoCodigo.value;
    request.datoLibro= document.getElementById('datoLibro').value;
    console.log("ola dato libro fes" +  request.datoLibro)

    request.datoObservacion=form.datoObservacion.value;
    

    fetch("save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
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
            const wrop1= appendAlert1(data.error, 'danger')
           
            setTimeout(()=>{
             wrop1.remove();
            },3000);
            window.location.href="index";
          
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
          const wrop12= appendAlert12('El ejemplar se registró exitosamente', 'success')
         
          setTimeout(()=>{
           wrop12.remove();
          },3000);
          setTimeout(()=>{
            window.location.href="index";
    
           },4000);
         
      
    })
    .catch(()=>{});

   //form.reset();
}}

function list(){
    let estado="Inactivo";
  

     let cont=1;
           fetch("listGeneral",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify()
        })
           .then(response => response.json())
           .then(data => {
               if(data.error !== ""){
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
                  const wrop1= appendAlert1(data.error, 'danger')
                 
                  setTimeout(()=>{
                   wrop1.remove();
                  },3000);
               
                  window.location.href="index";
                
               }
               if(data.result == ''){
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
                                 const wrop1= appendAlert1(data.error, 'danger')
                                
                                 setTimeout(()=>{
                                  wrop1.remove();
                                 },3000);
                              
                                 window.location.href="index";
                               
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


                if(ej.estado==2){
                  estado= "Prestado";
                
                }
                if(ej.estado==3){
                  estado= "Reservado";
                
                }




                   let html= '<tr  id= "'+ej.id+'" class="">';
                   html += '<td id="inden">' +  cont+ '</td>';
                   html += '<td id="">' +  ej.codigo+ '</td>';
                   html += '<td id="">' +  ej.libro+ '</td>';
                   html += '<td id="">' + ej.observación+ '</td>';
                   html += '<td id="">' + estado+ '</td>';
                   html += '<td id=""><button  onclick="modificar('+JSON.stringify(ej).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Modificar</button></td>';
                   html += '<td id=""><button '+botonEstado+' onclick="eliminar('+ej.id+')" type="button" class="btn btn-danger"  id="btnDesactivar">Desactivar</button></td>';
                   html += '</tr>';
         
           document.getElementById("tablaClientes").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });}

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
                                    const wrop1= appendAlert1(data.error, 'danger')
                                   
                                    setTimeout(()=>{
                                     wrop1.remove();
                                    },3000);
                                 
                                    window.location.href="index";
                                  
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
                  
                                 
                                 
                                 window.location.href="index";
                              
                             }}
                             )
                        
                  
                  
                  
                  
                  
                  
                      }
                        
                       
                              });
                   })
                   
                    
                  }
  function modificar(ejem){
  
                    document.getElementById("datoCodigo").value= ejem.codigo;
                    document.getElementById("datoLibro").value=ejem.libro;
                    document.getElementById("datoObservacion").value=ejem.observación;
                    //document.getElementById("datoId").value=lib.id;
                    
                  
                  
                  
                   let selectLibro= document.getElementById("datoLibro");
                   selectLibro.querySelectorAll("option").forEach(op=>{
                       if(ejem.libro== op.text){
                           selectLibro.value=op.value;
                       }
                   })
                   
                  
                  
                   const myModal = new bootstrap.Modal(document.getElementById('myModal'))
                   myModal.show();
                  let form= document.getElementById("formAct")
                  
                  
                  document.getElementById("btnAct").addEventListener("click",()=>{
                   let request= {}
                   request.datoId=ejem.id;
                    request.datoCodigo=form.datoCodigo.value;
                    request.datoObservacion= form.datoObservacion.value;
                    request.datoLibro=form.datoLibro.value;
                  
                  
                   fetch("update",
                     {
                         method:'POST',
                         headers:{ 'Content-Type':'application/json'},
                         body:JSON.stringify(request)
                       })
                         .then(response => response.json())
                         .then(data => {
                             if(data.error !== ""){
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
                                const wrop1= appendAlert1(data.error, 'danger')
                               
                                setTimeout(()=>{
                                 wrop1.remove();
                                },3000);
                             
                                window.location.href="index";
                              
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
                                 const wrop1= appendAlert1('El ejemplar se actualizó exitosamente', 'success')
                                
                                 setTimeout(()=>{
                                  wrop1.remove();
                                 },3000);
                              
                                 window.location.href="index";
                               
                                 /*let user= document.getElementById(id);
                                 user.querySelector("#btnMod").removeAttribute("disabled");
                                 user.querySelector("#btnDesactivar").removeAttribute("disabled");
                                 user.classList.remove("socio-inactivo");*/
                             }
                         
                  })
                  })
                  }
                  
                  
                  