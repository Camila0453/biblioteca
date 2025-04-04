document.addEventListener("DOMContentLoaded",()=>{

modificar()
})


function modificar(us){
    console.log(us)
   document.getElementById("datoNombre").value= us.nombreCompleto;
   document.getElementById("datoCorreo").value=us.nomUser;
   document.getElementById("datoDni").value=us.dni;
   
  let selectTipoUser= document.getElementById("datoTipoUsuario");
  selectTipoUser.querySelectorAll("option").forEach(op=>{
      if( us.tipoUsuario== op.text){

    
          selectTipoUser.value=op.value;
      }
  })
  let selectEstado= document.getElementById("selectEstado")
 
   selectEstado.value=us.estado
  console.log("select estado es"+ selectEstado.value)
  const myModal = new bootstrap.Modal(document.getElementById('myModal'))
  myModal.show();
let form= document.getElementById("formAct")


 document.getElementById("btnAct").addEventListener("click",()=>{
  let request= {}
   request.datoEstado=form.selectEstado.value;
   request.datoNombreC= form.datoNombre.value;
   request.datoCorreox=form.datoCorreo.value;
   request.datoDni=form.datoDni.value;
   request.datoTipoUsuario= form.datoTipoUsuario.value;
   request.datoId= us.id;

  fetch("update/usuario",
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
             
             // window.location.reload();
              
                /*let user= document.getElementById(id);
                user.querySelector("#btnMod").removeAttribute("disabled");
                user.querySelector("#btnDesactivar").removeAttribute("disabled");
                user.classList.remove("socio-inactivo");*/
            }
        
})
 })

   
  // console.log(us.nomUser);
       
    
    /**/
}