 document.getElementById("statusPageLink").classList.replace('text-dark', 'text-primary');
        document.getElementById("statusPageLink").classList.add('fw-bold');
        document.getElementById("statusPageLink").href = '#';

      let  logs_status=document.getElementById("logs_status");
      let  read1=document.getElementById("read1");
      let  read2=document.getElementById("read2");
      let  read3=document.getElementById("read3");
      let  read4=document.getElementById("read4");
      let  carro=document.getElementById("carro");
      let  angle=document.getElementById("angle");
      let  distance=document.getElementById("distance");
      let  speedoo=document.getElementById("speedoo");
      let  last_active=document.getElementById("last-active");
      let  rpicommand=document.getElementById("rpicommand");
      let  input_latitude=document.querySelector("#latitude");
      let  input_longitude=document.querySelector("#Longitude");
      let  input_altitude=document.querySelector("#altitude");
      let  x_x=document.querySelector(".x");
      let  y_y=document.querySelector(".y");
      let  z_z=document.querySelector(".z");
      let  send_btn=document.querySelector("#send_btn");
      let  arduino_echo=document.getElementById("arduino_echo");
      /////////////////////
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

         ///////logs-Status
        let stored_log_status="";
        let stored_log_text="";
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
                //////////// Car Data
        const data = firebase.database().ref('us');
        data.on('value', (snapshot) => {
            const data = snapshot.val();
            if (data) {
                const{us_1,us_2,us_3,us_4}=data;
                read1.innerText = Math.floor(us_2);
                read2.innerText = Math.floor(us_4);
                read3.innerText = Math.floor(us_3);
                read4.innerText = Math.floor(us_1);
            }
        });
        const geo_location = firebase.database().ref('location');
        geo_location.on('value', (snapshot) => {
            const data = snapshot.val();
            if (data) {
                const {  latitude, longitude, altitude } = data;
                input_altitude.innerText = altitude;
                input_latitude.innerText = latitude;
                input_longitude.innerText = longitude;
            }
        });
        //////////x-y-z
        const ecef_location = firebase.database().ref('locationEcef');
         ecef_location.on('value', (snapshot) => {
            const data = snapshot.val();
            if (data) {
                const { x, y, z } = data;
                x_x.innerText = Math.floor(x);
                y_y.innerText = Math.floor(y);
                z_z.innerText = Math.floor(z);
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
        //////////// Car Ip
        const RpiIpRef = firebase.database().ref('rpi_ip');
        RpiIpRef.on('value', (snapshot) => {
            const data = snapshot.val();
            if (data) {
                document.getElementById("rpiIp").innerText = data;
            }
        });
        //////////// Gps Thread
        const gpsThreadRef = firebase.database().ref('gps_thread');
        gpsThreadRef.on('value', (snapshot) => {
            const data = snapshot.val();
            if (data) {
                document.getElementById("gpsThread").checked = true;
                document.getElementById("gpsThread").value = "true";
            } else {
                document.getElementById("gpsThread").checked = false;
                document.getElementById("gpsThread").value = "false";
            }
        });
        document.getElementById("gpsThread").addEventListener("change", function() {
            const isChecked = this.checked;
            const updates = {};
            updates['/gps_thread'] = isChecked;
            firebase.database().ref().update(updates);
        });
         //////////// SMS Alert Thread
         const smsAlertThreadRef = firebase.database().ref('sms_thread');
         smsAlertThreadRef.on('value', (snapshot) => {
             const data = snapshot.val();
             if (data) {
                 document.getElementById("smsAlertThread").checked = true;
                 document.getElementById("smsAlertThread").value = "true";
             } else {
                 document.getElementById("smsAlertThread").checked = false;
                 document.getElementById("smsAlertThread").value = "false";
             }
         });
         document.getElementById("smsAlertThread").addEventListener("change", function() {
             const isChecked = this.checked;
             const updates = {};
             updates['/sms_thread'] = isChecked;
             firebase.database().ref().update(updates);
         });
