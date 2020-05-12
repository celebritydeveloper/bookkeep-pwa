//get inputs
let form = document.getElementById("add-customer-form")
let firstName = document.getElementById("firstName")
let lastName = document.getElementById("lastName")
let companyName = document.getElementById("companyName")
let email = document.getElementById("email")

let inputs = [firstName, lastName, companyName, email]

// User constructor
class Customer {
  constructor(id, firstName, lastName, companyName, email, userID) {
    ;(this.id = id),
      (this.firstName = firstName),
      (this.lastName = lastName),
      (this.companyName = companyName),
      (this.email = email),
      (this.userID = userID)
  }
}

// Store Class : Handle Storage
class Store {
  static getCurrentUser() {
    let currentUser
    if (sessionStorage.getItem("currentUser") === null) {
      currentUser = {}
    } else {
      currentUser = JSON.parse(sessionStorage.getItem("currentUser"))
    }
    return currentUser
  }

  static getCustomers() {
    let customers
    if (localStorage.getItem("customers") === null) {
      customers = []
    } else {
      customers = JSON.parse(localStorage.getItem("customers"))
    }
    return customers
  }

  static addCustomer(customer) {
    const customers = Store.getCustomers()
    customers.push(customer)
    localStorage.setItem("customers", JSON.stringify(customers))
    console.log(customers)
  }

  static generateID(customer) {
    let ID, customers
    customers = Store.getCustomers()
    //check if there is a customer
    if (customers.length) {
      //get the last customer id and add 1 to
      ID = customers[customers.length - 1].id + 1
    } else {
      ID = 1
    }
    customer.id = ID
  }

  static clearData() {
    let customers = []
    localStorage.setItem("customers", JSON.stringify(customers))
  }
}

// Event create a new customer
form.addEventListener("submit", (e) => {
  e.preventDefault()

  let newCustomer = new Customer(
    0,
    firstName.value,
    lastName.value,
    companyName.value,
    email.value,
    Store.getCurrentUser().id
  )
  //generate an auto id for customer
  Store.generateID(newCustomer)
  //add customer to local storage
  Store.addCustomer(newCustomer)
  //reset form
  form.reset()
  alert("New Customer added successfully")
  return true
})
