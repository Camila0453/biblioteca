console.log("hola soy el js")
const showSave = ()=>{
  
console.log("hola soy showsave")

  
   window.location.href = "socio/showSave";
 };
/*const sendNewClient = ()=>{
   alert("hola soy js")
 
    let form = document.forms["formAlta"];
    
  if(form.reportValidity()){
   
    let request = {};
    request.datoApellido = form.datoApellido.value;
    request.datoNombres = form.datoNombres.value;
    request.datoDNI = form.datoDNI.value;
    request.datoDomicilio= form.datoDomicilio.value;
    request.datoLocalidad=form.datoLocalidad.value;
    request.datoProvincia=form.datoProvincia.value;
    request.datoPostal=form.datoPostal.value;
    request.datoTelefono=form.datoTelefono.value;
    request.datoCorreo=form.datoCorreo.value;
 
    

    fetch("cliente/save",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== ""){
           alert(data.error);
            return;
        }
        
            alert("Se registro el cliente: " +  data.apellido);
            window.location.href="cliente/index";
    
      
    })
    .catch(()=>{});

   form.reset();
}
   }*/