    <!-- Jquery 3.5.1 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Jquery UI 1.12.1 -->
    <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script src="../bower_components/jquery-migrate/jquery-migrate.min.js"></script>

    <!-- Datatables -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap4.min.js"></script>


    <script type="text/javascript"> 
        $(document).on('click', '.close', function(){
            $('.alert').hide();
        })
        
        $(document).on('click', '.donation', function() {
            // e.preventDefault();
            $('#donate').modal('show');
        })
    </script>

    <!-- Data Table Initialize -->
    <script>
      $(function () {
        $('#dtUser').DataTable({
          "searching": false,
            "paging": true,
            "info": false
        })
      })
    </script>
    

