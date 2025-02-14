document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-comment-btn');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const commentSection = document.getElementById(targetId);
            if (commentSection) {
                commentSection.classList.toggle('hidden');
            }
        });
    });
});