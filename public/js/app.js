window.addEventListener("load", function() {
    let submit = document.getElementById("username-submit-btn");
    if(submit !== null) {
        submit.addEventListener("click", function(event) {
            event.preventDefault();
            let username = document.getElementById("username").value;
            let url =  window.location.toString();
            if(url[url.length - 1] !== "/") {
                url += "/";
            }
            url += username;
            window.location = url;
        });
    }
});