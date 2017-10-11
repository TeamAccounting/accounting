<?php
	include_once("modals/database_commands.php");	
?>
</body>

<script src="bootstrap/js/bootstrap.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/daterangepicker/moment.js"></script>
<script src="plugins/select2/select2.min.js"></script>		
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script language="javascript" type="text/javascript" src="plugins/flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="plugins/flot/jquery.flot.categories.js"></script>
<script language="javascript" type="text/javascript" src="plugins/flot/jquery.flot.orderBars.js"></script>
<!-- <<<<<<< HEAD
 --><script src="js/accounting.js"></script>	
<!-- ======= -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="plugins/datatables/media/js/jszip.min.js"></script>
<script type="text/javascript" src="plugins/datatables/media/js/pdfmake.min.js"></script>
<script type="text/javascript" src="plugins/datatables/media/js/vfs_fonts.js"></script>
<script type="text/javascript" src="plugins/datatables/media/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="plugins/datatables/media/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="plugins/datatables/media/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="plugins/datatables/media/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="plugins/datatables/media/js/buttons.print.min.js"></script>

	
<!-- >>>>>>> origin/master -->

<script type="text/javascript">
$(function() {
    $('.date-picker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
});
</script>

</html>