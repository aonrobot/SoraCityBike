        <?php require_once 'functions/noti.php';?>
        <script>
            $(document).ready(function() {
              $(".animsition").animsition().one('animsition.start',function(){
              }).one('animsition.end',function(){
                $(this).find('.animsition-child').addClass('zoom-in').css({
                  "opacity":1
                });
              })
            });
        </script>
        <!-- animsition js -->
        <script src="components/animsition/dist/js/jquery.animsition.min.js"></script>

	</div><!-- END wrap -->		
	
</body>

</html>