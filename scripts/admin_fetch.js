let currentPage = 1;
const batchSize = 6;
let searchName = 'all';
let state = 'all';
let ord = 'DESC';
// let area = '0';
let isFetching = false;
let hasMore = true;

function fetchNextBatch() {
    if (isFetching || !hasMore) return;

    isFetching = true;
    ord = document.getElementById('order').value;
    searchName = document.getElementById('search').value;
    state = document.getElementById('state').value;
    // area = document.getElementById('area').value;
    
    if (searchName !== '' && currentPage > 1) {
        isFetching = false;
        return;
    }

    const url = `./server/admin.php?page=${currentPage}&batchSize=${batchSize}&userName=${searchName}&state=${state}&order=${ord}`;

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data); // Debugging line
            if (data && data.users) { // Check if data and data.users are defined
                createUserElement(data.users);
                hasMore = data.hasMore;
                currentPage++;
            } else {
                console.error('Invalid data structure:', data);
            }
            isFetching = false;
        })
        .catch(error => {
            console.error('Fetch request failed:', error);
            isFetching = false;
        });

    console.log('Fetching next batch...');
}

function createUserElement(data) {
    const roomsContainer = document.getElementById('roomsContainer');

    data.forEach(user => {
        const userElement = document.createElement('div');
        userElement.classList.add('room');

        let style = '';
        if (user.role == 'admin') {
            style = 'background-color:lightblue;';
        }

        console.log(user.role);
        
        userElement.innerHTML = `
            <div class="room-info">
                <h3>${user.name}</h3>
                <p><b>Phone:</b> ${user.phone}</p>
                <p><b>Email:</b> ${user.email}</p>
                <p><b>Created At:</b> ${user.created_at}</p>
                <div class="btn_container2">
                    <div class="btn">
                        <a href="./server/admin_options.php?id=${user.id}&action=0">
                        <button id="approve" class="approve">
                            <i class="fa-solid fa-check"></i>
                        </button></a>
                    </div>
                    <div class="btn">
                         <a href="./sign-up.php?id=${user.id}&action=1">
                         <button id="edit" class="edit">
                            <i class="fa-solid fa-edit"></i>
                        </button></a>
                    </div>
                    <div class="btn">
                        <a href="./server/admin_options.php?id=${user.id}&action=2">
                        <button id="delete" class="delete">
                            <i class="fa-solid fa-trash"></i>
                        </button></a>
                    </div>
                    <div class="btn">
                        <a href="./server/admin_options.php?id=${user.id}&action=3">
                        <button id="admin" class="block" style=${style}>
                            <i class="fa-solid fa-user"></i>
                        </button></a>
                    </div>

                </div>
            </div>
        `;

        roomsContainer.appendChild(userElement);
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

document.getElementById('state').addEventListener('change', function() {
    currentPage = 1;
    document.getElementById('roomsContainer').innerHTML = '';
    hasMore = true;
    fetchNextBatch();
});

document.getElementById('order').addEventListener('change', function() {
    currentPage = 1;
    document.getElementById('roomsContainer').innerHTML = '';
    hasMore = true;
    fetchNextBatch();
});

document.getElementById('area').addEventListener('change', function() {
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
