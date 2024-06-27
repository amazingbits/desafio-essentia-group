const allowedCustomerImageFormats = ["jpg", "png"];

function handlePreviewerImage(fileInput) {
    if (fileInput.length > 0) {
        const file = fileInput[0];
        const fileFormat = getFileFormat(file.name);
        if (allowedCustomerImageFormats.includes(fileFormat)) {
            const preViewerImageDiv = document.querySelector(".pre-viewer-image");
            const image = document.createElement("img");
            image.src = URL.createObjectURL(file);
            preViewerImageDiv.innerHTML = "";
            preViewerImageDiv.appendChild(image);
            image.onload = function () {
                URL.revokeObjectURL(image.src);
            }
        }
    }
}

function getFileFormat(fileName) {
    const fileNameExp = fileName.split(".");
    return fileNameExp[fileNameExp.length - 1].toLowerCase();
}

async function handleCustomerForm(url, data) {
    const response = await fetch(url, {
        method: "POST",
        mode: "cors",
        body: data
    });
    return await response.json();
}

function displayCustomAlert(
    title,
    text,
    icon = "success",
) {
    swal.fire({
        title,
        icon,
        text,
    });
}

function displayCustomConfirm(
    title,
    text,
    callback,
    icon = "info",
) {
    swal.fire({
        title,
        text,
        icon,
        showCancelButton: true,
        cancelButtonColor: "#d33",
        cancelButtonText: "Não",
    }).then((e) => {
        if (e.isConfirmed) {
            callback();
        }
    });
}