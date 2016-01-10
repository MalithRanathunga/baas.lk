<script>
function myFunction() {
    document.getElementById("ratingForm").submit();
}
</script>



<form name="ratingForm" id="ratingForm" method="post" action="smscheck.php">
    <input id="input-2c" name="rating" class="rating" min="0" max="5" step="0.5" data-size="sm"
           data-symbol="&#xf005;" data-glyphicon="false" data-rating-class="rating-fa" onclick="myFunction()" onchange="document.getElementById('ratingForm').submit();" >
        
 </form>
   

   <script>
function myFunction() {
    document.getElementById("ratingForm").submit();
}
</script>

   
   <?php 
        if(isset($_POST['rating'])){
                echo $_POST['rating'];
        }
   ?>



<script>
    jQuery(document).ready(function () {
        $("#input-21f").rating({
            starCaptions: function(val) {
                if (val < 3) {
                    return val;
                } else {
                    return 'high';
                }
            },
            starCaptionClasses: function(val) {
                if (val < 3) {
                    return 'label label-danger';
                } else {
                    return 'label label-success';
                }
            },
            hoverOnClear: false
        });
        
        $('#rating-input').rating({
              min: 0,
              max: 5,
              step: 1,
              size: 'lg',
              showClear: false
           });
           
        $('#btn-rating-input').on('click', function() {
            $('#rating-input').rating('refresh', {
                showClear:true, 
                disabled:true
            });
        });
        
        
        $('.btn-danger').on('click', function() {
            $("#kartik").rating('destroy');
        });
        
        $('.btn-success').on('click', function() {
            $("#kartik").rating('create');
        });
        
        $('#rating-input').on('rating.change', function() {
            alert($('#rating-input').val());
        });
        
        
        $('.rb-rating').rating({'showCaption':true, 'stars':'3', 'min':'0', 'max':'3', 'step':'1', 'size':'xs', 'starCaptions': {0:'status:nix', 1:'status:wackelt', 2:'status:geht', 3:'status:laeuft'}});
    });
</script>

