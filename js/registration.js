//get inputs
let form = document.getElementById("register-form")
let businessName = document.getElementById("businessName")
let email = document.getElementById("businessEmail")
let password = document.getElementById("password")
let verifyPassword = document.getElementById("confirmPassword")
let state = document.getElementById("location")

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

// Store Class : Handle Storage
class Store {
  static getUsers() {
    let users
    if (localStorage.getItem("users") === null) {
      users = []
    } else {
      users = JSON.parse(localStorage.getItem("users"))
    }
    return users
  }

  static addUser(user) {
    const users = Store.getUsers()
    users.push(user)
    localStorage.setItem("users", JSON.stringify(users))
    console.log(users)
  }

  static checkUser(email) {
    let users = Store.getUsers()
    let isExist = false // user does'nt exist

    users.forEach((user) => {
      if (user.email === email) {
        isExist = true // user  exist
        console.log("user already exist")
      } else {
        isExist = false // user does'nt exist
        console.log("user does not exist")
      }
    })

    return isExist
  }

  static clearData() {
    let users = []
    localStorage.setItem("users", JSON.stringify(users))
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

// function validate form
function validate(input) {
  //get confirm password container
  let confirmPasswordContainer = document.getElementById("confirm-password")
  let emailPattern = /^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/

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
    if (input.value.trim().length > 6 && input.value.trim() !== "") {
      //remove invalid class if its already there
      input.classList.remove("is-invalid")
      //add the valid class
      input.classList.add("is-valid")
      document.querySelector("#valid-feedback-3").classList.add("d-none")

      //show confirm passwo
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

// Event create a new user
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
            //check if user exist
            if (Store.checkUser(email.value)) {
              alert(`user with email: ${email.value} already exist`)
              return false
            } else {
              //Add user to Local Storage
              Store.addUser(newUser)

              // remove the valid class
              businessName.classList.remove("is-valid")
              email.classList.remove("is-valid")
              password.classList.remove("is-valid")
              state.classList.remove("is-valid")

              //clear fields
              form.reset()
              alert("Registration successfull")
              return true
            }
          }
})
