function toggleReplyForm(id) {
    const allReplyForms = document.getElementsByClassName("reply-form");
    for (let index = 0; index < allReplyForms.length; index++) {
        const element = allReplyForms[index];
        element.classList.add("hidden");
    }

    const currentReplyForm = document.getElementById("reply-form-" + id);
    currentReplyForm.classList.toggle("hidden");
    currentReplyForm.scrollIntoView({behavior: 'smooth'});
}