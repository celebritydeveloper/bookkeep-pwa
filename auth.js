//get inputs
let form = document.querySelector("#register-form")
let businessName = document.querySelector("#validationServer01")
let email = document.querySelector("#validationServer02")
let password = document.querySelector("#validationServer03")
let verifyPassword = document.querySelector("#validationServer04")
let state = document.querySelector("#validationServer05")

let inputs = [businessName, email, password, verifyPassword, state]

// User constructor
class User {
  constructor(name, email, password, state) {
    ;(this.name = name),
      (this.email = email),
      (this.password = password),
      (this.state = state)
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

//clear fields
function clearFields() {
  businessName.value = ""
  email.value = ""
  password.value = ""
  verifyPassword.value = ""
  state.value = state.options[0].value
}

// function validate form
function validate(input) {
  //get confirm password container
  let confirmPasswordContainer = document.querySelector("#confirm-password")
  let emailPattern = /^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/

  if (input.id === "validationServer01") {
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
      input.focus()
      return false
    }
  } else if (input.id === "validationServer02") {
    if (emailPattern.test(input.value.trim())) {
      //remove invalid class if its already there
      input.classList.remove("is-invalid")
      //add the valid class
      input.classList.add("is-valid")
      document.querySelector("#valid-feedback-2").classList.remove("d-none")
      return true
    } else {
      input.classList.add("is-invalid")
      document.querySelector("#valid-feedback-2").classList.add("d-none")
      input.focus()
      return false
    }
  } else if (input.id === "validationServer03") {
    if (input.value.trim().length > 6 && input.value.trim() !== "") {
      //remove invalid class if its already there
      input.classList.remove("is-invalid")
      //add the valid class
      input.classList.add("is-valid")
      document.querySelector("#valid-feedback-3").classList.add("d-none")

      //show confirm passwo
      confirmPasswordContainer.classList.remove("d-none")
      document.querySelector("#valid-feedback-3").classList.remove("d-none")
      return true
    } else {
      input.classList.add("is-invalid")

      //hide confirm password
      confirmPasswordContainer.classList.add("d-none")
      input.focus()
      return false
    }
  } else if (input.id === "validationServer04") {
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
      document.querySelector("#valid-feedback-4").classList.remove("d-none")
      input.focus()
      return false
    }
  } else if (input.id === "validationServer05") {
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
      document.querySelector("#valid-feedback-5").classList.remove("d-none")
      input.focus()
      return false
    }
  }
}

// Event create a user
form.addEventListener("submit", (e) => {
  e.preventDefault()

  if (validate(businessName))
    if (validate(email))
      if (validate(password))
        if (validate(verifyPassword))
          if (validate(state)) {
            let newUser = new User(
              businessName.value,
              email.value,
              password.value,
              state.value
            )

            //clear fields
            clearFields()
          }
})
