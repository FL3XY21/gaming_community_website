document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tabs button');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const targetId = tab.getAttribute('data-target');

            // Remove 'active' class from all tabs and contents
            tabs.forEach(btn => btn.classList.remove('active'));
            contents.forEach(content => content.classList.remove('active'));

            // Add 'active' class to the clicked tab and corresponding content
            tab.classList.add('active');
            document.getElementById(targetId).classList.add('active');
        });
    });

    // Optionally, activate the first tab by default
    if (tabs.length > 0) {
        tabs[0].click();
    }
});
