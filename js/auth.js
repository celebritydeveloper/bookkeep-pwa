const form = document.getElementById("register-form");
const businessName = form["businessName"];
const email = form["businessEmail"];
const password = form["password"];
const verifyPassword = form["confirmPassword"];
const state = form["location"];
const btn = document.getElementById("sub");
const spinner = document.createElement('SPAN');


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
      document.querySelector("#valid-feedback-1").classList.remove("d-none")
      return true
    } else {
      input.classList.add("is-invalid")
      document.querySelector("#valid-feedback-1").classList.add("d-none");
      input.focus();
      return false
    }
  } else if (input.id === "password") {
    if (input.value.trim().length > 6 && input.value.trim() !== "" && passwordPattern.test(input.value.trim())) {
      //remove invalid class if its already there
      input.classList.remove("is-invalid");
      //add the valid class
      input.classList.add("is-valid")
      document.querySelector("#valid-feedback-2").classList.remove("d-none");

      //show confirm password
      confirmPasswordContainer.classList.remove("d-none")

      return true
    } else {
      input.classList.add("is-invalid")

      //hide confirm password
      confirmPasswordContainer.classList.add("d-none")
      document.querySelector("#invalid-feedback-2").classList.remove("d-none");
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
      document.querySelector("#invalid-feedback-4").classList.add("d-none");
      document.querySelector("#valid-feedback-3").classList.remove("d-none");
      return true
    } else {
      input.classList.add("is-invalid")
      document.querySelector("#valid-feedback-3").classList.add("d-none");
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




form.addEventListener("submit", (e) => {
    e.preventDefault();    

    btn.textContent = '';
    btn.appendChild(spinner);
    spinner.setAttribute("class", "fa fa-circle-o-notch fa-spin");


    auth.createUserWithEmailAndPassword(email.value, password.value).then(users => {
      

      return database.collection("users").doc(users.user.uid).set({
        businessName: businessName.value,
        state: state.value,
      });
        
    }).then(() => {
      var user = firebase.auth().currentUser;

      user.sendEmailVerification().then(function() {
        const response = document.getElementById("response");
        response.classList.add("alert-success");
        response.textContent = "Successfully Registered, Please Confirm Email Address";
        form.reset();
      //remove the valid class
        businessName.classList.remove("is-valid");
        email.classList.remove("is-valid");
        password.classList.remove("is-valid");
        verifyPassword.classList.remove("is-valid");
        state.classList.remove("is-valid");
        btn.textContent = "Create Account";
        spinner.style.display = "none";
        console.log("Email Sent");
      }).catch(function(error) {
        console.log(error.message);
      });
    });
      
    
});
