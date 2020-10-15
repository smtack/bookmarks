var toggleSignup = document.querySelector("#signup");
var toggleLogin = document.querySelector("#login");
var signup = document.querySelector(".signup");
var login = document.querySelector(".login");

window.onload = function() {
	toggleSignup.style.backgroundColor = "#F03434";
	toggleLogin.style.backgroundColor = "#22313F";
	signup.style.display = "block";
	login.style.display = "none";
}

toggleSignup.addEventListener("click", function() {
	toggleSignup.style.backgroundColor = "#F03434";
	toggleLogin.style.backgroundColor = "#22313F";
	signup.style.display = "block";
	login.style.display = "none";
});

toggleLogin.addEventListener("click", function() {
	toggleSignup.style.backgroundColor = "#22313F";
	toggleLogin.style.backgroundColor = "#F03434";
	signup.style.display = "none";
	login.style.display = "block";
});
