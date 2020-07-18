//get inputs
let email = document.getElementById("email")
let password = document.getElementById("password")
let form = document.getElementById("login-form");
const loginBtn = document.getElementById("login-btn");
const spinner1 = document.createElement('SPAN');
console.log(spinner1);

let inputs = [email, password];


function validate(input) {

  let emailPattern = /^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/

  if (input.id === "email") {
    if (emailPattern.test(input.value.trim())) {
      //remove invalid class if its already there
      input.classList.remove("is-invalid")
      //add the valid class
      input.classList.add("is-valid")
      document.getElementById("valid-feedback").classList.remove("d-none")
      return true
    } else {
      input.classList.add("is-invalid")
      document.getElementById("valid-feedback").classList.add("d-none")
      return false
    }
  } else if (input.id === "password") {
    if (input.value.trim().length > 6 && input.value.trim() !== "") {
      //remove invalid class if its already there
      input.classList.remove("is-invalid")
      //add the valid class
      input.classList.add("is-valid")
      document.getElementById("valid-feedback-2").classList.add("d-none")
      return true
    } else {
      input.classList.add("is-invalid")
      return false
    }
  }
}

//validate inputs on input and on blur
inputs.forEach((input) => {
  input.addEventListener("blur", () => {
    validate(input)
  })
  input.addEventListener("input", () => {
    validate(input)
  })
})

//Login a user
form.addEventListener("submit", (e) => {
  e.preventDefault();
      loginBtn.innerHTML = '';
      loginBtn.appendChild(spinner1);
      spinner1.setAttribute("class", "fa fa-circle-o-notch fa-spin");
      console.log(spinner1);
  //validate input
  if (validate(email))
    if (validate(password)) {
     auth.signInWithEmailAndPassword(email.value, password.value).then(() => {
       window.location.href = "./index.html";
    });
    }
});