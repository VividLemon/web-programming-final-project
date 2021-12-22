window.addEventListener('load', () => {
    console.log("Working");
    window.addEventListener("error", function (eventObj) {
        alert("ERROR: " + eventObj.message)
    });
    const contactForm = document.getElementById("contactForm");
    const txtFirstName = document.getElementById("txtFirstName");
    const txtLastName = document.getElementById("txtLastName");
    const txtEmail = document.getElementById("txtEmail");
    const txtComments = document.getElementById("txtComments");
    const vFirstName = document.getElementById("vFirstName");
    const vLastName = document.getElementById("vLastName");
    const vEmail = document.getElementById("vEmail");
    const vComments = document.getElementById("vComments");
    contactForm.addEventListener("submit", (eventObj) => {
        if (validateContactForm() == false) {
            eventObj.preventDefault();
        }
    });

    function validateContactForm() {
        let formIsValid = true;
        clearValidationMessages();
        if (txtFirstName.value == "") {
            vFirstName.innerHTML = "Please enter your first name";
            vFirstName.style.display = "block";
            formIsValid = false;
        }
        if (txtLastName.value == "") {
            vLastName.innerHTML = "Please enter your last name";
            vLastName.style.display = "block";
            formIsValid = false;
        }
        if (txtEmail.value == "") {
            vEmail.innerHTML = "Please enter your email";
            vEmail.style.display = "block";
            formIsValid = false;
        } else if (validateEmailAddress(txtEmail.value) == false) {
            vEmail.innerHTML = "The email you entered is not valid";
            vEmail.style.display = "block";
            formIsValid = false;
        }
        if (txtComments.value == "") {
            vComments.innerHTML = "Please enter some comments";
            vComments.style.display = "block";
            formIsValid = false;
        } else if (containsURL(txtComments.value)) {
            vComments.innerHTML = "URLs are not allowed in the comments";
            vComments.style.display = "block";
            formIsValid = false;
        }
        return formIsValid;
    }

    function clearValidationMessages() {
        let divs = document.querySelectorAll(".validation-message");
        for (let x = 0; x < divs.length; x++) {
            divs[x].innerHTML = "";
            divs[x].style.display = "none";
        }
    }

    function containsURL(str) {
        let regExp = /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i;
        return regExp.test(str);
    }

    function validateEmailAddress(email) {
        let regExp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return regExp.test(email);
    }
});

window.addEventListener("load",()=>{window.addEventListener("error",(function(e){alert("ERROR: "+e.message)}));const e=document.getElementById("contactForm"),t=document.getElementById("txtFirstName"),n=document.getElementById("txtLastName"),l=document.getElementById("txtEmail"),a=document.getElementById("txtComments"),s=document.getElementById("vFirstName"),m=document.getElementById("vLastName"),o=document.getElementById("vEmail"),d=document.getElementById("vComments");e.addEventListener("submit",e=>{0==function(){let e=!0;(function(){let e=document.querySelectorAll(".validation-message");for(let t=0;t<e.length;t++)e[t].innerHTML="",e[t].style.display="none"})(),""==t.value&&(s.innerHTML="Please enter your first name",s.style.display="block",e=!1);""==n.value&&(m.innerHTML="Please enter your last name",m.style.display="block",e=!1);""==l.value?(o.innerHTML="Please enter your email",o.style.display="block",e=!1):0==(i=l.value,/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(i))&&(o.innerHTML="The email you entered is not valid",o.style.display="block",e=!1);var i;""==a.value?(d.innerHTML="Please enter some comments",d.style.display="block",e=!1):(r=a.value,/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i.test(r)&&(d.innerHTML="URLs are not allowed in the comments",d.style.display="block",e=!1));var r;return e}()&&e.preventDefault()})});