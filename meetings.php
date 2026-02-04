<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Location Tracker</title>

    <!-- Leaflet CSS -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
        }

        #status {
            margin-bottom: 10px;
            font-weight: bold;
            color: green;
        }

        table {
            width: 100%;
            max-width: 400px;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        table td {
            padding: 6px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        #coords {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        #map {
            width: 100%;
            height: 400px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div id="status">Fetching location…</div>

<form id="meetingForm" action="save_meeting.php" method="POST">

<h3>Interaction Type</h3>
<select name="meeting_type" id="meeting_type" required>
    <option value="">--Select--</option>
    <option value="one_on_one">One-on-One Meeting</option>
    <option value="group">Farmer Group Meeting</option>
</select>

<div id="oneOnOne" style="display:none;">
    <table>
        <tr>
            <td>Name of person met</td>
            <td><input type="text" name="person_name"></td>
        </tr>

        <tr>
            <td>Category</td>
            <td>
                <select name="category">
                    <option value="">--Select--</option>
                    <option>Farmer</option>
                    <option>Seller</option>
                    <option>Influencer</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Contact</td>
            <td><input type="text" name="phone"></td>
        </tr>

        <tr>
            <td>Business Potential</td>
            <td>
                <select name="business_potential">
                    <option value="">--Select--</option>
                    <option>5–10 kg</option>
                    <option>10–50 kg</option>
                    <option>50–100 kg</option>
                    <option>100–200 kg</option>
                    <option>200+ kg</option>
                </select>
            </td>
        </tr>
    </table>
</div>

<div id="groupMeeting" style="display:none;">
    <table>
        <tr>
            <td>Village / Location</td>
            <td><input type="text" name="village_name"></td>
        </tr>

        <tr>
            <td>No. of Attendees</td>
            <td><input type="number" name="attendees"></td>
        </tr>

        <tr>
            <td>Meeting Type</td>
            <td><input type="text" name="group_meeting_type"></td>
        </tr>
    </table>
</div>

<h3>GPS Location</h3>
<div id="coords">
    <input name="lat" id="lat" readonly placeholder="Latitude">
    <input name="lng" id="lng" readonly placeholder="Longitude">
</div>

<div id="map"></div>

<input type="submit" value="Submit">

</form>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
const meetingType = document.getElementById("meeting_type");
const oneOnOne = document.getElementById("oneOnOne");
const groupMeeting = document.getElementById("groupMeeting");

meetingType.addEventListener("change", () => {
    oneOnOne.style.display = "none";
    groupMeeting.style.display = "none";

    if (meetingType.value === "one_on_one") {
        oneOnOne.style.display = "block";
    } else if (meetingType.value === "group") {
        groupMeeting.style.display = "block";
    }
});

let map, marker;

if ("geolocation" in navigator) {
    navigator.geolocation.watchPosition(
        position => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;
            document.getElementById("status").textContent = "Location updated";

            if (!map) {
                map = L.map("map").setView([lat, lng], 16);
                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution: "© OpenStreetMap contributors"
                }).addTo(map);

                marker = L.marker([lat, lng]).addTo(map);
            } else {
                marker.setLatLng([lat, lng]);
                map.panTo([lat, lng]);
            }
        },
        error => {
            document.getElementById("status").textContent = error.message;
            document.getElementById("status").style.color = "red";
        },
        {
            enableHighAccuracy: true
        }
    );
} else {
    document.getElementById("status").textContent = "Geolocation not supported";
}
</script>

</body>
</html>
