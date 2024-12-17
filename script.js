document.getElementById("singup").addEventListener(
    "submit",(e)=>{
        const email = document.forms["singup"]["email"].value;
        const user = document.forms["singup"]["user"].value;
        const pwd = document.forms["singup"]["pwd"].value;
        if (!pwd.match(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/)) {
            alert("password must containe letters, numbers and special charecters");
            document.getElementById("pwd").classList.add("border","border-red-500");
            e.preventDefault();
        }
        else{
            document.getElementById("pwd").classList.remove("border","border-red-500");
        }
        if (!user.match(/^[A-Za-z][A-Za-z0-9_]{7,29}$/)) {
            alert('username is between 7 and 29 charecters containing just letters or numbers or "_".');
            document.getElementById("user").classList.add("border","border-red-500");
            e.preventDefault();
        }
        else{
            document.getElementById("user").classList.remove("border","border-red-500");
        }
        if (!email.match(/^[a-z]{1,50}@[a-z]{1,12}\.[a-z]{1,3}$/)) {
            alert("write a valide email");
            document.getElementById("email").classList.add("border","border-red-500");
            e.preventDefault();
        }
        else{
            document.getElementById("email").classList.remove("border","border-red-500");
        }
    }
)