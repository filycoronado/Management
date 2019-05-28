app.controller('transactionController', ['$rootScope', '$scope', '$filter', '$routeParams', '$http', '$timeout', function ($rootScope, $scope, $filter, $routeParams, $http, $timeout) {
        $scope.agents = [];
        $scope.transactions = [];
        $scope.cashiers = [];
        $scope.Customer_name = "";
        $scope.Customer_phone = "";

        $scope.sortingOrder = 'id';
        $scope.reverse = false;
        $scope.itemsPerPage = 50;
        $scope.currentPage = 1;

        $scope.companies = [];
        $http.get('./Backend/web/index.php?r=api/get_companies', {}).then(function success(response) {
            $scope.companies = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_agents', {id: $scope.transactions.id_usuario}).then(function success(response) {
            $scope.agents = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/transaction_user', {}).then(function success(response) {
            $scope.transactions = response.data;
        });



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
        $scope.get_cashier = function (key_value) {
            var cashier_name = "Whitout Cashier";
            angular.forEach($scope.agents, function (value, key) {
                if (value.id === key_value) {
                    cashier_name = value.user + "";
                }
            });
            return cashier_name;
        };


        $scope.SerachCustomer = function () {
            $http.post('./Backend/web/index.php?r=api/get_customer_actives', {name: $scope.Customer_name, phone: $scope.Customer_phone}).then(function success(response) {
                $scope.transactions = response.data;
            });
        };
        $scope.getData = function () {
            return $filter('filter')($scope.transactions, $scope.searchbox);
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

        $scope.get_type_member = function (key) {
            var String = "";
            switch (key) {
                case "1":
                    String = "Vista";
                    break;
                case "2":
                    String = "Semanal";
                    break;
                case "3":
                    String = "Mensual";
                    break;
            }
            return String;
        };

        $scope.get_service = function (key) {
            var String = "";
            switch (key) {
                case "1":
                    String = "GYM";
                    break;
                case "2":
                    String = "OTHER";
                    break;
                case "3":
                    String = "OTHER";
                    break;
            }
            return String;
        };

    }]);