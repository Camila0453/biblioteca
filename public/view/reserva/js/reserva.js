document.addEventListener("DOMContentLoaded",()=>{
   
    list()
   
          });

function showSave(){
        //window.location.href = "view/cliente/cliente_alta.php";
        window.location.href = "showSave";
    };





function resAct(){
  let cont=0;
  fetch("resHoy",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify()})
  .then(response => response.json())
  .then(data => {
      if(data.error !== ""){
          alert("ocurrió un error: " + data.error);
          return;
      }
      if(data.result == ''){
        let ph2= document.getElementById("liveAlertPlaceholder1");
        const appendAlert12= (message,type)=>{
          let wrap12= document.createElement("div")
          wrap12.innerHTML=[
           `<div class="alert alert-${type} alert-dismissible" role="alert">`,
         `   <div>${message}</div>`,
        
           '</div>'
         ].join('')

         ph2.append(wrap12)
        return wrap12
          };
          const wrop12= appendAlert12("No hay reservas para mostrar", 'danger')
         
          setTimeout(()=>{
           wrop12.remove();
          },3000);
          setTimeout(()=>{
            //window.location.href="index";
    
           },3000);
         
         return;
      }
      //procesar data.result en una tabla (mostrar los clientes)
      let tab= document.getElementById("tablaClientes");
      let bodyx= tab.querySelector("tbody")
       bodyx.innerHTML="";



      let reservas = data.result;
     reservas.forEach((res)=>{
       let estado="Inactivo";
      let botonEstado= 'disabled';
       if(res.estadoRes==1){
         estado= "Activo";
         botonEstado='';
       } 
       if(res.estadoRes==2){
         estado= "Retirado";
      
       } 
       console.log("id res es"+ res.idRes)     
          let html= '<tr  id= "'+res.idRes+'" class="">';
          html += '<td id="inden">' +  cont+ '</td>';
          html += '<td id="">' +  res.idSo+ '</td>';
          html += '<td id="">' +  res.fechaInicio+ '</td>';
          html += '<td id="">' +  res.fechaFin+ '</td>';
          html += '<td id="">' + res.motivoCan + '</td>';
       
          html += '<td></td>';
          html += '<td>'+ res.fechaCan + '</td>';
          html += '<td id="">' + estado+ '</td>';
    
        
         
          html += '<td id=""><a href="ejemplaresReserva/'+res.idRes+'">Ver ejemplares </a></td>';
          html += '<td id=""><button '+botonEstado+' onclick="retirar('+JSON.stringify(res.idRes).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Retirar</button></td>';
          html += '<td id=""><button '+botonEstado+' onclick="eliminar('+res.idRes+')" type="button" class="btn btn-danger"  id="btnDesactivar">Cancelar</button></td>';
          html += '</tr>';

  document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
cont= cont+1;
      });
  
  });
  
  


}
function list(){
            let estado="Inactivo";
            
            
             let cont=1;
                   fetch("list/reserva",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify()})
                   .then(response => response.json())
                   .then(data => {
                       if(data.result == ''){
                        let ph2= document.getElementById("liveAlertPlaceholder1");
                       const appendAlert12= (message,type)=>{
                         let wrap12= document.createElement("div")
                         wrap12.innerHTML=[
                          `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                        `   <div>${message}</div>`,
                       
                          '</div>'
                        ].join('')
               
                        ph2.append(wrap12)
                       return wrap12
                         };
                         const wrop12= appendAlert12("No hay reservas para mostrar", 'danger')
                        
                         setTimeout(()=>{
                          wrop12.remove();
                         },3000);
                         setTimeout(()=>{
                           //window.location.href="index";
                   
                          },3000);
                        
                        return;
                
                        }
                       
                      
                       //procesar data.result en una tabla (mostrar los clientes)
                       
                       let reservas = data.result;
                      reservas.forEach((res)=>{
                        let estado="Inactivo";
                       let botonEstado= 'disabled';
                        if(res.estadoRes==1){
                          estado= "Activo";
                          botonEstado='';
                        } 
                        if(res.estadoRes==2){
                          estado= "Retirado";
                       
                        } 
                        console.log("id res es"+ res.idRes)     
                           let html= '<tr  id= "'+res.idRes+'" class="">';
                           html += '<td id="inden">' +  cont+ '</td>';
                           html += '<td id="">' +  res.idSo+ '</td>';
                           html += '<td id="">' +  res.fechaInicio+ '</td>';
                           html += '<td id="">' +  res.fechaFin+ '</td>';
                           html += '<td id="">' + res.motivoCan + '</td>';
                        
                           html += '<td></td>';
                           html += '<td>'+ res.fechaCan + '</td>';
                           html += '<td id="">' + estado+ '</td>';
                     
                         
                          
                           html += '<td id=""><a href="ejemplaresReserva/'+res.idRes+'">Ver ejemplares </a></td>';
                           html += '<td id=""><button '+botonEstado+' onclick="retirar('+JSON.stringify(res.idRes).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Retirar</button></td>';
                           html += '<td id=""><button '+botonEstado+' onclick="eliminar('+res.idRes+')" type="button" class="btn btn-danger"  id="btnDesactivar">Cancelar</button></td>';
                           html += '</tr>';
                 
                   document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
               cont= cont+1;
                       });
                   
                   ;
                   
                   
               
              
});}
               function buscarLibro(input,resul,num) {
  
                let libro = document.getElementById(input).value.trim();
                let inputLibro= document.getElementById(input);
               
                // Si el ISBN está vacío, ocultamos los resultados
                if (libro === '') {
                  document.getElementById('resultadoBusqueda').style.display = 'none';
                  return;
                }
              
                // Realizamos la solicitud al backend (PHP) para buscar el libro
                fetch("../ejemplar/buscar", {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json"
                  },
                  body: JSON.stringify({ libro: libro  })
                })
                .then(response => response.json())
                .then(data => {
                  const listaLibros = document.getElementById('listaLibros'+num)
                  listaLibros.innerHTML = ''; // Limpiamos los resultados anteriores
                  
                  if (data.error=='') {
                    // Si encontramos libros, mostramos los resultados
                 
                   let libros = Array.isArray(data.result) ? data.result : [data.result]; // Si no es array, lo convertimos en uno
                   // let libros= data.result;
                   console.log("DATA RESULT ES"+data.result)
                    libros.forEach(libro => {
              
                      const li = document.createElement('li');
                      let estado=''
                      if(libro.estado==1){
                        estado='Disponible';
                      }
                      if(libro.estado==0){
                        estado='Dado de Baja';
                      }
                      if(libro.estado==2){
                        estado='Prestado';
                      }
                      if(libro.estado==3){
                        estado='Reservado';
                      }
                      li.textContent = 'Código:' +libro.codigo+',Estado: '+estado+'';
                      if(libro.estado==0 || libro.estado==2 || libro.estado==3){
                        li.style.color="gray"
                        li.style.cursor="not-allowed"
                        li.style.opacity=0.5
                      }
                      
                      else {
      
                        li.style.cursor="pointer";
                        li.addEventListener("click",()=>{
                          li.style.border="solid green"
                          
                          
                           setTimeout(()=>{
                            inputLibro.value= libro.codigo;
                         
                             },3000)
                         
        
                        })
                      }
                      
                      listaLibros.appendChild(li);
                  
                  
                      inputLibro.style.border= "solid green"
                     
                    
                    });
                    document.getElementById(resul).style.display = 'block';
                    setTimeout(()=>{
                 
                      document.getElementById(resul).style.display = 'none';
                       },9000)
                    
                  } else {
                    // Si no encontramos el libro, mostramos un mensaje
                    const li = document.createElement('li');
                    li.textContent = "No se encontraron libros";
                    inputLibro.style.border= "solid red"
                   
                    document.getElementById(resul).style.display = 'block';
                    listaLibros.appendChild(li);
                    setTimeout(()=>{
                   
                      document.getElementById(resul).style.display = 'none';
                       },9000)
                  
                  }
                  
                
                })
                .catch();
                /*if(comparar()== true){
                  alert("Los libros deben ser diferentes")
                }*/
              }
              
      
      
      
              
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      function buscarSocio(){
                  let formAlta=document.getElementById("formAlta")
                  let modal=document.getElementById("myModalAgg")
                  let datoSocio= document.getElementById("datoSocio")
                  let dni= datoSocio.value.trim();
                  let errSocio=document.getElementById("errSocio")
                 // if (formAlta.reportValidity()){
                  datoSocio.style.border='';
                   errSocio.style.display='none';
              
                if(dni===""){
                  return
                }
                fetch("../socio/loadd",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({dni:dni})})
                .then(response => response.json())
                .then(data => {
                  
                    if(data.error !== ""){
                       alert(data.error);
                        return;
      
                    }
                    let socio= data.result;
                   
                    if(data.result==""){
                      //alert("no se encontró el socio");
                       datoSocio.style.border= "solid red"
                       errSocio.style.display='block'
                       errSocio.textContent='Socio no encontrado'
                       setTimeout(()=>{
                      errSocio.style.display='none';
           
                       },3000)
                      
                      
                       
                   }else{
                  //  toast.hide()
                     datoSocio.style.border= "solid green"
                     errSocio.style.display='none';
                      fetch("../socio/socioCantPrestamo",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({id:dni})})
                     .then(response => response.json())
                    .then(data => {
                     console.log("data es"+data)
                    if(data.error !== ""){
                       alert(data.error);
                        return;
      
                    }
                   
                    if(data.result>=3){
                      errSocio.style.display='none';
                     datoSocio.style.border= "solid red"
                       errSocio.style.display='block'
                       errSocio.textContent="El socio ya tiene 3 libros, no puede realizar más préstamos."
                       setTimeout(()=>{
                        errSocio.style.display='none';
             
                         },3000)
                      /*const toast = document.getElementById('toastTiene3')
                      const toastBootstrap1 = bootstrap.Toast.getOrCreateInstance(toast)
                      toastBootstrap1.show()*/
                  
                       
                   }else{
                      //toast.hide()
      
                      datoSocio.style.border= "solid green"
                       errSocio.style.display='none'
      
                      
                   }
                    
                   })}
                      
                   
                   if(socio.estado==3){
                     datoSocio.style.border= "solid red"
                        errSocio.style.display='block'
                       errSocio.textContent="El socio está sancionado."
                       setTimeout(()=>{
                        errSocio.style.display='none';
             
                         },3000)
                    
                     /*const toast = document.getElementById('toastSancion')
                     const toastBootstrap1 = bootstrap.Toast.getOrCreateInstance(toast)
                     toastBootstrap1.show()
                     setTimeout(()=>{
                      window.location.href="index";
         
                     },3000);*/}})
      
                }
      
      
        function comparar(){
          console.log("ola soy comparar")
          let ej= document.getElementById("datoEjems").value.trim();
          let ej1= document.getElementById("datoEjems1").value.trim();
          let ej2= document.getElementById("datoEjems2").value.trim();
          let resul=false;
      if(ej1 &&ej2 &&ej){
        if( ej!= ej1 && ej1!=ej2 && ej2!=ej){
        resul= true
        }
      }
      else if((ej && !ej1 && !ej2) ){
        resul= true;}
        
      else if((!ej && ej1 && !ej2) ){
          resul= true;
          }
      
        else if((!ej && !ej1 && ej2) ){
            resul= true;
            }
      
      if(ej && ej1 && !ej2){
          if(ej!=ej1){
            resul= true;
         }}
       if(ej && !ej1 && ej2){
          if(ej!=ej2){
            resul= true;
         }}
       if(!ej && ej1 && ej2){
          if(ej1!=ej2){
            resul= true;
         }}
        
          return resul;
        }
           
      
      
      function sendNewRes(){
             let form = document.forms["formAlta"];
                        
              if(form.reportValidity()){
                  console.log("paso report todo lleno")
              
                let request = {};
                request.datoSocio = form.datoSocio.value;
                request.datoEjems1=form.datoEjems1.value;
                request.datoEjems=form.datoEjems.value;
                request.datoEjems2=form.datoEjems2.value;
                request.datofechaInicio=  document.getElementById("datoFechaInicio").value;
      
            
                fetch("save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
                .then(response => response.json())
                .then(data => {
                    if(data.error !== ""){
                       let ph2= document.getElementById("liveAlertPlaceholder1");
                       const appendAlert12= (message,type)=>{
                         let wrap12= document.createElement("div")
                         wrap12.innerHTML=[
                          `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                        `   <div>${message}</div>`,
                       
                          '</div>'
                        ].join('')
               
                        ph2.append(wrap12)
                       return wrap12
                         };
                         const wrop12= appendAlert12(data.error, 'danger')
                        
                         setTimeout(()=>{
                          wrop12.remove();
                         },3000);
                         setTimeout(()=>{
                           //window.location.href="index";
                   
                          },3000);
                        
                        return;
                    }
                    
                   
                    let ph2= document.getElementById("liveAlertPlaceholder1");
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
                      const wrop12= appendAlert12('La reserva se registró exitosamente', 'success')
                     
                      setTimeout(()=>{
                       wrop12.remove();
                      },3000);
                      setTimeout(()=>{
                        window.location.href="index";
                
                       },3000);
                     
                  
                })
                .catch(()=>{});
            
               //form.reset();
              }
            }
            
              
        function devolver(prestamo,ejem,socio){
      
      
          let btnAceptar1= document.getElementById("btnAceptar15");
          const toastLiveExample = document.getElementById('toastObsDev')
          const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
           toastBootstrap.show()
         
      btnAceptar1.addEventListener("click",()=>{
        let obs= document.getElementById("obsDev").value;
        fetch("devolver",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({prestamo: prestamo,ejem: ejem, obs: obs, socio: socio})})
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
              let ph4= document.getElementById("liveAlertPlaceholderdev");
                    const appendAlert14= (message,type)=>{
                      const wrap14= document.createElement("div")
                      wrap14.innerHTML=[
                       `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                     `   <div>${message}</div>`,
                    
                       '</div>'
                     ].join('')
            
                     ph4.append(wrap14)
                    return wrap14
                      };
                      const wrop14= appendAlert14(data.error, 'danger')
                     
                      setTimeout(()=>{
                       wrop14.remove();
                      },3000);
                      setTimeout(()=>{
                        window.location.href="index";
                
                       },3000);
                return;
            }
            if(data.result ){
              let ph4= document.getElementById("liveAlertPlaceholderdev");
                    const appendAlert14= (message,type)=>{
                      const wrap14= document.createElement("div")
                      wrap14.innerHTML=[
                       `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                     `   <div>${message}</div>`,
                    
                       '</div>'
                     ].join('')
            
                     ph4.append(wrap14)
                    return wrap14
                      };
                      const wrop14= appendAlert14('Se registró exitosamente la devolución.', 'success')
                     
                      setTimeout(()=>{
                       wrop14.remove();
                      },3000);
                      setTimeout(()=>{
                        window.location.href="index";
                
                       },3000);
            }
            //procesar data.result en una tabla (mostrar los clientes)
           
            })
      })
      
        }
      
      function renovar(pres,ejem,socio){
        console.log("ola soy renovar")
      
        fetch("renovar",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({prestamo: pres, ejem: ejem,socio: socio})})
        .then(response => response.json())
        .then(data => {
            if(data.error !== ""){
              let ph4= document.getElementById("liveAlertPlaceholderdev");
              const appendAlert14= (message,type)=>{
                const wrap14= document.createElement("div")
                wrap14.innerHTML=[
                 `<div class="alert alert-${type} alert-dismissible" role="alert">`,
               `   <div>${message}</div>`,
              
                 '</div>'
               ].join('')
      
               ph4.append(wrap14)
              return wrap14
                };
                const wrop14= appendAlert14(data.error, 'danger')
               
                setTimeout(()=>{
                 wrop14.remove();
                },3000);
                setTimeout(()=>{
                  window.location.href="index";
          
                 },3000);
               return
            }
            if(data.result ){
              let ph4= document.getElementById("liveAlertPlaceholderdev");
                    const appendAlert14= (message,type)=>{
                      const wrap14= document.createElement("div")
                      wrap14.innerHTML=[
                       `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                     `   <div>${message}</div>`,
                    
                       '</div>'
                     ].join('')
            
                     ph4.append(wrap14)
                    return wrap14
                      };
                      const wrop14= appendAlert14('Se registró exitosamente la renovación.', 'success')
                     
                      setTimeout(()=>{
                       wrop14.remove();
                      },3000);
                      setTimeout(()=>{
                        window.location.href="index";
                
                       },3000);
            }
            //procesar data.result en una tabla (mostrar los clientes)
           
            })
      }
      
      function devolver(prestamo,ejem,socio){
      
      
        let btnAceptar1= document.getElementById("btnAceptar15");
        const toastLiveExample = document.getElementById('toastObsDev')
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
         toastBootstrap.show()
       
    btnAceptar1.addEventListener("click",()=>{
      let obs= document.getElementById("obsDev").value;
      fetch("devolver",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({prestamo: prestamo,ejem: ejem, obs: obs, socio: socio})})
      .then(response => response.json())
      .then(data => {
          if(data.error !== ""){
            let ph4= document.getElementById("liveAlertPlaceholderdev");
                  const appendAlert14= (message,type)=>{
                    const wrap14= document.createElement("div")
                    wrap14.innerHTML=[
                     `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                   `   <div>${message}</div>`,
                  
                     '</div>'
                   ].join('')
          
                   ph4.append(wrap14)
                  return wrap14
                    };
                    const wrop14= appendAlert14(data.error, 'danger')
                   
                    setTimeout(()=>{
                     wrop14.remove();
                    },3000);
                    setTimeout(()=>{
                      window.location.href="index";
              
                     },3000);
              return;
          }
          if(data.result ){
            let ph4= document.getElementById("liveAlertPlaceholderdev");
                  const appendAlert14= (message,type)=>{
                    const wrap14= document.createElement("div")
                    wrap14.innerHTML=[
                     `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                   `   <div>${message}</div>`,
                  
                     '</div>'
                   ].join('')
          
                   ph4.append(wrap14)
                  return wrap14
                    };
                    const wrop14= appendAlert14('Se registró exitosamente la devolución.', 'success')
                   
                    setTimeout(()=>{
                     wrop14.remove();
                    },3000);
                    setTimeout(()=>{
                      window.location.href="index";
              
                     },3000);
          }
          //procesar data.result en una tabla (mostrar los clientes)
         
          })
    })
    
      }
    
    function retirar(res){
     
    
      fetch("retirar",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({id: res})})
      .then(response => response.json())
      .then(data => {
          if(data.error !== ""){
            let ph4= document.getElementById("liveAlertPlaceholderRETIRAR");
            const appendAlert14= (message,type)=>{
              const wrap14= document.createElement("div")
              wrap14.innerHTML=[
               `<div class="alert alert-${type} alert-dismissible" role="alert">`,
             `   <div>${message}</div>`,
            
               '</div>'
             ].join('')
    
             ph4.append(wrap14)
            return wrap14
              };
              const wrop14= appendAlert14(data.error, 'danger')
             
              setTimeout(()=>{
               wrop14.remove();
              },3000);
              setTimeout(()=>{
                window.location.href="index";
        
               },3000);
             return
          }
          if(data.result ){
            let ph4= document.getElementById("liveAlertPlaceholderRETIRAR");
                  const appendAlert14= (message,type)=>{
                    const wrap14= document.createElement("div")
                    wrap14.innerHTML=[
                     `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                   `   <div>${message}</div>`,
                  
                     '</div>'
                   ].join('')
          
                   ph4.append(wrap14)
                  return wrap14
                    };
                    const wrop14= appendAlert14('Se registró exitosamente el retiro del préstamo.', 'success')
                   
                    setTimeout(()=>{
                     wrop14.remove();
                    },3000);
                    setTimeout(()=>{
                      window.location.href="index";
              
                     },3000);
          }
          //procesar data.result en una tabla (mostrar los clientes)
         
          })
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
         let btnMotivo= document.getElementById("btnMotivo100")
        
        
        
        
         btnMotivo.addEventListener('click',()=>{
           
            toastBootstrap1.hide()
            let motivo= document.getElementById("inputMotivo100").value;
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
                        
                        let ph= document.getElementById("liveAlertPlaceholder6");
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
