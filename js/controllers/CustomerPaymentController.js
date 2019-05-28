app.controller('CustomerPaymentController', ['$rootScope', '$scope', '$filter', '$routeParams', '$http', '$timeout', function ($rootScope, $scope, $filter, $routeParams, $http, $timeout) {
        $scope.ShowButon;
        $scope.service_id = $routeParams.id;
        $scope.service = {};
        $scope.pay = {
            total: 0,
            paid: 0,
            change: 0
        };






        $scope.calculate_price = function () {
            if ($scope.service.type_member === "3" && $scope.service.promosion === "1") {
                $scope.pay.total = 150;
            } else if ($scope.service.type_member === "3" && $scope.service.promosion === "2") {
                $scope.pay.total = 125;
            } else if ($scope.service.type_member === "3" && $scope.service.promosion === "3") {
                $scope.pay.total = 100;
            } else if ($scope.service.type_member === "1") {
                $scope.pay.total = 20;
                $scope.service.promosion = "1";
            } else if ($scope.service.type_member === "2") {
                $scope.pay.total = 50;
                $scope.service.promosion = "1";
            }
        };


        $scope.calculate_change = function () {
            if ($scope.pay.paid > $scope.pay.total) {
                $scope.pay.change = $scope.pay.paid - $scope.pay.total;
            } else {
                $scope.pay.change = 0;
            }
            $scope.get_enalbed();
        };
        $scope.get_enalbed = function () {
            if ($scope.pay.paid >= $scope.pay.total) {
                $scope.ShowButon = false;
            } else {
                $scope.ShowButon = true;
            }
        };
        $http.post('./Backend/web/index.php?r=api/get_service_by_id', {id: $scope.service_id}).then(function success(response) {
            $scope.service = response.data;
            $scope.service.type = $scope.service.type.toString();
            $scope.service.type_member = $scope.service.type_member.toString();
            $scope.service.promosion = $scope.service.promosion.toString();

            $scope.calculate_price();
            $scope.get_enalbed();

        });

        $scope.save_pay = function () {
            $http.post('./Backend/web/index.php?r=api/make_a_payment', {id: $scope.service_id, service: $scope.service, pay: $scope.pay}).then(function success(response) {
                $scope.service = response.data;
            });
        };
    }]);