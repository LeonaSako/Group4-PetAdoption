document.addEventListener("DOMContentLoaded", function () {
    let accountType = document.getElementById('accountType');
    let form = document.querySelector('form');

    accountType.addEventListener('change', function (event) {
        let selectedValue = event.target.value;

        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            let formData = new FormData(form);
            formData.append('type', selectedValue); // Append the selected type to form data

            let xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                if (this.status == 200) {
                    document.getElementById('formtype').innerHTML = this.responseText;
                }
            };

            let url = '../components/form.php?type=' + encodeURIComponent(selectedValue);
            xhttp.open('POST', url);
            xhttp.send(formData);
        });
    });
});