<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacker Poulette</title>
</head>
<body>
<form action="/action_page.php">
  <label for="fname">First name:</label>
  <input type="text" id="fname" name="fname"><br><br>
  <label for="lname">Last name:</label>
  <input type="text" id="lname" name="lname"><br><br>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email"><br><br>
  <input type="radio" id="X" name="X" value="X">
  <label for="X">Other:</label><br>
  <input type="radio" id="Male" name="Male" value="Male">
  <label for="Male">Male</label><br>
  <input type="radio" id="Female" name="Female" value="Female">
  <label for="Female">Female</label><br><br>
  <label for="country">Choose a Country:</label>
  <select name="country" id=country">
  <option value="Italy">Italy</option>
  <option value="Belgium">Belgium</option>
  <option value="Spain">Spain</option>
  <option value="France">France</option>
  </select><br><br>
  <label for="subject">Choose a subject:</label>
  <select name="subject" id=subject">
  <option value="learning">Learning</option>
  <option value="gaming">Gaming</option>
  <option value="other">Other</option>
  </select><br><br>
  <label for="message">Enter a Message:</label>
  <input type="text" id="message" name="message"><br><br>
  <input type="submit" value="Submit">

  </form>
    
</body>
</html>