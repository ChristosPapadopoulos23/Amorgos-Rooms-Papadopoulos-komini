let currentPage = 1;
const batchSize = 6;
let SearchLocation = "all";
let SearchName = '';
let isFetching = false;
let hasMore = true; // Flag to indicate if more data is available

// Function to fetch a batch of data from the server
function fetchNextBatch() {
    if (isFetching || !hasMore) return;

    isFetching = true;
    SearchName = document.getElementById('fname').value;
    console.log(SearchName);
    SearchLocation = document.getElementById('area').value;
    console.log(SearchLocation);

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
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data);
            renderRoomBatch(data.rooms);
            // Update hasMore flag based on response
            hasMore = data.hasMore;
            currentPage++;
            isFetching = false;
        })
        .catch(error => {
            console.error('Fetch request failed:', error);
            isFetching = false;
        });

    console.log('Fetching next batch...');

}

// Function to render a batch of room elements based on fetched data
function renderRoomBatch(data) {
    const roomsContainer = document.getElementById('roomsContainer');

    data.forEach(room => {
        const roomElement = document.createElement('div');
        roomElement.classList.add('room');
        $link=room.url;
        if(room.url==null){
            $link=`Room_Page.php?name=${room.name}&id=${room.id}`;
        }
        if(room.image=='0'){
            roomElement.innerHTML = `
            <div class="room-info">
                <div class="room-name">${room.name}</div>
                <i class='bx bxs-map'></i>
                <div>&nbsp;&nbsp;${room.location}</div>
                <i class='bx bx-phone'></i>
                <div>: ${room.phone}</div>
                <i class='bx bx-mobile'></i>
                <div>: ${room.mobile}</div>
                <i class='bx bxs-envelope'></i>
                <div>: ${room.email}</div>
                <div class="ln"><a class="link" href="contact.php?value=${room.email}">Επικοινωνήστε απευθείας</a></div>
            </div>
            <a href="${$link}">
               <label class="morelbl">Περισσότερα εδώ</label>
            </a>
        `;
        }
        else{
            roomElement.innerHTML = `
                <div class="room-info">
                    <div class="room-name">${room.name}</div>
                    <i class='bx bxs-map'></i>
                    <div>&nbsp;&nbsp;${room.location}</div>
                    <i class='bx bx-phone'></i>
                    <div>: ${room.phone}</div>
                    <i class='bx bx-mobile'></i>
                    <div>: ${room.mobile}</div>
                    <i class='bx bxs-envelope'></i>
                    <div>: ${room.email}</div>
                    <div class="ln"><a class="link" href="contact.php?value=${room.email}">Επικοινωνήστε απευθείας</a></div>
                </div>
                <a href="${$link}">
                    <img class="room1-pic" src="${room.image}">
                </a>
            `;
        }
        roomsContainer.appendChild(roomElement);
    });
}

document.getElementById('fname').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        currentPage = 1;
        document.getElementById('roomsContainer').innerHTML = '';
        hasMore = true; // Reset the hasMore flag for new search
        fetchNextBatch();
    }
});

document.getElementById('area').addEventListener('change', function() {
    currentPage = 1;
    document.getElementById('roomsContainer').innerHTML = '';
    hasMore = true; // Reset the hasMore flag for new search
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
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {
            fetchNextBatch();
        }
    }, 200));
});

fetchNextBatch();
