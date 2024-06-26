window.onload = function() {

    // function promptForLocationPermission() {
    //     // Check if geolocation is supported by the browser
    //     if (navigator.geolocation) {
    //         // Prompt user for permission
    //         navigator.permissions.query({ name: 'geolocation' }).then(permissionStatus => {
    //             // If permission is not granted and prompt is not denied, keep prompting
    //             if (permissionStatus.state !== 'granted' && permissionStatus.state !== 'denied') {
    //                 navigator.geolocation.getCurrentPosition(() => {}, () => {}, {}); // Empty success and error callbacks
    //                 setTimeout(promptForLocationPermission, 1000); // Prompt again after 1 second
    //             }
    //         });
    //     }
    // }

//new function
let permissionAttempts = 0;

// Function to prompt user for location permission
function promptForLocationPermission() {
    // Check if geolocation is supported by the browser
    if (navigator.geolocation) {
        // Increment the permissionAttempts counter
        permissionAttempts++;

        // Check if the maximum number of attempts has been reached (2 attempts)
        if (permissionAttempts <= 2) {
            // Prompt user for permission
            navigator.geolocation.getCurrentPosition(
                () => {
                    // Permission granted, do nothing
                },
                () => {
                    // Permission not granted or prompt dismissed, try again after a delay
                    setTimeout(promptForLocationPermission, 3000);
                }
            );
        }
    }
}

// Call the function to start prompting for location permission
promptForLocationPermission();




    // Retrieve userId from wherever it is available in your code
    var userId = document.getElementById("userId").value;
        var tagId = document.getElementById("tagId").value;
    var tag_category = document.getElementById("tagCategory").value;

    // Send request to /page-scanned route when the window is fully loaded
    fetch('/page-scanned', {
        method: 'post', // Adjust the method based on your server-side route
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Include CSRF token if needed
        },
        body: JSON.stringify({ userId: userId, tagId:tagId, tag_category:tag_category }), // Include userId in the request body
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
};


// Function to open the modal
function openModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
}

// Function to close the modal
function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

// Function to handle form submission
document.getElementById("Form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission behavior
    var name = document.getElementById("name").value;
    var phone = document.getElementById("phone").value;
    
    // Here you can add code to handle form submission, such as sending data to a server via AJAX
    
    // Close the modal after form submission
    closeModal();
});

// Contact form

document.getElementById("Form").addEventListener("submit", function(event) {
    
    event.preventDefault(); // Prevent default form submission behavior

    // Retrieve form field values
    var name = document.getElementById("name").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var message = document.getElementById("message").value;
    var tagId = document.getElementById("tagId").value;
    var userId = document.getElementById("userId").value;
    var tag_category = document.getElementById("tagCategory").value;

    // Log form field values to the console
    console.log("Name: " + name);
    console.log("Phone Number: " + phone);
    console.log("Email: " + email);
    console.log('Message: ' + message);
    console.log('Tagid: ' + tagId);

    fetch('/store-contact', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Include CSRF token
        },
        body: JSON.stringify({ name:name, email:email, phone_number:phone, message:message, tagId:tagId, userId:userId, tag_category:tag_category }), // Include lat and lng in the request body
    }).then(response => {
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
});

// Rest of your script goes here...

// Geolocation Script
// Geolocation Script
document.getElementById("locationButton").addEventListener("click", function() {
    let lat;
    let lng;
    var userId = document.getElementById("userId").value;
    var tagId = document.getElementById("tagId").value;
    var tag_category = document.getElementById("tagCategory").value;

    // Function to get location and execute the script
    function getLocationAndExecuteScript() {
        navigator.geolocation.getCurrentPosition(function(position) {
            showPosition(position);
        }, function(error) {
            showError(error);
        });
    }

    // Call the function to get location and execute the script
    getLocationAndExecuteScript();

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
        switch (error.code) {
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
            body: JSON.stringify({ address: address, lat: lat, lng: lng, userId: userId, tagId: tagId, tag_category: tag_category }), // Include lat and lng in the request body
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
    
});

function getLocation() {
    // Function to get location and execute the script
    function getLocationAndExecuteScript() {
        navigator.geolocation.getCurrentPosition(function(position) {

            changeButtonText("Allowed");
            showPosition(position);
        }, function(error) {
            showError(error);
        });
    }

    // Call the function to get location and execute the script
    getLocationAndExecuteScript();
}

// Geolocation Script
document.getElementById("locationButton").addEventListener("click", function() {
    getLocation(); // Call the getLocation function when the button is clicked
});

function changeButtonText(text) {
    var paragraph = document.getElementById("location-text");
    paragraph.textContent = text;
}


// NEW script

// function getLocation() {
//     navigator.geolocation.getCurrentPosition(function(position) {
//         changeButtonText("Allowed");
//         showPosition(position);
//     }, function(error) {
//         showError(error);
//     });
// }

// window.onload = function() {
//     // Function to prompt user for location permission
//     let permissionAttempts = 0;

//     function promptForLocationPermission() {
//         if (navigator.geolocation) {
//             permissionAttempts++;
//             if (permissionAttempts <= 2) {
//                 navigator.geolocation.getCurrentPosition(
//                     () => {},
//                     () => {
//                         setTimeout(promptForLocationPermission, 3000);
//                     }
//                 );
//             }
//         }
//     }

//     // Call the function to start prompting for location permission
//     promptForLocationPermission();

//     // Retrieve userId from wherever it is available in your code
//     var userId = document.getElementById("userId").value;
//     var tagId = document.getElementById("tagId").value;
//     var tag_category = document.getElementById("tagCategory").value;

//     // Send request to /page-scanned route when the window is fully loaded
//     fetch('/page-scanned', {
//         method: 'post',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//         },
//         body: JSON.stringify({ userId: userId, tagId: tagId, tag_category: tag_category }),
//     })
//     .then(response => {
//         if (!response.ok) {
//             throw new Error('Network response was not ok');
//         }
//         return response.json();
//     })
//     .then(data => {
//         console.log(data);
//     })
//     .catch(error => {
//         console.error('There was a problem with the fetch operation:', error);
//     });

//     // Function to handle form submission
//     document.getElementById("Form").addEventListener("submit", function(event) {
//         event.preventDefault(); // Prevent default form submission behavior
//         var name = document.getElementById("name").value;
//         var phone = document.getElementById("phone").value;

//         closeModal();
//     });

//     // Contact form
//     document.getElementById("Form").addEventListener("submit", function(event) {
//         event.preventDefault(); // Prevent default form submission behavior

//         var name = document.getElementById("name").value;
//         var phone = document.getElementById("phone").value;
//         var email = document.getElementById("email").value;
//         var message = document.getElementById("message").value;
//         var tagId = document.getElementById("tagId").value;
//         var userId = document.getElementById("userId").value;
//         var tag_category = document.getElementById("tagCategory").value;

//         fetch('/store-contact', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//             },
//             body: JSON.stringify({ name:name, email:email, phone_number:phone, message:message, tagId:tagId, userId:userId, tag_category:tag_category }),
//         }).then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(data => {
//             console.log(data);
//         })
//         .catch(error => {
//             console.error('There was a problem with the fetch operation:', error);
//         });
//     });

//     // Geolocation Script
//     function getLocation() {
//         navigator.geolocation.getCurrentPosition(function(position) {
//             changeButtonText("Allowed");
//             showPosition(position);
//         }, function(error) {
//             showError(error);
//         });
//     }

//     // Function to get location and execute the script
//     document.getElementById("locationButton").addEventListener("click", getLocation);
//     document.getElementById("locationButton").addEventListener("touchstart", getLocation);

//     function showPosition(position) {
//         var lat = position.coords.latitude;
//         var lng = position.coords.longitude;
//         getLocationByCoordinates(lat, lng);
//     }

//     function getLocationByCoordinates(lat, lng) {
//         const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`;

//         fetch(url)
//             .then(response => {
//                 if (!response.ok) {
//                     throw new Error('Network response was not ok');
//                 }
//                 return response.json();
//             })
//             .then(data => {
//                 console.log("Address: " + data.display_name);
//                 console.log("Latitude: " + data.lat);
//                 console.log("Longitude: " + data.lon);
//                 console.log("Address details:", data.address);

//                 sendAddressToController(data.display_name, lat, lng);
//             })
//             .catch(error => {
//                 console.error('There was a problem with the fetch operation:', error);
//             });
//     }

//     function showError(error) {
//         switch (error.code) {
//             case error.PERMISSION_DENIED:
//                 console.log("User denied the request for Geolocation.");
//                 break;
//             case error.POSITION_UNAVAILABLE:
//                 console.log("Location information is unavailable.");
//                 break;
//             case error.TIMEOUT:
//                 console.log("The request to get user location timed out.");
//                 break;
//             case error.UNKNOWN_ERROR:
//                 console.log("An unknown error occurred.");
//                 break;
//         }
//     }

//     function sendAddressToController(address, lat, lng) {
//         fetch('/tagLocation', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//             },
//             body: JSON.stringify({ address: address, lat: lat, lng: lng, userId: userId, tagId: tagId, tag_category: tag_category }),
//         })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(data => {
//             console.log(data);
//         })
//         .catch(error => {
//             console.error('There was a problem with the fetch operation:', error);
//         });
//         console.log('Request sent');
//     }

//     function changeButtonText(text) {
//         var paragraph = document.getElementById("location-text");
//         paragraph.textContent = text;
//     }
// };
