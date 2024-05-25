let currentPage = 1;
const batchSize = 6;
let SearchLocation = "all";
let SearchName = '';
let isFetching = false; // To avoid duplicate requests

// Function to fetch a batch of data from the server
function fetchNextBatch() {
    if (isFetching) return; // Avoid duplicate requests

    isFetching = true;
    SearchName = document.getElementById('fname').value;

    if (SearchName !== '' && currentPage > 1) {
        isFetching = false;
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
            renderRoomBatch(data);

            // Increment the current page for the next batch
            currentPage++;
            isFetching = false; // Reset fetching flag
        })
        .catch(error => {
            console.error('Fetch request failed:', error);
            isFetching = false; // Reset fetching flag on error
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
                <img class="room1-pic" src="./media/room1.jpg">
            </a>
        `;

        roomsContainer.appendChild(roomElement);
    });
}

document.getElementById('search-btn').addEventListener('click', function() {
    // Reset current page to 1 when search button is clicked
    currentPage = 1;
    // Clear existing room elements
    document.getElementById('roomsContainer').innerHTML = '';
    // Fetch the first batch of data for the new search query
    fetchNextBatch();
});

$(document).ready(function() {
    const debounce = (func, wait) => {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    };

    $(window).scroll(debounce(function() {
        // Check if user has scrolled to the bottom of the page
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            fetchNextBatch();
        }
    }, 200));
});

// Initial fetch when page loads
fetchNextBatch();
