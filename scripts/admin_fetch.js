let currentPage = 1;
const batchSize = 6;
let SearchLocation = "all";
let SearchName = 'all';
let State = 'all';
let isFetching = false;
let hasMore = true; // Flag to indicate if more data is available


function fetchNextBatch() {
    if (isFetching || !hasMore) return;

    isFetching = true;
    SearchName = document.getElementById('search').value;
    SearchLocation = document.getElementById('Location').value;
    State = document.getElementById('State').value;

    if (SearchName !== '' && currentPage > 1) {
        isFetching = false;
        return;
    }

    const url = `./server/admin.php?page=${currentPage}&batchSize=${batchSize}&location=${SearchLocation}&roomName=${SearchName}&state=${State}`;

    fetch(url)
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Response text:', text);
                    throw new Error('Network response was not ok');
                });
            }
            return response.json();
        })
        .then(data => {
            renderRoomBatch(data.rooms);
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

function renderRoomBatch(data) {
    const roomsContainer = document.getElementById('roomsContainer');

    data.forEach(room => {
        const roomElement = document.createElement('div');
        roomElement.classList.add('room');

        roomElement.innerHTML = `
            <img src="media/church.jpg" alt="room1">
            <div class="room-info">
                <h3>${room.name}</h3>
                <p><b>Location:</b> ${room.location}</p>
                <p><b>Phone:</b> ${room.phone}</p>
                <p><b>Email:</b> ${room.email}</p>
                <p id="Description"><b>Description:</b><br>TODO HELLO</p>
                <div class="btn">
                    <button class="approve">
                        <i class="fa-solid fa-check"></i>
                    </button>
                    <button class="edit">
                        <i class="fa-solid fa-edit"></i>
                    </button>
                    <button class="delete">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        `;

        roomsContainer.appendChild(roomElement);
    });
}

document.getElementById('search').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        currentPage = 1;
        document.getElementById('roomsContainer').innerHTML = '';
        hasMore = true; // Reset the hasMore flag for new search
        fetchNextBatch();
    }
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
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            fetchNextBatch();
        }
    }, 200));
});

fetchNextBatch();
