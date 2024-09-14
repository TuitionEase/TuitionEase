flatpickr('#eventDate', {
    dateFormat: "Y-m-d", // Format to match your database date format
    minDate: "today", // Prevent selecting past dates
});


function showEventForm() {
    document.getElementById('eventForm').style.display = 'block';
}

function hideEventForm() {
    document.getElementById('eventForm').style.display = 'none';
    location.reload();
}

function addEvent() {
    // Fetch values from form
    const eventDateTime = document.getElementById('eventDate').value;
    const name = document.getElementById('eventName').value;
    const address = document.getElementById('eventAddress').value;
    const [datePart, timePart] = eventDateTime.split('T');
    
    // Example of sending data to a PHP script via AJAX (assuming you have jQuery)
    $.ajax({
        url: 'add_event.php',
        method: 'POST',
        data: {
            date: datePart,
            time: timePart,
            name: name,
            address: address,
            datetime: eventDateTime
        },
        success: function(response) {
            console.log('Event added successfully');
            console.log(response); // This will help debug any issues with the response
            // Optionally update the UI with the new event
            const newEventHtml = `
                <div class="box">
                    <h5 class="time">${timePart}</h5>
                    <h5 class="name">${name}</h5>
                    <p class="address">${address}</p>
                    <button class="btn btn-primary text-center delete-btn">Delete</button>
                </div>
            `;
            document.getElementById('edu-contents1').insertAdjacentHTML('beforeend', newEventHtml);
            // Reset form and hide it
            document.getElementById('addEventForm').reset();
            hideEventForm();
        },
        error: function(xhr, status, error) {
            console.error('Error adding event:', error);
        }
    });
    hideEventForm();
}

function deleteEvent(scheduleID) {
    if (confirm("Are you sure you want to delete this event?")) {
        // AJAX request to update status
        alert('Reload to see the changes!');
        $.ajax({
            url: 'delete_event.php', // URL to this same PHP file
            method: 'POST',
            data: { deleteScheduleID: scheduleID },
            success: function(response) {
                console.log('Event deleted successfully');
                console.log(response); // Log response for debugging
                // Optionally, update UI here if needed
            },
            error: function(xhr, status, error) {
                console.error('Error deleting event:', error);
            }
        });
    }
}

