<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
    <div>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Id Name:</th>
      <th scope="col">Candidate Name</th>
      <?php if(htmlspecialchars($_SESSION["username"]) == 'admin') : ?>
            <th scope="col">Count</th>
        <?php else : ?>
            <th scope="col">Action</th>
        <?php endif; ?>
      
    </tr>
  </thead>
  <tbody id="data">
    
  </tbody>
</table>
    </div>

</body>
</html>

 
<script>
    var variablejs = "<?php echo htmlspecialchars($_SESSION['username']); ?>" ;
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "data.php", true);
    ajax.send();
 
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
 
            var html = "";
            for(var a = 0; a < data.length; a++) {
                var id = data[a].id;
                var username = data[a].username;
                var counter = data[a].counter;
 
                html += "<tr>";
                    html += "<td>" + id + "</td>";
                    html += "<td>" + username + "</td>";
                    if(variablejs == 'admin'){
                        html += "<td>" + counter + "</td>";
                    }else{
                        html += "<td> <button type='submit' class='btn btn-primary add vote"+id+"' onClick='vote("+id+")'>Vote</button></td>";
                    }
                html += "</tr>";
            }
            document.getElementById("data").innerHTML += html;
        }
    };

    function vote(id) {
        var http = new XMLHttpRequest();
        var url = 'vote.php';
        var params = 'id='+id;
        http.open('POST', url, true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
                alert(http.responseText);
            }
        }
        var btns = document.getElementsByClassName("add");
        for (var i = 0; i < btns.length; i++) {
            btns[i].disabled = true;
        }
        http.send(params);
    }

</script>