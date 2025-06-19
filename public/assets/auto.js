    document.getElementById("autoPageLink").classList.replace('text-dark', 'text-primary');
    document.getElementById("autoPageLink").classList.add('fw-bold');
    document.getElementById("autoPageLink").href = '#';
    let  read1=document.getElementById("read1");
    let  read2=document.getElementById("read2");
    let  read3=document.getElementById("read3");
    let  read4=document.getElementById("read4");
let logs_status = document.getElementById("logs_status");
let statusParag = document.getElementById("carMove");
let carMode     = document.getElementById("carMode");
let angle     = document.getElementById("angle");
let carRotate = document.getElementById("carRotate");
let target_distance=0;
let mov_dis=0;
let progressbar = document.getElementById("progressbar");
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

const statusRef = firebase.database().ref('moving');
statusRef.on('value', (snapshot) => {
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

//////////// Car Target Distance
const targetDistanceRef = firebase.database().ref('target_distance');
targetDistanceRef.on('value', (snapshot) => {
    const data = snapshot.val();
    document.getElementById("target_distance").innerText = data;
    target_distance = data;  

    let percentage=target_distance==0?0:(mov_dis/target_distance)*100;
    if (percentage==100){
        progressbar.style.width=`${percentage}%`;
        progressbar.classList.remove("bg-danger")
        progressbar.classList.add("bg-success")
    }
    else{
        
        progressbar.style.width=`${percentage}%`;
        progressbar.classList.add("bg-danger")
        progressbar.classList.remove("bg-success")
    }
    
    document.getElementById("current_distance").innerText = mov_dis>target_distance?target_distance:Math.floor(mov_dis);
    document.getElementsByClassName("progress-bar")[0].setAttribute("aria-valuenow",percentage );

});

const wheelRpmRef = firebase.database().ref('wheel_rpms');
wheelRpmRef.on('value', (snapshot) => {
    const data = snapshot.val();
    if (data) {
        const{MO1,MO2,MO3,MO4}=data
        document.getElementById('wheelfl').innerText=Math.floor(MO1);
        document.getElementById('wheelfr').innerText=Math.floor(MO2);
        document.getElementById('wheelbl').innerText=Math.floor(MO3);
        document.getElementById('wheelbr').innerText=Math.floor(MO4);
    }
});

//////////// Car Data
const data = firebase.database().ref('data');
data.on('value', (snapshot) => {
    const data = snapshot.val();
    if (data) {
        const{car_speed,moved_distance,mpu_angle}=data

        // Car Mpu_angle
        angle.innerText = Math.floor(mpu_angle);
        carRotate.style.rotate=`${-mpu_angle}deg`;
        carRotate.style.transition=`1s`;
        document.getElementById('wheelfl').style.rotate=`${mpu_angle}deg`;
        document.getElementById('wheelfr').style.rotate=`${mpu_angle}deg`;
        document.getElementById('wheelbl').style.rotate=`${mpu_angle}deg`;
        document.getElementById('wheelbr').style.rotate=`${mpu_angle}deg`;

        document.getElementById('wheelfl').style.transition=`1s`;
        document.getElementById('wheelfr').style.transition=`1s`;
        document.getElementById('wheelbl').style.transition=`1s`;
        document.getElementById('wheelbr').style.transition=`1s`;

        // Car moved_distance
        mov_dis=moved_distance;
        let percentage=(moved_distance/target_distance)*100;
        if (percentage>100){
            percentage=100;
        }
        if (percentage==100){
            progressbar.style.width=`${percentage}%`;
            progressbar.classList.remove("bg-danger")
            progressbar.classList.add("bg-success")
        }
        else{
            
            progressbar.style.width=`${percentage}%`;
            progressbar.classList.add("bg-danger")
            progressbar.classList.remove("bg-success")
        }
        distance.innerText = Math.floor(moved_distance);
        document.getElementById("current_distance").innerText = moved_distance>target_distance?target_distance:Math.floor(moved_distance);
        document.getElementsByClassName("progress-bar")[0].setAttribute("aria-valuenow",percentage );


        // Car Speed
        speedoo.innerText = Math.floor(car_speed);
    }
});

pathSubmit=document.getElementById('pathSubmit');
locationSubmit=document.getElementById('locationSubmit');
squareApply=document.getElementById('squareDiv');
triApply=document.getElementById('triDiv');
rectApply=document.getElementById('rectDiv');

angleInput=document.getElementById('angleInput');
distanceInput=document.getElementById('distanceInput');
speedInput=document.getElementById('speedInput');

xInput=document.getElementById('xInput');
yInput=document.getElementById('yInput');
speedLocInput=document.getElementById('speedLocInput');

widthInput=document.getElementById('widthInput');
lengthInput=document.getElementById('lengthInput');
speedShapeInput=document.getElementById('speedShapeInput');

pathSubmit.onclick=function(){
    let data = {
                angle: parseFloat(angleInput.value) || 0,  // Convert to float, default to 0 if empty
                distance: parseFloat(distanceInput.value) || 0,
                speed: parseFloat(speedInput.value) || 0,
            };
    sendDataToRealtimeDB("executePaths",data,'push');
}


locationSubmit.onclick=function(){
    let data = {
                x: parseFloat(xInput.value) || 0,  // Convert to float, default to 0 if empty
                y: parseFloat(yInput.value) || 0,
                speed: parseFloat(speedLocInput.value) || 0,
            };
    sendDataToRealtimeDB("executeLocations",data,'push');
    xInput.value='';
    yInput.value='';
    speedLocInput.value='';
}

squareApply.onclick=function(){
    let data = {
                length: parseFloat(lengthInput.value) || 0,
                speed: parseFloat(speedShapeInput.value) || 0,
                type:'s',
            };
    sendDataToRealtimeDB("seqs",data,'push');
    lengthInput.value='';
    widthInput.value='';
    speedShapeInput.value='';
}
triApply.onclick=function(){
    let data = {
                length: parseFloat(lengthInput.value) || 0,
                speed: parseFloat(speedShapeInput.value) || 0,
                type:'t',
            };
    sendDataToRealtimeDB("seqs",data,'push');
    lengthInput.value='';
    widthInput.value='';
    speedShapeInput.value='';
}
rectApply.onclick=function(){
    let data = {
                length: parseFloat(lengthInput.value) || 0,
                width: parseFloat(widthInput.value) || 0,
                speed: parseFloat(speedShapeInput.value) || 0,
                type:'r',
            };
    sendDataToRealtimeDB("seqs",data,'push');
    lengthInput.value='';
    widthInput.value='';
    speedShapeInput.value='';
}

//////////// Car Ip
const RpiIpRef = firebase.database().ref('rpi_ip');
RpiIpRef.on('value', (snapshot) => {
    const data = snapshot.val();
    if (data) {
        document.getElementById("rpiIp").innerText = data;
    }
});

function sendDataToRealtimeDB(refrence,data,type="set") {
    const Ref = firebase.database().ref(refrence);
    if(type == "set"){
        Ref.set(data)
    }else if(type == "push"){
        Ref.push(data)
    }else if(type == "update"){
        Ref.update(data)
    }
}


pathSubmit.onclick=function(){
    let data = {
                angle: parseFloat(angleInput.value) || 0,  // Convert to float, default to 0 if empty
                distance: parseFloat(distanceInput.value) || 0,
                speed: parseFloat(speedInput.value) || 0,
                obsMode:modeInput.value
            };
    sendDataToRealtimeDB("executePaths",data,'push');
    angleInput.value='';
    distanceInput.value='';
    speedInput.value='';
}


locationSubmit.onclick=function(){
    let data = {
                x: parseFloat(xInput.value) || 0,  // Convert to float, default to 0 if empty
                y: parseFloat(yInput.value) || 0,
                speed: parseFloat(speedLocInput.value) || 0,
                obsMode:modeInput.value
            };
    sendDataToRealtimeDB("executeLocations",data,'push');
    xInput.value='';
    yInput.value='';
    speedLocInput.value='';
}

squareApply.onclick=function(){
    let data = {
                length: parseFloat(lengthInput.value) || 0,
                speed: parseFloat(speedShapeInput.value) || 0,
                type:'s',
                obsMode:modeInput.value
            };
    sendDataToRealtimeDB("seqs",data,'push');
    lengthInput.value='';
    widthInput.value='';
    speedShapeInput.value='';
}
triApply.onclick=function(){
    let data = {
                length: parseFloat(lengthInput.value) || 0,
                speed: parseFloat(speedShapeInput.value) || 0,
                type:'t',
                obsMode:modeInput.value
            };
    sendDataToRealtimeDB("seqs",data,'push');
    lengthInput.value='';
    widthInput.value='';
    speedShapeInput.value='';
}
rectApply.onclick=function(){
    let data = {
                length: parseFloat(lengthInput.value) || 0,
                width: parseFloat(widthInput.value) || 0,
                speed: parseFloat(speedShapeInput.value) || 0,
                type:'r',
                obsMode:modeInput.value
            };
    sendDataToRealtimeDB("seqs",data,'push');
    lengthInput.value='';
    widthInput.value='';
    speedShapeInput.value='';
}

modeInput.onclick=function(){
    if(modeInput.value =="false")
    {
        modeInput.value="true";
    }
    else{
        modeInput.value="false";
    }
}

    //////////// Car Data
        const usData = firebase.database().ref('us');
        usData.on('value', (snapshot) => {
            const data = snapshot.val();
            if (data) {
                const{us_1,us_2,us_3,us_4}=data;
                read1.innerText = Math.floor(us_2);  
                read2.innerText = Math.floor(us_4);  
                read3.innerText = Math.floor(us_3);  
                read4.innerText = Math.floor(us_1);  
            }
        });


