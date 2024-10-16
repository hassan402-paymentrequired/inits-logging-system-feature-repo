<button id="scrollUpBtn" class="btn btn-primary btn-scroll-up shadow" style="display: none;">
  <i class="bi bi-arrow-up"></i>
</button>

<style>

</style>

<script>
  // Get the button
  const scrollUpBtn = document.getElementById('scrollUpBtn');

  // Show or hide the button based on scroll position
  window.onscroll = function() {
      if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
          scrollUpBtn.style.display = 'block'; // Show the button
      } else {
          scrollUpBtn.style.display = 'none'; // Hide the button
      }
  };

  // Scroll to the top when the button is clicked
  scrollUpBtn.onclick = function() {
      window.scrollTo({
          top: 0,
          behavior: 'smooth' // Smooth scroll
      });
  };
</script>
