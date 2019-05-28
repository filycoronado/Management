app.controller('CsutomerEditController', ['$rootScope', '$scope', '$filter', '$routeParams', '$http', '$timeout', function ($rootScope, $scope, $filter, $routeParams, $http, $timeout) {
        var id = $routeParams.id;
        $scope.ShowButon = false;
        $scope.client = {
            languaje: "1",
        };

        $http.post('./Backend/web/index.php?r=api/get_customer_id', {id: id}).then(function success(response) {
            $scope.client = response.data;
            $scope.client.languajePrefernce = $scope.client.languajePrefernce + "";
            $scope.client.dob = new Date($scope.client.dob  + "T12:00:00Z");
        });
        $scope.save_customer = function () {
            $scope.ShowButon = true;
            $http.post('./Backend/web/index.php?r=api/update_customer', {id:id,client: $scope.client, }).then(function success(response) {
                alert(response.data.message);
            });
        };

    }]);