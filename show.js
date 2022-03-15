const visibilityBtn = document.getElementById("visibilityBtn")
visibilityBtn.addEventListener("cliclk", toggleVisibility)

function toggleVisibility(){
    const passwordInput = document.getElementById("visibilityBtn")
    if (passwordInput.type === "password") {
        passwordInput.type = "text"
    }
    else{
        passwordInput.type = "password"
    }
}