 <?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "attendance";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $semester = $_POST["semester"];
    $course_code = $_POST["course_code"];
    $from_date = $_POST["from_select_date"];
    $to_date = $_POST["to_select_date"];
    $deptName = $_POST["deptName"];


    $sql = "SELECT * FROM attendance_details WHERE date BETWEEN '$from_date' AND '$to_date' AND semester='$semester' AND dept_name='$deptName'";
    $result = $conn->query($sql);

    $sql2 = "SELECT COUNT(DISTINCT date) as date_count FROM attendance_details WHERE date BETWEEN '$from_date' AND '$to_date' AND semester='$semester' AND dept_name='$deptName'";
    $result2 = $conn->query($sql2);


    // Query to select distinct students
    $studentQuery = "SELECT DISTINCT student_roll, name FROM attendance_details WHERE date BETWEEN '$from_date' AND '$to_date' AND semester='$semester' AND dept_name='$deptName'";
    $studentResult = $conn->query($studentQuery);



    
  }

  require_once 'fetchData.php';

  $departments = fetchData("department");
  $courseCode = fetchData("courses");


  // Close the database connection
  // $conn->close();

  ?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Attendance Report</title>
   <link rel="stylesheet" href="styles.css">
   <link rel="stylesheet" href="styles2.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

 </head>

 <body>
   <div class="container">
     <div class="content">
       <div class="section-title">Attendance Report</div>
       <div class="form-section">
         <form action="index.php" method="post">
           <div class="form-row">
             <div class="form-field">
               <label for="studentIDInput">Dept Name:</label>
               <!-- <input type="text" id="deptName" required> -->
               <select class="form-control" id="deptName" name="deptName">
                 <option value="Software Engineering">Software Engineering</option>
                 <option value="Computer Science And Engineering">Computer Science And Engineering</option>
                 <option value="Information And Communication Engineering">Information And Communication Engineering</option>

               </select>
             </div>
           </div>
           <div class="form-row">
             <div class="form-field">
               <label for="ct3MarksInput">Semester:</label>
               <input type="number" name="semester" id="semester" required>
             </div>
           </div>
           <div class="form-row">
             <div class="form-field">
               <label for="ct3MarksInput">Course Code:</label>
               <!-- <input type="text" name="course_code"> -->
               <select class="form-control" id="course_code" name="course_code">
                 <?php foreach ($courseCode as $course_code) { ?>
                   <option value="<?php echo $course_code["course_code"]; ?>"><?php echo $course_code["course_code"] ?> <?php echo $course_code["course_name"]; ?></option>
                 <?php } ?>
               </select>
             </div>
           </div>
           <div class="form-row">
             <div class="form-field">
               <label for="date">Select From Date:</label>
               <input type="date" name="from_select_date">
             </div>
             <div class="form-field">
               <label for="date">Select To Date:</label>
               <input type="date" name="to_select_date">
             </div>
           </div>
           <input type="submit" value="Fetch Details" class="submit-button">
         </form>
       </div>

       <div class="form-buttons">
         <button class="submit-button" hidden>Fetch Details</button>
         <!-- <button class="cancel-button">Cancel</button> -->
       </div>
       <?php 
        if (isset($result2) && $result2->num_rows > 0) {
          while ($row2 = $result2->fetch_assoc()) {
          $date_count = $row2['date_count'];
          echo "Total distinct dates within the selected range: " . $date_count;
        }} else {
          echo "Error in executing SQL query: " . $conn->error;
        } ?>
       
       <div class="table-section">
         <table id="marksTable">
           <thead>
             <tr>
               <th>Student Name</th>
               <th>Student ID</th>
               <th>Totall Class Held</th>
               <th>Present</th>
               <th>Present Percentage</th>
               <th>Attendance Marks</th>
               <!-- <th>Semester</th>
               <th>Status</th>
               <th>Date</th> -->
             </tr>
           </thead>
           <tbody id="marksTableBody">
             <?php
             
              if (isset($studentResult) && $studentResult->num_rows > 0) {
                while ($studentRow = $studentResult->fetch_assoc()) {
                  $studentRoll = $studentRow["student_roll"];
                  $studentName = $studentRow["name"];

                  // Query to count all records for the student
                  $totalCountQuery = "SELECT COUNT(*) AS total_count FROM attendance_details WHERE date BETWEEN '$from_date' AND '$to_date' AND student_roll='$studentRoll'";
                  $totalCountResult = $conn->query($totalCountQuery);
                  $totalCountRow = $totalCountResult->fetch_assoc();
                  $totalCount = $totalCountRow["total_count"];

                  // Query to count 'present' records for the student
                  $presentCountQuery = "SELECT COUNT(*) AS present_count FROM attendance_details WHERE date BETWEEN '$from_date' AND '$to_date'AND student_roll='$studentRoll' AND status='present'";
                  $presentCountResult = $conn->query($presentCountQuery);
                  $presentCountRow = $presentCountResult->fetch_assoc();
                  $presentCount = $presentCountRow["present_count"];
                  $percentage = ($presentCount*100)/ $totalCount;
                  $percentage = number_format($percentage, 2);
                  $marks = ($percentage*5)/100;
                  
                  $roundMarks= round($marks);

                  // Display student information and counts
                  echo "<tr>";
                  echo "<td> $studentName</td>";
                  echo "<td> $studentRoll</td>";
                  echo "<td> $totalCount</td>";
                  echo "<td> $presentCount</td>";
                  echo "<td>$percentage</td>";
                  
                  echo "<td> $roundMarks</td>";

                  echo "</tr>";
                }
              } else {
                echo "No records found";
              }
              $conn->close();
              ?>
           </tbody>
         </table>
         <!-- <div class="download-button">
        <button onclick="downloadTable()">Download</button>
      </div> -->
       </div>
     </div>
   </div>

   <!-- <script src="script.js"></script> -->
 </body>

 </html>