app.controller('SalesReportController', ['$rootScope', '$scope', '$filter', '$routeParams', '$http', '$timeout', function ($rootScope, $scope, $filter, $routeParams, $http, $timeout) {

        $scope.Customer_actives = [];
        $scope.report = {
            agency: "101",
            agent: "",
            type_policy: "1",
            company: "",
            cashier: "",
            payment_method: "",
            type_transaction: "",
            payment_method_adc: "",
            erase: "2",

        };

        $scope.sortingOrder = 'id';
        $scope.reverse = false;
        $scope.itemsPerPage = 50;
        $scope.currentPage = 1;



        $scope.companies = [];
        $scope.cashiers = [];
        $scope.agents = [];
        $scope.Types_policies = [];

        $http.get('./Backend/web/index.php?r=api/get_companies', {}).then(function success(response) {
            $scope.companies = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_agents', {}).then(function success(response) {
            $scope.agents = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_cashiers', {}).then(function success(response) {
            $scope.cashiers = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_types', {}).then(function success(response) {
            $scope.Types_policies = response.data;
        });

        $scope.SerachCustomer = function () {
            $http.post('./Backend/web/index.php?r=api/get_sales_report', {report: $scope.report}).then(function success(response) {
                $scope.Customer_actives = response.data;
            });
        };
        $scope.getData = function () {
            return $filter('filter')($scope.Customer_actives, $scope.searchbox);
        };

        $scope.numberOfPages = function () {

            return Math.ceil($scope.getData().length / $scope.itemsPerPage);
        };

        $scope.getTimes = function () {
            var times = $scope.numberOfPages();
            $scope.local_array = [];
            for (var i = 0; i < times; i++) {
                $scope.local_array.push(i);
            }
            return $scope.local_array;
        };

        $scope.resetPage = function () {
            $scope.currentPage = 1;
            $scope.getTimes();
        };

        // change sorting order
        $scope.sort_by = function (newSortingOrder) {
            if ($scope.sortingOrder == newSortingOrder)
                $scope.reverse = !$scope.reverse;

            $scope.sortingOrder = newSortingOrder;
        };

        $scope.displayingStart = function () {
            if ($scope.getData().length == 0 || $('#customer-table>tbody>tr').length == 0)
                return 0;
            else
                return ($scope.currentPage - 1) * $scope.itemsPerPage + 1;
        };

        $scope.displayingEnd = function () {
            return ($scope.currentPage - 1) * $scope.itemsPerPage + $('#customer-table>tbody>tr').length;
        };


        $scope.change_page = function (key) {
            $scope.currentPage = key;

        };

        $scope.get_agent = function (keyvalue) {
            var name = "";
            angular.forEach($scope.agents, function (value, key) {

                if (value.id == keyvalue) {

                    name = value.user;
                    return false;
                }
            });
            return name;
        };
        $scope.get_company = function (keyvalue) {
            var name = "";
            angular.forEach($scope.companies, function (value, key) {

                if (value.id == keyvalue) {

                    name = value.nombre;
                    return false;
                }
            });
            return name;
        };

        $scope.get_pm = function (keyvalue) {
            if (keyvalue == 1) {
                return "Cash";
            } else if (keyvalue == 2) {
                return "Card";
            }
        };

    }]);