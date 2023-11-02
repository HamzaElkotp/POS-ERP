var dropzone = document.getElementById("myDropzone");
var fileInput = document.getElementById("inputGroupFile02");
var previewContainer = document.getElementById("previewContainer");
var previewContent = document.getElementById("previewContent");

dropzone.addEventListener("click", function () {
    fileInput.click();
});

dropzone.addEventListener("dragover", function (event) {
    event.preventDefault();
    event.stopPropagation();
    dropzone.classList.add("active");
});

dropzone.addEventListener("dragleave", function (event) {
    event.preventDefault();
    event.stopPropagation();
    dropzone.classList.remove("active");
});

dropzone.addEventListener("drop", function (event) {
    event.preventDefault();
    event.stopPropagation();
    dropzone.classList.remove("active");

    var files = event.dataTransfer.files;
    if (files.length > 0) {
        var file = files[0];
        if (validateFile(file)) {
            fileInput.files = files;
            showFileName(file.name);
            previewFile(file);
        } else {
            showMessage("Invalid file type. Please upload a PNG, JPG, PDF, or Word document.", false);
        }
    }
});

fileInput.addEventListener("change", function () {
    var file = this.files[0];
    if (validateFile(file)) {
        showFileName(file.name);
        previewFile(file);
    } else {
        showMessage("Invalid file type. Please upload a PNG, JPG, PDF, or Word document.", false);
    }
});

// Function to validate file type
function validateFile(file) {
    var allowedTypes = ["image/png", "image/jpeg", "image/jpg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document"];
    return allowedTypes.includes(file.type);
}

// Function to show the selected file name
function showFileName(filename) {
    var dropzoneText = dropzone.querySelector(".dropzone-text");
    dropzoneText.textContent = filename;
}

// Function to show success or error message
function showMessage(message, isSuccess) {
    var messageContainer = document.getElementById("messageContainer");
    messageContainer.textContent = message;
    messageContainer.classList.remove("success", "error");

    if (isSuccess) {
        messageContainer.classList.add("success");
    } else {
        messageContainer.classList.add("error");
    }

    messageContainer.style.display = "block";

    setTimeout(function () {
        messageContainer.style.display = "none";
    }, 3000);
}

// Function to preview the selected file
function previewFile(file) {
    previewContainer.classList.remove("d-none");
    previewContent.innerHTML = ""; 

    if (file.type.startsWith("image/")) {
        var img = document.createElement("img");
        img.classList.add("preview-image");
        img.src = URL.createObjectURL(file);
        previewContent.appendChild(img);
    } else if (file.type === "application/pdf") {
        var embed = document.createElement("embed");
        embed.classList.add("preview-pdf");
        embed.src = URL.createObjectURL(file);
        previewContent.appendChild(embed);
    } else if (file.type === "application/msword" || file.type === "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
        var iframe = document.createElement("iframe");
        iframe.classList.add("preview-word");
        iframe.src = URL.createObjectURL(file);
        previewContent.appendChild(iframe);
    }
}
//editor  
function initCKEditor(textareaId) {
    CKEDITOR.replace(textareaId, {
        height: 250,
        toolbar: [
            { name: 'styles', items: ['Styles', 'Format'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'insert', items: ['Image', 'Table'] },
            { name: 'tools', items: ['Maximize'] },
            { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
            { name: 'clipboard', items: ['Undo', 'Redo'] },
        ]
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Determine if the "editor" textarea exists on the page
    var editorTextarea = document.getElementById('editor');

    if (editorTextarea) {
        // Initialize CKEditor if the "editor" textarea exists
        initCKEditor('editor');

        // Listen for form submission
        document.querySelector('form').addEventListener('submit', function (event) {
            // Get the editor content
            var editorContent = CKEDITOR.instances['editor'].getData();

            // Set the content to the hidden input field just before submitting the form
            document.getElementById('content').value = editorContent;
        });
    }
});


// meta title validation
function validateMetaTitle() {
    const metaTitle = document.getElementById('meta_title');
    const feedback = document.getElementById('meta_title_feedback');
    const progress = document.getElementById('meta_title_progress');
    const count = document.getElementById('meta_title_count');

    const minLength = 40; // Minimum required length for meta title
    const maxLength = 60; // Maximum allowed length for meta title

    const length = metaTitle.value.length;
    const percentage = (length / maxLength) * 100;
    const remaining = maxLength - length;

    if (length === 0) {
        feedback.textContent = '';
        metaTitle.classList.remove('is-invalid');
        progress.style.display = 'none'; // Hide the progress bar
    } else {
        progress.style.display = 'block'; // Show the progress bar
        progress.style.width = percentage + '%';
        progress.style.height = '5px'; // Set the height of the progress bar
        progress.setAttribute('aria-valuenow', percentage);

        count.textContent = 'Character count: ' + length;

        if (length < minLength) {
            feedback.textContent = 'Minimum ' + minLength + ' characters required';
            feedback.classList.add('text-danger');
            feedback.classList.remove('text-warning');
            metaTitle.classList.add('is-invalid');
            progress.classList.remove('bg-success');
            progress.classList.remove('bg-warning');
            progress.classList.remove('bg-danger');
            progress.classList.add('bg-danger');
        } else if (length > maxLength) {
            feedback.textContent = 'Exceeded maximum length';
            feedback.classList.add('text-danger');
            feedback.classList.remove('text-warning');
            metaTitle.classList.add('is-invalid');
            progress.classList.remove('bg-success');
            progress.classList.remove('bg-warning');
            progress.classList.remove('bg-danger');
            progress.classList.add('bg-danger');
        } else if (length > maxLength * 0.9) {
            feedback.textContent = 'Approaching maximum length';
            feedback.classList.add('text-warning');
            feedback.classList.remove('text-danger');
            metaTitle.classList.remove('is-invalid');
            progress.classList.remove('bg-success');
            progress.classList.remove('bg-danger');
            progress.classList.add('bg-warning');
        } else {
            feedback.textContent = 'Valid';
            feedback.classList.remove('text-danger');
            feedback.classList.remove('text-warning');
            metaTitle.classList.remove('is-invalid');
            progress.classList.remove('bg-danger');
            progress.classList.remove('bg-warning');
            progress.classList.add('bg-success');
        }
    }
}

// meta description validation
document.addEventListener("DOMContentLoaded", function () {
    const metaDescription = document.getElementById('meta_description');
    const feedback = document.getElementById('meta_description_feedback');
    const progress = document.getElementById('meta_description_progress');
    const count = document.getElementById('meta_description_count');

    const minLength = 120; // Minimum required length for meta description
    const maxLength = 160; // Maximum allowed length for meta description

    metaDescription.addEventListener('input', function () {
        const length = metaDescription.value.length;
        const percentage = (length / maxLength) * 100;
        const remaining = maxLength - length;

        if (length === 0) {
            feedback.textContent = '';
            metaDescription.classList.remove('is-invalid');
            progress.style.display = 'none'; // Hide the progress bar
        } else {
            progress.style.display = 'block'; // Show the progress bar
            progress.style.width = percentage + '%';
            progress.style.height = '5px'; // Set the height of the progress bar
            progress.setAttribute('aria-valuenow', percentage);

            count.textContent = 'Character count: ' + length;

            if (length < minLength) {
                feedback.textContent = 'Minimum ' + minLength + ' characters Are Good For Meta Description';
                feedback.classList.add('text-danger');
                feedback.classList.remove('text-warning');
                metaDescription.classList.add('is-invalid');
                progress.classList.remove('bg-success');
                progress.classList.remove('bg-warning');
                progress.classList.remove('bg-danger');
                progress.classList.add('bg-danger');
            } else if (length > maxLength) {
                feedback.textContent = 'Exceeded maximum length';
                feedback.classList.add('text-danger');
                feedback.classList.remove('text-warning');
                metaDescription.classList.add('is-invalid');
                progress.classList.remove('bg-success');
                progress.classList.remove('bg-warning');
                progress.classList.remove('bg-danger');
                progress.classList.add('bg-danger');
            } else if (length > maxLength * 0.9) {
                feedback.textContent = 'Approaching maximum length';
                feedback.classList.add('text-warning');
                feedback.classList.remove('text-danger');
                metaDescription.classList.remove('is-invalid');
                progress.classList.remove('bg-success');
                progress.classList.remove('bg-danger');
                progress.classList.add('bg-warning');
            } else {
                feedback.textContent = 'Valid';
                feedback.classList.remove('text-danger');
                feedback.classList.remove('text-warning');
                metaDescription.classList.remove('is-invalid');
                progress.classList.remove('bg-danger');
                progress.classList.remove('bg-warning');
                progress.classList.add('bg-success');
            }
        }
    });
});

//meta keywords 
var tags = [];

function addTag() {
    var input = document.getElementById("tags_input");
    var tag = input.value.trim();

    if (tag !== "") {
        tags.push(tag);
        input.value = "";

        renderTags();
    }
}

function removeTag(index) {
    tags.splice(index, 1);
    renderTags();
}

function renderTags() {
    var container = document.getElementById("tag_container");
    container.innerHTML = "";

    tags.forEach(function (tag, index) {
        var tagElement = document.createElement("span");
        tagElement.classList.add("tag");
        tagElement.textContent = tag;

        var removeButton = document.createElement("button");
        removeButton.textContent = "x";
        removeButton.addEventListener("click", function () {
            removeTag(index);
        });

        tagElement.appendChild(removeButton);
        container.appendChild(tagElement);
    });

    // Update the hidden input field value
    var tagsInput = document.getElementById("tags");
    tagsInput.value = tags.join(",");
}
function renderTags() {
    var container = document.getElementById("tag_container");
    container.innerHTML = "";

    tags.forEach(function (tag, index) {
        var tagElement = document.createElement("span");
        tagElement.classList.add("tag");
        tagElement.textContent = tag;

        var removeButton = document.createElement("button");
        removeButton.textContent = "x";
        removeButton.addEventListener("click", function () {
            removeTag(index);
        });

        tagElement.appendChild(removeButton);
        container.appendChild(tagElement);
    });

    // Update the hidden input field value
    var tagsInput = document.getElementById("meta_keywords");
    tagsInput.value = tags.join(",");
}
// image preview
    function previewImage(event, previewId) {
        const reader = new FileReader();
        const preview = document.getElementById(previewId);
        const file = event.target.files[0];
        const image = preview.querySelector('img');

        reader.onloadend = function () {
            image.src = reader.result;
            image.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            image.src = '#';
            image.style.display = 'none';
        }
    }