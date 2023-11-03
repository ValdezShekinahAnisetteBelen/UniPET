
    const deliveryGif = document.getElementById("delivery-gif");
    const message = document.getElementById("message");

    // Function to change the GIF and message
    function changeGif(gifSrc, text, duration, redirect) {
        deliveryGif.src = gifSrc;
        message.innerText = text;

        if (redirect) {
            setTimeout(() => {
                window.location.href = "order_history.html";
            }, duration);
        } else {
            setTimeout(() => {
                changeGif("loading.gif", "Loading...", 60000, true);
            }, duration);
        }
    }

    changeGif("User/wp-content/uploads/sites/2/2019/08/preview.gif", "Your Order has been submitted", 60000, false);
