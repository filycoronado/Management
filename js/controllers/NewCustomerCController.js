app.controller('NewCustomerCController', ['$rootScope', '$scope', '$filter', '$routeParams', '$http', '$timeout', function ($rootScope, $scope, $filter, $routeParams, $http, $timeout) {
        $scope.ShowButon = false;
        $scope.client = {
            languaje: "1",
        };
        $scope.policy = {
            type: "1",
            company: "3",
            location: "1",
            adc_number: "",
        };
        $scope.Types_policies = [];
        $scope.companies = [];
        $scope.dealers = [];
        $scope.cashiers = [];

        $scope.dealership = {
            is_dealer: "2",
            typeDelivery: "1",
            dealer: "1",
        };
        $scope.payment = {
            type_ins: "1",
            type_adc: "1",
            cashier: " ",
            status_transaction: "1",

        };

        $http.get('./Backend/web/index.php?r=api/get_types', {}).then(function success(response) {
            $scope.Types_policies = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_companies', {}).then(function success(response) {
            $scope.companies = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_dealers', {}).then(function success(response) {
            $scope.dealers = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_cashiers', {}).then(function success(response) {
            $scope.cashiers = response.data;
        });



        $scope.save_customer = function () {
            $scope.ShowButon = true;
            $http.post('./Backend/web/index.php?r=api/save_client', {client: $scope.client, policy: $scope.policy, dealer: $scope.dealership, payment: $scope.payment}).then(function success(response) {
                alert(response.data.message);
            });
        };


    }]);