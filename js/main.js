// START PAGE CONEXION 
let form=document.forms['connEmp']
let user =form['user']
let pwd =form['pwd']
let btn_connEmp=form['btn_connEmp']
 function validationFormConexion(){
    user.addEventListener('blur',function(){
        if(user.value=="" ){
            if(user.nextElementSibling.tagName != "SPAN"){
                let span=document.createElement("span");
                span.innerHTML="remplir le champ user !!<br>"
                span.style.color="red"
                user.after(span)
            }
            return false 
          }else{
            if(user.nextElementSibling.tagName == "SPAN"){
                user.nextElementSibling.remove()
            }
          }
     })
     
     pwd.addEventListener('blur',()=>{
        if(pwd.value==""){
            if(pwd.nextElementSibling.tagName != "SPAN"){
                let span=document.createElement("span");
                span.innerHTML="remplir le champ password !! <br>"
                span.style.color="red"
                pwd.after(span)
            }
            return false
          }else{
            if(pwd.nextElementSibling.tagName == "SPAN"){
                pwd.nextElementSibling.remove()
            }
          }
     })
      
      return true
 }
 validationFormConexion()
// END PAGE CONEXION 
// START PAGE SINSCRIRE 

// END PAGE SINSCRIRE 