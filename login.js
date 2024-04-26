
function checkCompleteness()
{
    const form = document.getElementById("log_form");
    const msg = document.getElementById("msg");
	const rname = document.getElementById("regName");
	const regEmail = document.getElementById("regEmail");
	const regPass = document.getElementById("regPass");
	const regCPass = document.getElementById("regCPass");
	const type = document.getElementById("accType");
	type.style.color = 'black';
	rname.style.color = 'black';
	regEmail.style.color = 'black';
	regPass.style.color = 'black';
	regCPass.style.color = 'black';
		msg.innerHTML = " ";
    if( form.Username.value.length < 4  ) { // name entered
		msg.innerHTML = "Username must be longer than 4 characters";
		rname.style.color = 'red';
		alert("Username must be longer than 4 characters");
		return false;
    }

	    if( form.Email.value.length < 8  ) { // name entered
		regEmail.style.color = 'red';
		msg.innerHTML = "Email address must be longer than 8 characters";
		alert("Email address must be longer than 8 characters");
		return false;
    }
	
	
	 const checkboxes = Array.from(document.querySelectorAll(".checkbox"));
  
	 if( !checkboxes.reduce((acc, curr) => acc || curr.checked, false)) { // name entered
		msg.innerHTML = "Please select at least one from Buyer or Seller ";
		type.style.color = 'red';
		alert("Please select at least one from Buyer or Seller");
		return false;
    }
	
	if( form.Password.value.length < 4  ) { // name entered
		regPass.style.color = 'red';
		msg.innerHTML = "Password  must be longer than 4 characters";
		alert("Password  must be longer than 4 characters");
		return false;
    }
	if( form.Password.value !=  form.CPassword.value   ) { // name entered
		regCPass.style.color = 'red';
		msg.innerHTML = "Password and Confirm Password not matched!";
		alert("Password and Confirm Password not matched!");
		return false;
    }




    // passed all the checks: OK to submit

    return true;
}
