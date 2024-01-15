let oldStyle;

    function likeOn(postId, init){
        let button = document.getElementById("likebutton" + postId);
        let likes = document.getElementById("likenumber" + postId);
        oldStyle = button.style;
        button.style.backgroundColor = "#ff0000";
        button.style.borderColor = "#ff0000";
        button.innerHTML = '<i class="bi bi-heart-fill"></i>';
        
        button.dataset.isOn = "true";
        let n = parseInt(likes.innerText.split(" ")[0]) + 1;
        if(!init)
            likes.innerText = n + " likes";
        console.log("likeOn");
    }

    function likeOff(postId, init){
        let button = document.getElementById("likebutton" + postId);
        let likes = document.getElementById("likenumber" + postId);
        button.style = oldStyle;
        button.dataset.isOn = "false";
        button.innerHTML = '<i class="bi bi-heart"></i>';
        let n = parseInt(likes.innerText.split(" ")[0]) - 1;
        if(!init)
            likes.innerText = n + " likes";
        console.log("likeOff");
    }

    function updateLikeVisual(postId, init, visualizerId){

        console.log("started Update")
        let button = document.getElementById("likebutton" + postId);
        
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "updateLike.php?id="+postId, false);
        xhr.send();
        if(button.dataset.isOn === "true"){
            likeOff(postId, init);
        } else {
            likeOn(postId, init);
        }
    }