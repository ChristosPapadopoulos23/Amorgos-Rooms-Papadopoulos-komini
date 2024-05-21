let currentPage = 1;
const batchSize = 6;
let SearchLocation = "all";
let SearchName = '';


// Function to fetch a batch of data from the server
function fetchNextBatch() {

    console.log(SearchName);

    if (SearchName !== '' && currentPage > 1) {
        return;
    }

    const url = `./server/fetch-rooms.php?page=${currentPage}&batchSize=${batchSize}&location=${SearchLocation}&roomName=${SearchName}`;


    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse response as JSON
        })
        .then(data => {
            console.log(data);
            renderRoomBatch(data);

            // Increment the current page for the next batch
            currentPage++;
        })
        .catch(error => {
            console.error('Fetch request failed:', error);
        });

    console.log('Fetching next batch...');
}

// Function to render a batch of room elements based on fetched data
function renderRoomBatch(data) {
    const roomsContainer = document.getElementById('roomsContainer');

    data.forEach(room => {
        const roomElement = document.createElement('div');
        roomElement.classList.add('room');

        // Create and append room content (customize based on your data structure)
        roomElement.innerHTML = `
            
            <div class="room-info">
                <div class="room-name">${room.name}</div>
                <i class='bx bx-phone'></i>
                <div>${room.location}</div>
                <i class='bx bx-mobile'></i>
                <div>: ${room.phone}</div>
                <i class='bx bxs-envelope'></i>
                <div>: ${room.email}</div>
                <div><a class="link" href="contact.html">Επικοινωνήστε απευθείας</a></div>
            </div>
            <a href="Julia_Rooms.html">
                <div class="room1-pic"></div>
            </a>
        `;

        roomsContainer.appendChild(roomElement);
    });
}

// document.getElementById('search-btn').addEventListener('click', function() {
//     // Reset current page to 1 when search button is clicked
//     currentPage = 1;
//     // Clear existing room elements
//     document.getElementById('roomsContainer').innerHTML = '';
//     // Fetch the first batch of data for the new search query
//     fetchNextBatch();
// });

// document.getElementById('Location').addEventListener('change', function() {
//     // Reset current page to 1 when location selection changes
//     currentPage = 1;
//     // Clear existing room elements
//     document.getElementById('roomsContainer').innerHTML = '';
//     // Fetch the first batch of data for the new location
//     fetchNextBatch();
// });

fetchNextBatch();

document.getElementById('fetchNextBatchButton').addEventListener('click', function() {
    fetchNextBatch();
});

$(document).ready(function() {
    $(window).scroll(function() {
        // Check if user has scrolled to the bottom of the page
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
            // Send AJAX request to trigger function in Java backend
            console.log('SEED DATA');
            fetchNextBatch();
        }
    });
});