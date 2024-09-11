document.addEventListener('DOMContentLoaded', () => {
    const adminLoginForm = document.getElementById('adminLoginForm');
    
    adminLoginForm.addEventListener('submit', (event) => {
        const username = document.getElementById('admin_username').value;
        const password = document.getElementById('admin_password').value;
        
        if (!username || !password) {
            alert('Please fill in all fields.');
            event.preventDefault(); // Prevent form submission
        }
    });
});
