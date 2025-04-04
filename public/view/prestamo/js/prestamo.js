
document.addEventListener("DOMContentLoaded",()=>{
console.log("ola")
    list()
    cont=0;
          });
const showSave = ()=>{
   
            //window.location.href = "view/cliente/cliente_alta.php";
            window.location.href = "showSave";
        };
 

function buscarEjems(x){
  console.log("ñajaaa")

            let inputActual= document.getElementById(x);
            let err=inputActual.nextElementSibling;

            let datoEjems=inputActual.value;
            let ej1= document.getElementById("datoEjems");
            let ej2= document.getElementById("datoEjems1");
           let ej3= document.getElementById("datoEjems2");

           ej1.style.border= "";
            ej2.style.border= "";
            ej3.style.border= "";
 
            ej1.nextElementSibling.style.display= 'none';
            ej2.nextElementSibling.style.display= 'none';
            ej3.nextElementSibling.style.display= 'none';
         
          


            if(!comparar()){
              inputActual.style.border= "solid red"
             err.style.display='block'
              err.textContent='No pueden haber libros repetidos'
              setTimeout(()=>{
             err.style.display='none';
  
              },3000)
    
             
        
              
              
            }

           // if (formAlta.reportValidity()){
          fetch("../ejemplar/loadd",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify({datoEjems: datoEjems})})
          .then(response => response.json())
          .then(data => {
            console.log("data es"+data)
              if(data.error !== ""){
                 alert(data.error);
                  return;

              }
             /* document.getElementById("datoEjems").style.border= "";
              document.getElementById("datoEjems1").style.border= "";
              document.getElementById("datoEjems2").style.border= "";*/
              if(data.result==false){
              
            
                inputActual.style.border= "solid red"
                err.style.display='block'
              err.textContent='Ejemplar no encontrado.'
              setTimeout(()=>{
              err.style.display='none';
  
              },3000)
             
                 
             }else{
           
                inputActual.style.border= "solid green"
             }
              
          

            
               
            
          })
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
                toastBootstrap1.show()
                setTimeout(()=>{
                 window.location.href="index";
    
                },3000)*/
                 
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
function list(){
    let estado="Inactivo";
    
    
     let cont=1;
           fetch("list",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify()})
           .then(response => response.json())
           .then(data => {
               if(data.error !== ""){
                   alert("ocurrió un error: " + data.error);
                   return;
               }
               if(data.result == ''){
                   alert("No hay prestamos para mostrar")
               }
               //procesar data.result en una tabla (mostrar los clientes)
               
               let prestamos = data.result;
              prestamos.forEach((pres)=>{
                let estado="Inactivo";
                let tipo="A domicilio";
               let botonEstado= 'disabled';
            
                if(pres.estado==1){
                  estado= "Activo";
                  botonEstado='';
                
                }
                if(pres.tipo==0){
                   tipo="En sala"
                  
                  }

                   let html= '<tr  id= "'+pres.id+'" class="">';
                   html += '<td id="inden">' +  cont+ '</td>';
                   html += '<td id="">' +  pres.socioNombre+' ' +pres.socioApellido+'</td>';
                   html += '<td id="">' +  pres.codigoEjemplar+ '</td>';
                   html += '<td id="">' +  pres.libro+ '</td>';
                   html += '<td id="">' + pres.fechaInicio+ '</td>';
                   html += '<td id="">' +  pres.fechaVen+ '</td>';
                   html += '<td id="">'+pres.fechaDev+'</td>';
                   html += '<td id="">'+pres.cantReno+'</td>';
                   html += '<td id="">'+pres.obsDev+'</td>';
                   html += '<td id="">' + tipo + '</td>';
                   
                   html += '<td id="">' + estado+ '</td>';
                   html += '<td id=""><button  onclick="modificar('+JSON.stringify(pres).replace(/"/g,'&quot;')+')" type="button" class="btn btn-primary"  id="btnMod">Modificar</button></td>';
                   html += '<td id=""><button '+botonEstado+' onclick="eliminar('+pres.id+')" type="button" class="btn btn-danger"  id="btnDesactivar">Eliminar</button></td>';
                   html += '<td id=""><button '+botonEstado+' onclick="eliminar('+pres.id+')" type="button" class="btn btn-success"  id="btnDesactivar">Devolver</button></td>';
                   html += '</tr>';
         
           document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
       cont= cont+1;
               });
           
           });
           
           
       
       };


  function comparar(){
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
       function modalAgg(){
        const myModal = new bootstrap.Modal(document.getElementById('myModalAgg'))
        myModal.show();}
function sendNewPres(){
       let form = document.forms["formAlta"];
                  
        if(form.reportValidity()){
            console.log("paso report todo lleno")
        
          let request = {};
          request.datoSocio = form.datoSocio.value;
          request.datoEjems1=form.datoEjems1.value;
          request.datoEjems=form.datoEjems.value;
          request.datoEjems2=form.datoEjems2.value;
          request.datoTipo=form.datoTipo.value;
          console.log("datoejem"+request.datoEjems)
          console.log("datoejem1"+request.datoEjems1)
          console.log("datoejem2"+request.datoEjems2)
          fetch("save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
          .then(response => response.json())
          .then(data => {
              if(data.error !== ""){
                 alert(data.error);
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
                const wrop12= appendAlert12('El libro se registró exitosamente', 'success')
               
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
      
        
      