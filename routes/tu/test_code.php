<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <span>Select 24 hour time format</span>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <br/>
                <!-- <span>Select time with Date</span>
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <br/>
                <span>Select 12 hour time format</span>
                <div class='input-group date' id='datetimepicker3'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div> -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#datetimepicker1').datetimepicker({
            format: 'HH:mm'
        });

        $('#datetimepicker2').datetimepicker({
            format: 'MM/DD/YYYY HH:mm'
        });
        $('#datetimepicker3').datetimepicker({
            format: 'hh:mm A',
        });
    });
</script>
