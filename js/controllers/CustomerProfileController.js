app.controller('CustomerProfileController', ['$rootScope', '$scope', '$filter', '$routeParams', '$http', '$timeout', function ($rootScope, $scope, $filter, $routeParams, $http, $timeout) {

        $scope.Client_ID = $routeParams.id;
        $scope.Customer;
        $scope.policies = [];
        $scope.companies = [];
        $scope.agents = [];
        $scope.policy_types = [];
        $http.get('./Backend/web/index.php?r=api/get_companies', {}).then(function success(response) {
            $scope.companies = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_agents', {}).then(function success(response) {
            $scope.agents = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_types', {}).then(function success(response) {
            $scope.policy_types = response.data;
        });
        $http.post('./Backend/web/index.php?r=api/get_customer_id', {id: $scope.Client_ID}).then(function success(response) {
            $scope.Customer = response.data;
        });
        $http.post('./Backend/web/index.php?r=api/get_policies_id', {id: $scope.Client_ID}).then(function success(response) {
            $scope.policies = response.data;
        });
        $scope.get_languaje = function (key_value) {
            var Languaje = "";
            switch (key_value) {
                case 1:
                    Languaje = "ENGLISH";
                    break;
                case 2:
                    Languaje = "SPANISH";
                    break;
            }
            return Languaje;
        };
        $scope.get_company = function (key_value) {
            var company_name = "";
            angular.forEach($scope.companies, function (value, key) {
                if (value.id === key_value) {
                    company_name = value.nombre + "";
                }
            });
            return company_name;
        };
        $scope.get_agent = function (key_value) {
            var Agent_name = "";
            angular.forEach($scope.agents, function (value, key) {
                if (value.id === key_value) {
                    Agent_name = value.user + "";
                }
            });
            return Agent_name;
        };
        $scope.get_policy_type = function (key_value) {
            var name_type = "";
            angular.forEach($scope.policy_types, function (value, key) {
                if (value.id === key_value) {
                    name_type = value.name + "";
                }
            });
            return name_type;
        };
        $scope.get_status = function (key_value) {

            var string = "";
            switch (key_value) {
                case 1:
                    string = "PENDING CANCELLATION";
                    break;
                case 2:
                    string = "CANCELLED NON-PAYMENT";
                    break;
                case 3:
                    string = "CANCELLED UW";
                    break;
                case 4:
                    string = "RETAINED";
                    break;
                case 5:
                    string = "REINSTATED";
                    break;
                case 6:
                    string = "CANCELLED SERVICE";
                    break;
                case 7:
                    string = "EXPIRED";
                    break;
                case 8:
                    string = "RENEWED";
                    break;
                case 9:
                    string = "PENDING RENEWAL";
                    break;
                case 10:
                    string = "NEW BUSINESS";
                    break;
                case 11:
                    string = "NO LONGER CLIENT";
                    break;
                case 12:
                    string = "UNDERWRITING";
                    break;
                case 13:
                    string = "FLAT CANCELLATION";
                    break;
                case 14:
                    string = "REWRITE";
                    break;
                case -5:
                    string = "INACTIVE";
                    break;

            }
            return string;
        };
    }]);