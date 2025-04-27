
function showIndex(){
    window.location.href = "index";
}
function log1(){
    
    let form=document.forms["formLogin"];
    let request = {};
  
    request.datoCuenta= form.datoUsuario.value;
    request.datoClave= form.datoClave.value;
    if(form.reportValidity()==true){
   
       fetch("usuario/autentication",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
       .then(response => response.json())
       .then(data => {
           if(data.error !== "" && data.error !=="Debe resetear su clave"){
            
            let ph2= document.getElementById("liveAlertPlaceholder");
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
              const wrop12= appendAlert12(data.error, 'danger')
             
              setTimeout(()=>{
               wrop12.remove();
              },3000);
          
               return;
           }
        
           
           if(data.perfil == 2){
            
            window.location.href = "usuario/indexOp";
           };
           if(data.perfil == 1){
            
            window.location.href = "usuario/indexadmin";
           };
           if(data.perfil == "5"){
            window.location.href = "usuario/indexSocio";
           };
            
          /* if(data.error == "Debe resetear su clave"){
               
              window.location.href = "usuario/reseteoClave/"+cuenta;
               
           };*/

       })
       .catch(()=>{});
    }
   }
/*function log(){
   
    let form=document.forms["formLogin"];
    let request = {};
    let cuenta= form.datoCuenta.value;
    request.datoCuenta= form.datoCuenta.value;
    request.datoClave= form.datoClave.value;
    
    fetch("usuario/autentication",{"method":"POST", "headers":{"Content-Type":"application/json"}, "body": JSON.stringify(request)})
    .then(response => response.json())
    .then(data => {
        if(data.error !== "" && data.error !=="Debe resetear su clave"){
           alert(data.error);
            return;
        }
       /* if(data.perfil == "1"){
            window.location.href = "usuario/admin";
        };
        if(data.perfil == "4"){
            window.location.href = "cliente/index";
        };
         
        if(data.error == "Debe resetear su clave"){
            
           window.location.href = "usuario/reseteoClave/"+cuenta;
            
        };

    })
    .catch(()=>{});
 }*/

