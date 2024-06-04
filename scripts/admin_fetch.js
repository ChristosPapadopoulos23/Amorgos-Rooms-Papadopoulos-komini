let currentPage = 1;
const batchSize = 6;
let searchLocation = "all";
let searchName = 'all';
let state = 'all';
let isFetching = false;
let hasMore = true;

function fetchNextBatch() {
    if (isFetching || !hasMore) return;

    isFetching = true;
    searchName = document.getElementById('search').value;
    searchLocation = document.getElementById('area').value;
    state = document.getElementById('state').value;
    
    if (searchName !== '' && currentPage > 1) {
        isFetching = false;
        return;
    }

    const url = `./server/admin.php?page=${currentPage}&batchSize=${batchSize}&location=${searchLocation}&roomName=${searchName}&state=${state}`;

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            createRoomElement(data.rooms); // Use createRoomElement instead of renderRoomBatch
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

function createRoomElement(data) {
    const roomsContainer = document.getElementById('roomsContainer');

    data.forEach(room => {
        const roomElement = document.createElement('div');
        roomElement.classList.add('room');
        let link = room.url ? room.url : `Room_Page.php?name=${room.name}&id=${room.id}`;
        
        roomElement.innerHTML = `
            <img src="${room.image}" alt="room1">
            <div class="room-info">
                <h3>${room.name}</h3>
                <p><b>Location:</b> ${room.location}</p>
                <p><b>Phone:</b> ${room.phone}</p>
                <p><b>Email:</b> ${room.email}</p>
                <p id="Description"><b>Description:</b><br>${room.description}</p>
                <div class="btn_container2">
                    <div class="btn">
                        <button class="approve">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>
                    <div class="btn">
                        <button class="edit">
                            <i class="fa-solid fa-edit"></i>
                        </button>
                    </div>
                    <div class="btn">
                        <button class="delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;

        roomsContainer.appendChild(roomElement);
    });
}

document.getElementById('search').addEventListener('keydown', function(event) {
    if (event.key === 'Enter' || event.keyCode === 13) {
        currentPage = 1;
        document.getElementById('roomsContainer').innerHTML = '';
        hasMore = true;
        fetchNextBatch();
    }
});

document.getElementById('area').addEventListener('change', function() {
    currentPage = 1;
    document.getElementById('roomsContainer').innerHTML = '';
    hasMore = true;
    fetchNextBatch();
});

document.getElementById('state').addEventListener('change', function() {
    currentPage = 1;
    document.getElementById('roomsContainer').innerHTML = '';
    hasMore = true;
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
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            fetchNextBatch();
        }
    }, 200));
});

fetchNextBatch();
