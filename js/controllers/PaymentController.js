app.controller('PaymentController', ['$rootScope', '$scope', '$filter', '$routeParams', '$http', '$timeout', function ($rootScope, $scope, $filter, $routeParams, $http, $timeout) {
        var id_policy = $routeParams.pol;
        var id_cliente = $routeParams.cus;
        $scope.ShowButon = false;
        $scope.cashiers = [];
        $scope.payment = {
            type_ins: "1",
            type_adc: "1",
            cashier: " ",
            status_transaction: "1",
        };
        $scope.endrose = {
            is_endrose: "1",
        };
        $http.get('./Backend/web/index.php?r=api/get_cashiers', {}).then(function success(response) {
            $scope.cashiers = response.data;
        });

        $scope.save_customer = function () {
            $scope.ShowButon = true;
            $http.post('./Backend/web/index.php?r=api/make_payment', {id_policy: id_policy, id_cliente: id_cliente, payment: $scope.payment,endorse:$scope.endrose}).then(function success(response) {
                alert(response.data.message);
            });
        };


    }]);