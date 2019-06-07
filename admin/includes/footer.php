<!-- Start Footer -->
<footer class="footer text-center text-white p-2">Created By <strong><a href="http://shaalan.epizy.com/M-Shaalan-v1" target="_blank">M.Shaalan</a></strong> 2018</footer>
<!-- End Footer -->
</body>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script type="text/javascript" src="js/dropzone.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Views',    			   <?php echo $session->count; ?>],
          ['Comments',        <?php echo Comment::count_all(); ?>],
          ['Users',  			   <?php echo User::count_all(); ?>],
          ['Photos',			   <?php echo Photo::count_all(); ?>],
        ]);

        var options = {
          legend: 'none',
          pieSliceText: 'label',
          title: 'My Daily Activities',
          backgroundColor: 'transparent',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</html>
