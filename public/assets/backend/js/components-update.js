

  // File Upload Handlers
  function handleFileSelect(event) {
    var file = event.target.files[0];
    if (validateFile(file)) {
      previewFile(file);
    } else {
      showMessage("Invalid file type. Please upload an image file.", false);
      clearFileInput();
    }
  }

  function handleDragOver(event) {
    event.preventDefault();
    event.stopPropagation();
    event.target.classList.add('dragover');
  }

  function handleDragLeave(event) {
    event.preventDefault();
    event.stopPropagation();
    event.target.classList.remove('dragover');
  }

  function handleDrop(event) {
    event.preventDefault();
    event.stopPropagation();
    event.target.classList.remove('dragover');

    var files = event.dataTransfer.files;
    if (files.length > 0) {
      var file = files[0];
      if (validateFile(file)) {
        previewFile(file);
      } else {
        showMessage("Invalid file type. Please upload an image file.", false);
      }
    }
  }

  function validateFile(file) {
    var allowedTypes = ["image/jpeg", "image/png", "image/gif"];
    return allowedTypes.includes(file.type);
  }

  function clearFileInput() {
    var fileInput = document.getElementById('updatefileInput');
    fileInput.value = null;
  }

  function previewFile(file) {
    var reader = new FileReader();
    reader.onload = function (e) {
      var previewContent = document.getElementById('previewContent');
      previewContent.innerHTML = ''; // Clear previous preview content
      var img = document.createElement('img');
      img.src = e.target.result;
      img.alt = 'Selected Image';
      img.classList.add('preview-image');
      previewContent.appendChild(img);
    };
    reader.readAsDataURL(file);
  }

  function showMessage(message, isSuccess) {
    var messageContainer = document.getElementById('messageContainer');
    messageContainer.textContent = message;
    messageContainer.classList.remove('success', 'error');

    if (isSuccess) {
      messageContainer.classList.add('success');
    } else {
      messageContainer.classList.add('error');
    }

    messageContainer.style.display = 'block';

    setTimeout(function () {
      messageContainer.style.display = 'none';
    }, 3000);
  }

  // Click Event Handler for File Input
  function handleClick() {
    var fileInput = document.getElementById('updatefileInput');
    fileInput.value = null; // Reset the file input value
    fileInput.click();
  }

  // Event Listeners
  var dropzone = document.getElementById('updatefile');
  var fileInput = document.getElementById('updatefileInput');

  dropzone.addEventListener('dragover', handleDragOver);
  dropzone.addEventListener('dragleave', handleDragLeave);
  dropzone.addEventListener('drop', handleDrop);
  fileInput.addEventListener('change', handleFileSelect);



//meta update keywords 
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
};
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