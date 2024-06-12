
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        const title = form.querySelector('input[name="title"]');
        const author = form.querySelector('input[name="author"]');

        if (title.value.trim() === '' || author.value.trim() === '') {
            event.preventDefault();
            alert('Please fill out all fields.');
        }
    });
});
