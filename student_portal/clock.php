<!DOCTYPE html>
<html>
<head>
  <title>Simple Clock</title>
  <style>
    #clock {
      width: 250px;
      height: 250px;
      border: 10px solid #000;
      border-radius: 50%;
      font-size: 48px;
      text-align: center;
      line-height: 200px;
      margin: 50px auto;
    }
  </style>
</head>
<body>
  <div id="clock"></div>

  <script>
    function updateClock() {
      var now = new Date();
      var hours = now.getHours();
      var minutes = now.getMinutes();
      var seconds = now.getSeconds();

      // Format the time
      var timeString = formatTime(hours) + ":" + formatTime(minutes) + ":" + formatTime(seconds);

      // Update the clock element
      document.getElementById("clock").innerHTML = timeString;

      // Schedule the next update in 1 second
      setTimeout(updateClock, 1000);
    }

    function formatTime(value) {
      // Add leading zero if the value is less than 10
      return value < 10 ? "0" + value : value;
    }

    // Start the clock
    updateClock();
  </script>
</body>
</html>
