function populateState() {
  let stateAPI = "http://locationsng-api.herokuapp.com/api/v1/states"
  let states = new XMLHttpRequest()

  states.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let state = JSON.parse(this.responseText)

      state.forEach((location) => {
        let option = document.createElement("OPTION")
        option.textContent = location.name
        const select = document.querySelector(
          "#register-form #location"
        )

        select.appendChild(option)
      })
    }
  }

  states.open("GET", stateAPI, true)
  states.send()
}

populateState();
