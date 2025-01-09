<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My CV Sender</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="my-4 text-center">Mass CV Sender</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-2"></div>
        <div class="col-12 col-sm-6 col-lg-4">
            <div class=" ">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" name="position" id="position" placeholder="Web Developer" autocomplete="off">
                <label for="emailList" class="form-label mt-3">List</label>
                <textarea class="form-control" id="emailList" rows="10" cols="30" placeholder="Enter each email on a new line"></textarea><br>
                <button class="btn btn-dark w-100 rounded-5" onclick="sendEmails()">Send My CV</button>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4">
            <label class="form-label">History</label>
            <div class="card" style="height: 400px;overflow:scroll;">
                <div class="card-body">
                    <div id="results"></div>
                </div>
            </div>
            <div class="mt-3 text-center">
                <i class="text-muted">github.com/jaycee0610 & Rootscratch.com</i>
            </div>
        </div>
    </div>
</div>
<script>
    function sendEmails() {
        const position = $('#position').val().trim();
        const emails = $('#emailList').val().split('\n').map(email => email.trim()).filter(email => email !== ''); // Split, trim, and filter valid emails
        const $resultsDiv = $('#results');


        // Check if position or emails are empty
        if (!position) {
            $resultsDiv.append('Position is required.<br>');
            return;
        }
        if (emails.length === 0) {
            $resultsDiv.append('No valid emails found.<br>');
            return;
        }

        emails.forEach(email => {
            $.ajax({
                url: 'send.php',
                method: 'GET',
                data: {
                    email: email,
                    position: position
                },
                success: function(data) {
                    $resultsDiv.append(`Email sent to ${email}<br>`); // Append success message
                },
                error: function(xhr, status, error) {
                    $resultsDiv.append(`Failed to send email to ${email}: ${xhr.statusText}<br>`); // Append error message
                }
            });
        });
    }
</script>


</body>

</html>