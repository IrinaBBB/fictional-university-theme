class OSMMap {
    constructor() {
        document.querySelectorAll(".osm-map").forEach(el => {
            this.new_map(el)
        })
    }

    new_map($el) {
        const markers = $el.querySelectorAll(".marker")

        const map = L.map($el).setView([0, 0], 13)

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "&copy; OpenStreetMap contributors"
        }).addTo(map)

        map.markers = []

        markers.forEach(marker => {
            this.add_marker(marker, map)
        })

        this.center_map(map)
    }

    add_marker($marker, map) {
        const lat = parseFloat($marker.getAttribute("data-lat"))
        const lng = parseFloat($marker.getAttribute("data-lng"))

        const marker = L.marker([lat, lng]).addTo(map)

        map.markers.push(marker)

        if ($marker.innerHTML.trim()) {
            marker.bindPopup($marker.innerHTML)
        }
    }

    center_map(map) {
        const markerGroup = L.featureGroup(map.markers)

        if (map.markers.length === 1) {
            map.setView(markerGroup.getBounds().getCenter(), 16)
        } else if (map.markers.length > 1) {
            map.fitBounds(markerGroup.getBounds())
        }
    }
}

export default OSMMap