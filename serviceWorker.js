const welp = "welp-v1"
const assets = [
  "/",
  "/index.php",
  "/public/css/mainStyle.css",
  "/public/js/indexPostList.js",
]

self.addEventListener("install", installEvent => {
  installEvent.waitUntil(
    caches.open(welp).then(cache => {
      cache.addAll(assets)
    })
  )
})

self.addEventListener("fetch", fetchEvent => {
    fetchEvent.respondWith(
      caches.match(fetchEvent.request).then(res => {
        return res || fetch(fetchEvent.request)
      })
    )
  })