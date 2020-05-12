//get inputs
let email = document.getElementById("email")
let password = document.getElementById("password")
let form = document.getElementById("login-form")

let inputs = [email, password]

//user database : local storage
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

  static checkUser(email, password) {
    let users = Store.getUsers()
    let isDetails = false // login details doestn match

    users.forEach((user) => {
      if (user.email === email && user.password === password) {
        isDetails = true // login details match
        console.log("user already exist")
      } else {
        isDetails = false // login details doestn match
        console.log("user does not exist")
      }
    })

    return isDetails
  }
}

function validate(input) {
  //get confirm password container
  let confirmPasswordContainer = document.getElementById("confirm-password")
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
  e.preventDefault()

  //validate input
  if (validate(email))
    if (validate(password)) {
      if (Store.checkUser(email.value, password.value)) {
        alert("Login successful")

        //set form to default state
        form.reset()
        email.classList.remove("is-valid")
        password.classList.remove("is-valid")
      } else {
        alert("Login details not correct")
      }
    }
})
