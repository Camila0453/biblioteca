console.log("ñajaaaa")
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
              alert(data.error);
               return;
           }
           console.log("ñao")
           
           if(data.perfil == 1){
            
            window.location.href = "usuario/indexadmin";
           };
           /*if(data.perfil == "4"){
             
           };
            
           if(data.error == "Debe resetear su clave"){
               
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

