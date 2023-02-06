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
<script>
    // Global variables
    var client = null;
    // These are configs
    var hostname = "203.150.37.144"; //'103.2.115.15'; // 203.150.37.144   decccloud.com
    var port = "8083";
    var clientId = "mqtt_js_3074" + parseInt(Math.random() * 100000, 10);
    var count = 0;
    alert(clientId)
    function connect() {
        client = new Paho.MQTT.Client(hostname, Number(port), clientId);
        console.info('Connecting to Server: Hostname: ', hostname, '. Port: ', port, '. Client ID: ', clientId);

        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;

        var options = {
            onSuccess: onConnect, // after connected, subscribes
            onFailure: onFail // useful for logging / debugging
        };
        // connect the client
        client.connect(options);
        console.info('Connecting...');
    }
    // ---------------------------------------------------------------------------------------
    function onConnect(context) {
        console.log("Client Connected");
        // And subscribe to our topics	-- both with the same callback function
        options = {
            qos: 1,
            onSuccess: function (context) {
                // console.log("ไม่สามารถเชื่อมต่อกับ เครื่อง ได้ !!!!");
                // setInterval(function() {
                //     location.reload();
                // }, 30000);
                console.log("subscribed");
            }
        }
        // client.subscribe(house_master + "/control/config/manual", options);
        client.subscribe(house_master + "/control/set_config", options);
        if(eq == 0){
            client.subscribe(house_master + "/data_sensor/filter", options);
        }else {
            client.subscribe(house_master + "/data_sensor/filter_eq", options);
        }
        client.subscribe(house_master + "/control/response", options);
        // client.subscribe(house_master + "/control/config/auto", options);
        client.subscribe(house_master + "/monitor/_hardware/realtime", options);
        client.subscribe("web_system", options);
        client.subscribe(house_master + "/control/loads/spanel", options);
    }

    function onFail(context) {
        location.reload();
    }
    var timeoutId = 0;
    var timeoutId2 = 0;
    function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
            console.log("Connection Lost: " + responseObject.errorMessage);
            connect();
            // location.reload();
            // window.alert("Someone else took my websocket!\nRefresh to take it back.");
        }
    }
    function onMessageArrived(message) {
        if(message.destinationName == house_master + "/control/set_config") {
            var result = message.payloadString;
            var parseJSON = $.parseJSON(result);
        }
    }// exit_message
    connect();
</script>
