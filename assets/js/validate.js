function validar(){
    var name,lastname,mail,user,pass,expression;
    name=document.getElementById("name").value;
    lastname=document.getElementById("lastname").value;
    mail=document.getElementById("mail").value;
    user=document.getElementById("user").value;
    pass=document.getElementById("password").value;
    expresion=/\w+@+\w+\.+[a-z]/;
    if (name==="" || lastname==="" ||mail===""||user===""||pass==="") {
        alert("Please do not leave any spaces");
        return false;
    }
    if (name.length>100||lastname.length>100||mail.length>100||user.length>100||pass.length>100) {
        alert("Please dont use more than 100 characters per space");
        return false;
    }
    if (!expresion.test(mail)) {
        alert("Please enter a mail");
        return false;
    }
}

