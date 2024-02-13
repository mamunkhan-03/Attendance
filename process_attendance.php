<?php
// Check if the "submitAttendance" button is clicked
if (isset($_POST["submitAttendance"])) {
  // Get the date for the attendance record (you can customize this as needed)
  $date = date("Y-m-d"); // Assuming a date format like YYYY-MM-DD

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "attendance";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $serials = $_POST["serial"];
  $studentIds = $_POST["roll_number"];
  $names = $_POST["name"];
  $deptNames = $_POST["dept_name"];
  $semesters = $_POST["semester"];
  $sessions = $_POST["session"];
  $course_codes = $_POST["course_code"];
  $currDate = $_POST["date"];
  $attendanceStatuses = $_POST['attendance_hidden'];


  for ($i = 0; $i < count($studentIds); $i++) {
    // Sanitize the input data to prevent SQL injection (you can use prepared statements for better security)
    $studentId = $conn->real_escape_string($studentIds[$i]);
    $serial = $conn->real_escape_string($serials[$i]);
    $name = $conn->real_escape_string($names[$i]);
    $deptName = $conn->real_escape_string($deptNames[$i]);
    $course_code = $conn->real_escape_string($course_codes[$i]);
    $semester = $conn->real_escape_string($semesters[$i]);
    $session = $conn->real_escape_string($sessions[$i]);
    $dateUpdate = $conn->real_escape_string($currDate[$i]);
    $attendanceStatus = $conn->real_escape_string($attendanceStatuses[$studentId]); // Corrected this line

    // Insert a new record into the attendance database with all the details
    $queries[] = "INSERT INTO attendance_details (serial,student_roll, name, course_code, dept_name, session, semester,status,date) 
              VALUES ('$serial', '$studentId', '$name', '$course_code', '$deptName', '$session', '$semester','$attendanceStatus','$dateUpdate')";

  }
  foreach($queries as $query){
    if ($conn->query($query) !== TRUE) {
      echo "Error: " . $query . "<br>" . $conn->error;
    } else {
      echo "Attendance Are Submitted";
    }
  }
  
  $conn->close();


  // Close the attendance database connection
  // $conn->close();
} ?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Document</title>
</head>

<body>
  <div class="popup" id="popup">
    <div class="popup-content">
      <span class="close" id="close">&times;</span>
      <h2>Attendance Updated Successfully</h2>
      <p>Your Attendance data has been inserted into the database.</p>
    </div>
  </div>
  <script>
    var popup = document.getElementById("popup");
    var close = document.getElementById("close");

    function showPopup() {
      popup.classList.add("show");
    }

    close.addEventListener("click", function() {
      popup.classList.remove("show");
    });

   
  </script>

  <!-- <script src="script.js"></script> -->

</body>

</html>