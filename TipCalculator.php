
<!DOCTYPE html>
<html lang="en" ng-app="Tippy" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />

    <title>Tip Calculator</title>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

    <!-- Angular Material Library -->
    <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.0/angular-messages.js"></script>
</head>
<?php
    $radioButton1 = array("15%"=>"0.15","20%"=>"0.2");
    $radioButton2 = array("25%"=>"0.25","Custom"=>"-1");
?>
<body ng-controller="tipCalc" >
    <div flex layout="column" ng-cloak>
        <md-toolbar class="md-primary" layout="row" layout-align="center center">
            <div class="md-toolbar-tools">
                <span flex></span>
                <h2 class="md-flex">Tip Calculator</h2>
                <span flex></span>
            </div>
        </md-toolbar>
        <md-content flex layout-padding>
               <form layout="column" name="billForm">
                        <md-input-container>
                            <label>Bill Amount</label>
                            <input type="number" step="0.01" ng-model="value" required name="bill" min="0.01"/>
                        </md-input-container>
                        <div ng-messages="billForm.bill.$touched && billForm.bill.$error" style="display:inline-block;vertical-align:top;color: red;margin-top: 5px;">
                            <p ng-message="required">Please enter a bill amount</p>
                            <p ng-message="min">Bill amount should be atleast 1 cent</p>
                            <p ng-message="number">Please enter a valid value</p>
                        </div>
                        <div layout="row" layout-align="center">
                            <span></span>
                            <div layout="column">
                                <md-subheader class="md-primary">Tip Percentage: </md-subheader>

                                <md-radio-group layout="row" ng-model="percent">
                                    <div layout="column">
                                        <div layout="row">
                                            <?php
                                                foreach ($radioButton1 as $x => $x_value){
                                            ?>
                                            <md-radio-button value=<?php echo "$x_value"?>> <?php echo $x?></md-radio-button>
                                            <?php } ?>

                                        </div>
                                        <br>
                                        <div layout="row">
                                            <?php
                                            foreach ($radioButton2 as $x => $x_value){
                                            ?>
                                            <md-radio-button value=<?php echo "$x_value"?>> <?php echo $x?></md-radio-button>
                                            <?php } ?>

                                        </div>
                                        <br>
                                    </div>
                                </md-radio-group>

                                <div ng-hide="percent!=-1">
                                    <md-input-container>
                                        <label>Custom Amount</label>
                                        <input type="number" step="0.1" ng-model="custom">
                                    </md-input-container>
                                </div>
                                <span></span>
                            </div>
                        </div>
                        <br>
                        <md-button class="md-primary md-raised" md-no-ink ng-click="submitRequest()"
                        ng-disabled="billForm.bill.$dirty&&billForm.bill.$invalid || billForm.bill.$untouched&&billForm.bill.$error">Calculate</md-button>
               </form>

        </md-content>
    </div>


    <script type="text/javascript" src="main.js"></script>
</body>
</html>