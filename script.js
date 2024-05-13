document.addEventListener('DOMContentLoaded', function () {
    var downloadButton = document.getElementById('download-button');
    var modal = document.getElementById('boatModal');

    downloadButton.addEventListener('click', function () {
        modal.style.display = "block";
    });

    // Close the modal when the close button is clicked
    var closeButton = document.querySelector('.modal-header .close');
    closeButton.addEventListener('click', function () {
        modal.style.display = "none";
    });

    // Close the modal when the user clicks outside of it
    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });



    const modelViewer = document.querySelector('#boatModalViewer');
    modelViewer.cameraOrbit = 'auto auto 65%'; 

    // Check if the URL has the parameter 'download=true'
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('download') && urlParams.get('download') === 'true') {
        // Open the modal
        var modal = document.getElementById('boatModal');
        modal.style.display = "block";

        // Switch modal content
        document.getElementById('content_1').style.display = "none";
        document.getElementById('content_2').style.display = "block";

        // Create a Blob containing the PDF data
        fetch('https://sea-machines.com/wp-content/uploads/2024/05/SELKIESpecSheet.pdf')
            .then(response => response.blob())
            .then(blob => {
                // Create a temporary anchor element
                var a = document.createElement('a');
                a.style.display = 'none';
                document.body.appendChild(a);

                // Create a URL for the Blob
                var url = window.URL.createObjectURL(blob);

                // Set the download attribute and trigger the click event
                a.href = url;
                a.download = 'Brochure.pdf';
                a.click();

                // Cleanup
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
            })
            .catch(error => console.error('Error fetching PDF:', error));
    }
});


