const cacheName = "cache-v1";
const cacheAssets = [
  "icons/car_512.png",
  "index.html",
  "live.html",
  "auto.html",
  "car_status.html",
  "logs.html",
  "Login-Register.html",
  "headerfooterManager.js",
  "logo.png",
  "travel_15126156.png", 
  "script.js",
  "manifest.json",
];
self.addEventListener("install", (installed) => {   
    installed.waitUntil(
        caches.open(cacheName).then((cache) => {
            return cache.addAll(cacheAssets);
        }).catch((err) => {
            console.log("Error", err);
        })
    );
    console.log("installed",installed);
});

self.addEventListener("activate",(activated)=>{
    activated.waitUntil(
        caches.keys().then((keys)=>{
            return Promise.all(keys.filter((key)=> key !==cacheName).map((key)=> caches.delete(key)));
    }));
    console.log("activated",activated);
});

self.addEventListener("fetch", (fetched) => {
    fetched.respondWith(
        caches.match(fetched.request).then((response)=>{
            return response || fetch(fetched.request);
        }))
});


