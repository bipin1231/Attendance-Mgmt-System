// Function to toggle between light and dark mode
function toggleMode() {
    const body = document.body;
    const isDarkMode = body.classList.toggle('dark-theme');
    const mode = isDarkMode ? 'dark' : 'light';
    // Store the user's preference in a cookie
    document.cookie = `mode=${mode}; expires=Fri, 31 Dec 9999 23:59:59 GMT`;
}
// Check for the user's preference in cookies and set the initial mode
function setInitialMode() {
    const cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)mode\s*=\s*([^;]*).*$)|^.*$/, '$1');
    if (cookieValue === 'dark') {
        document.body.classList.add('dark-theme');
    }
}
// Add an event listener to the toggle button
const toggleButton = document.getElementById('mode-changer');
if (toggleButton) {
    toggleButton.addEventListener('click', toggleMode);
}
// Set the initial mode when the page loads
window.addEventListener('load', setInitialMode);