function toggleChat(){

    let chat = document.getElementById("chatbot");

    if(chat.style.display === "flex"){
        chat.style.display = "none";
    }else{
        chat.style.display = "flex";
    }

}

function askFAQ(question){

    document.getElementById("userMessage").value = question;
    sendMessage();

}

function sendMessage(){

    let input = document.getElementById("userMessage");
    let message = input.value.trim();

    if(message === "") return;

    let chatBody = document.getElementById("chat-body");

    chatBody.innerHTML += `<div class="user-msg">${message}</div>`;

    // typing animation
    let typing = document.createElement("div");
    typing.className = "bot-msg";
    typing.innerHTML = "Typing...";
    chatBody.appendChild(typing);

    fetch("/BMS/CHATBOT/chatbot.php",{
        method:"POST",
        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },
        body:"message="+encodeURIComponent(message)
    })
    .then(res=>res.text())
    .then(data=>{

        typing.remove();

        chatBody.innerHTML += `<div class="bot-msg">${data}</div>`;

        chatBody.scrollTop = chatBody.scrollHeight;

    });

    input.value="";

}

// ENTER KEY
document.getElementById("userMessage").addEventListener("keydown", function(e){

    if(e.key === "Enter"){
        e.preventDefault();
        sendMessage();
    }

});