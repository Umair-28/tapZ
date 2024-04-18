window.onload = function() {
    let lat;
    let lng;
    var userId = document.getElementById("userId").value;
    var tagId = document.getElementById("tagId").value;
    var tag_category = document.getElementById("tagCategory").value;

    function getLocation() {
        if (navigator.geolocation) {
            navigator.permissions.query({ name: 'geolocation' }).then(permissionStatus => {
                if (permissionStatus.state === 'granted') {
                    // If permission is granted, get current position
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else if (permissionStatus.state === 'prompt') {
                    // If permission is not granted but not denied, prompt user for permission
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                } else {
                    // If permission is denied or unavailable, handle accordingly
                    console.log("Geolocation permission denied or unavailable.");
                }
            });
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        lat = position.coords.latitude;
        lng = position.coords.longitude;
        console.log("Latitude: " + lat);
        console.log("Longitude: " + lng);
        getLocationByCoordinates(lat, lng); // Pass latitude and longitude to getLocationByCoordinates
    }

    function getLocationByCoordinates(lat, lng) {
        // Construct the URL with the latitude and longitude values
        const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`;

        // Make a GET request to the API endpoint
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Handle the response data
                console.log("Address: " + data.display_name); // Log the display name
                console.log("Latitude: " + data.lat); // Log the latitude
                console.log("Longitude: " + data.lon); // Log the longitude
                console.log("Address details:", data.address); // Log the address details

                // Send the address to the controller method
                sendAddressToController(data.display_name, lat, lng); // Pass lat and lng to sendAddressToController
            })
            .catch(error => {
                // Handle errors
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                console.log("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                console.log("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                console.log("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                console.log("An unknown error occurred.");
                break;
        }
    }

    function sendAddressToController(address, lat, lng) {
        // Make an AJAX request to your server-side endpoint
        fetch('/tagLocation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Include CSRF token
            },
            body: JSON.stringify({ address: address, lat: lat, lng: lng, userId: userId, tagId: tagId, tag_category:tag_category }), // Include lat and lng in the request body
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Handle the response from the server if needed
            console.log(data);
        })
        .catch(error => {
            // Handle errors
            console.error('There was a problem with the fetch operation:', error);
        });
        console.log('Request sent');
    }

    // Call getLocation function to start geolocation process
    getLocation();
};
