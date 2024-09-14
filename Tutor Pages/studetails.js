document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.stubtn').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            
            if (confirm('Are you sure you want to remove this student?')) {
                const studentid = this.getAttribute('data-studentid');
                const card = document.getElementById('card-' + studentid);

                // Make an AJAX request to delete the student record
                fetch('', { // The same file handles the request
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({ studentid: studentid })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the card from the UI
                        card.remove();
                    } else {
                        alert('Failed to remove student: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while removing the student.');
                });
            }
        });
    });

////add new student
// Event listener for Add Student button
const addStudentForm = document.getElementById('addStudentForm');
if (addStudentForm) {
    addStudentForm.addEventListener('submit', function (event) {
        event.preventDefault();

        // Collect form data
        const formData = new FormData(addStudentForm);

        // Make an AJAX request to add the new student
        fetch('addstudent.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Optionally update the UI or display a success message
                alert('Student added successfully.');
                addStudentForm.reset(); // Reset the form after successful submission
            } else {
                alert('Failed to add student: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while adding the student.');
        });
    });
}
});