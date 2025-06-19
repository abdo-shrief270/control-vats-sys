    document.getElementById("logsPageLink").classList.replace('text-dark', 'text-primary');
    document.getElementById("logsPageLink").classList.add('fw-bold');
    document.getElementById("logsPageLink").href = '#';
    logs_div=document.getElementById("viewLogsDiv");
    logs_status=document.getElementById("logs_status");
    const firebaseConfig = {
    apiKey: "AIzaSyCt3PpT9MV8TBlsgDmjvUngq-ZF1lNYQ2c",
    authDomain: "rpi-car-track.firebaseapp.com",
    databaseURL: "https://rpi-car-track-default-rtdb.firebaseio.com",
    projectId: "rpi-car-track",
    storageBucket: "rpi-car-track.firebasestorage.app",
    messagingSenderId: "603017187064",
    appId: "1:603017187064:web:c8da4c7a71d9745fe8b50d",
    measurementId: "G-GEM4R145LE"
    };
    firebase.initializeApp(firebaseConfig);
    const db = firebase.database();
    function formatTimeAgo(seconds) {
        if (seconds < 60) return `${seconds} sec`;

        const minutes = Math.floor(seconds / 60);
        if (minutes < 60) return `${minutes} min`;

        const hours = Math.floor(minutes / 60);
        if (hours < 24) return `${hours} hour${hours !== 1 ? 's' : ''}`;

        const days = Math.floor(hours / 24);
        if (days < 30) return `${days} day${days !== 1 ? 's' : ''}`;

        const months = Math.floor(days / 30);
        if (months < 12) return `${months} month${months !== 1 ? 's' : ''}`;

        const years = Math.floor(months / 12);
        return `${years} year${years !== 1 ? 's' : ''}`;
    }

    const logsRef = firebase.database().ref('logs');
    logsRef.on('value', (snapshot) => {
        const data = snapshot.val();
        if (data) {
            logs_div.innerHTML = '';
            Object.entries(data).forEach(([key, log]) => {
                const { status, text, timestamp } = log;

               const now = Date.now();
const time_diff = Math.max(0, Math.floor(now / 1000 - timestamp));
const timeAgoText = `${formatTimeAgo(time_diff)} ago`;

                logs_div.innerHTML += `
                    <div class="w-100 bg-${status} row border rounded d-flex justify-content-between align-content-center align-items-center p-1">
                        <div class="col-12 col-md-7 m-0 text-md-start text-center text-lg-start""><p class="m-0 fs-6 ">${text}</p></div>
                        <div class="col-6 col-md-3 text-sm-start text-lg-end"><p class="m-0">${timeAgoText}</p></div>
                        <div class="col-6 col-md-2 text-end"><p class="m-0">${status}</p></div>
                    </div>
                `;
            });
        }
    });
    let stored_log_status = "";
    let stored_log_text = "";
    const status_s = firebase.database().ref('log');
    status_s.on('value', (snapshot) => {
        const data = snapshot.val();
        if (data) {
            const { status, text } = data;

            if (stored_log_status !== status || stored_log_text !== text) {
                logs_status.classList.remove(`bg-${stored_log_status}`);
                stored_log_status = status;
                stored_log_text = text;
                logs_status.classList.add(`bg-${status}`);
                logs_status.innerText = text;
            }
        }
    });
    //////////// Car Ip
    const RpiIpRef = firebase.database().ref('rpi_ip');
    RpiIpRef.on('value', (snapshot) => {
        const data = snapshot.val();
        if (data) {
            document.getElementById("rpiIp").innerText = data;
        }
    });
