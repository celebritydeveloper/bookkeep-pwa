
      const form = document.getElementById("register-form");
      let businessName = document.getElementById("businessName")
      let email = document.getElementById("businessEmail")
      let password = document.getElementById("password")
      let verifyPassword = document.getElementById("confirmPassword")
      let state = document.getElementById("location")
            let response = document.getElementById("response");

      let inputs = [businessName, email, password, verifyPassword, state];

      //validate inputs on input and on blur
          inputs.forEach((input) => {
            input.addEventListener("blur", () => {
              validate(input);
            })
            input.addEventListener("input", () => {
              validate(input);
            })
          });

// function validate form
function validate(input) {
  //get confirm password container
  let confirmPasswordContainer = document.getElementById("confirm-password")
  let emailPattern = /^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/;
  let passwordPattern = /^(?=.{6,}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W).*$/;

  if (input.id === "businessName") {
    if (input.value.trim() !== "") {
      //remove invalid class if its already there
      input.classList.remove("is-invalid")
      //add the valid class
      input.classList.add("is-valid")
      document.querySelector("#valid-feedback-1").classList.remove("d-none")
      return true
    } else {
      input.classList.add("is-invalid")
      document.querySelector("#valid-feedback-1").classList.add("d-none")
      input.focus();
      return false
    }
  } else if (input.id === "businessEmail") {
    if (emailPattern.test(input.value.trim())) {
      //remove invalid class if its already there
      input.classList.remove("is-invalid")
      //add the valid class
      input.classList.add("is-valid")
      document.querySelector("#valid-feedback-2").classList.remove("d-none")
      return true
    } else {
      input.classList.add("is-invalid")
      document.querySelector("#valid-feedback-2").classList.add("d-none");
      input.focus();
      return false
    }
  } else if (input.id === "password") {
    if (input.value.trim().length > 6 && input.value.trim() !== "" && passwordPattern.test(input.value.trim())) {
      //remove invalid class if its already there
      input.classList.remove("is-invalid");
      //add the valid class
      input.classList.add("is-valid")
      document.querySelector("#valid-feedback-3").classList.add("d-none");

      //show confirm password
      confirmPasswordContainer.classList.remove("d-none")

      return true
    } else {
      input.classList.add("is-invalid")

      //hide confirm password
      confirmPasswordContainer.classList.add("d-none")
      document.querySelector("#valid-feedback-3").classList.remove("d-none");
      input.focus();
      return false
    }
  } else if (input.id === "confirmPassword") {
    if (
      input.value.trim() === password.value.trim() &&
      input.value.trim() !== ""
    ) {
      //remove invalid class if its already there
      input.classList.remove("is-invalid")
      //add the valid class
      input.classList.add("is-valid")
      document.querySelector("#valid-feedback-4").classList.add("d-none")
      return true
    } else {
      input.classList.add("is-invalid")
      document.querySelector("#valid-feedback-4").classList.remove("d-none");
      input.focus();
      return false
    }
  } else if (input.id === "location") {
    if (
      input.value !== input.options[1].value &&
      input.value !== input.options[0].value
    ) {
      //remove invalid class if its already there
      input.classList.remove("is-invalid")
      //add the valid class
      input.classList.add("is-valid")
      document.querySelector("#valid-feedback-5").classList.add("d-none")
      return true
    } else {
      input.classList.add("is-invalid")
      document.querySelector("#valid-feedback-5").classList.remove("d-none");
      input.focus();
      return false
    }
  }
}




      form.addEventListener('submit', registerUser);

      function registerUser(e) {
        e.preventDefault();

        if (validate(businessName))
            if (validate(email))
              if (validate(password))
                if (validate(verifyPassword))
                  if (validate(state)) {

                    let ajax = new XMLHttpRequest();
        
        ajax.open("POST", "signup1.php", true);
        ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        ajax.onload = function() {
          console.log(this.responseText);
          response.classList.add("alert-success")
          response.textContent = this.responseText;
          
        }

        ajax.send(`name=${businessName.value}&email=${email.value}&password=${password.value}&location=${state.value}`);
        if(registerUser) {
          form.reset();
          // remove the valid class
              businessName.classList.remove("is-valid")
              email.classList.remove("is-valid")
              password.classList.remove("is-valid")
              verifyPassword.classList.remove("is-valid")
              state.classList.remove("is-valid")
        }



          }

        
        
      }