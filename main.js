function logout() {
    ajaxReq('logout.php');
}

function ajaxReq() {
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Specify the PHP script URL and request method (e.g., POST or GET)
    var url = inputtedURL;
    var method = 'POST';

    // Set up the AJAX request
    xhr.open(method, url, true);

    // Set the content type header if necessary
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Define the callback function to handle the response
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Handle the response from the PHP script
            var response = xhr.responseText;
            console.log(response);
        }
    };

    // Send the AJAX request
    xhr.send();
}