<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DATA RETRIEVAL</title>
    <style media="screen">
    body{background-color: #FFFDD0;font-family: Arial, sans-serif;}
    h1{text-align: center;color:black;background-color: PINK;opacity: 0.9;padding: 20px;}
    form{font-size: 20px;}
    input{width:250px;margin-left:30px;height:20px;}
    input:focus{border: none;resize: none;outline: none;border:3px solid DodgerBlue;}
    button{box-shadow: 0 1px 6px rgba(0, 0, 0, 0.12), 0 1px 4px rgba(0, 0, 0, 0.24);font-size: 18px;
      border: none;background-color: transparent;resize: none;outline: none;background-color: DodgerBlue;width:160px;height:40px;color:white;opacity: 0.8;
     clear:right;
    }
    button:hover{opacity:1}
    button:focus{color:black;}
    table{font-size: 20px;}
    td{padding-right: 20px;}
    #avg_val{font-size: 20px;color:red;}
    img{width:60px;height:60px;float: left;position: absolute;top:30px;}
    </style>
  </head>
  <body>
    <h1>STUDENT DATA RETRIEVAL</h1>
    <a href="homepage.html"><img src="home-button.svg" alt="home button"></a>
    <form action="data_entry.php" method="post">
      Registration Number: <input type="text" name="reg"><br><br>
      <button type="submit" formaction="data_retrieval.php">Display Details</button>
      <button type="submit" formaction="data_entry.php">Update Info</button>
    </form>
   <br><br>
   <table border="1" bgcolor="gold">
     <tr id="rgn"></tr>
     <tr id="nme"></tr>
     <tr id="m1"></tr>
     <tr id="m2"></tr>
     <tr id="m3"></tr>

   </table>
   <br>
  <p style="cursor:pointer;"onclick="avg()" id="button"></p>
  <p id="avg_val"></p>
    <?php
     if($_SERVER['REQUEST_METHOD']=='POST')
     {
       $data= $_POST['reg'];
       $servername = "localhost";
       $username = "root";
       $password = "1234";
       $database="student_data";
       $conn = new mysqli($servername, $username, $password,$database,3308);
       $sql= "select * from Student_info where Reg_no='$data'";
       $result=mysqli_query($conn, $sql);
       $row = $result->fetch_assoc();
       if(!$row)
       {
         echo "No such data found.";
       }
       global $regno,$name,$marks1,$marks2,$marks3;
       $regno= $row['Reg_no'];
       $name= $row['Name'];
       $marks1= $row['Marks1'];
       $marks2= $row['Marks2'];
       $marks3= $row['Marks3'];
      }
     ?>

     <script type="text/javascript">
     <?php
     echo "var reg ='$regno';";
     echo "var name ='$name';";
     echo "var marks1 ='$marks1';";
     echo "var marks2 ='$marks2';";
     echo "var marks3 ='$marks3';";
 ?>
 if(name)
 {
   document.getElementById("rgn").innerHTML="<td><b>Registration Number</b></td><td>"+reg+"</td>";
   document.getElementById("nme").innerHTML="<td><b>Name</b></td><td>"+name+"</td>";
   document.getElementById("m1").innerHTML="<td><b>Computer Networks Marks</b></td><td>"+marks1+"</td>";
   document.getElementById("m2").innerHTML="<td><b>Operating System Marks</b></td><td>"+marks2+"</td>";
   document.getElementById("m3").innerHTML="<td><b>Software Engineering Marks</b></td><td>"+marks3+"</td>";
   document.getElementById("button").innerHTML="<button>Caulate Average</button>";
}
function avg()
{
  document.getElementById("avg_val").innerHTML="<b>Average Marks</b>: "+(parseInt(marks1)+parseInt(marks2)+parseInt(marks3))/3;
}
     </script>
  </body>
</html>
