app.controller('UpdatePolicyController', ['$rootScope', '$scope', '$filter', '$routeParams', '$http', '$timeout', function ($rootScope, $scope, $filter, $routeParams, $http, $timeout) {
        var id_policy = $routeParams.pol;
        var id_cliente = $routeParams.cus;
        $scope.ShowButon = false;

        $scope.policy = {

        };
        $scope.Types_policies = [];
        $scope.companies = [];


        $http.get('./Backend/web/index.php?r=api/get_types', {}).then(function success(response) {
            $scope.Types_policies = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_companies', {}).then(function success(response) {
            $scope.companies = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_dealers', {}).then(function success(response) {
            $scope.dealers = response.data;
        });
        $http.post('./Backend/web/index.php?r=api/get_policy_by_id', {id: id_policy}).then(function success(response) {
            $scope.policy = response.data;
            $scope.policy.company_id = $scope.policy.company_id + "";
            $scope.policy.policy_type = $scope.policy.policy_type + "";
            $scope.policy.location = $scope.policy.location + "";
            $scope.policy.status_policy = $scope.policy.status_policy + "";
            $scope.policy.date_cancellation = new Date($scope.policy.date_cancellation + "T12:00:00Z");
            $scope.policy.date_expiration = new Date($scope.policy.date_expiration + "T12:00:00Z");
        });
        $scope.save_customer = function () {
            $scope.ShowButon = true;
            $http.post('./Backend/web/index.php?r=api/update_policy', {id_policy: id_policy, id_cliente: id_cliente, policy: $scope.policy}).then(function success(response) {
                alert(response.data.message);
            });
        };
        $scope.set_value = function (key, keyvalue) {
            var value = (!keyvalue);
            switch (key) {
                case 1:
                    $scope.policy.aplication = value;
                    break;
                case 2:
                    $scope.policy.phoneNumber = value;
                    break;
                case 3:
                    $scope.policy.driverLicense = value;
                    break;
                case 4:
                    $scope.policy.registration = value;
                    break;
                case 5:
                    $scope.policy.pictures = value;
                    break;
                case 6:
                    $scope.policy.proofop = value;
                    break;
                case 7:
                    $scope.policy.adcsinged = value;
                    break;
                case 8:
                    $scope.policy.bank_info = value;
                    break;
                case 9:
                    $scope.policy.email_info = value;
                    break;
            }
        };
        $scope.Update_policy = function () {
            $http.post('./Backend/web/index.php?r=api/update_policy_status', {id_policy: id_policy, id_cliente: id_cliente, policy: $scope.policy}).then(function success(response) {
                alert(response.data.message);
            });
        };


    }]);