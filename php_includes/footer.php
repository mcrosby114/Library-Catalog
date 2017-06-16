<footer <?php if ($thisPage == 'Log In' || $thisPage == 'Sign Up' || $thisPage == 'Success' || $thisPage == 'Add Project' || $thisPage == 'Add Task') { echo " class=\"absolutePos\" "; } ?>>
    <ul>
      <li>&copy;<?php date_default_timezone_set("America/Boise"); echo date("Y"); ?> Matthew Crosby &nbsp&nbsp</li>
      <li><a class="footLink" href="https://github.com/mcrosby114" target="_blank">Github</a></li> |
      <li><a class="footLink" href="https://www.linkedin.com/in/matthewcrosby" target="_blank">LinkedIn</a></li>
    </ul>
</footer>
</html>
