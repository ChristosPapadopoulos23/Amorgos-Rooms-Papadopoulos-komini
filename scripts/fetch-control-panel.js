const user_id = document.getElementById('userID').textContent;

function fetchUsersRooms() {
    const url = `./server/fetch-panel.php?user_id=${user_id}`;

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            renderRoomBatch(data.rooms);
        })
        .catch(error => {
            console.error('Fetch request failed:', error);
        });

    console.log('Fetching next batch...');
}

function renderRoomBatch(data) {
    const roomsContainer = document.getElementById('roomsContainer');
    roomsContainer.innerHTML = ''; // Clear the container before appending new elements

    data.forEach(room => {
        const roomElement = createRoomElement(room);
        roomsContainer.appendChild(roomElement);
    });
}

function createRoomElement(room) {
    const roomElement = document.createElement('div');
    roomElement.classList.add('room');
    roomElement.innerHTML = `
        <img src="media/church.jpg" alt="room1">
        <div class="room-info">
            <h3>${room.name}</h3>
            <p><b>Location:</b> ${room.location}</p>
            <p><b>Phone:</b> ${room.phone}</p>
            <p><b>Email:</b> ${room.email}</p>
            <p id="Description"><b>Description:</b><br>${room.description || 'TODO HELLO'}</p>
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
    return roomElement;
}

fetchUsersRooms();