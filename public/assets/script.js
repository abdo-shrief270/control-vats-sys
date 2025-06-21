if(navigator.serviceWorker){
    navigator.serviceWorker.register('assets/sw.js')
    .then((reg)=>{
        // console.log("file is here", reg)
    })
    .catch((err)=>{
        // console.log("Error", err)
    })
}
Notification.requestPermission().then((permission)=>{
    if(permission === 'granted'){
        // console.log("Permission granted");
    }else{
        // console.log("Permission denied");
    }
});

let installBtn = document.getElementById("install");
let deferredPrompt;
window.addEventListener("beforeinstallprompt", (installEvent)=>{
    installEvent.preventDefault();
    installBtn.style.display = "block";
    deferredPrompt = installEvent;
});

installBtn.addEventListener("click", (e)=>{
    e.preventDefault();
    if(deferredPrompt){
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult)=>{
            if(choiceResult.outcome === 'accepted'){
                // console.log("User accepted the install");
                installBtn.style.display = "none";
            }else{
                // console.log("User dismissed the A2HS prompt");
            }
        });
    }
});
