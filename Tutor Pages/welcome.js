// Function to load notes from local storag

function showAddReminderForm() {
    document.getElementById('addReminderForm').style.display = 'block';
}

function hideAddReminderForm() {
    document.getElementById('addReminderForm').style.display = 'none';
}


function addReminder() {
    const description = document.getElementById('reminderDescription').value;
    if (description.trim() === '') {
        alert('Please enter a reminder.');
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'reminders.php?action=add', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status === 200) {
            hideAddReminderForm();
            window.location.href = "./Tutor Pages/welcome.php";
        }
    };
    xhr.send('description=' + encodeURIComponent(description));
}

function deleteReminder(noteId) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'reminders.php?action=delete', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status === 200) {
            window.location.href = "./Tutor Pages/welcome.php";
        }
    };
    xhr.send('noteId=' + noteId);
}


document.addEventListener('DOMContentLoaded', loadEvents);

function loadEvents() {
    // Load events from localStorage
    const events = JSON.parse(localStorage.getItem('events')) || [];
    
    // Create boxes for each valid event
    const contentsDiv = document.getElementById('edu-contents');
    events.forEach(event => {
        if (event.time && event.name && event.address) {
            const newBox = createBox(event.time, event.name, event.address);
            contentsDiv.appendChild(newBox);
        }
    });

    // Add event listener for delete buttons
    const deleteButtons = document.querySelectorAll('.box button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', deleteBox);
    });
}


// Load events when the document is ready
document.addEventListener('DOMContentLoaded', loadEvents);
