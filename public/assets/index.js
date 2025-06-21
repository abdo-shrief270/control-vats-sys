        document.getElementById("indexPageLink").classList.replace('text-dark', 'text-primary');
        document.getElementById("indexPageLink").classList.add('fw-bold');
        document.getElementById("indexPageLink").href = '#';
        statusParag = document.getElementById("carMove");
        carstatus = document.getElementById("carStatus");
        vspeed_p = document.getElementById("carSpeed");
        logs_status = document.getElementById("logs_status");
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
        // Map Initialization
        var map = L.map('mapDiv').setView([0, 0], 10); // Default center (can be updated later)
        // Google Satellite Layer
        var esriSatellite = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© AVDTM'
        });
        esriSatellite.addTo(map);
        // Marker and Circle Variables
        var marker;
        // Function to update map with new coordinates
        function updateMap(latitude, longitude, accuracy = 50) {
            if (marker) {
                map.removeLayer(marker);
            }
            // Add Marker and Circle
            marker = L.marker([latitude, longitude]).addTo(map).bindTooltip("car Location", { permanent: true, direction: 'top', className: 'location-label' });
            // Fit bounds around the marker and circle
            var featureGroup = L.featureGroup([marker]).addTo(map);
            map.fitBounds(featureGroup.getBounds());
        }
            // Fetch Realtime Data from Firebase
        const locationRef = firebase.database().ref('locations');
        locationRef.on('value', (snapshot) => {
            const data = snapshot.val();
            if (data) {
                Object.entries(data).forEach(([key, location]) => {
                    const { latitude, longitude, altitude } = location;
                    //console.log(Retrieved Location: Lat: ${latitude}, Long: ${longitude}, Alt: ${altitude});
                    updateMap(parseFloat(latitude), parseFloat(longitude), 50);
                });
            } else {
                console.log('No location data found in Firebase.');
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

        /////person inside and allowed
        const personallowed = firebase.database().ref("person");
        personallowed.on("value", (snapshot) => {
        const data = snapshot.val();
        if(data){
            if (data.allowed) {
            carstatus.style.color = "#28AA45";
            carstatus.style.backgroundColor = "#28A7451A";
            carstatus.innerText = `${data.name} is Allowed`;
            } else {
            carstatus.style.color = "#A72845";
            carstatus.style.backgroundColor = "#7A28351A";
            carstatus.innerText = `${data.name} is Not Allowed`;
            }
        }else{
            carstatus.style.color = "#A72845";
            carstatus.style.backgroundColor = "#7A28351A";
            carstatus.innerText = "No one in the car";
        }

        });


         //////////// Car Data
         const data = firebase.database().ref('data');
         data.on('value', (snapshot) => {
             const data = snapshot.val();
             if (data) {
                 const{car_speed}=data

                 if (car_speed <= 80) {
                    vspeed_p.style.backgroundColor = "#28A7451A";
                    vspeed_p.innerText = "Vehicle speed " + car_speed + " %";
                    vspeed_p.style.color = "#28AA45";
                }
                else {
                    vspeed_p.style.backgroundColor = "#7A28351A";
                    vspeed_p.innerText = "Vehicle speed " + car_speed + " %";
                    vspeed_p.style.color = "#A72845";
                }
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
