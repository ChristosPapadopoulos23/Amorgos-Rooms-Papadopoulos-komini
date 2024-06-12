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
        <img src="${room.image}" alt="room1">
        <div class="room-info">
            <h3>${room.name}</h3>
            <p><b>Location:</b> ${room.location}</p>
            <p><b>Phone:</b> ${room.phone}</p>
            <p><b>Email:</b> ${room.email}</p>
            <p class="description" id="Description"><b>Description:</b><br>${room.description}</p>
            <div class="btn_container2">
                <div class="btn">
                    <button class="edit"><a href="./edit_business.php?id=${room.id}&action=1">
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
    return roomElement;
}

fetchUsersRooms();