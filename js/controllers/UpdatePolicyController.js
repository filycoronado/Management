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
        });
        $scope.save_customer = function () {
            $scope.ShowButon = true;
            $http.post('./Backend/web/index.php?r=api/save_client', {id_policy: id_policy, id_cliente: id_cliente, policy: $scope.policy}).then(function success(response) {
                alert(response.data.message);
            });
        };


    }]);