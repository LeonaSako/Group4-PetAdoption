//let userType = document.querySelector('input[name="user"]');
/*let agencyType = document.getElementById["agency"];

userType.addEventListener("click", function () {
    handleForm("User");
});

agencyType.addEventListener("click", function () {
    handleForm("Agency");
});

function handleForm(type) {
    let xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        if (this.status == 200) {
            document.getElementById('formtype').innerHTML = this.responseText;
        }
    };
    xhttp.open('GET', '../components/form.php?type=' + type);
    xhttp.send();
}*/

document.addEventListener("DOMContentLoaded", function () {
    let accountType = document.getElementById('accountType');

    accountType.addEventListener('change', function () {
        let selectedValue = event.target.value;

        let xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            if (this.status == 200) {
                document.getElementById('formtype').innerHTML = this.responseText;
            }
        };
        let url = "../components/form.php?type=" + encodeURIComponent(selectedValue);
        xhttp.open('GET', url);
        xhttp.send();
    });

});

/*var xhttp = new XMLHttpRequest();

userType.addEventListener('change', function () {
    var selectedValue = document.querySelector('input[name="accountType"]:checked').value;
    if (selectedValue === "user") {
        handleForm("User");
    } else if (selectedValue === "agency") {
        handleForm("Agency");
    }
});

function handleForm(type) {
    xhttp.onreadystatechange = function () {
        if (xhttp.status === 200) {
            document.getElementById('formtype').innerHTML = this.responseText;
        }
    };
    xhttp.open('GET', '../components/form.php?type=' + type);
    xhttp.send();
}*/
