auth.onAuthStateChanged(user => {
    if(user) {
        database.collection("users").onSnapshot(snapshot => {
            setupUI(user);
        }, err => {
            console.log(err.message);
        });
        
        console.log("User logged in", user);
    }else {
        console.log("User logged out");
    }
});


const setupUI = (user) => {
    if(user) {
        database.collection("users").doc(user.uid).get().then((doc) => {
            const bizName = document.getElementById("bizName");
            bizName.textContent = doc.data().businessName;
        });
    }else {
        console.log("Null");
    }
}


const logout = document.getElementById("logout");

logout.addEventListener("click", (e) => {
  e.preventDefault();
  auth.signOut().then(() => {
      window.location.href = "./login.html";
  });
});
