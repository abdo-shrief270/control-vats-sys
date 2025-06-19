document
  .getElementById("livePageLink")
  .classList.replace("text-dark", "text-primary");
document.getElementById("livePageLink").classList.add("fw-bold");
document.getElementById("livePageLink").href = "#";
statusParag = document.getElementById("carMove");
carstatus = document.getElementById("carStatus");
logs_status = document.getElementById("logs_status");
const firebaseConfig = {
  apiKey: "AIzaSyCt3PpT9MV8TBlsgDmjvUngq-ZF1lNYQ2c",
  authDomain: "rpi-car-track.firebaseapp.com",
  databaseURL: "https://rpi-car-track-default-rtdb.firebaseio.com",
  projectId: "rpi-car-track",
  storageBucket: "rpi-car-track.firebasestorage.app",
  messagingSenderId: "603017187064",
  appId: "1:603017187064:web:c8da4c7a71d9745fe8b50d",
  measurementId: "G-GEM4R145LE",
};

firebase.initializeApp(firebaseConfig);
const db = firebase.database();

const statusRef = firebase.database().ref("moving");
statusRef.on("value", (snapshot) => {
  const data = snapshot.val();
  if (data) {
    statusParag.style.color = "#AA2845";
    statusParag.style.backgroundColor = "#7A28351A";
    statusParag.innerText = "Vehicle is moving";
  } else {
    statusParag.style.color = "#28AA45";
    statusParag.style.backgroundColor = "#28A7451A";
    statusParag.innerText = "Vehicle is not moving";
  }
});
/////person inside and allowed
const personallowed = firebase.database().ref("person");
personallowed.on("value", (snapshot) => {
  const data = snapshot.val();
  if (data) {
    if (data.allowed) {
      carstatus.style.color = "#28AA45";
      carstatus.style.backgroundColor = "#28A7451A";
      carstatus.innerText = `${data.name} is Allowed`;
    } else {
      carstatus.style.color = "#A72845";
      carstatus.style.backgroundColor = "#7A28351A";
      carstatus.innerText = `${data.name} is Not Allowed`;
    }
  } else {
    carstatus.style.color = "#A72845";
    carstatus.style.backgroundColor = "#7A28351A";
    carstatus.innerText = "No one in the car";
  }
});
let stored_log_status = "";
let stored_log_text = "";
const status_s = firebase.database().ref("log");
status_s.on("value", (snapshot) => {
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
const RpiIpRef = firebase.database().ref("rpi_ip");
RpiIpRef.on("value", (snapshot) => {
  const data = snapshot.val();
  if (data) {
    document.getElementById("rpiIp").innerText = data;
  }
});

const liveImg = document.getElementById("live");
// Fetch and listen for the live stream URL
const streamUrlRef = db.ref("car/stream_url"); // Replace with your actual path

streamUrlRef.on("value", (snapshot) => {
  const url = snapshot.val();
  if (url) {
    liveImg.src = `${url}`;
    liveImg.alt = "Stream URL is available";
  } else {
    liveImg.src = `https://control.vats-sys.com/assets/icons/stream_error.png`;
    liveImg.alt = "Stream URL is not available";
  }
});

const detectionImage = document.getElementById("detection_image");
// Fetch and listen for the live stream URL
const detectionImageUrlRef = db.ref("car/image_url"); // Replace with your actual path

detectionImageUrlRef.on("value", (snapshot) => {
  const url = snapshot.val();
  if (url) {
    detectionImage.src = `${url}`;
    detectionImage.alt = "Detection image URL is available";
  } else {
    detectionImage.src = `https://control.vats-sys.com/assets/icons/stream_error.png`;
    detectionImage.alt = "Detection image URL is not available";
  }
});
