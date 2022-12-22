</div>
        </div>
                
        <script
          src="https://code.jquery.com/jquery-3.6.2.min.js"
          integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA="
          crossorigin="anonymous"></script>
          
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script>

        $("#menu-toggle").click(function(e) {
           e.preventDefault();
           $("#wrapper").toggleClass("toggled-2");
        });
        $("#menu-toggle-2").click(function(e) {
           e.preventDefault();
           $("#wrapper").toggleClass("toggled-2");
           $('#menu ul').hide();
        });

        function initMenu() {
           $('#menu ul').hide();
           $('#menu ul').children('.current').parent().show();
           //$('#menu ul:first').show();
           $('#menu li a').click(
              function() {
                 var checkElement = $(this).next();
                 if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                    return false;
                 }
                 if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                    $('#menu ul:visible').slideUp('normal');
                    checkElement.slideDown('normal');
                    return false;
                 }
              }
           );
        }
        $(document).ready(function() {
           initMenu();
        });
            
        </script>
        <script type="text/javascript">
            $("#close_toast_success" ).click(function() {
              $("#SuccessToast").toggleClass("show hide");
              
            });
             $("#close_toast_error" ).click(function() {
              $("#ErrorToast").toggleClass("show hide");
              
            });

         <?php if(session()->getTempdata('success')){ ?>
            var success_msg='<?php echo session()->getTempdata('success')?>';
            $("#SuccessToast").show().delay(3000).fadeOut();
            $("#success_div_toast").text(success_msg);
            $("#SuccessToast").toggleClass("show hide");
            
         <?php }else if(session()->getTempdata('error')){  ?>
            var error_msg='<?php echo session()->getTempdata('error')?>';
            $("#ErrorToast").show().delay(3000).fadeOut();
             
            $("#ErrorToast").toggleClass("show hide");
            $("#error_div_toast").text(error_msg);
            
         <?php } ?>

      </script>

  </body>
</html>