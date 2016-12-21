var myApp = angular.module('Tippy', ['ngMaterial','ngMessages']);
myApp.config(function($mdThemingProvider) {
    $mdThemingProvider.theme('default')
        .dark();
});
myApp.controller('tipCalc',['$scope','$http','$rootScope','sendRequest','$mdBottomSheet', function ($scope,$http, $rootScope,
                                                                                                    sendRequest,$mdBottomSheet) {
    $scope.title = "Tip Calculator"
    $scope.percent=0.18;
    $scope.submitRequest = function () {

        if($scope.percent!=-1)
            $rootScope.percent = $scope.percent;
        else
            $rootScope.percent = $scope.custom * 0.01;

        $rootScope.value = $scope.value;
        sendRequest.sendReq().then(function (data) {
            $scope.data = data;
            $scope.showResult();
        });
    }

    $scope.showResult = function () {
        $rootScope.data = $scope.data;

        $mdBottomSheet.show({
            templateUrl: 'bottomsheet.html',
            controller: 'bottomSheet'
        });
    };


}]);

myApp.service('sendRequest',['$rootScope', '$http','$q', function ($rootScope, $http, $q) {

    this.sendReq = function () {
        console.log($rootScope.value);
        console.log($rootScope.percent);
        var req = {
            method: 'POST',
            url: "http://localhost/calculate.php",
            data: {
                value: $rootScope.value,
                percent: $rootScope.percent,

            }
        };

        return $q(function (resolve, reject) {
            $http(req).then(function successCallback(response) {
                if(response.data){
                    $rootScope.data = response.data;
                    resolve(response.data);
                }else{
                    reject();
                }

            }, function error(response) {
                reject();
            });
        });
    }
    return this;

}]);

myApp.controller('bottomSheet',['$rootScope','$scope', function ($rootScope, $scope) {
    $scope.data = $rootScope.data;
    $scope.results = [
        {icon: 'add_location', value:$scope.data.tip, comment:'Tip'},
        {icon: 'filter_1',  value:$scope.data.total, comment: 'Total'},
        {icon: 'filter_2', value:$scope.data.split2, comment: 'Split Between Two'},
        {icon: 'filter_3', value:$scope.data.split3, comment: 'Split Between Three'},
        {icon: 'filter_4', value:$scope.data.split4, comment: 'Split Between Four'}
    ];
}]);