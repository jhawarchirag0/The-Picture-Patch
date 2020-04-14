function validateForm()
{
    var fn = document.getElementById("fn").value;
    var letters = /^[A-Za-z]+$/;
    if(fn==""){
        alert("First Name is required!");
    }
    else if(fn.match(letters)){

        var ln = document.getElementById("ln").value;
        if(ln==""){
            alert("Last Name is required!");
        }
        else if(ln.match(letters)){
            var email = document.getElementById("email").value;
            var mailformat = /\S+@\S+\.\S+/;
            if(email==""){
                alert("Email Address is required!");
            }
            else if(email.match(mailformat)){

                var password = document.getElementById("pss").value;
                var passformat = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/
                if(pss ==""){
                    alert("Contact Number is required!");
                }
                else if(password.match(passformat)){
                    alert("Form Submitted")
                }
                else{
                    alert("Invalid Password Format!")
                }   
            }
            else{
                alert("Invalid Email Format!")
            }

        }
    }
    else{
        alert("Invalid First Name Format!");
    }
}