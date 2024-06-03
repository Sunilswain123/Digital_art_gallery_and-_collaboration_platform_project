  const sign_in_btn = document.querySelector("#sign-in-btn");
  const sign_up_btn = document.querySelector("#sign-up-btn");
  const container = document.querySelector(".container");
  const signup=document.querySelector("#signup");

  sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
  });

  sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
  });

  signup.addEventListener("click",()=>{
    container.classList.add("sign-up-mode");
  });

  const signUpForm = document.querySelector('.sign-up-form');
  const signInForm = document.querySelector('.sign-in-form');

function validator(e){
  let name=document.getElementById("username").value;
  let mobile=document.getElementById("phone").value;
  let mail=document.getElementById("email").value;
  let pass=document.getElementById("password").value;
  let conpass=document.getElementById("conpassword").value;

  let errname=document.getElementById("nameError");
  let errmobile=document.getElementById("phnError");
  let errmail=document.getElementById("emailError");
  let errpass=document.getElementById("passError");
  let errconpass=document.getElementById("conpassError");

  const namepat=/[a-zA-Z]{2,}/
  const mobpat=/^[6-9][0-9]{9}$/
  const mailpat=/^[\w\.]{4,}@[a-zA-Z\.]{4,}[a-zA-Z]{2,}/
  const passpat=/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*+~]).{8,16}$/

  if(name === "" || name === null){
    errname.innerHTML="*Required!";
    e.preventDefault();
  } else if(!name.match(namepat)){
    errname.innerHTML="Invalid Name!";
    e.preventDefault();//jaha kri web design and we care about 
  } else {
    errname.innerHTML = ""
  }

  if(mobile === "" || mobile===null){
    errmobile.innerHTML="*Required!";
    e.preventDefault();
  } else if(!mobile.match(mobpat)){
    errmobile.innerHTML="Invaid Mobile No!";
    e.preventDefault();
  } else {
    errmobile.innerHTML="";
  }

  if(mail === "" || mail === null){
    errmail.innerHTML="*Required!";//Hud io lii duin satare lp and so then
    e.preventDefault(); 
  } else if(!mail.match(mailpat)){
    errmail.innerHTML="Invalid Email!";
    e.preventDefault();
  } else {
    errmail.innerHTML="";
  }

  if(pass === "" || pass === null){
    errpass.innerHTML="*Required!";
    e.preventDefault();
  } else if(!pass.match(passpat)){
    errpass.innerHTML="Weak password!"
    e.preventDefault();
  } else {
    errpass.innerHTML="";
  }
  
  if(conpass === "" || conpass === null){
    errconpass.innerHTML="*Required!";
    e.preventDefault();
  } else if(conpass !== pass){
    errconpass.innerHTML="Passwords must be same!"
    e.preventDefault();
  } else {
    errconpass.innerHTML="";
  }
}
  
