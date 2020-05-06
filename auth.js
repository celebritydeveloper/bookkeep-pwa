//get inputs
let form = document.querySelector("#register-form")
let businessName = document.querySelector("#business-name")
let email = document.querySelector("#business-email")
let password = document.querySelector("#password")
let state = document.querySelector("#input-state")

// User constructor
class User {
  constructor(name, email, password, state) {
    ;(this.name = name),
      (this.email = email),
      (this.password = password),
      (this.state = state)
  }
}

// Event create a user
form.addEventListener("submit", (e) => {
  e.preventDefault()

  let emailPattern = /^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/

  let businessNameValue = businessName.value.trim()
  let emailValue = email.value.trim()
  let passwordValue = password.value.trim()
  let stateValue = state.value.trim()

  if (businessNameValue == "") {
    alert("businessName must not be empty")
    return false
  } else if (!emailPattern.test(emailValue)) {
    alert("email not valid")
    return false
  } else if (passwordValue == "") {
    alert("password must not be empty")
    return false
  } else if (passwordValue.length < 6) {
    alert("password must be more than 6 digit")
    return false
  }

  //create new user
  const newUser = new User(
    businessNameValue,
    emailValue,
    passwordValue,
    stateValue
  )

  //clear fields
  businessName.value = ""
  email.value = ""
  password.value = ""
  state.value = state.options[0].value

  //console.log(newUser)
  console.log(newUser)
})
