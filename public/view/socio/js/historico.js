function buscar($dniOnom){

    let formBus=document.getElementById("formBus")
    let datoBus= document.getElementById("datoBus")
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















document.addEventListener("DOMContentLoaded",()=>{
    list()
  
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
                     let socios = data.result;
                    socios.forEach((so)=>{
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
                         html += '<td id="">' +  so.nombreSocio+ '</td>';
                         html += '<td id="">' + so.apellido + '</td>';
                         html += '<td>'+ + so.dni + '</td>';
                         html += '<td id="">' + so.domicilio+ '</td>';
                         html += '<td id="">'+so.localidad+ '</td>';
                         html += '<td id="">'+so.provincia+ '</td>';
                         html += '<td id="">'+so.telefono+ '</td>';
                         html += '<td id="">'+ so.correo+ '</td>';
                         html += '<td id="">'+ so.fechaAlta+ '</td>';
                         html += '<td id="">'+ estado+ '</td>';
                         html += '<td id="">'+ so.tsn+ '</td>';
                         html += '<td id=""></td>';
                         html += '<td id=""></td>';
                         html += '<td id=""></td>';
                         html += '<td id="">'+ so.fechaHora+' </td>';
                         html += '<td id="">'+ so.motivo+' </td>';
                         html += '<td id="">'+ so.usuarioBaja+' </td>';
                         html += '</tr>';
        
               
                 document.getElementById("tablaProductos").insertAdjacentHTML("beforeend",html);
             cont= cont+1;
                     });
                    }
                 )};
                
                  